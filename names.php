<?php

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
    try {
        // Call the channels.list method to retrieve information about the
        // currently authenticated user's channel.
        $channelsResponse = $youtube->channels->listChannels( 'contentDetails', array(
            'mine' => 'true',
        ) );

        $htmlBody = '';
        foreach ( $channelsResponse[ 'items' ] as $channel ) {
            // Extract the unique playlist ID that identifies the list of videos
            // uploaded to the channel, and then call the playlistItems.list method
            // to retrieve that list.
            $uploadsListId = $channel[ 'contentDetails' ][ 'relatedPlaylists' ][ 'uploads' ];

            $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems( 'snippet', array(
                'playlistId' => $uploadsListId,
                'maxResults' => 50
            ) );
            $total = 0;
            $htmlBody .= "<h3>Videos in Channel $uploadsListId</h3>";
            $htmlBody .= '<br>';
            $htmlBody .= "<ul class='video-list'>";
            foreach ( $playlistItemsResponse[ 'items' ] as $playlistItem ) {
                $htmlBody .= sprintf( '<li>%s%s</li>', "https://www.youtube.com/watch?v=", $playlistItem[ 'snippet' ][ 'resourceId' ][ 'title' ] );
                $total++;
            }
            $htmlBody .= '</ul>';
            $htmlBody .= '<br>';
            $htmlBody .= "<h2>Total Videos in List: ";
            $htmlBody .= $total + '</h2>';
        }
    } catch ( Google_Service_Exception $e ) {
        $htmlBody = sprintf( '<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars( $e->getMessage() ) );
    } catch ( Google_Exception $e ) {
        $htmlBody = sprintf( '<p>An client error occurred: <code>%s</code></p>',
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

<head>
    <title>Video Titles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://www.websitetalkingheads.com/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="https://www.websitetalkingheads.com/css/examples.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <section class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?=$htmlBody?>
            </div>
        </div>
    </section>
</body>

</html>