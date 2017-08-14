// JavaScript Document
var arrUrls = ["http://www.you2repeat.com/watch?v=XXXXXX", "http://youtubeonrepeat.com/watch/?v=XXXXXX", "https://listenonrepeat.com/?v=XXXXXX", "http://www.youtubeloop.net/watch?v=XXXXXX", "http://www.infinitelooper.com/?v=XXXXXX", "https://endlessvideo.com/watch?v=XXXXXX", "https://loopvideos.com/XXXXXX", "https://www.youtuberepeater.com/watch?v=XXXXXX",  "http://loopvid.io/video/XXXXXX","http://youloop.org/loop.php?v=XXXXXX"];
var linkList = Array();
var info;
$('#getURLs').click(function () {
    "use strict";
    var list = $('#keywords').val();
    list = list.split("\n");
    list = list.filter(function (value) {
        return value !== "" && value !== null;
    });
    console.log(list);
    var i = 0;
    var listLength = list.length;
    var l = listLength - 1;
    var id = $('#videoID').val();
    id = id.substring(id.lastIndexOf("=") + 1);
    $('#playlistID').val(id);
    for (i = 0; i < 9; i++) {
        var newUrl = arrUrls[i].replace('XXXXXX', id);
        info = '[';
        info += list[l];
        info += '](';
        info += newUrl + ')';
        linkList[i] = info;
        console.log(l);
        if (l === 0) {
            l = listLength - 1;
        } else {
            l--;
        }
    }
    var $link = $('#link-container');
    $link.val(linkList);
    $link.val($('#link-container').val().replace(/,/g, '\n'));
    autosize.update($('#link-container'));
});
