<?php
$content = $_GET[ 'link-container' ];
$api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1'; // your api_developer_key
$api_paste_code = $content; // your paste text
echo( $api_user_code );
$api_paste_private = '0'; // 0=public 1=unlisted 2=private
$api_paste_name = $_GET[ 'playlistID' ] . '.markdown'; // name or title of your paste
$api_paste_expire_date = 'N';
$api_paste_format = 'markdown';
$api_user_key = $_GET[ 'userID' ]; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created]
$api_paste_name = urlencode( $api_paste_name );
$api_paste_code = urlencode( $api_paste_code );


$url = 'https://pastebin.com/api/api_post.php';
$ch = curl_init( $url );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key=' . $api_user_key . '&api_paste_private=' . $api_paste_private . '&api_paste_name=' . $api_paste_name . '&api_paste_expire_date=' . $api_paste_expire_date . '&api_paste_format=' . $api_paste_format . '&api_dev_key=' . $api_dev_key . '&api_paste_code=' . $api_paste_code . '' );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
curl_setopt( $ch, CURLOPT_NOBODY, 0 );

$response = curl_exec( $ch );
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pasebin Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="Jumbotron">
		<h1 class="text-center">My YouTube Tools</h1>
		<h2 class="text-center">Link to New Paste: <a href="<?=$response?>" title="Link to New Paste" target="_blank"><?=$response?></a></h2>
		<div class="d-flex align-items-center">
			<button class="btn btn-purple" id="getPastebin" type="button" onclick="goBack()">Go Back</button>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="auth.js"></script>
	<script type="text/javascript" src="includes/my_uploads.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script>
		function goBack() {
			window.history.back();
		}
	</script>
</body>

</html>