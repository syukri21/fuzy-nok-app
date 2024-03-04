<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Scanner</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>dependencies/bootstrap-5.0.2-dist/css/bootstrap.min.css"
          type="text/css">
</head>
<body>
<div id="video-container" style="height: 100vh" class="mx-0">
    <video id="qr-video" style="height: 100%"></video>
</div>

<!--loading-->
<div id="loading" class="d-flex align-items-center justify-content-center" style="height: 0;opacity: 0">
    <div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-primary"></div>
        <div class="spinner-grow text-primary"></div>
    </div>
</div>

<script src="<?= base_url() ?>dependencies/scanner/scanner.js"></script>
<script src="<?= base_url() ?>dependencies/jquery/jquery.min.js"></script>

<script>
    const video = document.getElementById('qr-video');

    function setResult(result) {
        console.log(result.data);
        $("#video-container").css("display", "none")
        const $loading = $("#loading");
        $loading.css("opacity", 1)
        $loading.css("height", "100vh")
        window.location.replace(result.data)

    }

    // ####### Web Cam Scanning #######
    const scanner = new QrScanner(video, result => setResult(result), {
        onDecodeError: error => {
            console.log(error)
        },
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });
    scanner.start();
</script>
