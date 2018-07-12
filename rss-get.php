<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Get RSS Feeds from Channel ID</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>
</head>

<body>
	<div id="header"></div>
	<section class="jumbotron text-center">
		<h1>Get RSS Feeds from Channel ID</h1>
		<h2>Ender the channel ID</h2>
		<h3>Found at <a href="https://www.youtube.com/account_advanced" title="Advanced" target="_blank">https://www.youtube.com/account_advanced</a> under account information</h3>
		<h2>Returns the RSS feeds for the Channel, user, and all the playlists</h2>
		<button id="execute-request-button" class="btn btn-danger center-block">Authorize</button>
		<div class="container">
				<input type="text" id="channel">
		</div>
		<button id="start" class="btn btn-purple center-block text-uppercase">GET RSS feeds</button>
	</section>
	<div class="alert alert-info">
		<div class="container">
			<textarea id="rss-feeds"></textarea>
			<div class="d-flex text-center">
				<button type="button" class="btn btn-primary text-capitalize" id="copy">Copy Feed URLs</button>
			</div>
		</div>
		<div class="container">
			<textarea id="rss-links"></textarea>
			<div class="d-flex justify-content-around">
				<button type="button" class="btn btn-primary text-capitalize" id="copy-links">Copy Feed Links</button>
			</div>
		</div>
	</div>
	<footer id="footer"></footer>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="auth.js"></script>
	<script type="text/javascript" src="includes/my_uploads.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/navigation.js"></script>
	<script src="includes/autosize.js"></script>
	<script src="includes/rss-feeds.js"></script>
	<script>
		$( "#copy" ).click( function () {
			$( "#rss-feeds" ).select();
			document.execCommand( 'copy' );
		} );
		$( "#copy-links" ).click( function () {
			console.log( 'select ' );
			$( "#rss-links" ).select();
			document.execCommand( 'copy' );
		} );
		autosize( document.querySelectorAll( 'textarea' ) );
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()">
	</script>
</body>
</html>