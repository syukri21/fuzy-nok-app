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

    <div class="card shadow mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Mesin</h6>

            <div class="d-flex justify-content-end align-content-center align-items-center ">
                <a href="/machine/add" class="btn btn-primary " role="button">
                    <i class="fas fa-plus mr-2"></i> Tambah Mesin </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>QR URL</th>
                        <th>Updated At</th>
                        <th class="d-flex justify-content-center">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>QR URL</th>
                        <th>Updated At</th>
                        <th class="d-flex justify-content-center">Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach ($data as $datum) : ?>
                        <tr>
                            <td><?= $datum->name ?></td>
                            <td><?= $datum->description ?></td>
                            <td><?= $datum->qr_url ?></td>
                            <td><?= $datum->created_at->humanize() ?></td>
                            <td><?= $datum->updated_at->humanize() ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="/machine/edit/<?= $datum->id ?>" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $datum->id ?>"
                                        data-name="<?= $datum->name ?>"
                                        class="btn btn-danger btn-circle btn-sm">
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Delete <span id="delete-name"
                                                                                class="text-primary"></span></h5>
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
    <!--    js modal-->
    <script>
        window.onload = function () {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var modal = $(this)
                modal.find('.modal-title #delete-name').text(name)
                modal.find('.modal-footer a').attr('href', '/machine/delete/' + id)
            })
        }
    </script>



<?= $this->endSection() ?>