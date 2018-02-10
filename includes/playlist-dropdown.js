// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken;
var videoList = Array();
var GoogleAuth, title, description, channel, snippet, videoId, getVideo, categoryId,privacy,language,isAuthorized;
var tags = Array();
var videoUpdate = true;
// After the API loads, call a function to get the uploads playlist ID.
function handleAPILoaded() {
    "use strict";
    requestUserUploadsPlaylistId();
}

// Call the Data API to retrieve the playlist ID that uniquely identifies the
// list of videos uploaded to the currently authenticated user's channel.
function requestUserUploadsPlaylistId() {
    "use strict";
    // See https://developers.google.com/youtube/v3/docs/channels/list
    var request = gapi.client.youtube.channels.list({
        mine: true,
        part: 'contentDetails'
    });
    request.execute(function (response) {
        $('#playlistClick').click(function () {
            var playlist = $('#playlist').val();
            var playlistId = playlist.substring(playlist.lastIndexOf("=") + 1);
            requestVideoPlaylist(playlistId);
        });

    });
}

// Retrieve the list of videos in the specified playlist.
function requestVideoPlaylist(playlistId, pageToken) {
    "use strict";
    $('#video-container').html('');
    var requestOptions = {
        playlistId: playlistId,
        part: 'snippet',
        maxResults: 50
    };
    if (pageToken) {
        requestOptions.pageToken = pageToken;
    }
    var request = gapi.client.youtube.playlistItems.list(requestOptions);
    request.execute(function (response) {
        // Only show pagination buttons if there is a pagination token for the
        // next or previous page of results.
        nextPageToken = response.result.nextPageToken;
        var nextVis = nextPageToken ? 'visible' : 'hidden';
        $('#next-button').css('visibility', nextVis);
        prevPageToken = response.result.prevPageToken;
        var prevVis = prevPageToken ? 'visible' : 'hidden';
        $('#prev-button').css('visibility', prevVis);
        var playlistItems = response.result.items;
        $('#editor-section').removeClass("alert-warning");
        $('#editor-section').addClass("alert-success");
        if (playlistItems) {
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
            $("#reporter").text($("#optionlist option:first").val());
        } else {
            $('#video-container').html('Sorry you have no uploaded videos');
        }
        $('#optionlist').on('change',function(){
            console.log( 'hit ' );
            $('#reporter').text($('#optionlist').val());
            getResults();
        });
    });
}
//get results

       function getResults() {
            videoUpdate = false;
            getVideo = $('#reporter').text();
            defineRequest(getVideo);
        }
        $('#update').click(function () {
            update();
        });
// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var videoId = videoSnippet.resourceId.videoId;
    $('#optionlist').append('<option value="' + videoId + '">' + videoId + '</option>');
}

// Retrieve the next page of videos in the playlist.
function nextPage() {
    "use strict";
    requestVideoPlaylist(playlistId, nextPageToken);
}

// Retrieve the previous page of videos in the playlist.
function previousPage() {
    "use strict";
    requestVideoPlaylist(playlistId, prevPageToken);
}
