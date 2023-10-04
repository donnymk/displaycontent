function play_video(content_name, source) {
    var myPlayer = videojs('my-video');

    $('#content-name').html(content_name);
    myPlayer.src(source);
    return true;
}

var player_all = videojs('all-video');

player_all.playlist([{
        sources: [{
                src: 'http://media.w3.org/2010/05/sintel/trailer.mp4',
                type: 'video/mp4'
            }],
        poster: 'http://media.w3.org/2010/05/sintel/poster.png'
    }, {
        sources: [{
                src: 'http://media.w3.org/2010/05/bunny/trailer.mp4',
                type: 'video/mp4'
            }],
        poster: 'http://media.w3.org/2010/05/bunny/poster.png'
    }, {
        sources: [{
                src: 'http://vjs.zencdn.net/v/oceans.mp4',
                type: 'video/mp4'
            }],
        poster: 'http://www.videojs.com/img/poster.jpg'
    }, {
        sources: [{
                src: 'http://media.w3.org/2010/05/bunny/movie.mp4',
                type: 'video/mp4'
            }],
        poster: 'http://media.w3.org/2010/05/bunny/poster.png'
    }, {
        sources: [{
                src: 'http://media.w3.org/2010/05/video/movie_300.mp4',
                type: 'video/mp4'
            }],
        poster: 'http://media.w3.org/2010/05/video/poster.png'
    }]);

// Play through the playlist automatically.
player_all.playlist.autoadvance(0);
