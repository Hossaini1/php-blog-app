<?php
include "./include/database/config.php";
include "./include/database/db.php";

$categories = $db->query("SELECT * FROM `categories`");

// echo "<pre>";
// print_r($categories->fetchAll());
?>


<header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="index.php" class="fs-4 fw-medium link-body-emphasis text-decoration-none">Blog-App</a>


    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">


        <?php if ($categories->rowCount() > 0): ?>

            <?php foreach ($categories as $category) : ?>
                <a href="#" class="fw-bold ms-3 link-body-emphasis text-decoration-none"><?= $category['title'] ?></a>
            <?php endforeach ?>

        <?php endif ?>


    </nav>
</header>