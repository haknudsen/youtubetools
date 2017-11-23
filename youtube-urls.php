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
    <title>Get YouTube Video URL Variations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron text-center">
        <h1>Get YouTube Video URL Variations</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h2>videoID:</h2>
                    <input type="text" id="videoID">
                </div>
                <div class="col-sm-6">
                    <h2>Keywords(one per row):</h2>
                    <textarea id="keywords" style="max-height: 500px"></textarea>
                    <button type="button" class="btn btn-orange center" id="randomize">Randomize</button>
                </div>
                <button type="button" class="btn btn-purple center" id="getURLs">Get URLs</button>
            </div>
        </div>
        <div class="alert alert-info">
            <div class="row">
                <div class="col-sm-12">
                    <form action="pastebin-send.php">
                        <button type="submit" class="btn btn-green">Send to Paste Bin</button>
                        <div class="m-1">
                            <label>Enter name for Pastebin:<input type="text" value="" name="playlistID" id="playlistID"></label>
                        </div>
                        <textarea id="link-container" name="link-container" class="text-left" style="max-height: 500px"></textarea>
                        <input type="hidden" value="<?=$response?>" name="userID" id="userID">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer"></footer>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/youtube_variations.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
    <script src="includes/autosize.js"></script>
</body>

</html>