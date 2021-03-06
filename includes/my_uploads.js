// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken, link;
var i = 0;
var videoList = Array();
var playlistItems;
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
    $('#video-container').val('');
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

        playlistItems = response.result.items;
        if (playlistItems) {
            console.log(playlistItems.length);
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
            createList();
            autosize.update($('#video-container'));
            autosize.update($('#spin'));
        } else {
            $('#video-container').val('Sorry you have no uploaded videos');
        }
    });
}

function createList() {
    "use strict";
    var spin = "{";
    for (var l = 0; l < videoList.length; l++) {
        if (l > 0) {
            spin += "|" + videoList[l];
        } else {
            spin += videoList[l];
        }
    }
    spin += "}";
    $('#spin').text(spin);
    autosize.update($('#spin'));
}
// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var videoId = videoSnippet.resourceId.videoId;
    var videoURL = videoId;
    link = 'https://www.youtube.com/watch?v=' + videoURL;
    if (i < playlistItems.length-1) {
        link = link + '\n';
    }
    $('#video-container').val($('#video-container').val() + link);
    videoList[i] = videoURL;
    console.log(i);
    i++;
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
$('#sendClick').click(function () {
    $.ajax({
        url: "save.php",
        data: {
            videoList: videoList,
            playlistId: playlistId
        },
        type: 'post',
        success: function (data) {
            $('#idList').html(data);
        }
    });
});
