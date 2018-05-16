<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Get List of our Pastes</title>
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
    <div class="container">
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
    $api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1';
    $api_user_key = $response;
    $api_results_limit = '4';
    $url = 'https://pastebin.com/api/api_post.php';
    $ch = curl_init( $url );

    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, 'api_option=list&api_user_key=' . $api_user_key . '&api_dev_key=' . $api_dev_key . '&api_results_limit=' . $api_results_limit . '' );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
    curl_setopt( $ch, CURLOPT_NOBODY, 0 );

    $response = curl_exec( $ch );
    echo PHP_EOL;
   print_r($response);
    ?>
    </div>
    </section>
    <?php include("includes/nav.html"); ?>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
</body>

</html>