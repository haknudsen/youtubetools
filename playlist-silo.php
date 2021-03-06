<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Playlist Silo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container text-center">
		<h1>This app creates a silo of a Playlist</h1>
		<h2>The 1st video links to the 2nd video, the 2nd video links to the 3rd, and so on until the last video in the playlist which links back to the 1st video</h2>
		<h2>If playlist is larger than 50 videos, only the 1st 50 videos will be siloed</h2>
		<h3 class="alert-danger">Doesn't work in Chrome for some reason</h3>
		<h3>Playlist to Silo</h3>
		<div id="login-container" class="pre-auth"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
		<br>
		<div class="d-flex align-items-center">
			<div class="col-md-8 offset-md-2">
				<input class="silo" type="text" name="playlist" id="playlist">
				<h2 class="text-center">Phrase</h2>
				<input class="silo" type="text" name="phrase" id="phrase" value="Watch the next video">
				<button type="button" class="btn btn-purple center-block" id="playlistClick">Start</button>
			</div>
		</div>
	</section>
	<section class="alert alert-success">
		<h3 class="text-center">Number of videos in Playlist: <span id="count"></span></h3>
	</section>
	<section class="alert alert-info">
		<div class="d-flex align-items-center">
			<button type="button" class="btn btn-primary center-block" id="complete">Complete</button>
			<h2 class="text-center text-uppercase" id="success">Waiting...</h2>
			<button type="button" class="btn btn-danger center-block" id="clear">Clear</button>
		</div>
	</section>
	<?php include("includes/nav.html"); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="includes/autosize.js"></script>
	<script src="auth.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/playlist-silo.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
	</script>
</body>
</html>