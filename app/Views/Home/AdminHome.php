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

<!--flash success-->
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success " role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>


<div class="card shadow mb-4 ">
    <div class="card-header d-flex justify-content-between align-items-center ">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Operator</h6>

        <div class="d-flex justify-content-end align-content-center align-items-center ">
            <a href="/operator/add" class="btn btn-primary " role="button">
                <i class="fas fa-plus mr-2"></i> Tambah Operator </a>
        </div>
    </div>

    <div class="card-body">
        <!--  add operator-->

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
                            <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $datum->user_id ?>"
                                    data-name="<?= $datum->first_name ?> <?= $datum->last_name ?>"
                                    class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->makeLinks($page, $perPage, $count, 'simple', 0, 'operator') ?>


        </div>
    </div>
</div>

<!--            modal confirm-->
<div>
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

    <script>
        window.onload = function () {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-footer a').attr('href', '/operator/delete/' + id)
                modal.find('#delete-name').text(button.data('name'))
            })
        }
    </script>
</div>
<?= $this->endSection() ?>
