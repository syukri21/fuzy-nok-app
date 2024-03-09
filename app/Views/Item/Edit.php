<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

<?php
/** @var array $data */
?>

<div>
    <div class="mb-4 d-flex justify-content-end">
        <a href="/machine" class="btn btn-primary " role="button">
            <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
    </div>

    <!--    add operator -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Item</h6>
        </div>

        <div class="card-body">
            <form action="/item/edit/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!--                flash data if error -->
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <!--                flash data if success -->
                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $data['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description"
                    ><?= $data['description'] ?></textarea>
                </div>

                <!--                    ganti image -->
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="image">Image</label>
                    <div class="col-sm-10 d-flex justify-content-between px-0">
                        <div class="">
                            <img src="<?= base_url() . $data['image'] ?>"
                                 id="image-preview"
                                 width="200px"
                                 alt="no image">
                        </div>
                        <div>
                            <input type="file" accept="image/jpeg, image/png, image/jpg"
                                   class="form-control-file"
                                   name="image"
                                   id="image">
                            <button class="btn btn-primary mt-2" disabled type="button" id="upload-image">Upload
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>

        function onUploadImage() {
            const uploadImage = $("#upload-image");
            uploadImage.removeAttr("disabled")
            uploadImage.on("click", function () {
                const val = $("#image")[0].files;
                console.log(val)
                const formData = new FormData();
                formData.append('image', val[0]);
                console.log("asd")
                $.ajax({
                    url: "<?= base_url() . '/item/upload-image' ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log("data", data)
                        $("#uploadModal").modal('show')
                        $("#upload-text").removeClass("text-danger").addClass("text-success").text("Image uploaded successfully")
                    },
                    error: function (data) {
                        $("#uploadModal").modal('show')
                        $("#upload-text").removeClass("text-success").addClass("text-danger").text("Image upload failed")
                    }
                })
            })
        }

        window.onload = function () {
            onUploadImage()
        }


        function readURL(input) {
            const files = input.target.files;
            if (files && files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(files[0]);
            }
        }

        // change do not use jquery
        document.getElementById("image").addEventListener("change", function (e) {
            readURL(e);
        })
    </script>

    <?= $this->endSection() ?>
