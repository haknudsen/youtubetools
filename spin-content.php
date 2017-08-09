<!doctype html>
<html>

<head>
    <title>Spin Here</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron">
        <div class="container-fluid text-center">
            <h2>Content to Spin</h2>
            <form id="content" action="spin-decode.php">
                <div class="form-group">
                    <textarea id="decode" name="decode"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

    <footer id="footer"></footer>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/header-autoresize.js"></script>
    <script src="includes/autosize.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>