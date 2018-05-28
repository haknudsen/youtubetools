<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Randomize Lists</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include( "includes/header.php"); ?>
	<section class="container">
		<h1 class="text-center">Randomize a List</h1>
	</section>
	<section class="container-fluid text-center">
		<div class="d-flex align-items-start">
			<div class="col-6">
				<h3 class="text-center">Range</h3>
				<div class="d-flex align-items-start">
					<div class="col-4 offset-2">
						<h4 class="text-center">Low</h4>
						<input id="low" type="text">
						<h6 class="text-center">*For 1 leave empty</h6>
					</div>
					<div class="col-4">
						<h4 class="text-center">High</h4>
						<input id="high" type="text">
						<h6 class="text-center">*For max leave empty</h6>
					</div>
				</div>
				<div class="btn-group" role="group" aria-label="Randomize List">
					<button id="getSpintax" class="btn btn-primary">Get Spintax</button>
					<button id="commas" class="btn btn-purple">Comma Separated</button>
					<button id="randomize" class="btn btn-drkblue">Randomize</button>
				</div>
			</div>

			<div class="col-6">
				<div class="mt-3">
					<textarea id="decode" name="decode" style="max-height: 700px"></textarea>
					<button id="clear" class="btn btn-danger">Clear Fields</button>
				</div>
				<div>
				</div>
			</div>
		</div>

		<div class="container">
			<textarea id="spin" style="max-height: 700px"></textarea>
			<div class="m-1">
				<button type="button" class="btn btn-primary text-capitalize mx-auto" id="copy">Copy</button>
				<h3>Total Letter Count : <span id="counter">0</span></h3>
				<h3>Number of lines: <span id="lines"></span></h3>
			</div>
		</div>-
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include( "includes/nav.html"); ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="includes/lists-random.js"></script>
	<script src="includes/autosize.js"></script>
	<script src="includes/jquery.simplyCountable.js"></script>
	<script>
		$( document ).ready( function () {
			listFunctions();
			autosize( document.querySelectorAll( 'textarea' ) );
		} );
	</script>
</body>

</html>