<!doctype html>
<html>

<head>
    <title>Get all from Spin</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="jumbotron">
        <div class="container-fluid text-center">
            <h2>Spin All</h2>
            <h3 class="text-danger">Only works for 2 to 7 phrases</h3>
            <button type="button" id="spaces" class="btn btn-default">Click for No Spaces</button>
            <form id="content" action="spin-decode-all.php">
                <div class="form-group">
                    <textarea id="decode" name="decode"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
	<div class="d-flex align-items-center">
	<button onclick="goBack()">Go Back</button>
	</div>
	<?php include("includes/random-site-ad.php"); ?>
    <?php include("includes/nav.html"); ?>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="includes/my_uploads.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script>
		function goBack() {
			window.history.back();
		}
        autosize( document.querySelectorAll( 'textarea' ) );
        $( '#spaces' ).click( function () {
            $( '#content' ).attr( 'action', 'spin-decode-all-no-spaces.php' );
            $( '#spaces' ).css( 'color', '#00FF00' );
        } );
    </script>
</body>

</html>