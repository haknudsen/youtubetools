<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>videoID</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <section class="jumbotron">
        <div class="container text-center">
            <form action="privacy_update.php" method="post">
                videoID: <input type="text" name="videoID"><br>
                <div class="active">
                <br>
                <input type="submit"></div>
            </form>
        </div>
    </section>
    <footer id="footer"></footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script>
    $(document).ready(function(){
        $("#footer").load("includes/footer.html")
    })
</script>
</body>

</html>