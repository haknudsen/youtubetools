<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>My Spinner</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="container-fluid alert-success p-2 m-1 text-center">
		<div style="min-height:500px;">
			<table cellpadding="5" cellspacing="5" border="0" align="center" width="800px">
				<tr>
					<td>
						Spyntax content:<br/>
						<textarea id="textSpin" rows="10" style="width:100%;"></textarea>
						<input id="chkNewLine" type="checkbox"/>Convert newline to &ltbr /&gt
					</td>
				</tr>
				<tr>
					<td>
						<input id="inpSpin" type="button" value="Next Spun" onclick="Spin();"/> <input id="inpHtml" type="button" value="Html Code" onclick="Html(this);" style="display:none;"/>
					</td>
				</tr>
				<tr>
					<td>
						<textarea id="textHtml" rows="10" style="width:100%;display:none;"></textarea>
						<label id="lblSpin"></label>
					</td>
				</tr>
			</table>
		</div>
		<button class="btn btn-green center-block" onclick="goBack()">Go Back</button>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="includes/my_uploads.js"></script>
	<script src="includes/best-spinner.js"></script>
	<script src="includes/autosize.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
		$( "#copy" ).click( function () {
			$( "#decode" ).select();
			document.execCommand( 'copy' );
		} );

		function goBack() {   
			window.history.back();
		}
	</script>
</body>

</html>