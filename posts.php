<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $( document ).ready( function () {
            $.ajax( {
                url: "http://seovideoexperts.com/wp-json/wp/v2/posts?per_page=1",
                success: function ( result ) {
                    var excerpt = result[0].excerpt.rendered;
                    var linkStart = '[&hellip;]';
                    var theLink = '<a href="http://seovideoexperts.com/">[&hellip;]</a>';
                    var excerptLink = excerpt.replace(linkStart, theLink);
                    $("#excerpt").html(excerptLink);
                    $('#title').text(result[0].title.rendered);
                },
            error: function ( xhr ) {
                alert( "An error occured: " + xhr.status + " " + xhr.statusText );
            }
        } );
        } );
    </script>
</head>

<body>
<section class="container">
       <h2>Latest Blog Post- <span id="title"></span></h2>
    <div id="excerpt" class="text-info"></div>
    <div id="results" name="results"></div>
</section>
</body>

</html>