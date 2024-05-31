<?= $this->extend('Layout/OperatorLayout/Layout') ?>
<?php

/**
 * @var array|object $machine
 * @var array|object $qr
 * @var array|object $qr_data
 * @var array|object $shifts
 * @var array|object  $item
 * */
?>
<?= $this->section('content') ?>

<form class="container" method="post" action="/production/add/<?= $qr->id ?>">
  <!--    flash error-->
  <?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger" role="alert">
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>
  <div class="mt-3">
    <!--        machine-->
    <div class="row">
      <div class="col-5 d-flex justify-content-between">
        <span class="text-dark">Mesin</span>
        <span class="text-dark">:</span>
      </div>
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
        <span class="text-dark">:</span>
      </div>
      <div class="col-auto"><span class="text-dark"><?= $qr_data->noJobDesk ?></span>
      </div>
    </div>
    <!--        item-->
    <div class="row">
      <div class="col-5 d-flex justify-content-between">
        <span class="text-dark">Item</span>
        <span class="text-dark">:</span>
      </div>
      <div class="col-auto"><span class="text-dark"><?= $item->name ?></span>
      </div>
    </div>
  </div>

  <hr class="border-0 p-0" />

  <div class="mt-3">
    <!--        cav-->
    <div class="row align-items-center">
      <div class="col-3 d-flex justify-content-between">
        <span class="text-dark">Cav</span>
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
        <input type="number" class="form-control form-control-sm text-center" id="cycle" name="cycle" />
      </div>
    </div>
    <div class="mt-3"></div>
    <div class="row align-items-center">
      <div class="col-3 d-flex justify-content-between">
        <label for="result" class="text-dark">Hasil</label>
        <span class="text-dark">:</span>
      </div>
      <div class="col-9">
        <input type="text" class="form-control form-control-sm text-center" id="result" name="result" />
      </div>
    </div>

    <div class="mt-3"></div>
    <div class="row align-items-center">
      <div class="col-3 d-flex justify-content-between">
        <span class="text-dark">Defect</span>
        <span class="text-dark">:</span>
      </div>
      <div class="col-3">
        <input type="number" class="form-control form-control-sm text-center" id="defect" name="defect">
      </div>
      <div class="col-3 d-flex justify-content-between">
        <span class="text-dark">OK</span>
        <span class="text-dark">:</span>
      </div>
      <div class="col-3">
        <input type="number" class="form-control form-control-sm text-center" id="ok" name="ok">
      </div>
    </div>
    <div class="mt-3"></div>
    <div class="row align-items-center">
      <div class="col-3 d-flex justify-content-between">
        <label class="text-dark" for="shift">Shift</label>
        <span class="text-dark">:</span>
      </div>
      <div class="col-9">
        <select class="form-select form-select-sm" id="shift" name="shift_id">
          <option value="" selected disabled>Pilih Shift</option>
          <?php foreach ($shifts as $shift) : ?>
            <option value="<?= $shift->id ?>" id="shift-option-<?= $shift->id ?>" data-shift-start="<?= $shift->start_time ?>" data-shift-end="<?= $shift->end_time ?>"><?= $shift->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <hr class="mt-3 border-0">
    <div class="row align-items-center">
      <div class="col-5 d-flex justify-content-between">
        <span class="text-dark">Jam Kerja</span>
        <span class="text-dark">:</span>
      </div>
      <div class="col-auto">
        <span class="text-dark" id="start_time_text"></span>
        <span class="text-dark"> - </span>
        <span class="text-dark" id="end_time_text"></span>
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


  <!--    onSelect shift fill the Jam Kerja-->
  <script>
    window.onload = function() {

      // on Change option
      $("#shift").on("change", function(e) {
        var $option = $("#shift-option-" + e.target.value);
        let start = $option.data("shift-start");
        let end = $option.data("shift-end");
        $("#start_time_text").html(start);
        $("#end_time_text").text(end);
      })


      const cav = <?= $qr_data->cav ?? 0  ?>;
      //  on Change cycle
      $("#cycle").on("keyup", function(e) {
        let value = e.target.value;
        $("#result").val(value * cav);
      })

      //  on Change cycle
      $("#defect").on("keyup", function(e) {
        let value = e.target.value;
        var result = $("#result").val();
        $("#ok").val(result - value)
      })

      //  on Change cycle
      $("#ok").on("keyup", function(e) {
        let value = e.target.value;
        var result = $("#result").val();
        $("#defect").val(result - value)
      })
    }
  </script>

  <?= $this->endSection() ?>


  <!--    script-->
