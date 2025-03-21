<?php
session_start();

// include "../database/db.php";
include(__DIR__ . "/../database/config.php");
include(__DIR__ . "/../database/db.php");

// var_dump($_SERVER["REQUEST_URI"]);
// var_dump(str_contains($_SERVER["REQUEST_URI"], "pages"))
$path = $_SERVER["REQUEST_URI"];

if (!isset($_SESSION['email'])) {
    if (str_contains($path, 'pages')) {
        header("Location:../auth/login.php?err_msg=Please login");
    } else {
        header("Location:./pages/auth/login.php?err_msg=Please login");
    }
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin-Panel Dashboard</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous" />

    <?php if (str_contains($path, "pages")) : ?>
        <link rel="stylesheet" href="../../assets/css/style.css" />
    <?php else : ?>
        <link rel="stylesheet" href="./assets/css/style.css" />
    <?php endif ?>

</head>

<body>
    <header
        class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
        <a
            class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white"
            href="index.php">Admin Panel</a>

        <button
            class="ms-2 nav-link px-3 text-white d-md-none"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu">
            <i class="bi bi-justify-left fs-2"></i>
        </button>
    </header>