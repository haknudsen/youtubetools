// JavaScript Document
$.fn.extend({
    autoresize: function () {
        $(this).on('change keyup keydown paste cut', function () {
            $(this).height(0).height(this.scrollHeight);
        }).change();
    }
});