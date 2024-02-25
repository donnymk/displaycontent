var json_data;
var json_datatable;

// Get the image element by its id
var gambar = document.getElementById("my-img");
// button to trigger fullscreen image view
var btnFullScreenImage = document.getElementById("fullscreen-img");

var divgambar = document.getElementById("ck_slide");

// digunakan sebagai kontrol (play and stop) slideshow
var intervalId;
var intervalTime = 10000; // initial interval time
var stateSlideshow = 0; //  0 = idle, 1 = running, 2 = stopped

// kondisi awal aktifkan input untuk konten multimedia (gambar dan video)
aktifkan_konten_mm();

// get data konten outlet yang aktif dari ajax request
// then:
// 1. create Datatable (https://datatables.net/examples/data_sources/js_array.html)
// 2. filter konten video yang aktif dan format data sesuai yang dibutuhkan video.js
fetch("get_content_active_ajax", {
    method: "GET",
    headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    }
})
        .then(response => response.json())
        .then(data => {
            // memformat data sesuai yang dibutuhkan Databables
            json_datatable = set_contents_datatable(data);
            //console.log(json_datatable);
            new DataTable('#datakonten', {
                columns: [
                    {title: '#'},
                    {title: 'Jenis konten'},
                    {title: 'Screen Orientation'},
                    {title: 'Nama konten'},
                    {title: 'Konten'},
                    {title: 'Ditambahkan'}
                ],
                data: JSON.parse(json_datatable)
            });

            // filter konten video yang aktif dan format data sesuai yang dibutuhkan video.js
            json_data = get_active_video(data);
            play_all_active_video(json_data);

            // filter konten gambar yang aktif, format data untuk slideshow dan
            // hanya tampilkan gambar pertama (gambar selanjutnya disembunyikan)
            div_images = get_active_images(data);
            $('#ck_slide').html(div_images);
            $("#ck_slide > div:gt(0)").hide();
            
            console.log(stateSlideshow);
            
        })
        .catch((error) => {
            console.error('Error:', error);
        });

// Add a click event listener to the image and button element that calls the makeFullScreen function
gambar.addEventListener("click", makeFullScreen);
btnFullScreenImage.addEventListener("click", makeFullScreen);

divgambar.addEventListener("click", makeFullScreenDiv);

// aktifkan input konten multimedia dan nonaktifkan input konten teks
function aktifkan_konten_mm() {
    $('#div_konten_mm').show();
    $('#div_konten_alt').hide();
    $('#konten').attr('required', 'required');
    $('#kontenAlt').removeAttr('required');
}

// aktifkan input konten teks dan nonaktifkan input konten multimedia
function aktifkan_konten_alt() {
    $('#div_konten_mm').hide();
    $('#div_konten_alt').show();
    $('#kontenAlt').attr('required', 'required');
    $('#konten').removeAttr('required');
}

function atur_konten() {
    // get data input jenis konten
    var jenisKonten = $('#jenisKonten').val();

    switch (jenisKonten) {
        case 'gambar':
            aktifkan_konten_mm();
            break;
        case 'video':
            aktifkan_konten_mm();
            break;
        case 'teks':
            aktifkan_konten_alt();
            break;
        default:
            console.log('Terjadi sesuatu yang tidak diharapkan');
            break;
    }
}

// Use the Fullscreen API to request the browser to enter full screen mode for a specific element, such as an image
// Add an event listener to the image element that calls the requestFullscreen method when clicked
// Handle the different browser prefixes for this method, such as webkitRequestFullscreen or mozRequestFullScreen
// To exit full screen mode, call the exitFullscreen method on the document object
// Use some CSS rules to adjust the size and position of the image when it is in full screen mode

// Define a function to request full screen mode for the image element
function makeFullScreen() {
    // Check if the image element is already in full screen mode
    if (document.fullscreenElement === gambar) {
        // Exit full screen mode
        document.exitFullscreen();
    } else {
        // Request full screen mode for the image element
        // Use different browser prefixes if needed
        if (gambar.requestFullscreen) {
            gambar.requestFullscreen();
        } else if (gambar.webkitRequestFullscreen) {
            gambar.webkitRequestFullscreen();
        } else if (gambar.mozRequestFullScreen) {
            gambar.mozRequestFullScreen();
        }
    }
}

// Define a function to request full screen mode for the slideshow images
function makeFullScreenDiv() {
    // Check if the image element is already in full screen mode
    if (document.fullscreenElement === divgambar) {
        // Exit full screen mode
        document.exitFullscreen();
    } else {
        // Request full screen mode for the image element
        // Use different browser prefixes if needed
        if (divgambar.requestFullscreen) {
            divgambar.requestFullscreen();
        } else if (divgambar.webkitRequestFullscreen) {
            divgambar.webkitRequestFullscreen();
        } else if (divgambar.mozRequestFullScreen) {
            divgambar.mozRequestFullScreen();
        }
    }
}

// fungsi untuk menampilkan gambar yang dipilih user
function view_img(content_name, source) {

    $('#img-name').html(content_name);
    $('#my-img').attr('src', source);
    $('#my-img').attr('width', '100%');
    return true;
}

// fungsi untuk putar video yang dipilih user
function play_video(content_name, source) {
    var myPlayer = videojs('my-video');

    $('#content-name').html(content_name);
    myPlayer.src(source);
    return true;
}

// fungsi untuk putar semua video yang aktif
function play_all_active_video(list_data) {
    var player_all = videojs('all-video');
    console.log(list_data);

    player_all.playlist(JSON.parse(list_data));
    // Play through the playlist after x second(s).
    player_all.playlist.autoadvance(0);
    // When repeat is enabled, the "next" video after the final video in the playlist is the first video in the playlist. This affects the behavior of calling next(), of autoadvance, and so on.
    player_all.playlist.repeat(true);
}

// memformat data sesuai yang dibutuhkan Databables
function set_contents_datatable(data) {
    const arr_datatables = [];
    const ajax_data = data.data;

    for (let i = 0; i < ajax_data.length; i++) {
        var list = [];
        // tombol view video
        var tombol_view = '<a href="" data-toggle="modal" data-target="#modal_play" onclick="return play_video(\'' + ajax_data[i].nama_content + '\',\'uploads/contents/' + ajax_data[i].konten + '\')" title="Putar video"><span class="fa fa-2x fa-play"></span></a>';
        // tombol view image
        if (ajax_data[i].jenis_content === "gambar") {
            tombol_view = '<a href="" data-toggle="modal" data-target="#modal_view_img" onclick="return view_img(\'' + ajax_data[i].nama_content + '\',\'uploads/contents/' + ajax_data[i].konten + '\')" title="Tampilkan gambar"><span class="fa fa-2x fa-image"></span></a>';
        }
        // tombol view running text
        else if (ajax_data[i].jenis_content === "teks") {
            tombol_view = '<a href="view_running_text/' + ajax_data[i].id_content + '" title="Tampilkan teks berjalan"><span class="fa fa-2x fa-file-text"></span></a>';
        }
        list.push(i+1);
        list.push(ajax_data[i].jenis_content);
        list.push(ajax_data[i].screen_orientation);
        list.push(ajax_data[i].nama_content);
        list.push(tombol_view);
        list.push(ajax_data[i].timestamp);
        arr_datatables.push(list);
    }
    data_konten = JSON.stringify(arr_datatables);
    //return list;
    return data_konten;
}

// untuk memfilter konten video yang aktif
// dan memformat data sesuai yang dibutuhkan video.js
function get_active_video(data) {
    //console.log(data.data);
    const ajax_data = data.data;
    const list = [];

    for (let i = 0; i < ajax_data.length; i++) {
        // jika konten "tidak aktif" atau jenis konten bukan video maka lewati
        if (ajax_data[i].aktif !== '1' || ajax_data[i].jenis_content !== 'video') {
            continue;
        }
        // jika konten "aktif" tambahkan ke list
        var item = {
            sources: [{
                    src: 'uploads/contents/' + ajax_data[i].konten,
                    type: 'video/mp4'
                }]
        }
        list.push(item);
    }
    active_contents = JSON.stringify(list);
    //return list;
    return active_contents;
}

// untuk memfilter konten image yang aktif
// dan memformat data yang sesuai untuk slideshow images
function get_active_images(data) {
    //console.log(data.data);
    const ajax_data = data.data;
    var div_slideshow = '';

    for (let i = 0; i < ajax_data.length; i++) {
        // jika konten "tidak aktif" atau jenis konten bukan gambar maka lewati
        if (ajax_data[i].aktif !== '1' || ajax_data[i].jenis_content !== 'gambar') {
            continue;
        }
        // jika konten "aktif" tambahkan ke list
        div_slideshow += '<div><img src="uploads/contents/' + ajax_data[i].konten + '" width="100%"></div>';
    }
    //active_contents = JSON.stringify(list);
    return div_slideshow;
    //return active_contents;
}

// to start the interval for slideshow
function slideshow_images(time) {
    intervalId = setInterval(function () {
        $('#ck_slide > div:first')
                .fadeOut(100)
                .next()
                .fadeIn(900)
                .end()
                .appendTo('#ck_slide');
    }, time);
    stateSlideshow = 1;
}

// to play or stop slideshow images
function play_slideshow() {
    // if slideshow is still running
    if (stateSlideshow === 1) {
        // stop the interval
        clearInterval(intervalId);
        // set status to 2 (stopped)
        stateSlideshow = 2;
        // ubah keterangan tombol
        $('#btn-slideshow-images').html('<span class="fa fa-play"></span> Start slideshow');
    }
    // if slideshow is not started yet (idle) or stopped
    else if (stateSlideshow === 0 || stateSlideshow === 2) {
        // start the interval
        slideshow_images(intervalTime);
        // ubah keterangan tombol
        $('#btn-slideshow-images').html('<span class="fa fa-stop"></span> Stop slideshow');
        
        // request fullscreen
        makeFullScreenDiv();
    }
    console.log(stateSlideshow);
}
