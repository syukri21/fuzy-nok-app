<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

<!--add machine-->
<div>
  <!--    add operator -->
  <div class="mb-4 d-flex justify-content-end">
    <a href="/machine" class="btn btn-primary " role="button">
      <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Tambah Order</h6>
    </div>
    <div class="card-body">
      <!--            flash data if error -->
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger">
          <?php echo session()->getFlashdata('error'); ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= base_url() ?>order/add">

        <input type="number" hidden id="id" name="id" value="">

        <!--                 item -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="item_id">Item</label>
          <select class="form-control col-sm-10 rounded-0 form-select form-select-sm" id="item_id" name="item_id">
            <option value="" selected disabled>Pilih Item</option>
            <?php foreach ($items as $item) : ?>
              <option value="<?= $item->id ?>" id="item-option-<?= $item->id ?>"><?= $item->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-sm-2 text-dark" for="target">Target Produksi</label>
          <input type="number" class=" form-control col-sm-10 rounded-0 form-select form-select-sm" id="target" name="target" placeholder="..." required>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="machines">Machines</label>
          <select class="form-control col-sm-8 rounded-0 form-select form-select-sm" id="machines" name="machines">
            <option value="" selected disabled>Pilih Item</option>
            <?php foreach ($machines as $machine) : ?>
              <option value="<?= $machine->id ?>" data-machine-name="<?= $machine->name ?>" id="machine-option-<?= $machine->id ?>"><?= $machine->name ?></option>
            <?php endforeach; ?>
          </select>
          <button class="btn btn-primary col-sm-2 rounded-0" type="button" id="add-machine">Tambah Mesin</button>
        </div>

        <div class="form-group row">
          <div class="col-sm-2 col-form-label"></div>
          <div class="col-sm-10" id="machine-container"></div>
        </div>
        <input type="text" hidden id="machine_ids" name="machine_ids">

        <div id="qr-container" class="d-flex justify-content-center align-items-center hidden">
          <div id="qr-image" style="width: 200px"></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <script src="<?= base_url() ?>js/qr.js"></script>
  <script>
    window.onload = function() {


      $("#add-machine").click(function() {
        const id = $("#machines").val();
        const machine = $("#machine-option-" + id)
        const name = machine.attr("data-machine-name");
        $("#machine-container").append(`
          <div class="display-inline" id="machine-${id}">
          <span class="badge badge-primary" id="machine-badge-${id}">${name}</span>
          </div>
          `)
        machine.remove();
        if ($("#machine_ids").val() == "") {
          $("#machine_ids").val(id);
        } else {
          $("#machine_ids").val($("#machine_ids").val() + "," + id);
        }
      })


      $("#generate-qr").click(function() {
        const text = $("#qr_text").val();
        const relPath = "qr/generate";
        const url = "<?= base_url() ?>" + relPath;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data) {
            data = JSON.parse(data)
            $("#qr").val(data.qr);
            $("#id").val(data.id);
            new QRCode(document.getElementById("qr-image"), data.qr);
            $("#qr-container").removeClass("hidden");
          }
        });
      })
    }
  </script>
  <style>
    .display-inline {
      display: inline;
    }
  </style>
</div>
<?= $this->endSection() ?>
