<?php include_once APPROOT . '/views/include/header.php' ?>

    <?php flash('success') ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4"><?=$title?></h1>
            <p class="lead"><?=$description?></p>
        </div>
    </div>

<?php include_once APPROOT . '/views/include/footer.php' ?>