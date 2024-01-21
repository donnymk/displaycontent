<?php
foreach ($running_text as $key => $value) {
    $data_running_text = $value->data;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>Admin Outlet</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->

        <!-- EOF CSS INCLUDE -->

        <style>
            body {
                background-color: black;
                overflow: hidden;
            }
            .container{
                display: flex;
                height: 100vh;
                align-items: center;
                font-weight: bold;
            }
            @-moz-keyframes scroll-left {
                0% {
                    -moz-transform: translateX(100%);
                }
                100% {
                    -moz-transform: translateX(-100%);
                }
            }

            @-webkit-keyframes scroll-left {
                0% {
                    -webkit-transform: translateX(100%);
                }
                100% {
                    -webkit-transform: translateX(-100%);
                }
            }

            @keyframes scroll-left {
                0% {
                    -moz-transform: translateX(100%);
                    -webkit-transform: translateX(100%);
                    transform: translateX(100%);
                }
                100% {
                    -moz-transform: translateX(-100%);
                    -webkit-transform: translateX(-100%);
                    transform: translateX(-100%);
                }
            }
            /* Style the marquee container and text */
            .marquee {
                width: 100%;
                height: 50px;
                overflow: visible;
                position: relative;
                white-space: nowrap;
            }
            .marquee p {
/*                display: inline-block;
                float: right;*/
                color: white;
                font-size: 28px;
                position: absolute;
                width: 100%;
                height: 100%;
                margin: 0;
                line-height: 50px;
                text-align: center;
                -moz-transform: translateX(100%);
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
                -moz-animation: scroll-left 3s linear infinite;
                -webkit-animation: scroll-left 3s linear infinite;
                animation: scroll-left 30s linear infinite;
            }
        </style>
    </head>
    <body onclick="toggleFullScreen()">
        <!-- PAGE CONTENT -->
        <div class="container">
            <div class="marquee">
                <p><?= $data_running_text ?></p>
            </div>
        </div>

        <!-- END PAGE CONTENT -->


        <!-- START PRELOADS -->

        <!-- END PRELOADS -->

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->

        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->

        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->

        <!-- END TEMPLATE -->

        <script>
            // Get the document element to display the page in fullscreen
            var elem = document.documentElement;
            // Get the button element to toggle fullscreen mode
            //var div = document.getElementById("my-running-text");
            // Define a function to open or close fullscreen mode
            function toggleFullScreen() {
                // Check if the page is already in fullscreen mode
                if (document.fullscreenElement) {
                    // If yes, exit fullscreen mode
                    document.exitFullscreen();
                } else {
                    // If not, request fullscreen mode
                    elem.requestFullscreen();
                }
            }
        </script>
        <!-- END SCRIPTS -->

    </body>
</html>
