<!doctype html>
<html>

<head>
    <title>Home</title>
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
    <section class="jumbotron">
        <div class="container-fluid text-center">
            <h2>Spin All</h2>
        <h3 class="text-danger">Only works for 2 to 4 spins</h3>
            <form id="content" action="spin-decode-all.php">
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
    <script>
        $( document ).ready( function () {
            $( "#footer" ).load( "includes/footer.html" )
        } )
    </script>
</body>

</html>