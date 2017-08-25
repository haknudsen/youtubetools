<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Get List of our Pastes</title>
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
    <footer id="footer"></footer>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
</body>

</html>