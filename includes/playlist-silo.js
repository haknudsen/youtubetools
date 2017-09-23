// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken, GoogleAuth, snippet, videoId, getVideo, categoryId, isAuthorized, i, count,desRec;
var updated = Array();
var phrase = Array();
var videoList = Array();
var description = Array();
var videoUpdate = true;
var link = 'https://youtu.be/';
var counter = 0;
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
            $("#reporter").text(videoList);
            $('#count').text(videoList.length);
            autosize.update($('#reporter'));
            videoUpdate = false;
            i = 0;
            count = 1;
            while (videoList[i]) {
                defineRequest(videoList[i]);
                phrase[i] = $('#phrase').val() + ' ' + link + videoList[count];
                console.log(count + ':' + videoList[i] + ':' + phrase[i]);
                count++;
                if (count > videoList.length - 1) {
                    count = 0;
                }
                i++;
            }
        } else {
            $('#video-container').html('Sorry you have no uploaded videos');
        }
    });
}
$('#complete').click(function () {
    "use strict";
    i = 0;
    videoUpdate = true;
    while (videoList[i]) {
        updated[i] = description[i] + '\n' + phrase[i];
        console.log(updated[i]);
        buildApiRequest('PUT',
            '/youtube/v3/videos', {
                'part': 'snippet'
            }, {
                'id': videoList[i],
                'snippet.categoryId': '19',
                'snippet.description': updated[i]
            });
        i++;
    }
    $('#success').text('updated!');
});
// Create a listing for a video.
function displayResult(videoSnippet) {
    "use strict";
    var videoId = videoSnippet.resourceId.videoId;
    videoList[counter] = videoId;
    description[counter] = desRec;
    console.log( description[counter] );
    counter++;
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

function handleClientLoad() {
    "use strict";
    gapi.load('client:auth2', initClient);
}

function initClient() {
    "use strict";
    // Initialize the gapi.client object, which app uses to make API requests.
    // Get API key and client ID from API Console.
    // 'scope' field specifies space-delimited list of access scopes

    gapi.client.init({
        'clientId': '90875073625-ff3ntj9kehegnbamaoace12q6lo37v6u.apps.googleusercontent.com',
        'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest'],
        'scope': 'https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner'
    }).then(function () {
        GoogleAuth = gapi.auth2.getAuthInstance();

        // Listen for sign-in state changes.
        GoogleAuth.isSignedIn.listen(updateSigninStatus);

        // Handle initial sign-in state. (Determine if user is already signed in.)
        setSigninStatus();

        // Call handleAuthClick function when user clicks on "Authorize" button.
        $('#execute-request-button').click(function () {
            handleAuthClick(event);
        });
    });
}

function handleAuthClick(event) {
    "use strict";
    // Sign user in after click on auth button.
    GoogleAuth.signIn();
}

function setSigninStatus() {
    "use strict";
    var user = GoogleAuth.currentUser.get();
    isAuthorized = user.hasGrantedScopes('https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtubepartner');
    // Toggle button text and displayed statement based on current auth status.
    if (isAuthorized) {}
}

function updateSigninStatus(isSignedIn) {
    "use strict";
    setSigninStatus();
}

function createResource(properties) {
    "use strict";
    var resource = {};
    var normalizedProps = properties;
    for (var p in properties) {
        var value = properties[p];
        if (p && p.substr(-2, 2) == '[]') {
            var adjustedName = p.replace('[]', '');
            if (value) {
                normalizedProps[adjustedName] = value.split(',');
            }
            delete normalizedProps[p];
        }
    }
    for (var p in normalizedProps) {
        // Leave properties that don't have values out of inserted resource.
        if (normalizedProps.hasOwnProperty(p) && normalizedProps[p]) {
            var propArray = p.split('.');
            var ref = resource;
            for (var pa = 0; pa < propArray.length; pa++) {
                var key = propArray[pa];
                if (pa == propArray.length - 1) {
                    ref[key] = normalizedProps[p];
                } else {
                    ref = ref[key] = ref[key] || {};
                }
            }
        };
    }
    return resource;
}

function removeEmptyParams(params) {
    "use strict";
    for (var p in params) {
        if (!params[p] || params[p] == 'undefined') {
            delete params[p];
        }
    }
    return params;
}

function executeRequest(request) {
    "use strict";
    request.execute(function (response) {
        if (videoUpdate === false) {
            snippet = response.items[0].snippet;
            categoryId = snippet.categoryId;
            videoId = response.items[0].id;
            desRec = snippet.description;
            console.log( i + ':' + snippet.description );
        }
    });
}

function buildApiRequest(requestMethod, path, params, properties) {
    "use strict";
    params = removeEmptyParams(params);
    var request;
    if (properties) {
        var resource = createResource(properties);
        request = gapi.client.request({
            'body': resource,
            'method': requestMethod,
            'path': path,
            'params': params
        });
    } else {
        request = gapi.client.request({
            'method': requestMethod,
            'path': path,
            'params': params
        });
    }
    executeRequest(request);
}

/***** END BOILERPLATE CODE *****/


function defineRequest(getVideo) {
    "use strict";
    // See full sample for buildApiRequest() code, which is not 
    // specific to a particular youtube or youtube method.

    buildApiRequest('GET',
        '/youtube/v3/videos', {
            'id': getVideo,
            'part': 'snippet'
        });

}
// the end!!!
