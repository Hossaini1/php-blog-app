<?php
include "./include/database/config.php";
include "./include/database/db.php";

if (!isset($db)) {
    die("Fehler: Datenbankverbindung nicht vorhanden.");
}


$categories = $db->query("SELECT * FROM `categories`");

// if (empty($categories)) {
//     die("categories daten sind nicht vorhanden!");
// }else{
//   echo "<pre>";
// print_r($categories->fetchAll());  
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <title>Php blog app</title>
</head>

<body>

    <!-- div wrapper -->
    <div class="container py-3">

        <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="index.php" class="fs-4 fw-medium link-body-emphasis text-decoration-none">Blog-App</a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">

                <?php if ($categories->rowCount() > 0): ?>

                    <?php foreach ($categories as $category) : ?>
                        <a href="index.php?category=<?= $category['id'] ?>" class="ms-3 link-body-emphasis text-decoration-none <?= (isset($_GET['category'])) && $category['id'] == $_GET['category'] ? 'fw-bold' : '' ?> "><?= $category['title'] ?></a>

                        <!-- < ?php echo "link for {$category['title']}: index,php?category={$category['id']}<br> " ?> -->
                    <?php endforeach ?>

                <?php endif ?>

            </nav>
        </header>