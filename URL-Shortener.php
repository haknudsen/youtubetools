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
    <title>URL Shortener</title>
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
        <div class="container text-center">
            <div class="row">
                <label>URL to Shorten
        <input type="text" id="url">
      </label>
            </div>
            <div class="row">
                <label>Keyword
        <input type="text" id="keyword">
      </label>
            </div>
            <button type="button" class="btn btn-green center-block" id="getURL">Get URL</button>
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
<script>
    $( '#getURL' ).click( function() {
        var shortURL,keyword,str;
	var longUrl = $( '#url' ).val();
	gapi.client.setApiKey( 'AIzaSyAIcryxKhc2Dhcus5leonpybDnkSNtwioE' );
	gapi.client.load( 'urlshortener', 'v1', function() {
		document.getElementById( "result" ).innerHTML = "";
		var request = gapi.client.urlshortener.url.insert( {
			'resource': {
				'longUrl': longUrl
			}
		} );
		request.execute( function( response ) {
        console.log(response.id);
			if ( response.id != null ) {
                shortURL = response.id;
                keyword = $( '#keyword' ).val();
            $('#playlistID').val( keyword);
				str = "<a href='" + shortURL + "'>" + keyword + "</a>";
				$('#result').html(str);
				info = '[';
				info += keyword;
				info += '](';
				info += shortURL + ')';
                $('#link-container').text(info);
			} else {
				alert( "Error: creating short url \n" + response.error );
			}
		} );
	} );
} );
</script> 
<script src="includes/header-autoresize.js"></script>
</body>
</html>