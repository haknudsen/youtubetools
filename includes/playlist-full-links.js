// Define some variables used to remember state.
var playlistId, nextPageToken, prevPageToken, link, count;
var videoList = Array();
var playlistItems;
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
			link = "";
			count = 0;
			playlistId = playlist.substring(playlist.lastIndexOf("=") + 1);
			requestVideoPlaylist(playlistId);
		});

	});
}

// Retrieve the list of videos in the specified playlist.
function requestVideoPlaylist(playlistId, pageToken) {
	"use strict";
	$('#playlist-container').val('');
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
		prevPageToken = response.result.prevPageToken
		var prevVis = prevPageToken ? 'visible' : 'hidden';
		$('#prev-button').css('visibility', prevVis);

		playlistItems = response.result.items;
		if (playlistItems) {
			var i = 0;
			while (i < playlistItems.length) {
				displayResult(playlistItems[count].snippet);
				i++;
			}
			$('#playlist-container').val(link);
			autosize.update($('#playlist-container'));
		} else {
			$('#playlist-container').val('Sorry you have no uploaded videos');
		}
	});
}

// Create a listing for a video.
function displayResult(videoSnippet) {
	"use strict";
	var videoId = videoSnippet.resourceId.videoId;
	var videoURL = videoId;
	link += 'https://www.youtube.com/watch?v=' + videoURL + '\n';
	link += 'https://www.youtube.com/watch?v=' + videoURL + "&list=" + playlistId;
	if (count < playlistItems.length - 1) {
		link += '\n';
	}
	count++;

}
