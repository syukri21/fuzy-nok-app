<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>
<div>
    <!--    add operator -->
    <div class="mb-4 d-flex justify-content-end">
        <a href="/operator" class="btn btn-primary " role="button">
            <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Operator</h6>
        </div>
        <div class="card-body">
            <!--            flash data if error -->
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <!--  add operator-->
            <form action="/operator/add" method="post">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="nik">NIK</label>
                    <input type="text" class="form-control col-sm-10" id="nik" name="nik" placeholder="NIK" required>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="first_name">First Name</label>
                    <input type="text" class="form-control col-sm-10" id="first_name" name="first_name"
                           placeholder="First Name"
                           required>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="last_name">Last Name</label>
                    <input type="text" class="form-control col-sm-10" id="last_name" name="last_name"
                           placeholder="Last Name"
                           required>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="email">Email</label>
                    <input type="email" class="form-control col-sm-10" id="email" name="email" placeholder="Email"
                           required>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="phone">Phone</label>
                    <input type="text" class="form-control col-sm-10" id="phone" name="phone" placeholder="Phone"
                           required>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-dark" for="password">Password</label>
                    <input type="password" class="form-control col-sm-10" id="password" name="password"
                           placeholder="Password"
                           required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
