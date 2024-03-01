<?php /** @var object $pager */ ?>
<div>
    <!--    simple pager-->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= $pager->getCurrentPageNumber() == 1 ? " disabled" : '' ?>">
                <a class="page-link" href="?page_operator=<?= $pager->getCurrentPageNumber() - 1 ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $pager->getPageCount(); $i++) : ?>
                <li class="page-item"><a class="page-link" href="?page_operator=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor ?>
            <li class="page-item <?= $pager->getCurrentPageNumber() == $pager->getPageCount() ? " disabled" : '' ?>">
                <a class="page-link"
                   href="?page_operator=<?= $pager->getCurrentPageNumber() + 1 ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>