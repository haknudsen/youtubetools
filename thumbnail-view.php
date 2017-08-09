<?php
$videoId = $_POST[ "videoID" ];
$pos = strpos($videoId, '=');
if($pos){
$videoId = explode('=', $videoId)[1];
}
$resolution = array( "default", "sddefault", "mqdefault", "hqdefault", "maxresdefault" );
$htmlBody .= '<div class="container">';
for ( $x = 0; $x < sizeof( $resolution ); $x++ ) {
    $imgurl = '//img.youtube.com/vi/' . $videoId . '/' . $resolution[ $x ] . '.jpg';
    $htmlBody .= '<div class="text-center">';
    $htmlBody .= '<a href="' .$imgurl . '"><img src="' . $imgurl;
    $htmlBody .= '" class="img img-responsive center-block box"></a>';
    $htmlBody .= '<h3><a href="' .$imgurl . '">' .$imgurl . '</a></h3>';
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
    <title>Tags Viewer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron">
        <div id="header"></div>
        <section class="container-fluid">
            <?=$htmlBody?>
        </section>
        <footer id="footer"></footer>
<script src="includes/header-autoresize.js"></script> 
<script src="includes/autosize.js"></script> 
<script>
    autosize(document.querySelectorAll('textarea'));
</script> 
</body>

</html>