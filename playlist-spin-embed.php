<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Get Embed Code for Videos in Playlist</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/my_uploads.css">
</head>

<body>
    <div id="header"></div>
    <section class="container">
        <h1 class="text-center">Get Embed Code for Videos in Playlist</h1>
        <div id="login-container" class="pre-auth"> This application requires access to your YouTube account. Please <a href="#" id="login-link">authorize</a> to continue. </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <input type="text" name="playlist" id="playlist" style="width: 800px;margin: 5px auto">
                <div class="row  text-capitalize center">
                    <h3 class="text-center">Text Anchors</h3>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-drkblue" id="embed-left">Float Left</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-purple" id="embed-center">Center</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="alert alert-success">
        <textarea class="m-1" id="link-container" style="max-height: 400px"></textarea>
        <button type="button" class="btn btn-primary text-capitalize center-block" id="copy">Copy</button>
        <textarea class="m-1" id="spintax"></textarea>
        <button type="button" class="btn btn-primary text-capitalize center-block" id="copy-spin">Copy Spin</button>
        <button type="button" class="btn btn-warning text-capitalize center-block" id="reset">Reset</button>
    </section>
    <section class="container">
        <div style="width: 50%;max-width:1280px;float:left;padding-right:1rem">
            <div style="position: relative; padding-bottom: 56.25%;  height: 0; overflow: hidden;background: #000">
                <iframe type="text/html" style="position: absolute; top:0; left: 0; width: 100%; height: 100%" src="https://www.youtube.com/embed/AycQ445FBe0?autoplay=1&loop=1&rel=0" frameborder="0"></iframe>
            </div>
        </div>
        Theus Law Offices uses know-how and assessment in the following specialties: Wills and Trusts Asset Protection Planning Trust Protector Services Succession and Probate Administration Estate and Trust Litigation Business Succession Planning Medicaid and Elder Law Planning Asset Protection is an important part of Estate Planning. Theus Law Offices includes asset security includes that successfully protect your traditions from unexpected liabilities today and for future generations. Our group consists of among the location's only licensed experts in Estate Planning and Administration, You will get knowledgeable, skilled and informative suggestions required to guarantee that your family will not be strained with the psychological and monetary expenses of succession and probate matters, which your traditions will be secured Theus Law Offices concentrates on estate, succession and asset defense planning. We use the most sophisticated strategies for both big and little estates to produce an extensive strategy customized particularly for the special requirements and scenarios of each customer.
    </section>
    <footer id="footer"></footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="auth.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="includes/navigation.js"></script>
    <script src="includes/autosize.js"></script>
    <script src="includes/playlist-embed.js"></script>
    <script>
        autosize( document.querySelectorAll( 'textarea' ) );
        $( "#copy" ).click( function () {
            $( "#link-container" ).select();
            document.execCommand( 'copy' );
        } );
        $( "#copy-spin" ).click( function () {
            $( "#spintax" ).select();
            document.execCommand( 'copy' );
        } );
    </script>
</body>

</html>