<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>My Spinner</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="my_uploads.css">
</head>

<body>
    <section class="container">
        <h1 class="text-center">My YouTube Tools</h1>
    </section>
    <section class="container">
        <?php
        $content = $_GET[ 'decode' ];
        echo( spin( $content ) );

        function spin( $s ) {
            preg_match_all( '#\{(.+?)\}#is', $s, $match );
            if ( empty( $match ) ) {
                return "fail";
            }
            $cleaned = $match[ 1 ];
            for ( $count = 0; $count < count( $cleaned ); $count++ ) {
                $t = $cleaned[ $count ];
                if ( strpos( $t, '{' ) !== false ) {
                    $t = substr( $t, strrpos( $t, '{' ) + 1 );
                }
                $parts[ $count ] = explode( "|", $t );
            }
            $c = [];
            for ( $phrase = 0; $phrase < $count; $phrase++ ) {
                for ( $length = 0; $length < count( $parts[ $phrase ] ); $length++ ) {
                    $c[$string][ $length ] = $parts[ $phrase ][ $length ];
                    echo( '<br>' );
                    echo( $c[$string][ $length ]  );
                }
                echo( '<br>' );
            }
            $final=[];
            $x=0;
            for($finalcount=0;$finalcount<count($c[$x]);$finalcount++){
                echo($finalcount);
                for($sub=0;$sub< count($c[$finalcount]);$sub++){
                    $final[$finalcount]= $c[$finalcount][$sub];
                }
                
            }
        }

        ?>

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