<?= $this->extend('Layout/AdminLayout/Layout') ?>

<?= $this->section('content') ?>

<?php
/** @var array $data */
/**
 * @var array $pager
 * @var int $page
 * @var int $perPage
 * @var int $count
 */
?>

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

    <div class="card shadow mb-4">

        <div class="card-header d-flex justify-content-between align-items-center ">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Item</h6>

            <div class="d-flex justify-content-end align-content-center align-items-center ">
                <a href="/item/add" class="btn btn-primary " role="button">
                    <i class="fas fa-plus mr-2"></i> Tambah Item </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($data as $item) : ?>
                        <tr>
                            <td> <?= $item->id ?></td>
                            <td> <?= $item->name ?></td>
                            <td> <?= $item->description ?></td>
                            <td><img src="<?= base_url() . $item->image ?>" alt="image" width="100px"></td>
                            <td> <?= $item->created_at ?></td>
                            <td> <?= $item->updated_at ?></td>
                            <td>
                                <a href="/item/edit/<?= $item->id ?>" class="btn btn-primary">Edit</a>
                                <a href="/item/delete/<?= $item->id ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?= $this->endSection() ?>