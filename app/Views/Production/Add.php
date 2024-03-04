<?= $this->extend('Layout/OperatorLayout/Layout') ?>
<?php

/**
 * @var array $machine
 * @var array $qr
 * @var array $qr_data
 * */
?>
<?= $this->section('content') ?>

<div class="container">
    <div class="mt-3">
        <!--        machine-->
        <div class="row">
            <div class="col-5 d-flex justify-content-between">
                <span class="text-dark">Mesin</span>
                <span class="text-dark">:</span></div>
            <div class="col-auto"><span class="text-dark"><?= $machine->name ?></span></div>
        </div>
        <!--        job-->
        <div class="row">
            <div class="col-5 d-flex justify-content-between">
                <span class="text-dark">Job</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-auto"><span class="text-dark"><?= $qr_data->job ?></span>
            </div>
        </div>
        <!--        no job desk-->
        <div class="row">
            <div class="col-5 d-flex justify-content-between">
                <span class="text-dark">No Job Desk</span>
                <span class="text-dark">:</span></div>
            <div class="col-auto"><span class="text-dark"><?= $qr_data->noJobDesk ?></span>
            </div>
        </div>
        <!--        item-->
        <div class="row">
            <div class="col-5 d-flex justify-content-between">
                <span class="text-dark">Item</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-auto"><span class="text-dark"><?= $qr_data->item ?></span>
            </div>
        </div>
    </div>

    <hr class="border-0 p-0"/>

    <div class="mt-3">
        <!--        cav-->
        <div class="row align-items-center">
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">Casv</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-3">
                <span class="text-dark"><?= $qr_data->cav ?>
                </span>
            </div>
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">Cycle</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-3">
                <input type="number" class="form-control form-control-sm text-center" id="cycle" name="cycle"/>
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="row align-items-center">
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">Hasil</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-9">
                <input type="text" class="form-control form-control-sm text-center" id="hasil" name="hasil"/>
            </div>
        </div>

        <div class="mt-3"></div>
        <div class="row align-items-center">
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">Defect</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-3">
                <input type="text" class="form-control form-control-sm text-center" id="defect"
                       name="defect">
            </div>
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">OK</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-3">
                <input type="text" class="form-control form-control-sm text-center" id="ok"
                       name="ok">
            </div>
        </div>
        <div class="mt-3"></div>
        <div class="row align-items-center">
            <div class="col-3 d-flex justify-content-between">
                <span class="text-dark">Shift</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-9">
                <span class="text-dark">1</span>
            </div>
        </div>
        <hr class="mt-3 border-0">
        <div class="row align-items-center">
            <div class="col-5 d-flex justify-content-between">
                <span class="text-dark">Jam Kerja</span>
                <span class="text-dark">:</span>
            </div>
            <div class="col-auto">
                <span class="text-dark">08:00 - 18:00</span>
            </div>
        </div>

        <hr class="mt-3 border-0">
        <div class="mb-3"></div>
<!--        button save and exit-->
        <div class="row mt-3">

            <div class="col-12  d-flex justify-content-end">
                <button class="btn-lg shadow-lg mt-4 w-100 btn-primary">Save</button>
            </div>

        </div>

    </div>


    <?= $this->endSection() ?>
