// JavaScript Document
var beforeOrAfter;
$('#prefix').click(function () {
    "use strict";
    beforeOrAfter = "before";
    addPreSuf();
});
$('#suffix').click(function () {
    "use strict";
    beforeOrAfter = "after";
    addPreSuf();
});

function addPreSuf() {
    "use strict";
    var toAdd = $('#decode').val();
    var text = $('#list').val();
    text = text.replace(/\r/g, '');
    text = text.split(/\n/);
    var textlen = text.length;
    var textarrout = new Array();
    for (var x = 0; x < textlen; x++) {
        if( beforeOrAfter === "before"){
        textarrout[x] =  toAdd + ' ' + text[x];
        }else{
        textarrout[x] = text[x] + ' ' + toAdd;
        }
    }
    var textout = textarrout.join('\n');
    $('#spin').val(textout);
    fieldUpdate();
}
$('#clear').click(function () {
    "use strict";
    $("#spin").val('');
    $("#decode").val('');
    $("#list").val('');
    fieldUpdate();
});

function fieldUpdate() {
    "use strict";
    autosize.update($('#spin'));
    $('#spin').blur();
}
