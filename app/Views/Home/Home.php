<?= $this->extend('Layout/OperatorLayout/Layout') ?>

<?= $this->section('content') ?>


<?php
/**
 * @var array $userData
 * @var array $user
 */
?>

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
    <hr class="border-top-0 mb-4">

    <div class="d-flex w-100">
        <!--        two button produksi and report produksi-->
        <div class="w-100 pr-2 ">
            <a class="btn btn-lh btn-primary w-100 h-100 d-flex align-items-center justify-content-center" href="/qr/scan">
                <i class="fas fa-box mr-3"></i>
                Produksi
            </a>
        </div>

        <div class="w-100 pl-2">
            <a class="btn btn-lg btn-success w-100  h-100 d-flex align-items-center justify-content-center" href="/production/report">
                <i class="fas fa-file mr-3"></i>
                Laporan
            </a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <hr class="border-top-0"/>
</div>

<!--    generate chart-->
<div class="container mt-5">
    <!--        title-->
    <h6 class="text-dark">OK Chart</h6>
    <hr class="border-top-0">
    <canvas id="okproduction"></canvas>
</div>

<div class="container mt-5">
    <!--        title-->
    <h6 class="text-dark">Defect Chart</h6>
    <hr class="border-top-0">
    <canvas id="defectproduction"></canvas>
</div>
<!local builtin = require('telescope.builtin')--    js chart-->
<script src="<?= base_url() ?>dependencies/chart.js/chart.js"></script>
<script>

    window.onload = function () {
        const ctx = document.getElementById("okproduction").getContext('2d');
        const okChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
            },

            // Configuration options go here
            options: {
                responsive: true,
            },
        });
        const defectCtx = document.getElementById("defectproduction").getContext('2d');
        const defectChart = new Chart(defectCtx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
            },
            options: {
                responsive: true,
            },
        });

        //     call api /api/chart
        $.ajax({
            url: '/api/chart',
            method: 'GET',
            success: function (data) {
                data = JSON.parse(data)
                data = data.data
                const datasets = [
                    {
                        label: 'OK',
                        data: [0,0,0,0,0,0,0,0,0,0,0,0],
                        tension: 0.3,
                        borderColor: '#2db300',
                        backgroundColor: '#ffffff',
                    },
                    {
                        label: 'Target',
                        data: [0,0,0,0,0,0,0,0,0,0,0,0],
                        tension: 0.3,
                        borderColor: '#b30000',
                        backgroundColor: '#ffffff',
                    },
                ]

                const defectDatasets = [
                    {
                        label: 'Defect',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        tension: 0.3,
                        borderColor: '#eb3636',
                        backgroundColor: '#f59b9b',
                    }
                ]

                for (let i = 0; i < 12; i++) {
                    const month = i + 1
                    for (const item of data) {
                        if (parseInt(item.date) === month) {
                            console.log(item)
                            defectDatasets[0].data[i] = parseInt(item.defect)
                            datasets[1].data[i] = parseInt(item.qrs)
                            datasets[0].data[i] = parseInt(item.ok)
                        }
                    }
                }
                okChart.data.datasets = datasets
                defectChart.data.datasets = defectDatasets
                defectChart.update()
                okChart.update()
            }
        })
    }


</script>


<?= $this->endSection() ?>

