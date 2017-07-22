<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>My Spinner</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <section class="container">
        <h1 class="text-center">My YouTube Tools</h1>
    </section>
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

    </section>
    <section class="alert alert-dismissible">
        <button class="btn btn-green center-block" onclick="goBack()">Go Back</button>
    </section>
    <footer id="footer"></footer>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script>
        $( document ).ready( function () {
            $( "#footer" ).load( "includes/footer.html" )
        } );

        function goBack() {   
            window.history.back();
        }
    </script>
</body>

</html>