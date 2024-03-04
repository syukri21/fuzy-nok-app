<?= $this->include('Layout/OperatorLayout/Header') ?>


<div class="bg-light" style="min-height: 100vh">
    <!--appbar with feature back, titile, and more-->
    <div class="d-flex justify-content-between align-items-center bg-light py-2">
        <button class="btn btn-light">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div>
            <h5 class="m-0 font-weight-bold text-gray-800"><?= $title ?></h5>
        </div>
        <form action="/logout" method="POST">
            <button class="btn btn-light" type="submit"><i class="fa  fa-sign-out-alt"></i></button>
        </form>
    </div>
    <?= $this->renderSection('content') ?>
</div>

<?= $this->include('Layout/OperatorLayout/Footer') ?>
