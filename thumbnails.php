<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Get Thumbnails</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron text-center">
        <h1>Get Thumbnails</h1>
        <h2>For a Specific Video</h2>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form action="thumbnail-view.php" method="post" class="form">
                        videoID: <input type="text" name="videoID">
                        <input type="submit" value="Submit" id="submit" class="btn btn-green"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer"></footer>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="includes/my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
</body>

</html>