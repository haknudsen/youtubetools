<?php
$api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1';
$api_user_name = urlencode( 'talkingheads' );
$api_user_password = urlencode( 'talk1ngheads' );
$url = 'https://pastebin.com/api/api_login.php';
$ch = curl_init( $url );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, 'api_dev_key=' . $api_dev_key . '&api_user_name=' . $api_user_name . '&api_user_password=' . $api_user_password . '' );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
curl_setopt( $ch, CURLOPT_NOBODY, 0 );

$response = curl_exec( $ch );
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Playlist Links for Pastebin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container">
		<h1 class="text-center">Playlist Links for Pastebin</h1>
		<div id="login-container" class="pre-auth"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
		<div class="d-flex align-items-center">
			<div class="col-lg-8 offset-md-2">
				<input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
				<div class="text-capitalize center">
					<div class="d-flex justify-content-center">
						<div class="col-md-6">
							<button type="button" class="btn btn-blue" id="anchor-title">Anchor on Title</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-orange" id="anchor-description">Anchor From Description</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="alert alert-info">
		<div class="d-flex align-items-center text-center">
			<form action="pastebin-send.php">
				<div class="m-0 d-flex align-items-center">
				<button type="submit" class="btn btn-green">Send to Paste Bin</button>
				</div>
				<div class="d-flex align-items-center m-1">
					<label>Enter name for Pastebin:  <input type="text" value="" name="playlistID" id="playlistID"></label>
				<textarea name="link-container" id="link-container"></textarea>
				<input type="hidden" value="<?=$response?>" name="userID" id="userID">
				</div>
			</form>
		</div>
		<button id="prev-button" class="paging-button" onclick="previousPage();">Previous Page</button>
		<button id="next-button" class="paging-button" onclick="nextPage();">Next Page</button>
	</div>
	<section class="container text-center">
		<div class="d-flex align-items-center">
			<button type="button" class="btn btn-danger" id="clear">Clear</button>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="auth.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/playlist-markdown.js"></script>
	<script src="includes/autosize.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
	</script>
</body>
</html>