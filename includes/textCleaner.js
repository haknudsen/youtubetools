// JavaScript Document
function changeText() {
    "use strict";
    var myText, str = "";
    //----------------------------------------------------Spaces
    $('#remove-extra').click(function () {
        myText = getText();
        myText = myText.replace(/ +/g," ");
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
        myText = temp.join('');
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
        str = myText.replace(/(\r\n|\n|\r)/gm, "");
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
    $('#convert-special').click(function () {
        myText = getText().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ' ');
        changeText(myText.trim());
    });
    ////-----------------------------------general functions
    function getText() {
        return $('#textCleaner').val().toString();
    }

    function changeText(myText) {
        $('#textCleaner').val(myText);
    }



}
jQuery.fn.cleanWhitespace = function() {
    "use strict";
    var textNodes = this.contents().filter(
        function() { return (this.nodeType === 3 && !/\S/.test(this.nodeValue)); })
        .remove();
    return this;
};
