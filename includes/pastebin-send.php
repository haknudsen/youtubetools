<?php
$content = $_GET['link-container'];
$api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1'; // your api_developer_key
$api_paste_code = $content; // your paste text
$api_paste_private = '0'; // 0=public 1=unlisted 2=private
$api_paste_name = 'Talking Heads-' . $_GET['playlistID'] . '.markdown'; // name or title of your paste
$api_paste_expire_date = 'N';
$api_paste_format = 'markdown';
$api_user_key = $_GET['userID']; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created]
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>
<body>
<div id="header"></div>
<section class="Jumbotron">
  <h1 class="text-center">My YouTube Tools</h1>
  <h2 class="text-center">Link to New Paste: <a href="<?=$response?>" target="_blank"><?=$response?></a></h2>
</section>
<footer id="footer"></footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script type="text/javascript" src="auth.js"></script> 
<script type="text/javascript" src="includes/my_uploads.js"></script> 
<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script> 
<script src="includes-header.js"></script>
</body>
</html>