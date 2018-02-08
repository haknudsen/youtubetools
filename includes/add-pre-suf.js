// JavaScript Document
var beforeOrAfter,space = "";
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
$('#space').click(function () {
    "use strict";
	var txt = $('#space').text();
	if(txt === 'Add Space Between'){
		$('#space').text('No Space');
		space = " ";
	}else{
		$('#space').text('Add Space Between');
		space = "";
	}
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
        textarrout[x] =  toAdd + space  + text[x];
        }else{
        textarrout[x] = text[x] + space + toAdd;
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
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    fieldUpdate();
});

function fieldUpdate() {
    "use strict";
    autosize.update($('#spin'));
    autosize.update($('#list'));
    $('#spin').blur();
}
