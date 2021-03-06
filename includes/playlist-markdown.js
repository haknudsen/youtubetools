// Define some variables used to remember state.
var nextPageToken, prevPageToken, i = 0,
    videoList = Array(),
    list = Array(),
    embed,title,videoURL,videoId,description,info,
    anchor = 'https://www.youtube.com/watch?v=';

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
$('#clear').click(function () {
    "use strict";
    $('#playlist').val('');
    $('#link-container').val('');
    $('#playlistID').val('');
});
$('#anchor-title').click(function () {
    "use strict";
    embed = 'title';
    getPlaylist();
});
$('#anchor-description').click(function () {
    "use strict";
    embed = 'description';
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
            autosize.update($link);

            $('#playlistID').val(title);
        } else {
            $('#link-container').html('Sorry you have no uploaded videos');
        }
    });
}


// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
        title = String(videoSnippet.title);
        videoId = videoSnippet.resourceId.videoId;
        videoURL = videoId;
        description = String(videoSnippet.description);
        info = "";
    title = fixTitle(title);
    description = fixDescription(description);
    info = '[';
    switch (embed) {
        case 'title':
            info += title;
            break;
        case 'description':
            info += description.split('.')[0];
            break;
    }
    info += '](';
    info += anchor + videoURL + ')';
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
    description = description.split('\n');
    console.log('d- ' + description);
    return description[0];
}
