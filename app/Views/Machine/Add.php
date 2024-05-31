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
      <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mesin</h6>
    </div>
    <div class="card-body">
      <!--            flash data if error -->
      <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger">
          <?php echo session()->getFlashdata('error'); ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= base_url() ?>machine/add">

        <input type="number" hidden id="id" name="id" value="">

        <div class="form-group row">
          <label class="col-2 col-form-label" for="machine_name">Machine Name</label>
          <input type="text" class="form-control col-sm-10" id="name" name="name">
        </div>
        <!--                qr text -->
        <div class="form-group row">
          <label class="col-sm-2 col-form-label " for="description">Description</label>
          <input type="text" class="form-control col-sm-10" id="description" name="description">
        </div>
        <!--                qr path -->
        <div class="form-group row">
          <label class="col-2 col-form-label" for="qr">QR Code</label>
          <input type="text" class="form-control col-sm-8 rounded-0" id="qr" name="qr">
          <button class="btn btn-primary col-sm-2 rounded-0" type="button" id="generate-qr">Generate QR
          </button>
        </div>

        <div id="qr-container" class="d-flex justify-content-center align-items-center hidden">
          <div id="qr-image" style="width: 200px" ></div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <script src="<?= base_url() ?>js/qr.js"></script>
  <script>
    window.onload = function() {
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
</div>
<?= $this->endSection() ?>
