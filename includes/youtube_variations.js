// JavaScript Document
var arrUrls = ["http://y2u.be/XXXXXX", "http://youtu.be/XXXXXX", "https://youtu.be/XXXXXX", "http://m.youtu.be/XXXXXX", "https://m.youtu.be/XXXXXX", "http://youtube.com/e/XXXXXX", "http://youtube.com/v/XXXXXX", "http://youtube.com/e/XXXXXX", "https://youtube.com/e/XXXXXX", "https://youtube.com/v/XXXXXX", "http://m.youtube.com/e/XXXXXX", "https://m.youtube.com/v/XXXXXX", "https://m.youtube.com/e/XXXXXX", "https://m.youtube.com/v/XXXXXX", "http://www.youtube.com/e/XXXXXX", "http://www.youtube.com/v/XXXXXX", "http://youtube.com/embed/XXXXXX", "https://youtube.com/embed/XXXXXX", "https://www.youtube.com/e/XXXXXX", "https://youtube.com/embed/XXXXXX", "https://www.youtube.com/v/XXXXXX", "http://m.youtube.com/embed/XXXXXX", "http://youtube.com/watch?v=XXXXXX", "https://m.youtube.com/embed/XXXXXX", "https://youtube.com/watch?v=XXXXXX", "http://www.youtube.com/embed/XXXXXX", "http://m.youtube.com/watch?v=XXXXXX", "https://m.youtube.com/watch?v=XXXXXX", "https://www.youtube.com/embed/XXXXXX", "http://m.www.youtube.com/embed/XXXXXX", "http://www.youtube.com/watch?v=XXXXXX", "http://youtube.com/v/XXXXXX?version=3", "http://www.youtube.com/watch?v=XXXXXX", "https://www.youtube.com/watch?v=XXXXXX", "https://youtube.com/v/XXXXXX?version=3", "http://youtube.com/e/XXXXXX?app=desktop", "https://youtube.com/e/XXXXXX?app=desktop", "http://www.youtube.com/v/XXXXXX?version=3", "https://www.youtube.com/v/XXXXXX?version=3", "http://www.youtube.com/v/XXXXXX&feature=kp", "http://www.youtube.com/e/XXXXXX?app=desktop", "https://www.youtube.com/v/XXXXXX&feature=kp", "https://www.youtube.com/watch?v=XXXXXX&app=m", "https://www.youtube.com/e/XXXXXX?app=desktop", "http://youtube.com/watch?v=XXXXXX&app=desktop", "http://www.youtube.com/v/XXXXXX&feature=share", "https://www.youtube.com/v/XXXXXX&feature=share", "https://youtube.com/watch?v=XXXXXX&app=desktop", "http://www.youtube.com/watch?v=XXXXXX&feature=kp", "http://www.youtube.com/v/XXXXXX&feature=youtu.be", "https://www.youtube.com/watch?v=XXXXXX&app=mobile", "https://www.youtube.com/v/XXXXXX&feature=youtu.be", "http://www.youtube.com/watch?v=XXXXXX&app=desktop", "https://www.youtube.com/watch?v=XXXXXX&feature=kp", "http://youtube.com/watch?feature=youtu.be&v=XXXXXX", "https://www.youtube.com/watch?v=XXXXXX&app=desktop", "http://youtube.com/watch?feature=youtu.be&v=XXXXXX", "https://youtube.com/watch?feature=youtu.be&v=XXXXXX", "https://www.youtube.com/watch?v=XXXXXX&feature=share", "http://www.youtube.com/v/XXXXXX&feature=youtube_gdata", "https://www.youtube.com/v/XXXXXX&feature=youtube_gdata", "http://www.youtube.com/watch?v=XXXXXX&feature=youtu.be", "https://www.youtube.com/watch?v=XXXXXX&hc_location=ufi", "http://www.youtube.com/watch?feature=youtu.be&v=XXXXXX", "http://youtube.com/watch?feature=youtube_gdata&v=XXXXXX", "https://www.youtube.com/watch?feature=youtu.be&v=XXXXXX", "https://www.youtube.com/watch?v=XXXXXX&feature=youtu.be", "https://youtube.com/watch?feature=youtube_gdata&v=XXXXXX", "http://www.youtube.com/watch?feature=youtube.be&v=XXXXXX", "https://youtube.com/watch?feature=youtube_gdata&v=XXXXXX", "http://youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://www.youtube.com/watch?feature=youtube.be&v=XXXXXX", "http://youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://www.youtube.com/watch?feature=youtube_gdata&v=XXXXXX", "http://www.youtube.com/watch?feature=youtube_gdata&v=XXXXXX", "http://m.youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://m.youtube.com/watch?v=XXXXXX&feature=youtube_gdata", "http://www.youtube.com/watch?v=XXXXXX&feature=youtube_gdata", "https://www.youtube.com/watch?v=XXXXXX&feature=youtube_gdata", "https://m.youtube.com/watch?feature=player_embedded&v=XXXXXX", "http://www.youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://www.youtube.com/watch?feature=player_embedded&v=XXXXXX", "http://m.www.youtube.com/watch?feature=player_embedded&v=XXXXXX", "https://www.youtube.com/attribution_link?a=XXXXXX&u=watch?v=XXXXXX&feature=share", "https://www.youtube.com/attribution_link?a=XXXXXX&u=%2Fwatch%3Fv%3DXXXXXX%26feature%3Dshare"];
var anchor = 'https://www.youtube.com/watch?v=';
var linkList = Array();
var info;
$('#getURLs').click(function () {
    "use strict";
    var list = $('#keywords').val();
    list = list.split("\n");
    list = list.filter(function(value) {
    return value !== "" && value !== null;
});
        console.log(list );
    var i = 0;
    var listLength = list.length;
    var l = listLength-1;
    var id = $('#videoID').val();
    id = id.substring(id.indexOf("=") + 1);
    $('#playlistID').val(id);
    for (i = 0; i <60; i++) {
        var newUrl = arrUrls[i].replace('XXXXX', id);
        info = '[';
        info += list[l];
        info += '](';
        info += anchor + newUrl + ')';
        linkList[i] = info;
        console.log(l);
        if(l === 0){l=listLength-1;}else{l--;}
    }
            var $link = $('#link-container');
            $link.val( linkList );
            $link.val($('#link-container').val().replace(/,/g, '\n'));
            $link.autoresize();
});
