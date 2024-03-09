<?php

use chillerlan\QRCode\QRCode;


/** @var array $data */

?>
<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

    <!--edit machine-->
    <div>
    <!--    edit machine -->
    <div class="mb-4 d-flex justify-content-end">
        <a href="/machine" class="btn btn-primary " role="button">
            <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Mesin</h6>
        </div>
        <div class="card-body">
            <!--            flash data if error -->
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!--  edit machine-->
            <form method="post" action="<?= base_url() ?>machine/edit/<?= $data['id'] ?>">
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="machine_name">Machine Name</label>
                    <input type="text" class="form-control col-sm-10" id="name" name="name"
                           value="<?= $data['name'] ?>">
                </div>
                <!--                qr text -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label " for="description">Description</label>
                    <input type="text" class="form-control col-sm-10" id="description"
                              name="description"
                              value="<?= $data['description'] ?>"></input>
                </div>
                <!--                qr path -->
                <div class="form-group row">
                    <label class="col-2 col-form-label" for="qr">QR Path</label>
                    <input type="text" class="form-control col-sm-8 rounded-0" id="qr" name="qr"
                           value="<?= $data['qr'] ?>">
                    <button class="btn btn-secondary col-sm-2 rounded-0" type="button" id="generate-qr">Generate QR
                    </button>
                </div>

                <div id="qr-container" class="d-flex justify-content-center align-items-center">
                    <?= '<img style="width: 250px;" id="qr" src="' . (new QRCode)->render($data['qr']) . '" alt="QR Code" />' ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            window.onload = function () {
                $("#generate-qr").click(function () {
                    const text = $("#qr_text").val();
                    const relPath = "qr/generate/" + encodeURI(text);
                    const url = "<?= base_url() ?>" + relPath;
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (data) {
                            console.log(data)
                            $("#qr-container")
                            $("#qr").attr("src", data);
                            $("#qr_path").val(relPath)
                        }
                    });
                })
            }
        </script>
    </div>

<?= $this->endSection() ?>