// JavaScript Document
var arrUrls = ["http://www.you2repeat.com/watch?v=XXXXXX", "http://youtubeonrepeat.com/watch/?v=XXXXXX", "https://listenonrepeat.com/?v=XXXXXX", "http://www.youtubeloop.net/watch?v=XXXXXX", "http://www.infinitelooper.com/?v=XXXXXX", "https://endlessvideo.com/watch?v=XXXXXX", "https://loopvideos.com/XXXXXX", "https://www.youtuberepeater.com/watch?v=XXXXXX"];
var linkList = Array();
var htmlList = Array();
var info;
$('#clear').click(function(){
    i=0;
    info='';
    $('#link-container').val('');
    $('#htmlLinks').val('');
    $('#videoID').val('');
    $('#keywords').val('');
})
$('#getURLs').click(function () {
    "use strict";
    var list = $('#keywords').val();
    list = list.split("\n");
    list = list.filter(function (value) {
        return value !== "" && value !== null;
    });
    var i = 0;
    var listLength = list.length;
    var l = listLength - 1;
    var id = $('#videoID').val();
    id = id.substring(id.lastIndexOf("=") + 1);
    $('#playlistID').val(list[0]);
    for (i = 0; i < arrUrls.length; i++) {
        var newUrl = arrUrls[i].replace('XXXXXX', id);
        $('#htmlLinks').val($('#htmlLinks').val() + newUrl + '\n');
        htmlList[i] = newUrl;
        info = '[';
        info += list[l];
        info += '](';
        info += newUrl + ')';
        linkList[i] = info;
        if (l === 0) {
            l = listLength - 1;
        } else {
            l--;
        }
    }
    var $link = $('#link-container');
    $link.val(linkList);
    $link.val($('#link-container').val().replace(/,/g, '\n'));
    console.log( htmlList);
    autosize.update($('#link-container'));
    autosize.update( $('#htmlLinks'));
});
