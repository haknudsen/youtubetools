// JavaScript Document
$.fn.extend({
    autoresize: function () {
        $(this).on('change keyup keydown paste cut', function () {
            var scroll = this.scrollHeight;
            if(scroll<60){scroll=60;}
            $(this).height(0).height(scroll);
        }).change();
    }
});