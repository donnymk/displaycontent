function play_video(content_name, source) {
    var myPlayer = videojs('my-video');

    $('#content-name').html(content_name);
    myPlayer.src(source);
    return true;
}

// get data content
function get_content() {
    fetch("get_content_ao_ajax", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                var value = [];
                //for (var i in data) {
                //    value.push(data[i].jumlahdata);
                //}
            })
            .catch((error) => {
                console.error('Error:', error);
            });
}

get_content();

var player_all = videojs('all-video');

player_all.playlist([{
        sources: [{
                src: 'http://media.w3.org/2010/05/sintel/trailer.mp4',
                type: 'video/mp4'
            }]
    }, {
        sources: [{
                src: 'http://vjs.zencdn.net/v/oceans.mp4',
                type: 'video/mp4'
            }]
    }]);

// Play through the playlist automatically.
player_all.playlist.autoadvance(0);
// When repeat is enabled, the "next" video after the final video in the playlist is the first video in the playlist. This affects the behavior of calling next(), of autoadvance, and so on.
player_all.playlist.repeat(true);


