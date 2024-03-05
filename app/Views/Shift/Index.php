<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

<?php
/** @var array $data */
?>
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger">
        <?php echo session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Shift</h6>

            <div class="d-flex justify-content-end align-content-center align-items-center ">
                <a href="/shift/add" class="btn btn-primary " role="button">
                    <i class="fas fa-plus mr-2"></i> Tambah Shift </a>
            </div>
        </div>
        <div class="card-body">

            <!--        table-->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Shift</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Shift</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($data as $datum) :
                        ?>
                        <tr>
                            <td><?= $datum->name ?></td>
                            <td><?= $datum->description ?></td>
                            <td><?= $datum->start_time ?></td>
                            <td><?= $datum->end_time ?></td>
                            <td class="text-center">
                                <a href="/shift/edit/<?= $datum->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="/shift/delete/<?= $datum->id ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>