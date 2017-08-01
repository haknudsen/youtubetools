// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken, i = 0, videoList = Array(),  video, description;
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
            var playlistId = playlist.replace("https://www.youtube.com/playlist?list=", "");
            requestVideoPlaylist(playlistId);
        });

    });
}

// Retrieve the list of videos in the specified playlist.
function requestVideoPlaylist(playlistId, pageToken) {
    "use strict";
    $('#description').html('');
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
        prevPageToken = response.result.prevPageToken
        var prevVis = prevPageToken ? 'visible' : 'hidden';
        $('#prev-button').css('visibility', prevVis);

        var playlistItems = response.result.items;
        if (playlistItems) {
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
        } else {
            $('#video-ids').html('Sorry you have no uploaded videos');
        }
    });
}


// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var title = videoSnippet.title;
    var videoId = videoSnippet.resourceId.videoId;
    $('#video-ids').append($('<option>', {
        value: videoId,
        text: title
    }));
    i++;
}




