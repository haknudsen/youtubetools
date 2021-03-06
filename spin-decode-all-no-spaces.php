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
    <section class="container">
        <h1 class="text-center">My YouTube Tools</h1>
    </section>
    <section class="container">
        <?php
        $content = $_GET[ 'decode' ];
        $a = [];
        $b = [];
        $c = [];
        $d = [];
        $e = [];
        $f = [];

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
            for ( $phrase = 0; $phrase < $count; $phrase++ ) {

                $a = $parts[ 0 ];
                $b = $parts[ 1 ];
                $c = $parts[ 2 ];
                $d = $parts[ 3 ];
                $e = $parts[ 4 ];
                $f = $parts[ 5 ];
                $g = $parts[ 6 ];
            }
            $final = [];
            $x = 0;
            for ( $counta = 0; $counta < count( $a ); $counta++ ) {
                $final[ $counta ] = $a[ $counta ];
                for ( $countb = 0; $countb < count( $b ); $countb++ ) {
                    if ( count( $c ) > 0 ) {
                        for ( $countc = 0; $countc < count( $c ); $countc++ ) {
                            if ( count( $d ) > 0 ) {
                                for ( $countd = 0; $countd < count( $d ); $countd++ ) {
                                    if ( count( $e ) > 0 ) {
                                        for ( $counte = 0; $counte < count( $e ); $counte++ ) {
                                            if ( count( $f ) > 0 ) {
                                                for ( $countf = 0; $countf < count( $f ); $countf++ ) {
                                                    if ( count( $g ) > 0 ) {
                                                        for ( $countg = 0; $countg < count( $g ); $countg++ ) {
                                                            echo( $final[ $counta ] . $b[ $countb ] . $c[ $countc ] . $d[ $countd ] . $e[ $counte ] . $f[ $countf ] . $g[ $countg ] . '<br>' );
                                                            ++$x;
                                                        }
                                                    } else {
                                                        echo( $final[ $counta ] . $b[ $countb ] . $c[ $countc ] . $d[ $countd ] . $e[ $counte ] . $f[ $countf ] . '<br>' );
                                                        ++$x;
                                                    }
                                                }
                                            } else {
                                                echo( $final[ $counta ] . $b[ $countb ] . $c[ $countc ] . $d[ $countd ] . $e[ $counte ] . '<br>' );
                                                ++$x;
                                            }
                                        }
                                    } else {
                                        echo( $final[ $counta ] . $b[ $countb ] . $c[ $countc ] . $d[ $countd ] . '<br>' );
                                        ++$x;
                                    }
                                }
                            } else {
                                echo( $final[ $counta ] . $b[ $countb ] . $c[ $countc ] . '<br>' );
                                ++$x;
                            }
                        }
                    } else {
                        echo( $final[ $counta ] . $b[ $countb ] . '<br>' );
                        ++$x;
                    }
                }
            }
            echo( '<br>Total Combinations: ' . $x );
            echo( '<br>phrases: ' . $phrase );
        }
        ?>

    </section>
    <?php include("includes/nav.html"); ?>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>