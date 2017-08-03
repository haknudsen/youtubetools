// JavaScript Document
$.fn.extend({
    autoresize: function () {
        "use strict";
        $(this).on('change paste cut blur', function () {
        var newHeight =  this.scrollHeight;
            console.log('newHeight-' + newHeight);
            console.log('current Height-' +$(this).height());
            if(this.scrollHeight < 40){
                newHeight = 40;
            }
            if(this.scrollHeight > 800){
                newHeight = 800;
            }
            $(this).height(0).height(newHeight);
        }).change();
    }
});
    $(document).ready(function(){
        "use strict";
        $("#footer").load("includes/nav.html");
        $("#header").load("includes/header.php");
    });