// JavaScript Document
function listFunctions() {
    "use strict";
    var list, text, i, holder;
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
        outputList(text);
    });
    $("#randomize").click(function () {
        list = $("#decode").val();
        text = list.split('\n');
        text.sort(function (a, b) {
            return 0.5 - Math.random()
        });
        outputList(text);
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
    function outputList(text){
        $("#spin").val('');
        holder = "";
        i = 0;
        while (text[i]) {
            holder += text[i];
            if (i < text.length-1) {
                holder += '\n';
            }
            i++;
            console.log( i + " - " + text[i]);
        }
        $("#spin").val(holder);
        fieldUpdate();}
}
