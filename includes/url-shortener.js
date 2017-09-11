// JavaScript Document
// copyright 2017 Talking Heads
var keywords, counter, info, x, i, shortURL, shorts, longUrl;
$('#getURL').click(function () {
    "use strict";
    keywords = $('#keywords').val();
    keywords = keywords.split('\n');
    $("#result").val('');
    $('#shorties').val('');
    $('#playlistID').val(keywords[0]);
    longUrl = $('#url').val();
    gapi.client.setApiKey('AIzaSyBbfVeAk8vKBeM7qLHlqGKObIKEZ5tbMNY');
    for (counter = 0; counter < keywords.length; counter++) {
        console.log( counter );
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
        for (x = 0; x < keywords.length; x++) {
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
