<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Playlist video links</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>
<body>
<div id="header"></div>
<section class="container">
  <h1 class="text-center">IDs from Playlist</h1>
  <div id="login-container" class="pre-auth"> This application requires access to your YouTube account.  Please <a href="#" id="login-link">authorize</a> to continue. </div>
  <div class="row text-center">
      <input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
	</div>
  <div class="row text-center">
      <button type="button" class="btn btn-primary" id="playlistClick">Submit</button>
  </div>
</section>
<section class="alert alert-success">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-3">
        <textarea id="video-container"></textarea>
        <button type="button" class="btn btn-green text-capitalize" id="copy">Copy</button>
      </div>
      <div class="col-md-9">
        <textarea id="spin"></textarea>
        <button type="button" class="btn btn-green text-capitalize" id="copy-spin">Copy</button>
      </div>
    </div>
  </div>
</section>
<footer id="footer"></footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script src="auth.js"></script>  
<script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script> 
<script src="includes/navigation.js"></script> 
<script src="includes/autosize.js"></script> 
<script src="includes/playlist-video-ids.js"></script>
<script>
    $("#copy-spin").click(function(){
    $("#spin-spin").select();
    document.execCommand('copy');
});
    $("#copy").click(function(){
    $("#video-container").select();
    document.execCommand('copy');
});
    autosize(document.querySelectorAll('textarea'));
</script>
</body>
</html>