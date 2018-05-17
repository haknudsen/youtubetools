<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Turn list into spin text</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <section class="container">
        <h1 class="text-center">Lists</h1>
    </section>
    <section class="container text-center">
        <h2 class="text-capitalize">Turn List into spintax or separate with commas</h2>
        <h3>Each part on its own line</h3>
        <div class="row">
            <div class="col-sm-4">
                <button id="prefix" class="btn btn-blue">Add Prefix</button>
            </div>
            <div class="col-sm-4">
                <button id="suffix" class="btn btn-green">Add Suffex</button>
            </div>
            <div class="col-sm-4">
                <button id="space" class="btn btn-purple">Add Space Between</button>
            </div>
        </div>
    </section>
    <section class="container-fluid alert-success m-1 text-center">
        <div class="row m-1">
            <div class="col-md-4">
                <h3 class="text-center">Prefix/Suffex</h3>
                <textarea id="decode" name="decode" style="max-height: 700px"></textarea>
            </div>
            <div class="col-md-8">
                <h3 class="text-center">List</h3>
                <textarea id="list" style="max-height: 700px"></textarea>
            </div>
        </div>
    </section>
    <section class="alert alert-success">

        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Result</h3>
                <textarea id="spin" style="max-height: 700px"></textarea>
            </div>
        </div>
        <div class="container text-center">
            <button type="button" class="btn btn-primary text-capitalize center-block" id="copy">Copy</button>
            <button id="clear" class="btn btn-warning center">Clear Fields</button>
        </div>
    </section>
    <?php include("includes/nav.html"); ?>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/add-pre-suf.js"></script>
    <script>
        $( "#copy" ).click( function () {
            $( "#spin" ).select();
            document.execCommand( 'copy' );
        } );
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>