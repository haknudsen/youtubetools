// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken;
var i = 0;
var videoList = Array();
var list = Array();
var max = true;
var embed = false;
var anchor = false;
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
            getPlaylist();
        });
    });
}
$('#maxresdefault').click(function () {
    embed = false;
    anchor = false;
    max = true;
    getPlaylist();
});
$('#mqdefault').click(function () {
    embed = false;
    anchor = false;
    max = false;
    getPlaylist();
});
$('#anchor-image').click(function () {
    max = false;
    embed = true;
    anchor = true;
    getPlaylist();
});
$('#embed-image').click(function () {
    max = false;
    embed = true;
    anchor = false;
    getPlaylist();
});

function getPlaylist() {
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
            console.log(playlistItems.length);
            $.each(playlistItems, function (index, item) {
                displayResult(item.snippet);
            });
         $('#link-container').val(list);
            $('#link-container').val($('#link-container').val().replace(/,/g, '\n'));
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
    console.log('title'+title);
    console.log(anchor + '- ' + embed + '-' + max);
    if(anchor){
        info = '<a href="https://www.youtube.com/watch?v=' + videoURL + '"><img src="//img.youtube.com/vi/' + videoURL  + '/mqdefault.jpg" alt="' + title + '"/></a>';
    }else{
    if (embed) {
        info = '<img src="//img.youtube.com/vi/' + videoURL;
    } else {
        info = 'https://img.youtube.com/vi/' + videoURL;
    }
    if (max) {
        info += '/maxresdefault.jpg';
    } else {
        info += '/mqdefault.jpg';
    }
    if (embed) {
        info += '" alt="' + title + '"/>';
    }
        
    }
    list[i] = info;
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
