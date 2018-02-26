// Define some variables used to remember state.
var center;
var anchor = '<div style="width: 100%;max-width:1280px;margin:0 auto;padding:1rem">\n  <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">\n    <iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/videoseries?list=';
var left = '<div style="width: 50%;max-width:640px;float:left;padding-right:1rem">\n  <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">\n    <iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/videoseries?list=';
var frameEnd = '" frameborder="0"></iframe>\n  </div>\n</div>';

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
$('#responsive').click(function () {
	"use strict";
	center = false;
	getPlaylist();
});

function getPlaylist() {
	"use strict";
	$('#link-container').val('');
	var playlist = $('#playlist').val();
	var playlistId = playlist.substring(playlist.lastIndexOf("=") + 1);
	var info = "";
	if (center) {
		info = anchor;
	} else {
		info = left;
	}
	info += playlistId + frameEnd;
	$('#link-container').val(info);
	autosize.update($('#link-container'));
}
