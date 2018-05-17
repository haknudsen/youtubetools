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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="jumbotron text-center">
        <h1>Get YouTube Video Loop URLs</h1>
        <button type="button" class="btn btn-danger" id="clear">Clear</button>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-6">
                    <h2>videoID:</h2>
                    <input type="text" id="videoID">
                </div>
                <div class="col-sm-6">
                    <h2>Keywords(one per row):</h2>
                    <textarea id="keywords" style="max-height: 500px"></textarea>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>PasteBin Links</h3>
                        <textarea id="link-container" name="link-container" class="text-left" style="max-height: 500px"></textarea>
                        <input type="hidden" value="<?=$response?>" name="userID" id="userID">
                            </div>
                            <div class="col-lg-6">
                                <h3>HTML Links</h3>
                        <textarea id="htmlLinks" name="htmlLinks" class="text-left" style="max-height: 500px"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("includes/nav.html"); ?>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/youtube_loops.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>