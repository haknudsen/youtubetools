// JavaScript Document
// copyright 2017 Talking Heads
var keywords, counter, info, x,i, shortURL,shorts;
$('#getURL').click(function () {
    "use strict";
    keywords = $('#keywords').val();
    keywords = keywords.split('\n');
    $("#result").val('');
    $('#shorties').val('');
    $('#playlistID').val(keywords[keywords.length-1]);
    var longUrl = $('#url').val();
    gapi.client.setApiKey('AIzaSyBbfVeAk8vKBeM7qLHlqGKObIKEZ5tbMNY');
    for (counter = 0; counter < keywords.length; counter++) {
        gapi.client.load('urlshortener', 'v1', function () {
            var request = gapi.client.urlshortener.url.insert({
                'resource': {
                    'longUrl': longUrl
                }
            });
            request.execute(function (response) {
                if (response.id !== null) {
                    shortURL = response.id;
                    $('#shorties').val($('#shorties').val() + shortURL + "\n");
                } else {
                    alert("Error: creating short url \n" + response.error);
                }
        autosize.update($('#shorties'));
            });
        });
    }
   $('#getPastebin').click(function(){
        if(typeof shortURL !== 'undefined'){
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
});
