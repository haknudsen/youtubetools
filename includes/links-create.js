// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken;
var i = 0;
var videoList = Array();
var ytUrls = ["http://y2u.be/XXXXXX","http://youtu.be/XXXXXX","https://youtu.be/XXXXXX","http://m.youtu.be/XXXXXX","https://m.youtu.be/XXXXXX","http://youtube.com/e/XXXXXX","http://youtube.com/v/XXXXXX","http://youtube.com/e/XXXXXX","https://youtube.com/e/XXXXXX","https://youtube.com/v/XXXXXX","http://m.youtube.com/e/XXXXXX","https://m.youtube.com/v/XXXXXX","https://m.youtube.com/e/XXXXXX","https://m.youtube.com/v/XXXXXX","http://www.youtube.com/e/XXXXXX","http://www.youtube.com/v/XXXXXX","http://youtube.com/embed/XXXXXX","https://youtube.com/embed/XXXXXX","https://www.youtube.com/e/XXXXXX","https://youtube.com/embed/XXXXXX","https://www.youtube.com/v/XXXXXX","http://m.youtube.com/embed/XXXXXX","http://youtube.com/watch?v=XXXXXX","https://m.youtube.com/embed/XXXXXX","https://youtube.com/watch?v=XXXXXX","http://www.youtube.com/embed/XXXXXX","http://m.youtube.com/watch?v=XXXXXX","https://m.youtube.com/watch?v=XXXXXX","https://www.youtube.com/embed/XXXXXX","http://m.www.youtube.com/embed/XXXXXX","http://www.youtube.com/watch?v=XXXXXX","http://youtube.com/v/XXXXXX?version=3","http://www.youtube.com/watch?v=XXXXXX","https://www.youtube.com/watch?v=XXXXXX","https://youtube.com/v/XXXXXX?version=3","http://youtube.com/e/XXXXXX?app=desktop","https://youtube.com/e/XXXXXX?app=desktop","http://www.youtube.com/v/XXXXXX?version=3","https://www.youtube.com/v/XXXXXX?version=3","http://www.youtube.com/v/XXXXXX&feature=kp","http://www.youtube.com/e/XXXXXX?app=desktop","https://www.youtube.com/v/XXXXXX&feature=kp","https://www.youtube.com/watch?v=XXXXXX&app=m","https://www.youtube.com/e/XXXXXX?app=desktop","http://youtube.com/watch?v=XXXXXX&app=desktop","http://www.youtube.com/v/XXXXXX&feature=share","https://www.youtube.com/v/XXXXXX&feature=share","https://youtube.com/watch?v=XXXXXX&app=desktop","http://www.youtube.com/watch?v=XXXXXX&feature=kp","http://www.youtube.com/v/XXXXXX&feature=youtu.be","https://www.youtube.com/watch?v=XXXXXX&app=mobile","https://www.youtube.com/v/XXXXXX&feature=youtu.be","http://www.youtube.com/watch?v=XXXXXX&app=desktop","https://www.youtube.com/watch?v=XXXXXX&feature=kp","http://youtube.com/watch?feature=youtu.be&v=XXXXXX","https://www.youtube.com/watch?v=XXXXXX&app=desktop","http://youtube.com/watch?feature=youtu.be&v=XXXXXX","https://youtube.com/watch?feature=youtu.be&v=XXXXXX","https://www.youtube.com/watch?v=XXXXXX&feature=share","http://www.youtube.com/v/XXXXXX&feature=youtube_gdata","https://www.youtube.com/v/XXXXXX&feature=youtube_gdata","http://www.youtube.com/watch?v=XXXXXX&feature=youtu.be","https://www.youtube.com/watch?v=XXXXXX&hc_location=ufi","http://www.youtube.com/watch?feature=youtu.be&v=XXXXXX","http://youtube.com/watch?feature=youtube_gdata&v=XXXXXX","https://www.youtube.com/watch?feature=youtu.be&v=XXXXXX","https://www.youtube.com/watch?v=XXXXXX&feature=youtu.be","https://youtube.com/watch?feature=youtube_gdata&v=XXXXXX","http://www.youtube.com/watch?feature=youtube.be&v=XXXXXX","https://youtube.com/watch?feature=youtube_gdata&v=XXXXXX","http://youtube.com/watch?feature=player_embedded&v=XXXXXX","https://www.youtube.com/watch?feature=youtube.be&v=XXXXXX","http://youtube.com/watch?feature=player_embedded&v=XXXXXX","https://youtube.com/watch?feature=player_embedded&v=XXXXXX","https://www.youtube.com/watch?feature=youtube_gdata&v=XXXXXX","http://www.youtube.com/watch?feature=youtube_gdata&v=XXXXXX","http://m.youtube.com/watch?feature=player_embedded&v=XXXXXX","https://m.youtube.com/watch?v=XXXXXX&feature=youtube_gdata","http://www.youtube.com/watch?v=XXXXXX&feature=youtube_gdata","https://www.youtube.com/watch?v=XXXXXX&feature=youtube_gdata","https://m.youtube.com/watch?feature=player_embedded&v=XXXXXX","http://www.youtube.com/watch?feature=player_embedded&v=XXXXXX","https://www.youtube.com/watch?feature=player_embedded&v=XXXXXX","http://m.www.youtube.com/watch?feature=player_embedded&v=XXXXXX","https://www.youtube.com/attribution_link?a=XXXXXX&u=watch?v=XXXXXX&feature=share","https://www.youtube.com/attribution_link?a=XXXXXX&u=%2Fwatch%3Fv%3DXXXXXX%26feature%3Dshare"];

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
        prevPageToken = response.result.prevPageToken
        var prevVis = prevPageToken ? 'visible' : 'hidden';
        $('#prev-button').css('visibility', prevVis);

        var playlistItems = response.result.items;
        if (playlistItems) {
            console.log(playlistItems.length);
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
            createList();
        } else {
            $('#video-container').html('Sorry you have no uploaded videos');
        }
    });
}

function createList() {
    "use strict";
    var spin = "";
    for (var l = 0; l < videoList.length; l++) {
        if (l > 0) {
            spin += "|" + videoList[l];
        } else {
            spin += videoList[l];
        }
    }
    $('#spin').text(spin);
}
// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var title = videoSnippet.title;
    var videoId = videoSnippet.resourceId.videoId;
    var videoURL = videoId;
    $('#video-container').append('https://www.youtube.com/watch?v=' + videoURL + '<br />');
    videoList[i] = videoURL;
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
    console.log(videoList);
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
