<?php
$api_dev_key = '8633e8df7b1fe0423b83017afbbaedd1';
$api_user_name = urlencode( 'talkingheads' );
$api_user_password = urlencode( 'talk1ngheads' );
$url = 'https://pastebin.com/api/api_login.php';
$ch = curl_init( $url );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, 'api_dev_key=' . $api_dev_key . '&api_user_name=' . $api_user_name . '&api_user_password=' . $api_user_password . '' );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
curl_setopt( $ch, CURLOPT_NOBODY, 0 );

$response = curl_exec( $ch );
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>URL with keywords for PasteBin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
	<script src="https://apis.google.com/js/client.js" type="text/javascript">
	</script>
</head>

<body>
	<?php include("includes/header.php"); ?>
	<section class="jumbotron">
		<div class="text-center bulk">
			<div class="d-flex align-items-center">
				<div class="col-6">
					<label>URL to Send to Pastebin
                    <input type="text" id="pasteURL" style="max-height: 300px"></input type="text">
      </label>
				</div>
				<div class="col-6">
					<label>Keywords
                    <textarea id="keywords" style="max-height: 300px"></textarea>
      </label>
				</div>
			</div>
			<button type="button" class="btn btn-green center-block" id="getPaste">Create Paste</button>
		</div>
		<div class="alert alert-info">
			<form action="pastebin-send.php" class="container">
				<textarea style="max-height: 500px" class="text-left" name="link-container" id="link-container"></textarea>
				<div class="m-1 text-center">
					<label>Enter name for Pastebin:<input type="text" value="" name="playlistID" id="playlistID"></label>
					<button type="submit" class="btn btn-green">Send to Paste Bin</button>
				</div>
				<input type="hidden" value="<?=$response?>" name="userID" id="userID">
			</form>
		</div>
	<div class="d-flex align-items-center">
	<button type="button" class="btn btn-danger center-block" id="clear">Clear Fields</button>
	</div>
	</section>
	<?php include("includes/random-site-ad.php"); ?>
	<?php include("includes/nav.html"); ?>
	<script src="includes/my-array.js"></script>
	<script src="includes/autosize.js"></script>
	<script>
		autosize( document.querySelectorAll( 'textarea' ) );
		$( '#getPaste' ).click( function () {
			var paste = Array();
			var keywords = textToArray( $( '#keywords' ).val() );
			var URL = $( '#pasteURL' ).val();
			var listLength = keywords.length;
			var l = listLength - 1;
			for ( i = 0; i < listLength; i++ ) {
				info = '[';
				info += keywords[ i ];
				info += '](';
				info += URL + ')';
				paste[ i ] = info;
				if ( l === 0 ) {
					l = listLength - 1;
				} else {
					l--;
				}
			}
			$( '#link-container' ).val( paste );
			$( '#link-container' ).val( $( '#link-container' ).val().replace( /,/g, '\n' ) );
			autosize.update($('#link-container'));
		} );
		$('#clear').click(function(){
			$( '#keywords' ).val('');
			$( '#pasteURL' ).val('');
			$( '#link-container' ).val( '' );
			paste = [];
		})
		function textToArray( myArray ) {
			"use strict";
			myArray = myArray.split( "\n" );
			myArray = myArray.filter( function ( value ) {
				return value !== "" && value !== null;
			} );
			return myArray;
		}
	</script>
</body>
</html>