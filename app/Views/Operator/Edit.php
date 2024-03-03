<?php

?>
<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>
<?php
/** @var array $operator */
?>
    <div>
        <!--    edit operator-->
        <div class="mb-4 d-flex justify-content-end">
            <a href="/admin" class="btn btn-primary " role="button">
                <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Operator</h6>
            </div>

            <div class="card-body">
                <!--            flash data if error -->
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <!--  edit operator-->
                <form action="/operator/edit/<?= $operator['user_id'] ?>" method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="nik">NIK</label>
                        <input type="text" class="form-control col-sm-10" id="nik" name="nik" placeholder="NIK"
                               value="<?= $operator['nik'] ?>" required>
                    </div>

                    <!--                    username-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="username">Username</label>
                        <input type="text" class="form-control col-sm-10" id="username" name="username"
                               placeholder="Username" value="<?= $operator['username'] ?>" required>

                    </div>

                    <!--                    gender-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="gender">Gender</label>
                        <select class="form-control col-sm-10" id="gender" name="gender">
                            <option
                                    value="male" <?= $operator['gender'] == 'male' ? 'selected' : '' ?>>Male
                            </option>
                            <option
                                    value="female" <?= $operator['gender'] == 'female' ? 'selected' : '' ?>>Female
                            </option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="first_name">First Name</label>
                        <input type="text" class="form-control col-sm-10" id="first_name" name="first_name"
                               placeholder="First Name"
                               value="<?= $operator['first_name'] ?>" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="last_name">Last Name</label>
                        <input type="text" class="form-control col-sm-10" id="last_name" name="last_name"
                               placeholder="Last Name"
                               value="<?= $operator['last_name'] ?>" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="email">Email</label>
                        <input type="email" class="form-control col-sm-10" id="email" name="email" placeholder="Email"
                               value="<?= $operator['email'] ?>" required>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="password">Password</label>
                        <input type="password" class="form-control col-sm-10" id="password" name="password"
                               placeholder="Password"
                               value="default" required>
                    </div>
                    <!--                    created at-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="created_at">Created At</label>
                        <input type="text" class="form-control col-sm-10" id="created_at" name="created_at"
                               placeholder="Created At"
                               value="<?= $operator['created_at'] ?>" disabled>
                    </div>

                    <!--                    updated at-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="updated_at">Updated At</label>
                        <input type="text" class="form-control col-sm-10" id="updated_at" name="updated_at"
                               placeholder="Updated At"
                               value="<?= $operator['updated_at'] ?>" disabled>
                    </div>

                    <div class="row mb-4 mt-4">
                        <div class="bg-gray-200 col-12" style="height: 1px"></div>
                    </div>

                    <!-- phone -->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="phone">Phone</label>
                        <input type="text" class="form-control col-sm-10" id="phone" name="phone" placeholder="Phone"
                               value="<?= $operator['phone'] ?>" required>
                    </div>

                    <!--                    alamat-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="address">Alamat</label>
                        <input type="text" class="form-control col-sm-10" id="address" name="alamat"
                               placeholder="Address"
                               value="<?= $operator['alamat'] ?>" required>
                    </div>

                    <div class="row mb-4 mt-4">
                        <div class="bg-gray-200 col-12" style="height: 1px"></div>
                    </div>

                    <!--                    ganti image -->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="image">Image</label>
                        <div class="col-sm-10 row">
                            <?php $image = isset($operator['image']) && strlen($operator['image']) > 0 ? $operator['image'] : 'no-image.png'; ?>
                            <div class="rounded mx-auto d-block col-sm-6">
                                <img src="<?= base_url() . $image ?>"
                                     id="image-preview"
                                     width="200px"
                                     alt="no image">
                            </div>

                            <div>
                                <input type="file" accept="image/jpeg, image/png, image/jpg"
                                       class="form-control-file"
                                       id="image">
                                <button class="btn btn-primary mt-2" disabled type="button" id="upload-image">Upload
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--    modal success and error upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"
         aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel"">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="upload-text">Image uploaded successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
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
                    url: "<?= base_url() . '/operator/upload-image/' . $operator['id'] ?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
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
        };

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