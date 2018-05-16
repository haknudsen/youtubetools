<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>My Spinner</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="container-fluid alert-success p-2 m-1 text-center">
        <?php
        $content = $_GET[ 'decode' ];
        /**
         * Spintax - A helper class to process Spintax strings.
         * @name Spintax
         * @author Jason Davis - https://www.codedevelopr.com/
         * Tutorial: https://www.codedevelopr.com/articles/php-spintax-class/
         */
        class Spintax {
            public

            function process( $text ) {
                return preg_replace_callback( '/\{(((?>[^\{\}]+)|(?R))*)\}/x', array( $this, 'replace' ), $text); } public function replace($text) { $text = $this->process($text[1]); $parts = explode('|', $text); return $parts[array_rand($parts)]; } } /* EXAMPLE USAGE */ $spintax = new Spintax(); $text = '<textarea id="decode">';
        $text .= $spintax->process($content);
        $text .= '</textarea>'; echo($text); ?>
            <button type="button" class="btn btn-primary text-capitalize center-block" id="copy">Copy</button>

    </section>
    <section class="alert alert-dismissible">
        <button class="btn btn-green center-block" onclick="goBack()">Go Back</button>
    </section>
    <?php include("includes/nav.html"); ?>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
        $( "#copy" ).click( function () {
            $( "#decode" ).select();
            document.execCommand( 'copy' );
        } );

        function goBack() {   
            window.history.back();
        }
    </script>
</body>

</html>