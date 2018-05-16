<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Get Thumbnails</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="jumbotron text-center">
        <h1>View Thumbnails</h1>
        <h2>For a Specific Video</h2>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <form action="thumbnail-view.php" method="post" class="form">
                        videoID: <input type="text" name="videoID">
                        <input type="submit" value="Submit" id="submit" class="btn btn-green"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("includes/nav.html"); ?>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="includes/my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
</body>

</html>