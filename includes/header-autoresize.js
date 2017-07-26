// JavaScript Document
$.fn.extend({
    autoresize: function () {
        "use strict";
        $(this).on('change keyup keydown paste cut', function () {
            $(this).height(0).height(this.scrollHeight);
        }).change();
    }
});
    $(document).ready(function(){
        "use strict";
        $("#footer").load("includes/footer.html");
        $("#header").load("includes/header.php");
    });