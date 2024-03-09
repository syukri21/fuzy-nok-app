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
                            <td><img src="<?= base_url()  . $item->image ?>" alt="image" width="100px"></td>
                            <td> <?= $item->created_at ?></td>
                            <td> <?= $item->updated_at ?></td>

                            <td class="text-center">
                                <a href="/item/edit/<?= $item->id ?>" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $item->id ?>"
                                        data-name="<?= $item->name ?>"
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


    <script>

        window.onload = function () {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('name')
                var modal = $(this)
                modal.find('.modal-title #delete-name').text(name)
                modal.find('.modal-footer a').attr('href', '/item/delete/' + id)
            })
        }
    </script>

<?= $this->endSection() ?>