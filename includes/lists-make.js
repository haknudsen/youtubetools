// JavaScript Document
function listFunctions() {
    "use strict";
    var list, text, i, holder;
    var randomArray = new Array();
    $("#getSpintax").click(function () {
        list = $("#decode").val();
        text = list.replace(/(\r\n|\n|\r)/gm, "|");
        text = "{" + text;
        text += "}";
        $("#spin").val(text);
        i = 1;
        fieldUpdate();
    });
    $("#commas").click(function () {
        list = $("#decode").val();
        text = list.replace(/(\r\n|\n|\r)/gm, ",");
        $("#spin").val(text);
        i = 1;
        fieldUpdate();
    });
    $("#getHTML").click(function () {
        list = $("#decode").val();
        text = list.replace(/(\r\n|\n|\r)/gm, ",");
        text = text.split(',');
        i = 0;
        holder = "<ul>\n";
        $("#spin").val('');
        while (text[i]) {
            holder += '   <li>' + text[i] + '</li>' + '\n';
            i++;
        }
        holder += "</ul>";
        $("#spin").val(holder);
        fieldUpdate();
    });
    $("#alphabetize").click(function () {
        list = $("#decode").val();
        text = list.split('\n');
        text.sort();
        $("#spin").val('');
        holder = "";
        i = 0;
        while (text[i]) {
            if (text[i] !== "") {
                holder += text[i] + '\n';
            }
            i++;
        }
        $("#spin").val(holder);
        fieldUpdate();
    });
    $("#randomize").click(function () {
        list = $("#decode").val();
        text = list.split('\n');
        $("#spin").val('');
        var i = 0,
            j = 0,
            temp = null;
        holder = "";
        for (i = text.length - 1; i > 0; i -= 1) {
            j = Math.floor(Math.random() * (i + 1));
            temp = text[i];
            holder += text[j] + '\n';
            text[j] = temp;
        }
        $("#spin").val(holder);
        fieldUpdate();
    });
    $('#convert-commas').click(function () {
        list = $("#decode").val();
        holder = list.replace(/,/g, '\n');
        $("#spin").val(holder);
        fieldUpdate();
    });
    //End functions
    $('#clear').click(function () {
        $("#spin").val('');
        $("#decode").val('');
        fieldUpdate();
    });
    $('#spin').simplyCountable({
        counter: '#counter',
        countType: 'characters',
        maxCount: 500
    });

    function fieldUpdate() {
        $('#lines').text(i);
        autosize.update($('#spin'));
        autosize.update($('#decode'));
        $('#spin').blur();
    }
}
