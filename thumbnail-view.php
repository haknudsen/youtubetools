<?php
$videoId = $_POST[ "videoID" ];
$pos = strrpos( $videoId, '=' );
if ( $pos ) {
    $videoId = substr( $videoId, $pos + 1 );
} else {
    $pos = strrpos( $videoId, '/' );
    if ( $pos ) {
        $videoId = substr( $videoId, $pos + 1 );
    }
}
$resolution = array( "default", "sddefault", "mqdefault", "hqdefault", "maxresdefault" );
$htmlBody .= '<div class="container">';
for ( $x = 0; $x < sizeof( $resolution ); $x++ ) {
    $imgurl = '//img.youtube.com/vi/' . $videoId . '/' . $resolution[ $x ] . '.jpg';
    $htmlBody .= '<div class="text-center">';
    $htmlBody .= '<a href="' . $imgurl . '"><img src="' . $imgurl;
    $htmlBody .= '" class="img img-responsive center-block box"></a>';
    $htmlBody .= '<h3><a href="' . $imgurl . '">' . $imgurl . '</a></h3>';
    $htmlBody .= '</div>';
    if ( get_headers( $url )[ 0 ] == 'HTTP/1.0 200 OK' ) {
        break;
    }
    $htmlBody .= '</div>';
}
?>
<!doctype html>
<html>

<head>
    <title>Thumbnail Viewer</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="jumbotron">
        <?php include("includes/header.php"); ?>
        <section class="container-fluid">
            <?=$htmlBody?>
        </section>
        <?php include("includes/nav.html"); ?>
        <script src="includes/navigation.js"></script>
        <script src="includes/autosize.js"></script>
        <script>
            autosize( document.querySelectorAll( 'textarea' ) );
        </script>
</body>

</html>