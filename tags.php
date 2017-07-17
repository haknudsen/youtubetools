<?php

/**
 * This sample adds new tags to a YouTube video by:
 *
 * 1. Retrieving the video resource by calling the "youtube.videos.list" method
 *    and setting the "id" parameter
 * 2. Appending new tags to the video resource's snippet.tags[] list
 * 3. Updating the video resource by calling the youtube.videos.update method.
 *
 * @author Ibrahim Ulukaya
 */

/**
 * Library Requirements
 *
 * 1. Install composer (https://getcomposer.org)
 * 2. On the command line, change to this directory (api-samples/php)
 * 3. Require the google/apiclient library
 *    $ composer require google/apiclient:~2.0
 */
if ( !file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    throw new\ Exception( 'please run "composer require google/apiclient:~2.0" in "' . __DIR__ . '"' );
}

require_once __DIR__ . '/vendor/autoload.php';
session_start();

/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$OAUTH2_CLIENT_ID = '90875073625-ff3ntj9kehegnbamaoace12q6lo37v6u.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = '1jNNC7gKdhMML1CwVCeyBoZN';


$client = new Google_Client();
$client->setClientId( $OAUTH2_CLIENT_ID );
$client->setClientSecret( $OAUTH2_CLIENT_SECRET );
$client->setScopes( 'https://www.googleapis.com/auth/youtube' );
$redirect = filter_var( 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ],
    FILTER_SANITIZE_URL );
$client->setRedirectUri( $redirect );

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube( $client );

// Check if an auth token exists for the required scopes
$tokenSessionKey = 'token-' . $client->prepareScopes();
if ( isset( $_GET[ 'code' ] ) ) {
    if ( strval( $_SESSION[ 'state' ] ) !== strval( $_GET[ 'state' ] ) ) {
        die( 'The session state did not match.' );
    }

    $client->authenticate( $_GET[ 'code' ] );
    $_SESSION[ $tokenSessionKey ] = $client->getAccessToken();
    header( 'Location: ' . $redirect );
}

if ( isset( $_SESSION[ $tokenSessionKey ] ) ) {
    $client->setAccessToken( $_SESSION[ $tokenSessionKey ] );
}

// Check to ensure that the access token was successfully acquired.
if ( $client->getAccessToken() ) {
    $htmlBody = '';
    try {

        // REPLACE this value with the video ID of the video being updated.
        $str = $_POST[ 'video' ];
        if(($pos = strpos($str, '=')) !== false)
        {
            $videoId = trim(substr($str, strrpos($str, '=') + 1));
        }
        else
        {
           $videoId = $str;
        }
        // Call the API's videos.list method to retrieve the video resource.
        $listResponse = $youtube->videos->listVideos( "snippet",
            array( 'id' => $videoId ) );

        // If $listResponse is empty, the specified video was not found.
        if ( empty( $listResponse ) ) {
            $htmlBody .= sprintf( '<h2>Can\'t find a video with video id: %s</h2>', $videoId );
        } else {
            // Since the request specified a video ID, the response only
            // contains one video resource.
            $video = $listResponse[ 0 ];
            $videoSnippet = $video[ 'snippet' ];
            $tags = $videoSnippet[ 'tags' ];

            $htmlBody .= "<h1>Tags for: " . $videoId . "</h1>";
            $htmlBody .= "<h2>" . $video[ 'snippet' ][ 'title' ] . "</h2><ul>";
            $htmlBody .= "<br>";
            for ( $i = 0; $i < count( $tags ); $i++ ) {
                $htmlBody .= $tags[ $i ];
                $htmlBody .= "<br>";
            }


            // Set the tags array for the video snippet
            $videoSnippet[ 'tags' ] = $tags;

            // Update the video resource by calling the videos.update() method.
            $updateResponse = $youtube->videos->update( "snippet", $video );

            $responseTags = $updateResponse[ 'snippet' ][ 'tags' ];


        }
    } catch ( Google_Service_Exception $e ) {
        $htmlBody .= sprintf( '<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars( $e->getMessage() ) );
    } catch ( Google_Exception $e ) {
        $htmlBody .= sprintf( '<p>An client error occurred: <code>%s</code></p>',
            htmlspecialchars( $e->getMessage() ) );
    }

    $_SESSION[ $tokenSessionKey ] = $client->getAccessToken();
} elseif ( $OAUTH2_CLIENT_ID == 'REPLACE_ME' ) {
    $htmlBody = <<<END
  <h2>Client Credentials Required</h2>
  <p>
    You need to set <code>\$OAUTH2_CLIENT_ID</code> and
    <code>\$OAUTH2_CLIENT_ID</code> before proceeding.
  <p>
END;
} else {
    // If the user hasn't authorized the app, initiate the OAuth flow
    $state = mt_rand();
    $client->setState( $state );
    $_SESSION[ 'state' ] = $state;

    $authUrl = $client->createAuthUrl();
    $htmlBody = <<<END
<h2>Authorization Required</h2>
<p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}
?>
<!doctype html>
<html>
<head>
<title>Get Tags</title>
</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="my_uploads.css">
</head>

<body>
    <section class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?=$htmlBody?>
            </div>
        </div>
    </section>
    <footer id="footer"></footer>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script>
        $( document ).ready( function () {
            $( "#footer" ).load( "includes/footer.html" )
        } )
    </script>
    
</body>

</html>