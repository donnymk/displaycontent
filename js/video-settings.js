function play_video(content_name, source) {
    var myPlayer = videojs('my-video');

    $('#content-name').html(content_name);
    myPlayer.src(source);
    return true;
}

var videoSource = new Array();
videoSource[0] = 'uploads/contents/1695046093_b757acfa039ba2d6784c.mp4';
videoSource[1] = 'uploads/contents/1695215263_d17e2da13db12d4d5ffd.mp4';
var videoCount = videoSource.length;
var i = 0;
var allPlayer = videojs('all-video');

allPlayer.src(videoSource[0]);

allPlayer.ready(function () {
    allPlayer.currentTime(80);

    // should be 10 seconds less than duration
    console.log(allPlayer.remainingTime());
});

function videoPlay(videoNum) {
    allPlayer.src(videoSource[videoNum]);
}

function nextVideo() {
    i++;
    if (i == (videoCount)) {
        i = 0;
        videoPlay(i);
    } else {
        videoPlay(i);
    }

}
