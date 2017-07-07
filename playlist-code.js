// JavaScript Document
// Define some variables used to remember state.
var playlistId, channelId;

// After the API loads, call a function to enable the playlist creation form.
function handleAPILoaded() {
    enableForm();
}

// Enable the form for creating a playlist.
function enableForm() {
    $('#playlist-button').attr('disabled', false);
}

// Create a private playlist.
function createPlaylist() {
    var playlistName = $('#playlist-name').val();
    var playlistDescription = $('#playlist-description-new').val();
    var request = gapi.client.youtube.playlists.insert({
        part: 'snippet,status',
        resource: {
            snippet: {
                title: playlistName,
                description: playlistDescription
            },
            status: {
                privacyStatus: 'public'
            }
        }
    });
    request.execute(function (response) {
        var result = response.result;
        if (result) {
            playlistId = result.id;
            $('#playlist-id').val(playlistId);
            $('#playlist-title').html(result.snippet.title);
            $('#playlist-description').html(result.snippet.description);
        } else {
            $('#status').html('Could not create playlist');
        }
    });
}

// Add a video ID specified in the form to the playlist.
function addVideoToPlaylist() {
    addToPlaylist($('#video-id').val());
}

<<<<<<< HEAD
// Add a video to a playlist. The "startPos" and "endPos" values let you
// start and stop the video at specific times when the video is played as
// part of the playlist. However, these values are not set in this example.
function addToPlaylist(id, startPos, endPos) {
    var listId = $('#playlist-id').val();
    var list = id.split("|");
    var request;
    for (var i = 0; i < list.length; i++) {
        var details = {
            videoId: list[i],
            kind: 'youtube#video'
        };
        request = gapi.client.youtube.playlistItems.insert({
            part: 'snippet',
            resource: {
                snippet: {
                    playlistId: listId,
                    resourceId: details
                }
            }
        });
    }
    request.execute(function (response) {
        $('#status').html('<pre>' + JSON.stringify(response.result) + '</pre>');
        console.log(details);
    });
=======
// Add a video to a playlist. 
function addToPlaylist(id) {
    var listId = $('#playlist-id').val();
    var list = id.split("|");
    for (var i = 0; i < list.length; i++) {
        sendRequest(list[i]);
    }

    function sendRequest(details) {
        console.log(details);
        buildApiRequest('POST',
            '/youtube/v3/playlistItems', {
                'part': 'snippet',
                'onBehalfOfContentOwner': ''
            }, {
                'snippet.playlistId': 'PL4Uv4nlnj1Gapl0GjGl30tfxRe2bA1W7e',
                'snippet.resourceId.kind': 'youtube#video',
                'snippet.resourceId.videoId': 'M7FIvfx5J10',
                'snippet.position': ''
            });
    }
>>>>>>> youtubetools/master
}