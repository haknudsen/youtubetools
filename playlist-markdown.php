<?php
$api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1';
$api_user_name = 'a_users_username';
$api_user_password = 'a_users_password';
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>
<body>
<div id="header"></div>
<section class="container">
  <h1 class="text-center">Playlist Links for Pastebin</h1>
  <div id="login-container" class="pre-auth"> This application requires access to your YouTube account.  Please <a href="#" id="login-link">authorize</a> to continue. </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
      <div class="row  text-capitalize center">
          <h3 class="text-center">Text Anchors</h3>
          <div class="row">
            <div class="col-sm-6">
              <button type="button" class="btn btn-blue" id="anchor-title">Anchor on Title</button>
            </div>
            <div class="col-sm-6">
              <button type="button" class="btn btn-orange" id="anchor-description">Anchor From Description</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
  <div class="alert alert-info">
      <div class="text-center">
         <form action="includes/pastebin-login.php">
          <button type="submit" class="btn btn-green">Log in to Paste Bin</button>
         </form>
      </div>
    <button id="prev-button" class="paging-button" onclick="previousPage();">Previous Page</button>
    <button id="next-button" class="paging-button" onclick="nextPage();">Next Page</button>
  </div>
<section class="alert alert-success">
      <div class="text-center">
         <form action="includes/pastebin-send.php">
          <button type="submit" class="btn btn-green">Send to Paste Bin</button>
          <div class="m-1">
              <label>Enter name for Pastebin:<input type="text" value="" name="playlistID" id="playlistID"></label>
          </div>
          <textarea name="link-container" id="link-container"></textarea>
          <input type="hidden" value="<?=$response?>" name="userID" id="userID">
         </form>
      </div>
  <textarea class="m-1" id="spintax"></textarea>
</section>
<footer id="footer"></footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script type="text/javascript" src="auth.js"></script> 
<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script> 
<script type="text/javascript" src="includes/playlist-markdown.js"></script> 
<script src="includes/header-autoresize.js"></script>
</body>
</html>