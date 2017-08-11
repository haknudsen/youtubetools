// JavaScript Document

$("#getSpintax").click(function () {
    var list = $("#decode").val();
    var text = list.replace(/(\r\n|\n|\r)/gm, "|");
    text = "{" + text;
    text += "}";
    $("#spin").val(text);
    fieldUpdate();
});
$("#commas").click(function () {
    var list = $("#decode").val();
    var text = list.replace(/(\r\n|\n|\r)/gm, ",");
    $("#spin").val(text);
    fieldUpdate();
});
$(document).ready(function () {
    $('#spin').simplyCountable({
        counter: '#counter',
        countType: 'characters',
        maxCount: 500
    });
});
function fieldUpdate(){
    autosize.update($('#spin'));
    autosize.update($('#decode'));
    $('#spin').blur();
}