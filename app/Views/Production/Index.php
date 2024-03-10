<?= $this->extend('Layout/OperatorLayout/Layout') ?>

<?= $this->section('content') ?>

    <div class="container px-2 mt-5">

        <?php
        /**
         * @var array $data
         */
        ?>

        <table id="dataTable"
               class="table bg-white text-nowrap table-bordered  table-responsive-sm table-sm table-hover">
            <thead class="border-0">
            <tr class="border-0">
                <th scope="row">Machine</th>
                <th scope="row">Shift</th>
                <th scope="row">Item</th>
                <th scope="row">Defect</th>
                <th scope="row">Ok</th>
                <th scope="row">Job</th>
                <th scope="row">No. Job Desk</th>
                <th scope="row">Cav</th>
                <th scope="row">Cycle</th>
                <th scope="row">Result</th>
                <th scope="row">Tanggal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $item) :
                ?>
                <tr>
                    <td class="text-primary"><?= $item->machine_name ?></td>
                    <td><?= $item->shift_name ?></td>
                    <td><?= $item->item_name ?></td>
                    <td class="text-danger"><?= $item->defect ?></td>
                    <td class="text-success"><?= $item->ok ?></td>
                    <td><?= $item->job ?></td>
                    <td><?= $item->noJobDesk ?></td>
                    <td><?= $item->cav ?></td>
                    <td><?= $item->cycle ?></td>
                    <td><?= $item->result ?></td>
                    <td><?= $item->created_at->humanize() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <style>
        #dataTable_wrapper #dataTable_filter > label {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #dataTable_wrapper #dataTable_filter > label input {
           margin-left: 20px;
        }

    </style>

<?= $this->endSection() ?>