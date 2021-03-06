// JavaScript Document
// copyright 2017 Talking Heads
var keywords, counter, info, x, i, shortURL, shorts, longUrl,listLength ;
    console.log("click<br/>");
$('#getURL').click(function () {
    "use strict";
    console.log("click<br/>");
    keywords = $('#keywords').val();
    keywords = keywords.split('\n');
	keywords = keywords.sort(function(a, b){return 0.5 - Math.random()});
    $("#result").val('');
    $('#shorties').val('');
    $('#playlistID').val(keywords[0]);
    longUrl = $('#url').val();
    gapi.client.setApiKey('AIzaSyBbfVeAk8vKBeM7qLHlqGKObIKEZ5tbMNY');
    listLength = keywords.length;
    if(listLength>70){
        listLength =70;
    }
    console.log(listLength);
    for (counter = 0; counter < listLength; counter++) {
        gapi.client.load('urlshortener', 'v1', function () {
            var request = gapi.client.urlshortener.url.insert({
                'resource': {
                    'longUrl': longUrl
                }
            });
            request.execute(function (response) {
                if (response.id !== null) {
                    shortURL = response.id;
                    if (shortURL !== null) {
                        $('#shorties').val($('#shorties').val() + shortURL + "\n");
                    }
                } else {
                    alert("Error: creating short url \n" + response.error);
                }
                autosize.update($('#shorties'));
            });
        });
    }
});
$('#getPastebin').click(function () {
    "use strict";
    if (typeof shortURL !== 'undefined') {
        $('#link-container').val('');
        shorts = $('#shorties').val();
        shorts = shorts.split('\n');
        for (x = 0; x < listLength; x++) {
            info = '';
            info = '[';
            info += keywords[x];
            info += '](';
            info += shorts[x] + ')';
            $('#link-container').val($('#link-container').val() + info + "\n");
            autosize.update($('#link-container'));
        }
    }
});
$('#clear').click(function () {
    "use strict";
    $('#playlistID').val('');
    $('#link-container').val('');
    $('#shorties').val('');
    $('#keywords').val('');
    $('#url').val('');
    keywords = counter = info = x = i = shortURL = shorts = 0;
    autosize.update($('#link-container'));
    autosize.update($('#shorties'));
    autosize.update($('#keywords'));
});
