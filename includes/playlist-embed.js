// Define some variables used to remember state.
var nextPageToken, prevPageToken, i = 0,
    videoList = Array(),
    list = Array(),
    center,
    spin;
    var anchor = '<div style="width: 100%;max-width:1280px;margin:0 auto;padding:1rem">\n  <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">\n    <iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/';
    var left = '<div style="width: 50%;max-width:1280px;float:left;padding-right:1rem">\n  <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">\n    <iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/';
    var frameEnd = '?autoplay=1&loop=1&rel=0" frameborder="0"></iframe>\n  </div>\n</div>'; n
    var leftEnd = '\n  </div>\n</div>';
 

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
}
$('#reset').click(function () {
    "use strict";
    console.log('reset');
    $('#playlist').text('');
    $('#link-container').val('');
    $('#spintax').val('');
});
$('#embed-center').click(function () {
    "use strict";
    center = true;
    getPlaylist();
});
$('#responsive').click(function () {
    "use strict";
    console.log('hit');
    center = false;
    getPlaylist();
});

function getPlaylist() {
    "use strict";
    $('#link-container').val('');
    var playlist = $('#playlist').val();
    var playlistId = playlist.substring(playlist.lastIndexOf("=") + 1);
    requestVideoPlaylist(playlistId);
}
// Retrieve the list of videos in the specified playlist.
function requestVideoPlaylist(playlistId, pageToken) {
    "use strict";
    $('#link-container').html('');
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
        if (playlistItems) {
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
            var $link = $('#link-container');
            $link.val(list);
            $link.val($('#link-container').val().replace(/,/g, '\n'));
            $link.autoresize();
            if (center) {
                spin = anchor;
            } else {
                spin = left;
            }
            var spintax = "{";
            for (var l = 0; l < videoList.length; l++) {
                if (l > 0) {
                    spintax += '|' + videoList[l];
                } else {
                    spintax += videoList[l];
                }
            }
            spintax += '}';
            spin += spintax;
            spin += frameEnd;
            if (!center) {
                spin += leftEnd;
            }
            $('#playlistID').val(playlistId);
            $('#spintax').val(spin);
            $('#spintax').autoresize();
        } else {
            $('#link-container').html('Sorry you have no uploaded videos');
        }
    });
}


// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var videoId = videoSnippet.resourceId.videoId,
        videoURL = videoId,
        info = "";
    if (center) {
        info = anchor;
    } else {
        info = left;
    }
    info += videoURL + frameEnd;
    if (!center) {
        info += leftEnd;
    }
     info += '\n';
    list[i] = info;
    videoList[i] = videoURL;
    i++;
}

$.fn.extend({
    autoresize: function () {
    "use strict";
        $(this).on('change keyup keydown paste cut', function () {
            $(this).height(0).height(this.scrollHeight);
        }).change();
    }
});
