<!DOCTYPE html>
<html>
	<head>
	<title>YouTube Search</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
	<section class="jumbotron">
		<div class="container">
		<h1 class="text-center">Search YouTube</h1>
		<div class="d-flex justify-content-center">
			<button class="btn btn-warning text-center" id="execute-request-button" type="button">Authorize</button>
			<label class="text-center">Search Term
        <input class="align-middle" id="term" name="term" type="text">
      </label>
			<button class="btn btn-purple text-center" id="search" type="button">Search</button>
		</div>
		</div>
	</section>
<section class="container">
      <div id="results"></div>
    </section>
<footer id="footer"></footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script> 
<script async defer onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()" src="https://apis.google.com/js/api.js">
	</script> 
<script src="includes/navigation.js">
	</script> 
<script src="includes/autosize.js">
	</script> 
<script src="includes/YouTube-Search.js"></script>
</body>
</html>