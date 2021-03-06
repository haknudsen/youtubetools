<!doctype html>
<html>

<head>
	<title>Playlist Videos Titles</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="jumbotron">
		<h1 class="text-center">Get Playlist Video Titles</h1>
		<div id="login-container" class="pre-auth text-center"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
		<div class="row">
			<div class="col-6 offset-3 ">
				<input type="text" name="playlist" id="playlist" style="width: 100%">
				<div class="d-flex align-items-center">
					<button type="button" class="btn btn-purple center-block" id="playlistClick">click</button>
				</div>
			</div>
		</div>
	</section>
	<section class="alert alert-info">
		<div id="video-container" class="container"></div>
		<div class="button-container">
			<button id="prev-button" class="paging-button" onclick="previousPage();">Previous Page</button>
			<button id="next-button" class="paging-button" onclick="nextPage();">Next Page</button>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="auth.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/navigation.js"></script>
	<script src="includes/autosize.js"></script>
	<script type="text/javascript" src="includes/my_titles.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
	</script>
</body>

</html>