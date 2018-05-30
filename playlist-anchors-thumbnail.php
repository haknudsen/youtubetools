<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Playlist video links</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container-fluid">
		<h1 class="text-center">Get Video Links with Anchors</h1>
		<div id="login-container" class="pre-auth text-center"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
		<div class="container">
			<div class="col-md-8 offset-md-2">
				<input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
				<div class="text-capitalize center">
					<h3 class="text-center">Text Anchors</h3>
					<div class="row">
						<button type="button" class="btn btn-drkblue" id="anchor-left">Responsive Left</button>
						<button type="button" class="btn btn-purple" id="anchor-image">Responsive Center</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="alert alert-success">
		<div class="container">
			<textarea class="m-1" id="link-container" style="max-height: 400px"></textarea>
			<div class="d-flex text-center">
				<button type="button" class="btn btn-primary text-capitalize center-block" id="copy">Copy</button>
			</div>
		</div>
		<div class="container">
			<textarea class="m-1" id="spintax"></textarea>
			<div class="d-flex text-center">
				<button type="button" class="btn btn-primary text-capitalize center-block" id="copy-spin">Copy Spin</button>
				<button type="button" class="btn btn-warning text-capitalize center-block" id="reset">Reset</button>
			</div>
		</div>
	</section>
	<?php include("includes/nav.html"); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="auth.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/navigation.js"></script>
	<script src="includes/autosize.js"></script>
	<script src="includes/playlist-thumbnails.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
		$( "#copy" ).click( function () {
			$( "#link-container" ).select();
			document.execCommand( 'copy' );
		} );
		$( "#copy-spin" ).click( function () {
			$( "#spintax" ).select();
			document.execCommand( 'copy' );
		} );
	</script>
</body>

</html>