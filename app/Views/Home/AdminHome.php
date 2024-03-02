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
<!-- DataTales Example -->
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success " role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Operator</h6>
    </div>

    <div class="card-body">
        <!--  add operator-->
        <div class="mb-4 d-flex justify-content-end align-content-center align-items-center">
            <a href="/operator/add" class="btn btn-primary " role="button">
                <i class="fas fa-plus mr-2"></i> Tambah Operator </a>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="d-flex justify-content-center">Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="d-flex justify-content-center">Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                foreach ($data as $datum) : ?>
                    <tr>
                        <td><?= $datum->first_name ?> <?= $datum->last_name ?></td>
                        <td><?= $datum->nik ?></td>
                        <td><?= $datum->email ?></td>
                        <td><?= $datum->phone ?></td>
                        <td class="d-flex justify-content-around">
                            <a href="/operator/edit/<?= $datum->id ?>" class="btn btn-primary btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->makeLinks($page, $perPage, $count, 'simple', 0, 'operator') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
