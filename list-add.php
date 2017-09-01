<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Turn list into spin text</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="container">
        <h1 class="text-center">Lists</h1>
    </section>
    <section class="container text-center">
        <h2 class="text-capitalize">Turn List into spintax or separate with commas</h2>
        <h3>Each part on its own line</h3>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <button id="prefix" class="btn btn-drkblue">Add Prefix</button>
            </div>
            <div class="col-sm-4">
                <button id="suffix" class="btn btn-green">Add Suffex</button>
            </div>
        </div>
    </section>
    <section class="container-fluid alert-success m-1 text-center">
        <div class="row m-1">
            <div class="col-md-3 col-md-offset-1">
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
            <button id="clear" class="btn btn-warning center">Clear Fields</button>
        </div>
    </section>
    <footer id="footer"></footer>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/add-pre-suf.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
    </script>
</body>

</html>