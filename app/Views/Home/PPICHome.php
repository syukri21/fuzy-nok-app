<?= $this->extend('Layout/PPICLayout/Layout') ?>

<?= $this->section('content') ?>

<?php
/** @var array $data */
/**
 * @var array|object $pager
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
  <div class="card-body">
    <!--  add operator-->
    PPIC Here
  </div>
</div>

<?= $this->endSection() ?>
