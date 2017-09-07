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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>URL Shortener</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js">
	</script>
	<link href="css/my_uploads.css" rel="stylesheet" type="text/css">
	<script src="https://apis.google.com/js/client.js" type="text/javascript">
	</script>
</head>
<body>
	<div id="header"></div>
	<section class="jumbotron">
		<div class="container text-center">
			<div class="row">
				<div class="col-sm-6">
					<h3>URL to Shorten</h3><input id="url" type="text">
				</div>
				<div class="col-sm-6">
					<h3>Keywords</h3>
					<h4>Use less than 80 keywords</h4>
					<textarea id="keywords" style="max-height: 500px"></textarea>
				</div>
			</div><button class="btn btn-green center-block" id="getURL" type="button">Get URL</button>
		</div>
	</section>
	<section class="alert alert-info">
		<div class="container">
			<div class="row">
				<h2 class="text-center" id="reporter"></h2>
				<div class="col-sm-4">
					<h3 class="text-center">Shorties</h3><button class="btn btn-purple text-center center-block" id="getPastebin" type="button">Get Pastebin</button> 
					<textarea id="shorties" name="shorties"></textarea>
				</div>
				<div class="col-sm-8">
					<h3 class="text-center">Links for Pastebin</h3>
					<form action="pastebin-send.php">
					<h3 class="text-center">Enter name for Pastebin:</h3>
                       <input id="playlistID" name="playlistID" type="text" value="">
                        <button class="btn btn-green text-center" type="submit">Send to Paste Bin</button>
						<textarea id="link-container" name="link-container"></textarea> <input id="userID" name="userID" type="hidden" value="&lt;?=$response?&gt;">
					</form>
				</div>
			</div>
		</div>
	</section>
	<footer id="footer"></footer>
	<script src="includes/url-shortener.js">
	</script> 
	<script src="includes/navigation.js">
	</script> 
	<script src="includes/autosize.js">
	</script> 
	<script>
	   autosize(document.querySelectorAll('textarea'));
	   $(document).ready(function(){
	       $('#keywords').val('');
	   })
	</script>
</body>
</html>