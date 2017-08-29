// JavaScript Document

$("#getSpintax").click(function () {
    "use strict";
    var list = $("#decode").val();
    var text = list.replace(/(\r\n|\n|\r)/gm, "|");
    text = "{" + text;
    text += "}";
    $("#spin").val(text);
    fieldUpdate();
});
$("#commas").click(function () {
    "use strict";
    var list = $("#decode").val();
    var text = list.replace(/(\r\n|\n|\r)/gm, ",");
    $("#spin").val(text);
    fieldUpdate();
});
$("#getHTML").click(function () {
    "use strict";
    var list = $("#decode").val();
    var text = list.replace(/(\r\n|\n|\r)/gm, ",");
    text = text.split(',');
    var i = 0, holder = "";
    $("#spin").val('');
    while(text[i]){
        holder += '<li>' + text[i] + '</li>' + '\n';
        i++;
    }
    $("#spin").val(holder);
    fieldUpdate();
});
$('#clear').click(function(){
    "use strict";
    $("#spin").val('');
    $("#decode").val('');
    fieldUpdate();
});
$(document).ready(function () {
    "use strict";
    $('#spin').simplyCountable({
        counter: '#counter',
        countType: 'characters',
        maxCount: 500
    });
});
function fieldUpdate(){
    "use strict";
    autosize.update($('#spin'));
    autosize.update($('#decode'));
    $('#spin').blur();
}