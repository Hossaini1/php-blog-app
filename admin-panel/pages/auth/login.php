<?php

session_start();

include( "../../include/database/config.php");
include( "../../include/database/db.php");

$invalidInpustEmail='';
$invalidInpustPassword='';

if (isset($_POST['login'])) {
    if (empty(trim($_POST['email']))) {
    $invalidInpustEmail='Email is requered!';
    }elseif(empty(trim($_POST['password']))){
        $invalidInpustPassword='Password is required!';
    }

    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email=$_POST['email'];
        $password=$_POST['password'];

        $user = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $user->execute(['email'=>$email, 'password'=>$password]);

        if ($user->rowCount()==1) {
            $_SESSION['email'] = $email;

            header("Location:../../index.php");
            exit();
        }

        header("Location:login.php?err_msg=Email is not registered.");
        exit();
    }
}

?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login Page</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="../../assets/css/style.css" />
    </head>
    <body class="auth">
        <main class="form-signin w-100 m-auto">
            <form method="POSt">
                <div class="fs-2 fw-bold text-center mb-4">Admin Panel Login</div>
                <?php if(isset($_GET['err_msg'])):?>
                    <p class="alert alert-sm alert-danger text-dark"><?= $_GET['err_msg'] ?></p>
                    <?php endif ?>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" />
                    <?= !empty($invalidInpustEmail) ? "<span class='form-text text-danger'>". $invalidInpustEmail."</span>":"" ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" minlength="7" />
                    <?= !empty($invalidInpustPassword) ? "<span class='form-text text-danger'>". $invalidInpustPassword."</span>":"" ?>

                </div>
                <button name="login" class="w-100 btn btn-primary mt-4" type="submit">
                    Login
                </button>
            </form>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
