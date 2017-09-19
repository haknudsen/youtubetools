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
                    <h3>Keywords-Use less than 80 keywords</h3>
                    <textarea id="keywords" style="max-height: 200px"></textarea>
                </div>
            </div>
    </section>
    <section class="button-container text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <button class="btn btn-green" id="getURL" type="button">Get Short URLs</button>
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-purple" id="getPastebin" type="button">Get links for Pastebin</button>
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-danger" id="clear" type="button">Clear Fields</button>
                </div>
            </div>
        </div>
    </section>
    <section class="alert alert-info">
        <div class="container">
            <div class="row">
                <h2 class="text-center" id="reporter"></h2>
                <div class="col-sm-4">
                    <h3 class="text-center">Shorties</h3>
                    <textarea id="shorties" name="shorties"></textarea>
                </div>
                <div class="col-sm-8">
                    <h3 class="text-center">Links for Pastebin</h3>
                    <form action="pastebin-send.php">
                        <button class="btn btn-blue center-block" type="submit">Send to Paste Bin</button>
                        <h3 class="text-center">Name of Paste:</h3>
                        <input id="playlistID" name="playlistID" type="text" class="m-1" value="">
                        <textarea id="link-container" name="link-container"></textarea>
                        <input id="userID" name="userID" type="hidden" value="<?=$response?>">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer"></footer>
    <script src="includes/url-shortener.js">
    </script><script src="includes/navigation.js">
</script>
    <script src="includes/autosize.js">
    </script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>