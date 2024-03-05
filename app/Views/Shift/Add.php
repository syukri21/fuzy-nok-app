<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>


    <div>
        <!--    add shift -->
        <div class="mb-4 d-flex justify-content-end">
            <a href="/qr" class="btn btn-primary " role="button">
                <i class="fas fa-arrow-left mr-2"></i> Kembali </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Shift</h6>
            </div>
            <div class="card-body">
                <!--            flash data if error -->
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <!--  add operator-->
                <form action="/shift/add" method="post">

                    <!--                    code, data, type-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="name">Name</label>
                        <div class="input-group col-sm-10 px-0">
                            <input type="text" class="form-control " id="name" name="name"
                                   placeholder="Name"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="description">Description</label>
                        <input type="text" class="form-control col-sm-10" id="description" name="description"
                               placeholder="Description"/>
                    </div>

                    <!--                start-->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="start_time">Start Time</label>
                        <input type="time" class="form-control col-sm-10" id="start_time" name="start_time"
                               placeholder="Start Time"/>
                    </div>

                    <!--                    end -->
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-dark" for="end_time">End Time</label>
                        <input type="time" class="form-control col-sm-10" id="end_time" name="end_time"
                               placeholder="End Time"/>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>

<?= $this->endSection() ?>