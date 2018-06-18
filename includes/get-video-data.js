// JavaScript Document

/***** START BOILERPLATE CODE: Load client library, authorize user. *****/

// Global variables for GoogleAuth object, auth status.
var GoogleAuth, title, description, snippet, videoId, getVideo, language, isAuthorized, short;
var tags = Array();

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
		$('#getVideo').addClass('btn-green');
		$('#execute-request-button').prop("disabled", true);
		$('#getVideo').click(function () {
			getVideo = $('#video').val();
			/*			getVideo = getVideo.substring(getVideo.lastIndexOf("=") + 1);*/
			defineRequest(getVideo);
		});
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
		if (p && p.substr(-2, 2) === '[]') {
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
				if (pa === propArray.length - 1) {
					ref[key] = normalizedProps[p];
				} else {
					ref = ref[key] = ref[key] || {};
				}
			}
		}
	}
	return resource;
}

function removeEmptyParams(params) {
	"use strict";
	for (var p in params) {
		if (!params[p] || params[p] === 'undefined') {
			delete params[p];
		}
	}
	return params;
}

function executeRequest(request) {
	"use strict";
	request.execute(function (response) {
		createSitemap();
		console.log(response);
		var items = response.items;
		var i = 0;
		while (items[i]) {
			snippet = items[i].snippet;
			videoId = items[i].id;
			tags = snippet.tags;
			short = snippet.description.substr(0, 200).replace(/\n/g, " ") + "...";
			addVideo();
			i++;
		}
		closeMap();
		autosize.update($('#sitemap'));
	});
}

function createSitemap() {
	"use strict";
	$('#sitemap').val("");
	$('#sitemap').val($('#sitemap').val() + '<?xml version="1.0" encoding="UTF-8"?>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '<url>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '<loc>' + $('#loc').val() + '</loc>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '<changefreq>' + $('#changefreq').val() + '</changefreq>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '<priority>' + $('#priority').val() + '</priority>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	console.log('sitemap start');
}

function addVideo() {
	"use strict";
	$('#sitemap').val($('#sitemap').val() + '<video:video>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	$('#sitemap').val($('#sitemap').val() + '<video:player_loc allow_embed="yes">http://www.youtube.com/v/' + videoId + '</video:player_loc>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	$('#sitemap').val($('#sitemap').val() + '<video:thumbnail_loc>http://img.youtube.com/vi/' + videoId + 'maxresdefault.jpg</video:thumbnail_loc>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	$('#sitemap').val($('#sitemap').val() + '<video:title>' + snippet.title + '</video:title>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	$('#sitemap').val($('#sitemap').val() + '<video:description>' + short + '</video:description>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	var i = 0;
	if (tags) {
		while (tags[i]) {
			$('#sitemap').val($('#sitemap').val() + '<video:tag>' + tags[i] + '</video:tag>');
			$('#sitemap').val($('#sitemap').val() + '\n    ');
			i++;
		}

	}
	$('#sitemap').val($('#sitemap').val() + '<video:category>' + snippet.categoryId + '</video:category>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
	$('#sitemap').val($('#sitemap').val() + '</video:video>');
	$('#sitemap').val($('#sitemap').val() + '\n    ');
}

function closeMap() {
	$('#sitemap').val($('#sitemap').val() + '</url>');
	$('#sitemap').val($('#sitemap').val() + '\n');
	$('#sitemap').val($('#sitemap').val() + '</urlset>');
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


function getTags() {
	"use strict";
	var stringTags = $('#tags').val();
	return stringTags.split(',');
}
