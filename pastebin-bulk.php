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
    <title>Bulk URLs for PasteBin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
    <script src="https://apis.google.com/js/client.js" type="text/javascript">
    </script>
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron">
        <div class="container text-center bulk">
            <div class="row">
                <div class="col-xs-6">
                    <label>URLs to Send to Pastebin
                    <textarea id="urls"></textarea>
      </label>
                </div>
                <div class="col-xs-6">
                    <label>Keywords
                    <textarea id="keywords"></textarea>
      </label>
                </div>
            </div>
            <button type="button" class="btn btn-green center-block" id="getPaste">Create Paste</button>
        </div>
        <div class="text-center m-1" id="result"></div>
        <div class="alert-info text-center">
            <form action="includes/pastebin-send.php">
                <textarea class="text-center" name="link-container" id="link-container"></textarea >
          <div class="m-1">
              <label>Enter name for Pastebin:<input type="text" value="" name="playlistID" id="playlistID"></label>
          </div>
          <button type="submit" class="btn btn-green">Send to Paste Bin</button>
          <input type="hidden" value="<?=$response?>" name="userID" id="userID">
         </form>
         </div>
</section>
<footer id="footer"></footer>
<script src="includes/header-autoresize.js"></script>
<script src="includes/my-array.js"></script>
<script src="includes/autosize.js"></script>
<script>
    autosize(document.querySelectorAll('textarea'));
    $( '#getPaste' ).click( function() {
        var myURLs = $('#urls').val();
        var keywords = $('#keywords').val();
        console.log('urls ' + myURLs);
        console.log('keywords ' + keywords);
        var paste = Array();
        myURLs = myURLs.textToArray();
        keywords = keywords.textToArray();
        console.log('urls ' + myURLs);
        console.log('keywords ' + keywords);
				str = "<a href='" + shortURL + "'>" + keyword + "</a>";
				$('#result').html(str);
				info = '[';
				info += keyword;
				info += '](';
				info += shortURL + ')';
                $('#link-container').text(info);
		} );
</script> 
</body>
</html>