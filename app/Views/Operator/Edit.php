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
                            <img src="<?= base_url() . 'uploads/' . $image ?>"
                                 id="image-preview"
                                 class="rounded mx-auto d-block col-sm-6" width="200" height="200"
                                 alt="no image">
                            <input type="file" accept="image/jpeg, image/png, image/jpg"
                                   class="form-control-file col-sm-6"
                                   id="image">
                        </div>
                        <script>
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
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
<?= $this->endSection() ?>