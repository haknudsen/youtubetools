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
$OAUTH2_CLIENT_ID = '90875073625-s9gk56m4dq235b7vcq986jfa4qrbgmqq.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'WAUktIUEHgamJdgVAIfMjqBe';

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
        $videoId = $_POST[ "videoID" ];

        // Call the API's videos.list method to retrieve the video resource.
        $listResponse = $youtube->videos->listVideos( "snippet",
            array( 'id' => $videoId ) );

        // If $listResponse is empty, the specified video was not found.
        if ( empty( $listResponse ) ) {
            $htmlBody .= sprintf( '<h3>Can\'t find a video with video id: %s</h3>', $videoId );
        } else {
            // Since the request specified a video ID, the response only
            // contains one video resource.
            $video = $listResponse[ 0 ];
            $videoSnippet = $video[ 'snippet' ];
            $description = $videoSnippet[ 'description' ];

            $htmlBody = '<form method="post" action="description_update.php">';
            $htmlBody .= '<input type="hidden" name="videoID" ';
            $htmlBody .= 'value="' . $videoId . '">';
            $htmlBody .= '<div>';
            $htmlBody .= '<h1 class="text-center">Description</h1>';
            $htmlBody .= '<label for="description"><span class="required">*</span> </label>';
            $htmlBody .= '<textarea id="description" name="description" required style="min-height: 500px;width: 100%;margin:0 auto;padding:10px">';
            $htmlBody .= $description;
            $htmlBody .= '</textarea>';
            $htmlBody .= '</div>';
            $htmlBody .= '<div style="margin:0 auto">';
            $htmlBody .= '<input type="submit" value="Submit" id="submit" style="margin:0 auto"/>';
            $htmlBody .= '</div>';
            $htmlBody .= '</form>';
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
  <h3>Client Credentials Required</h3>
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
<h3>Authorization Required</h3>
<p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
}
?>

<!doctype html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<head>
    <title>Edit Description</title>
</head>

<body>
    <section class="jumbotron">
        <section class="container">
            <?=$htmlBody?>
        </section>
    </section>
    <footer class="navbar navbar-default my-nav">
        <nav class="">
            <div class="container">

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="playlist.html">Playlist</a> </li>
                        <li><a href="index.html">Home</a> </li>
                        <li><a href="privacy.php">Privacy</a> </li>
                        <li><a href="titles.php">Titles</a> </li>
                        <li><a href="channel-list.php">Channel List</a> </li>
                        <li class="divider"></li>
                        <li><a href="tags.html">tags</a> </li>
                        <li class="divider"></li>
                        <li><a href="edit-description.php">Description</a> </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.html">Home</a> </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </footer>
</body>

</html>