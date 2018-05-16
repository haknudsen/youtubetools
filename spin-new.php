<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>My Spinner</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
		<div style="text-align:center;">Provided by <a href="http://www.weontech.com">www.WeOnTech.com</a> - Auto Blog Network - Blog Post SEO - LinkWheel SEO</div>
		<script type="text/javascript">
			function Html( obj ) {
				if ( obj.value == 'Html Code' ) {
					document.getElementById( "textHtml" ).value = document.getElementById( "lblSpin" ).innerHTML;
					document.getElementById( "textHtml" ).style.display = "block";
					document.getElementById( "lblSpin" ).style.display = "none";
					document.getElementById( "inpHtml" ).value = "Preview";
				} else {
					document.getElementById( "textHtml" ).style.display = "none";
					document.getElementById( "lblSpin" ).style.display = "block";
					document.getElementById( "inpHtml" ).value = "Html Code";
				}
			}

			function Spin() {
				var content = document.getElementById( "textSpin" ).value.trim();
				if ( content == "" ) {
					alert( "Please input spyntax content!" );
				} else if ( content.split( "{" ).length != content.split( "}" ).length ) {
					alert( "Incorrect spyntax in content! Please re-check it!" );
				} else {
					if ( document.getElementById( "chkNewLine" ).checked ) {
						var regX = /\n/gi;
						content = content.replace( regX, "<br />" );
					}
					document.getElementById( "lblSpin" ).innerHTML = GetSpinContent( content );
					document.getElementById( "inpHtml" ).style.display = "";
					if ( document.getElementById( "inpHtml" ).value == "Preview" )
						document.getElementById( "textHtml" ).value = document.getElementById( "lblSpin" ).innerHTML;
				}
			}

			function GetSpinContent( text ) {
				var result = text;
				var reg = new RegExp( /{([^{}]*)\}/i );
				while ( matches = reg.exec( result ) ) {
					var array = new Array();
					array = matches[ 1 ].split( '|' );
					result = result.replace( matches[ 0 ], array[ Math.floor( Math.random() * array.length ) ] );
				}

				reg = new RegExp( /\{\{([\s\S]*?)\}\}/i );
				while ( match = reg.exec( result ) ) {
					var array = new Array();
					array = match[ 1 ].split( '||' );
					result = result.replace( match[ 0 ], array[ Math.floor( Math.random() * array.length ) ] );
				}
				return result;
			}
		</script>
	</section>
	<section class="alert alert-dismissible">
		<button class="btn btn-green center-block" onclick="goBack()">Go Back</button>
	</section>
	<?php include("includes/nav.html"); ?>
	<script type="text/javascript" src="auth.js"></script>
	<script type="text/javascript" src="my_uploads.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<script src="includes/navigation.js"></script>
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