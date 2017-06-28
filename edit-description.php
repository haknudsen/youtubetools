<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>videoID</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="my_uploads.css">
</head>

<body>
    <section class="jumbotron">
        <div class="container text-center">
            <form action="description_update.php" method="post">
                videoID: <input type="text" name="videoID"><br>
                <div class="active">
                    <br>
                    <input type="submit">
                </div>
            </form>
        </div>
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