<!doctype html>
<html>

<head>
    <title>Playlist Videos Titles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="jumbotron">
        <h1 class="text-center">Get Playlist Video Titles</h1>
        <div id="login-container" class="pre-auth text-center"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input type="text" name="playlist" id="playlist" style="width: 100%">
                <br/>
                <button type="button" class="btn btn-purple center-block" id="playlistClick">click</button>
            </div>
        </div>
    </section>
    <section class="alert alert-info">
        <div id="video-container" class="container"></div>
        <div class="button-container">
            <button id="prev-button" class="paging-button" onclick="previousPage();">Previous Page</button>
            <button id="next-button" class="paging-button" onclick="nextPage();">Next Page</button>
        </div>
    </section>
    <footer id="footer"></footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="auth.js"></script>
    <script type="text/javascript" src="includes/my_titles.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/header-autoresize.js"></script>
</body>

</html>