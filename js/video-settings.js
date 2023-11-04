var json_data;
var json_datatable;
// Get the image element by its id
var gambar = document.getElementById("my-img");
// button to trigger fullscreen image view
var btnFullScreenImage = document.getElementById("fullscreen-img");

// get data content from ajax request
// then:
// 1. create Datatable (https://datatables.net/examples/data_sources/js_array.html)
// 2. filter konten yang aktif dan format data sesuai yang dibutuhkan video.js
fetch("get_content_ao_ajax", {
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
            {title: 'Screen Oreientation'},
            {title: 'Nama konten'},
            {title: 'Konten'},
            {title: 'Status'},
            {title: 'Ditambahkan'},
            {title: ''}
        ],
        data: JSON.parse(json_datatable)
    });

    // filter konten yang aktif dan format data sesuai yang dibutuhkan video.js
    json_data = get_active_video(data);
    play_all_active_video(json_data);
})
.catch((error) => {
    console.error('Error:', error);
});
       
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

// Add a click event listener to the image and button element that calls the makeFullScreen function
gambar.addEventListener("click", makeFullScreen);
btnFullScreenImage.addEventListener("click", makeFullScreen);

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
        // status default adalah "aktif"
        var status = '<a href="deactivate_content_ao/' + ajax_data[i].id_content + '" title="Nonaktifkan"><span class="fa fa-toggle-on"></span></a>';
        // tombol view video
        var tombol_view = '<a href="" data-toggle="modal" data-target="#modal_play" onclick="return play_video(\'' + ajax_data[i].nama_content + '\',\'uploads/contents/' + ajax_data[i].konten + '\')" title="Putar video"><span class="fa fa-2x fa-play"></span></a>';
        // jika status konten tidak aktif
        if (ajax_data[i].aktif === "0") {
            status = '<a href="activate_content_ao/' + ajax_data[i].id_content + '" title="Aktifkan"><span class="fa fa-toggle-off"></span></a>';
        }
        // tombol view image
        if (ajax_data[i].jenis_content === "gambar") {
            tombol_view = '<a href="" data-toggle="modal" data-target="#modal_view_img" onclick="return view_img(\'' + ajax_data[i].nama_content + '\',\'uploads/contents/' + ajax_data[i].konten + '\')" title="Tampilkan gambar"><span class="fa fa-2x fa-image"></span></a>';
        }
        list.push(ajax_data[i].id_content);
        list.push(ajax_data[i].jenis_content);
        list.push(ajax_data[i].screen_orientation);
        list.push(ajax_data[i].nama_content);
        list.push(tombol_view);
        list.push(status);
        list.push(ajax_data[i].timestamp);
        list.push('<a href="delkonten_ao/'+ajax_data[i].id_content+'" onclick="return confirm(\'Yakin hapus konten '+ajax_data[i].nama_content+'?\')"><span class="fa fa-trash-o"></span></a>');
        arr_datatables.push(list);
    }
    data_konten = JSON.stringify(arr_datatables);
    //return list;
    return data_konten;
}

// untuk memfilter konten yang aktif
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
