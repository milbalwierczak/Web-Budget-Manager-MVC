<?php include $this->resolve("partials/_navbar.php"); ?>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold mb-0 ">Cześć
                    <?php echo e($username); ?>!</h1>
            </div>
            <div class="col-lg-8 align-self-baseline">
                <h2 class="text-white-75">Twój bilans w tym miesiącu wynosi <?php
                                                                            echo e(number_format($balance, 2, ',', '')) ?> zł </h2>
                <hr class="divider">
                <p class="text-white fs-2">Cytat na dzisiaj:</p>
                <p class="text-start text-white-75 fst-italic fs-4"><?php echo e($quote); ?></p>
                <p class="text-end text-white-75 mb-5"><?php echo e($author); ?></p>
                <a class="btn btn-success btn-xl me-sm-4 mb-3 mb-sm-0" href="/income">+ Dodaj przychód</a>
                <a class="btn btn-danger btn-xl me-sm-4 mb-3 mb-sm-0" href="/expense">- Dodaj wydatek</a>
                <a class="btn btn-primary btn-xl mb-3 mb-sm-0" href="./balance.php"><i class="bi bi-graph-up"></i> Przeglądaj bilans</a>
            </div>
        </div>
    </div>
</header>

<?php include $this->resolve("partials/_footer.php"); ?>