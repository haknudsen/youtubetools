// JavaScript Document

/***** START BOILERPLATE CODE: Load client library, authorize user. *****/

// Global variables for GoogleAuth object, auth status.
var GoogleAuth, title, description, channel, snippet, videoId, getVideo, categoryId, language, isAuthorized;
var tags = Array();
var videoUpdate = true;

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
			videoUpdate = false;
			getVideo = $('#video').val();
			getVideo = getVideo.substring(getVideo.lastIndexOf("=") + 1);
			defineRequest(getVideo);
		});
		$('#update').click(function () {
			update();
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
			createSitemap();
			autosize.update($('#description'));
			autosize.update($('#tags'));
			autosize.update($('#sitemap'));
		}
	});
}

function createSitemap() {
	"use strict";
	var sitemap = {
		loc: $('#loc').val(),
		changefreq: $('#changefreq').val(),
		priority: $('#priority').val(),
		player_loc: "http://www.youtube.com/v/" + videoId,
		title: title,
		description: description.substr(0, 200).replace(/\n/g, " ") + "...",
		category: categoryId,
		tags: tags,
		thumbnail_loc: "http://img.youtube.com/vi/" + videoId + "maxresdefault.jpg"
	};
	var short = snippet.description.substr(0, 200).replace(/\n/g, " ") + "..."
	var s = JSON.stringify(sitemap);
	$('#sitemap').val(s);
	$('#description').val("");
	$('#description').val($('#description').val() + '<?xml version="1.0" encoding="UTF-8"?>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">');
	$('#description').val($('#description').val() + '<url>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<loc>' + $('#loc').val() + '</loc>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<changefreq>' + $('#changefreq').val() + '</changefreq>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<priority>' + $('#priority').val() + '</priority>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<video:video>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<video:player_loc allow_embed="yes">http://www.youtube.com/v/' + videoId + '</video:player_loc>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<video:thumbnail_loc>http://img.youtube.com/vi/' + videoId + 'maxresdefault.jpg</video:thumbnail_loc>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<video:title>' + snippet.title + '</video:title>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '<video:description>' + short + '</video:description>');
	$('#description').val($('#description').val() + '\n');
	var i = 0;
	while (tags[i]) {
		$('#description').val($('#description').val() + '<video:tag>' + tags[i] + '</video:tag>');
		$('#description').val($('#description').val() + '\n');
		i++;
	}
	$('#description').val($('#description').val() + '<video:category>' + snippet.categoryId + '</video:category>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '</video:video>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '</url>');
	$('#description').val($('#description').val() + '\n');
	$('#description').val($('#description').val() + '</urlset>');
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

function update() {
	"use strict";
	videoUpdate = true;
	title = $('#title').val();
	description = $('#description').val();
	tags = getTags();
	console.log(tags);
	// Sample js code for videos.update

	// See full sample for buildApiRequest() code, which is not 
	// specific to a particular youtube or youtube method.

	buildApiRequest('PUT',
		'/youtube/v3/videos', {
			'part': 'snippet'
		}, {
			'id': videoId,
			'snippet.categoryId': '19',
			'snippet.defaultLanguage': 'en',
			'snippet.description': description,
			'snippet.tags': tags,
			'snippet.title': title
		});
	$('#reporter').text('updated!');
}

function getTags() {
	"use strict";
	var stringTags = $('#tags').val();
	return stringTags.split(',');
}
