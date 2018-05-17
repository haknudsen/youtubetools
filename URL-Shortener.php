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
	<title>Keyword Link Creator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
	<script src="https://apis.google.com/js/client.js" type="text/javascript">
	</script>
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="jumbotron">
		<div class="container text-center">
			<div class="row">
				<div class="col-6">
					<h3>URL to Shorten</h3><input id="url" type="text">
				</div>
				<div class="col-6">
					<h3>Keywords-Use less than 80 keywords</h3>
					<textarea id="keywords" style="max-height: 200px"></textarea>
				</div>
			</div>
	</section>
	<section class="button-container text-center">
		<div class="container">
			<form action="pastebin-send.php">
				<div class="d-flex align-items-center">
					<div class="col-4">
						<button class="btn btn-green" id="getURL" type="button">Get Short URLs</button>
					</div>
					<div class="col-4">
						<button class="btn btn-purple" id="getPastebin" type="button">Get links for Pastebin</button>
					</div>
					<div class="col-4">
						<button class="btn btn-blue center-block" type="submit">Send to Paste Bin</button>
					</div>
				</div>
		</div>
	</section>
	<section class="alert alert-info">
		<div class="container">
			<div class="d-flex align-items-center">
				<h2 class="text-center" id="reporter"></h2>
				<div class="col-4">
					<h3 class="text-center">Shorties</h3>
					<textarea id="shorties" name="shorties"></textarea>
				</div>
				<div class="col-8">
					<h3 class="text-center">Links for Pastebin</h3>
					<h3 class="text-center">Name of Paste:</h3>
					<div class="d-flex align-items-center align-items-start">
					<input id="playlistID" name="playlistID" type="text" class="w-96" value="">
					</div>
					<textarea id="link-container" name="link-container"></textarea>
					<input id="userID" name="userID" type="hidden" value="<?=$response?>">
				</div>
			</div>
		</div>
		</form>
		<div class="d-flex align-items-center">
		<button class="btn btn-danger" id="clear" type="button">Clear Fields</button>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	</script>
	<script src="includes/autosize.js">
	</script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
	</script>
	<script src="includes/url-shortener.js"></script>
</body>

</html>