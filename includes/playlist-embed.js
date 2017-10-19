// Define some variables used to remember state.
var nextPageToken, prevPageToken, i = 0,
    videoList = Array(),
    list = Array(),
    center,
    anchor = '<iframe type="text/html" style="margin: 0 auto;display:block"  width="640" height="360" src="https://www.youtube.com/embed/',
    left = '<div style="position: relative; padding-bottom: 56.25%;  height: 0; overflow: hidden;"><iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/',
    frameEnd = '?autoplay=1&loop=1&rel=0" frameborder="0"></iframe>',
    description, title, spin;

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
$('#embed-left').click(function () {
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
                spin += "</div>";
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
    title = String(videoSnippet.title);
    description = String(videoSnippet.description);
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
        info += "</div>";
    }
    list[i] = info;
    videoList[i] = videoURL;
    i++;
}

function fixTitle(title) {
    "use strict";
    title = title.toString();
    title = title.replace(/,/g, ' ').trim();
    return title.replace(/\|/g, '');
}

function fixDescription(description) {
    "use strict";
    description = description.toString().split(/\n/);
    description = description[0];
    console.log('d- ' + description);
    return description;
}
$.fn.extend({
    autoresize: function () {
        $(this).on('change keyup keydown paste cut', function () {
            $(this).height(0).height(this.scrollHeight);
        }).change();
    }
});
