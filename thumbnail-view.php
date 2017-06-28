<?php
$videoId = $_POST[ "videoID" ];
$resolution = array( "default", "sddefault", "mqdefault", "hqdefault", "maxresdefault" );
$htmlBody .= '<div class="container">';
for ( $x = 0; $x < sizeof( $resolution ); $x++ ) {
    $htmlBody .= '<div class="text-center">';
    $htmlBody .= '<img src="//img.youtube.com/vi/';
    $htmlBody .= $videoId;
    $htmlBody .= '/';
    $htmlBody .= $resolution[ $x ];
    $htmlBody .= '.jpg"';
    $htmlBody .= 'class="img img-responsive center-block">';
    $htmlBody .= '<h3>' . $resolution[ $x ].'</h3>';
    $htmlBody .= '</div>';
    if ( get_headers( $url )[ 0 ] == 'HTTP/1.0 200 OK' ) {
        break;
    }
    $htmlBody .= '</div>';
}
?>
<!doctype html>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<head>
    <title>View Thumbnails</title>
</head>

<body>
    <section class="container-fluid">
        <?=$htmlBody?>
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
                        <li><a href="thumbnails.php">Thumbnails</a> </li>
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