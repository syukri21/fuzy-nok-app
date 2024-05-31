<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

<?php
/** @var array $data */
?>

<!--import clip.js-->

<!--flash success-->
<?php if (!empty(session()->getFlashdata('success'))) : ?>
  <div class="alert alert-success " role="alert">
    <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

<?php if (!empty(session()->getFlashdata('error'))) : ?>
  <div class="alert alert-danger " role="alert">
    <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

<div class="card shadow mb-4 ">
  <div class="card-header d-flex justify-content-between align-items-center ">
    <h6 class="m-0 font-weight-bold text-primary">Tabel QRData</h6>

    <div class="d-flex justify-content-end align-content-center align-items-center ">
      <a href="/qr/add" class="btn btn-primary " role="button">
        <i class="fas fa-plus mr-2"></i> Tambah QR </a>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Code</th>
            <th>Type</th>
            <th>QR URL</th>
            <th class="">Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Code</th>
            <th>Type</th>
            <th>QR URL</th>
            <th class="">Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          foreach ($data as $datum) : ?>
            <tr>
              <td><?= $datum->code ?></td>
              <td><?= $datum->type ?></td>
              <td>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="input-group-text show-qr" data-text="<?= base_url() . "api/qr/" . $datum->code ?>"><i class="fas fa-qrcode"></i>
                    </button>
                  </div>
                  <input class="form-control bg-white" type="text" value="<?= base_url() . "api/qr/" . $datum->code ?>" readonly name="qr-<?= $datum->code ?>" id="qr-<?= $datum->code ?>">
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-success copy-button" type="button" data-clipboard-demo data-clipboard-target="#qr-<?= $datum->code ?>">
                      <i class="fas fa-copy"></i>
                    </button>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <a href="/qr/edit/<?= $datum->id ?>" class="btn btn-primary btn-circle btn-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $datum->id ?>" data-name="<?= $datum->code ?>" class="btn btn-danger btn-circle btn-sm">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Delete <span id="delete-name" class="text-primary"></span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apa kamu yakin?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="#">Yes</a>
      </div>
    </div>
  </div>
</div>

<!--modal qr-->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">QR Code</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="qrcode">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script src="<?= base_url() ?>js/clip.js"></script>
<script src="<?= base_url() ?>js/qr.js"></script>

<!--    js modal-->
<script>
            let asd = new QRCode();

console.log(asd)

  function onClickButtonShowModal() {
    $(".show-qr").on("click", function() {
      const text = this.getAttribute("data-text");
      console.log(text)
      $.ajax({
        url: "/qr/generate",
        method: "POST",
        data: {
          text: text
        },

        success: function(data) {
          // show modal
          $('#qrcode').attr('src', data);
          $('#qrModal').modal('show');

        },
        error: function(data) {
          console.log(data);
        }
      });

    })

  }

  window.onload = function() {
    $('#deleteModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var name = button.data('name')
      var modal = $(this)
      modal.find('.modal-title #delete-name').text(name)
      modal.find('.modal-footer a').attr('href', '/qr/delete/' + id)
    })
    onClickButtonShowModal()
  }

  var clipboard = new ClipboardJS('.btn');

  clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);
  });

  clipboard.on('error', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);
  });
</script>


<?= $this->endSection() ?>
