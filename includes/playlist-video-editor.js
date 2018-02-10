// JavaScript Document

/***** START BOILERPLATE CODE: Load client library, authorize user. *****/

// Global variables for GoogleAuth object, auth status.


/**
 * Load the API's client and auth2 modules.
 * Call the initClient function after the modules load.
 */
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
    if (isAuthorized) {
    }
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
        console.log(response);
        console.log(videoUpdate);
        if (videoUpdate === false) {
            snippet = response.items[0].snippet;
            categoryId = snippet.categoryId;
            videoId = response.items[0].id;
            title = snippet.title;
            description = snippet.description;
            tags = snippet.tags;
            channel = snippet.channelTitle;
            channel = snippet.channelTitle;
            language = snippet.defaultLanguage;
            categoryId = snippet.categoryId;
            $('#language').val(language);
            $('#category').val(categoryId);
            $('#title').val(title);
            $('#description').val(description);
            $('#tags').val(tags);
            $('#channelTitle').val(channel);
            $('#videoId').text(videoId);
            $('#description').simplyCountable();
            $('#tags').simplyCountable({
                counter: '#counter2',
                countType: 'characters',
                maxCount: 500,
                countDirection: 'up'
            });
            autosize.update($('#description'));
            autosize.update($('#tags'));
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
    console.log(request);
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

function update() {
    "use strict";
    videoUpdate = true;
    title = $('#title').val();
    description = $('#description').val();
    tags = getTags();
            console.log( tags );
    // Sample js code for videos.update

// See full sample for buildApiRequest() code, which is not 
// specific to a particular youtube or youtube method.

buildApiRequest('PUT',
                '/youtube/v3/videos',
                {'part': 'snippet'},
                {'id': videoId,
                 'snippet.categoryId': '19',
                 'snippet.defaultLanguage': 'en',
                 'snippet.description': description,
                 'snippet.tags': tags,
                 'snippet.title': title
      });
    $('#reporter').text('updated!');
}
function getTags(){
    "use strict";
    var stringTags = $('#tags').val();
    return stringTags.split(',');
}
