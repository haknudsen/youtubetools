<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bulk URLs for PasteBin</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
    <script src="https://apis.google.com/js/client.js" type="text/javascript">
    </script>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="jumbotron">
        <div class="container text-center bulk">
            <div class="row">
                <div class="col-xs-6">
                    <label>URLs to Send to Pastebin
                    <textarea id="urls" style="max-height: 300px"></textarea>
      </label>
                </div>
                <div class="col-xs-6">
                    <label>Keywords
                    <textarea id="keywords" style="max-height: 300px"></textarea>
      </label>
                </div>
            </div>
            <button type="button" class="btn btn-green center-block" id="getPaste">Create HTML</button>
        </div>
        <div class="alert alert-info">
            <div class="m-1">
                <textarea class="text-left" name="link-container" id="link-container"></textarea>
            </div>
        </div>
    </section>
    <?php include("includes/nav.html"); ?>
    <script src="includes/navigation.js"></script>
    <script src="includes/my-array.js"></script>
    <script src="includes/autosize.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
        $( '#getPaste' ).click( function () {
            var paste = Array();
            var keywords = textToArray( $( '#keywords' ).val() );
            var myURLs = textToArray( $( '#urls' ).val() );
            var listLength = keywords.length;
            var l = listLength - 1;
            for ( i = 0; i < myURLs.length; i++ ) {
                info = '<a href="';
                info += myURLs[ i ];
                info += '" title="';
                info += keywords[ l ];
                info += '">';
                info += keywords[ l ];
                info += '</a>';
                paste[ i ] = info;
                if ( l === 0 ) {
                    l = listLength - 1;
                } else {
                    l--;
                }
            }
            $( '#link-container' ).val( paste );
            $( '#link-container' ).val( $( '#link-container' ).val().replace( /,/g, '\n' ) );
            autosize.update($('#link-container'));
            
        } );

        function textToArray( myArray ) {
            "use strict";
            myArray = myArray.split( "\n" );
            myArray = myArray.filter( function ( value ) {
                return value !== "" && value !== null;
            } );
            return myArray;
        }
    </script>
</body>

</html>