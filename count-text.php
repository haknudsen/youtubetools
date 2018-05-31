<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Character Count</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>
<body>
<div id="header"></div>
<section class="jumbotron text-center">
   <h1>Word and Character Count</h1>
    <textarea name="count" id="count" cols="30" rows="12"></textarea>
    <div class="d-flex justify-content-center">
        <h3>Total Letter Count : <span id="counter">0</span></h3>
		<div class="col-1"></div>
        <h3>Total Word Count : <span id="words">0</span></h3>
    </div>
    <button type="button" class="btn btn-primary text-capitalize text-center" id="copy">Copy</button>
</section>
<footer id="footer"></footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
<script src="includes/jquery.simplyCountable.js"></script>
<script src="includes/navigation.js"></script> 
<script src="includes/autosize.js"></script> 
<script>
    $(document).ready(function(){
          $('#count').simplyCountable();
          $('#count').simplyCountable({
      counter:            '#words',
      countType:          'words',
      maxCount:           500,
      strictMax:          false,
      countDirection:     'up',
      safeClass:          'safe',
      overClass:          'over',
      thousandSeparator:  ','
          });
    });
    autosize(document.querySelectorAll('textarea'));
    $("#copy").click(function(){
        $("textarea").select();
        document.execCommand('copy');
    });
</script>
</body>
</html>