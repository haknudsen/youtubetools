// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken, i = 0,
    videoList = Array(),
    list = Array(),
    max = true,
    embed,
    maxjpg = '/maxresdefault.jpg',
    mqjpg = '/mqdefault.jpg',
    anchor = '<a href="https://www.youtube.com/watch?v=',
    image = '<img src="https://img.youtube.com/vi/';

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
$('#anchor-title').click(function () {
    "use strict";
    embed = 'title';
    getPlaylist();
});
$('#anchor-tags').click(function () {
    "use strict";
    embed = 'tags';
    getPlaylist();
});
$('#anchor-image').click(function () {
    "use strict";
    embed = 'image';
    getPlaylist();
});

function getPlaylist() {
    "use strict";
    $('#link-container').val('');
    var playlist = $('#playlist').val();
    var playlistId = playlist.replace("https://www.youtube.com/playlist?list=", "");
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
            var spin = 'https://img.youtube.com/vi/';
            spin += "{";
            for (var l = 0; l < videoList.length; l++) {
                if (l > 0) {
                    spin += "|" + videoList[l];
                } else {
                    spin += videoList[l];
                }
            }
            spin += "}";
            if (max) {
                spin += maxjpg;
            } else {
                spin += mqjpg;
            }
            $('#spintax').val(spin);
            $('#spintax').autoresize();
            $('#playlistID').val(playlistId);
        } else {
            $('#link-container').html('Sorry you have no uploaded videos');
        }
    });
}


// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var title = String(videoSnippet.title),
        videoId = videoSnippet.resourceId.videoId,
        videoURL = videoId,
        info = "";
    title = title.replace(/\|/g, ' ').trim();
    title = title.replace('  ', ' ').trim();
    title = title.replace(/\n/g, '').trim();
    info = anchor + videoURL + '">';
    switch (embed) {
        case 'title':
            info += title;
            break;
        case 'tags':
            info += title;
            break;
        case 'image':
            info += image + videoURL + mqjpg + '" alt="' + title + '"/>';
            break;
    }
    info += '</a>';
    list[i] = info;
    videoList[i] = videoURL;
    i++;
}
$.fn.extend({
    autoresize: function () {
        $(this).on('change keyup keydown paste cut', function () {
            $(this).height(0).height(this.scrollHeight);
        }).change();
    }
});
