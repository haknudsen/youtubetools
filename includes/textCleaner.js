// JavaScript Document
function changeText() {
    "use strict";
    var myText, str = "";
    //----------------------------------------------------Spaces
    $('#remove-extra').click(function () {
        myText = getText();
        myText = myText.replace(/ +/g," ");
        myText = myText.replace(/\n /g,"\n");
        changeText(myText.trim());
    });
    $('#remove-trailing').click(function () {
        myText = getText();
        changeText(myText.trim());
    });
    //---------------------------------------Line Breaks
    $('#remove-extra-linebreaks').click(function () {
        myText = getText();
        myText = myText.replace(/\n\n/g,"\n");
        myText = myText.replace(/ \n/g,"\n");
        myText = myText.replace(/\s /g, '');

        changeText(myText.trim());
    });
    $('#remove-linebreaks').click(function () {
        myText = getText();
        var stringArray = myText.split('\n');
        var temp = [""];
        var x = 0;
        for (var i = 0; i < stringArray.length; i++) {
            if (stringArray[i].trim() !== "") {
                temp[x] = stringArray[i];
                x++;
            }
        }
        myText = temp.join(' ');
        changeText(myText);
    });
    //-------------------------------------Case
    $('#case-lower').click(function () {
        myText = getText();
        changeText(myText.toLowerCase());
    });
    $('#convert-br').click(function () {
        console.log('Hit');
        myText = getText();
        myText = myText.replace(/<br>/g, "/n");
        changeText(myText);
    });
    $('#case-upper').click(function () {
        myText = getText();
        changeText(myText.toUpperCase());
    });
    $('#case-sentence').click(function () {
        myText = getText(); {
            myText = myText.toLowerCase();
            var textArray = myText.split('.');
            var sentenceArray = [];

            for (var x = 0; x < textArray.length; x++) {
                textArray[x] = textArray[x].trim();
                var lower = textArray[x].slice(1);
                var part = textArray[x].charAt(0).toUpperCase();
                console.log('part- ' + part);
                console.log('1st character-' + textArray[x].charAt(0));
                console.log('lower: ' + lower);
                sentenceArray.push(part + lower);
            }
            str = sentenceArray.join('. ');
        }
        changeText(str);
    });
    $('#case-title').click(function () {
        myText = getText();
        str = myText.replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
        changeText(str);
    });
    ///----------------------------------HTML

    $('#hyperlinks').click(function () {
        myText = getText();
        str = '<a href="' + myText;
        str += '">' + myText;
        str += '</a>';
        changeText(str);
    });
    $('#remove-html').click(function () {
        myText = getText().replace(/(<([^>]+)>)/ig, "");
        str = myText.replace(/(\r\n|\n|\r)/gm, "\n");
        str = str.replace(/ +(?= )/g, '\n');
        changeText(str);
    });
    //---------------------------------convert

    $('#convert-html').click(function () {
        myText = getText();
        myText = myText.replace(/&lt;/g, "<")
            .replace(/&gt;/g, ">")
            .replace(/&amp;/g, "&")
            .replace(/&#039;/g, "'")
            .replace(/&#034;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&#34;/g, '"')
            .replace(/&quot;/g, '"')
            .replace(/&rsquo;/g, "'");

        changeText(myText);
    });
    $('#remove-special').click(function () {
        var s = getText();
            var s = text;
    // smart single quotes and apostrophe
    s = s.replace(/[\u2018\u2019\u201A]/g, "\'");
    // smart double quotes
    s = s.replace(/[\u201C\u201D\u201E]/g, "\"");
    // ellipsis
    s = s.replace(/\u2026/g, "...");
    // dashes
    s = s.replace(/[\u2013\u2014]/g, "-");
    // circumflex
    s = s.replace(/\u02C6/g, "^");
    // open angle bracket
    s = s.replace(/\u2039/g, "<");
    // close angle bracket
    s = s.replace(/\u203A/g, ">");
    // spaces
    s = s.replace(/[\u02DC\u00A0]/g, " ");
        s = s.replace(/’/g, "'");
        changeText(s);
    });
    $('#convert-commas').click(function(){
        myText = getText().replace(/,/g, '\n');
        changeText(myText);
    });
    ////-----------------------------------general functions
    function getText() {
        return $('#textCleaner').val().toString();
    }

    function changeText(myText) {
        $('#textCleaner').val(myText);
         autosize.update($('#textCleaner'));
    }



}
jQuery.fn.cleanWhitespace = function() {
    "use strict";
    var textNodes = this.contents().filter(
        function() { return (this.nodeType === 3 && !/\S/.test(this.nodeValue)); })
        .remove();
    return this;
};
