<?= $this->extend('Layout/OperatorLayout/Layout') ?>

<?= $this->section('content') ?>

    <div class="container mt-5">

        <?php
        /**
         * @var array $data
         */
        ?>

        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">Machine</th>
                <th scope="col">Shift</th>
                <th scope="col">Item</th>
                <th scope="col">Job</th>
                <th scope="col">No. Job Desk</th>
                <th scope="col">Cav</th>
                <th scope="col">Cycle</th>
                <th scope="col">Result</th>
                <th scope="col">Defect</th>
                <th scope="col">Ok</th>
                <th scope="col">Tanggal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $item) :
                ?>
                <tr>

                    <td><?= $item->machine_name ?></td>
                    <td><?= $item->shift_name ?></td>
                    <td><?= $item->item_name ?></td>
                    <td><?= $item->job ?></td>
                    <td><?= $item->noJobDesk ?></td>
                    <td><?= $item->cav ?></td>
                    <td><?= $item->cycle ?></td>
                    <td><?= $item->result ?></td>
                    <td><?= $item->defect ?></td>
                    <td><?= $item->ok ?></td>
                    <td><?= $item->created_at->humanize() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>


<?= $this->endSection() ?>