<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Playlist video links</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="container">
        <h1 class="text-center">Get Video Links with Anchors</h1>
        <div id="login-container" class="pre-auth"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
                <div class="row  text-capitalize center">
                    <h3 class="text-center">Text Anchors</h3>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-drkblue" id="anchor-left">Responsive Left</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-purple" id="anchor-image">Responsive Center</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="alert alert-success">
        <textarea class="m-1" id="link-container" style="max-height: 400px"></textarea>
        <button type="button" class="btn btn-primary text-capitalize center-block" id="copy">Copy</button>
        <textarea class="m-1" id="spintax"></textarea>
        <button type="button" class="btn btn-primary text-capitalize center-block" id="copy-spin">Copy Spin</button>
        <button type="button" class="btn btn-warning text-capitalize center-block" id="reset">Reset</button>
    </section>
    <footer id="footer"></footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="auth.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/playlist-thumbnails.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
        $( "#copy" ).click( function () {
            $( "#link-container" ).select();
            document.execCommand( 'copy' );
        } );
        $( "#copy-spin" ).click( function () {
            $( "#spintax" ).select();
            document.execCommand( 'copy' );
        } );
    </script>
</body>

</html>