// JavaScript Document
$.fn.extend({
    autoresize: function () {
        "use strict";
        $(this).on('change keyup keydown paste cut blur', function () {
            $(this).height(0).height(this.scrollHeight);
            console.log('Hit ' + this);
        }).change();
    }
});
    $(document).ready(function(){
        "use strict";
        $("#footer").load("includes/footer.html");
        $("#header").load("includes/header.php");
    });