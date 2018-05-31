<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Create Video Sitemap</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container-fluid">
			<h1 class="text-center">Video Data Editor</h1>
			<div class="container">
				<h3 class="text-capitalize text-center">Enter Video ID</h3>
				<div class="row">
					<input type="text" id="video" value="https://www.youtube.com/watch?v=VcGe4c5urb4">
				</div>
			</div>
			<div class="container">
				<div class="d-flex">
					<div class="col-6">
						<input type="text" id="loc" class="data" value="http://www.talkingheads.com/">
					</div>
					<div class="col-3">
						<input type="text" id="changefreq" value="monthly" class="data">
					</div>
					<div class="col-3">
						<input type="text" id="priority" value="0.8" class="data">
					</div>
				</div>
				<div class="d-flex text-center">
					<div class="col-6">
						<h3>Page URL</h3>
					</div>
					<div class="col-3">
						<h3>Change Frequency</h3>
					</div>
					<div class="col-3">
						<h3>Priority</h3>
					</div>
				</div>
			</div>
			<div class="d-flex text-center">
				<button type="button" class="btn btn-drkblue" id="execute-request-button">Authorize</button>
				<button type="button" class="btn btn-danger" id="getVideo">Get Video</button>
			</div>
			<h3 id="reporter" class="text-capitalize text-center"></h3>
	</section>
	<section class="container-fluid">
		<div class="alert alert-info">
			
			<div class="row">
				<div class="col-sm-6">
					<h3 class="text-capitalize text-center">description</h3>
					<textarea id="description" style="max-height: 960px;min-height: 20px"></textarea>
					<div class="m-1">
						<h3 class="text-capitalize text-center">Total Letter Count : <span id="counter">0</span></h3>
					</div>
				</div>
				<div class="col-sm-6">
					<h3 class="text-center">Video Sitemap</h3>
					<textarea id="sitemap" style="max-height: 960px;min-height: 20px"></textarea>
				</div>
			</div>
		</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="includes/autosize.js"></script>
	<script src="includes/jquery.simplyCountable-description.js"></script>
	<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};handleClientLoad()" onreadystatechange="if (this.readyState === 'complete') this.onload()">
	</script>
	<script src="includes/get-video-data.js"></script>
	<script>
		$( document ).ready( function () {
			autosize( document.querySelectorAll( 'textarea' ) );
			$( '#description' ).simplyCountable();
			$( '#tags' ).simplyCountable( {
				counter: '#counter2',
				countType: 'characters',
				maxCount: 500
			} );
		} );
	</script>
</body>
</html>