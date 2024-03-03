<?= $this->extend('Layout/OperatorLayout/Layout') ?>

<?= $this->section('content') ?>


<?php
/**
 * @var array $userData
 * @var array $user
 */
?>

<div class="bg-light" style="min-height: 100vh">
    <!--appbar with feature back, titile, and more-->
    <div class="d-flex justify-content-between align-items-center bg-light py-2">
        <button class="btn btn-light">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div>
            <h5 class="m-0 font-weight-bold text-gray-800">NOK</h5>
        </div>
        <form action="/logout" method="POST">
            <button class="btn btn-light" type="submit"><i class="fa  fa-sign-out-alt"></i></button>
        </form>
    </div>

    <div class="container mt-4 row">
        <div class="col-6">
            <img class="rounded-circle shadow-lg" style="height: 150px; width: 150px;"
                 src="<?= base_url() . $userData->image ?>" alt="">
        </div>

        <div class="col-6 d-flex flex-column justify-content-center align-items-start">
            <span class="m-0 pl-2 text-gray-800"><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
            <span class="mt-2 pl-2  text-gray-900"><?= $user['nik'] ?></span>
        </div>
    </div>



    <div class="container mt-4">
        <h6 class="text-dark">Action</h6>
        <hr class="border-top-0 mb-4"  >

        <div class="btn-group w-100">
            <!--        two button produksi and report produksi-->
            <button class="btn btn-lh btn-primary w-100">
                <i class="fas fa-box mr-3"></i>
                Produksi
            </button>

            <button class="btn btn-lg btn-success w-100">
                <i class="fas fa-file mr-3"></i>
                Laporan
            </button>

        </div>
    </div>

    <div class="container mt-4">
        <hr class="border-top-0"/>
    </div>

    <!--    generate chart-->
    <div class="container mt-5">
<!--        title-->
        <h6 class="text-dark">Chart</h6>
        <hr class="border-top-0" >
        <canvas id="chartProduksi" ></canvas>
    </div>
    <!--    js chart-->
    <script src="<?= base_url() ?>dependencies/chart.js/chart.js"></script>
    <script>

        var ctx = document.getElementById("chartProduksi").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: 'Produksi',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    tension:0.3
                }],
            },

            // Configuration options go here
            options: {
                responsive: true,
            },
        });
    </script>

</div>


<?= $this->endSection() ?>

