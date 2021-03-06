<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>textCleaner&#8482;</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container-fluid">
		<h1 class="text-center">textCleaner<sup>&#8482;</sup></h1>
		<div class="container-fluid">
			<textarea id="textCleaner"></textarea>
			<div class="d-flex align-items-center">
				<button type="button" class="btn btn-danger text-capitalize" id="clear">Clear</button>
				<button type="button" class="btn btn-primary text-capitalize" id="copy">Copy</button>
			</div>
		</div>
	</section>
	<section class="alert alert-info buttons-mine">
		<div class="container-fluid">
			<h3 class="text-center">Spaces</h3>
			<div class="d-flex align-items-center text-capitalize container" role="group" aria-label="Spaces">
				<div class="center">
					<button type="button" class="btn btn-green text-capitalize center" id="remove-extra">remove extra</button>
				</div>
				<div class="center">
					<button type="button" class="btn btn-green text-capitalize" id="remove-trailing">remove trailing</button>
				</div>
				<div class="center">
					<button type="button" class="btn btn-green text-capitalize" id="replace-spaces">replace with -</button>
				</div>
				<div class="center">
					<button type="button" class="btn btn-green text-capitalize" id="replace-dashes">replace - with Spaces</button>
				</div>
			</div>
			<hr>
			<div class="container">
				<div class="d-flex align-items-center">
					<div class="col-6">
						<h3 class="text-center">HTML</h3>
					</div>
					<div class="col-6">
						<h3 class="text-center">Line Breaks</h3>
					</div>
				</div>
				<div class="d-flex align-items-center text-capitalize" role="group" aria-label="HTML">
					<div class="col-6 center">
						<button type="button" class="btn btn-orange text-capitalize center" id="remove-html">Remove HTML</button>
						<button type="button" class="btn btn-orange text-capitalize" id="hyperlinks">Make URLs hyperlinks</button>
					</div>
					<div class="col-6 center">
						<button type="button" class="btn btn-drkblue text-capitalize center" id="remove-extra-linebreaks">remove extra line breaks</button>
						<button type="button" class="btn btn-drkblue text-capitalize" id="remove-linebreaks">remove all</button>
					</div>
				</div>
			</div>
			<hr>
			<h3 class="text-center">Change Case</h3>
			<div class="d-flex align-items-center">
				<div class="container d-flex align-items-center">
					<button type="button" class="btn btn-purple text-capitalize center" id="case-upper">All Upper</button>
					<button type="button" class="btn btn-purple text-capitalize center" id="case-lower">All lower</button>
					<button type="button" class="btn btn-purple text-capitalize center" id="case-sentence">Sentence Case</button>
					<button type="button" class="btn btn-purple text-capitalize center" id="case-title">Title Case</button>
				</div>
			</div>
			<hr>
			<div class="container">
				<h3 class="text-center">Convert</h3>
				<div class="d-flex align-items-center text-capitalize" role="group" aria-label="convert">
							<button type="button" class="btn btn-blue text-capitalize center" id="remove-special">Remove Special Characters</button>
							<button type="button" class="btn btn-blue text-capitalize center" id="convert-html">Replace HTML Entities</button>
							<button type="button" class="btn btn-blue text-capitalize center" id="convert-commas">Replace Commas with line break</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="includes/textCleaner.js"></script>
	<script src="includes/autosize.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
		$( "#copy" ).click( function () {
			$( "textarea" ).select();
			document.execCommand( 'copy' );
		} );
		$( document ).ready( function () {
			changeText();
		} )
	</script>
</body>
</html>