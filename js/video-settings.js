function play_video(content_name, source) {
    var myPlayer = videojs('my-video');
    
    $('#content-name').html(content_name);
    myPlayer.src(source);
    return true;
}
