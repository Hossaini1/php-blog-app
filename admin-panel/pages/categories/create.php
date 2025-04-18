<?php
include "../../include/layout/header.php";

$invalidInputTitle = "";

if (isset($_POST['addCategory'])) {
    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = "Title is required!";
    }else{
        $title = $_POST['title'];
        $query = $db->prepare("INSERT INTO `categories`(title) VALUE(:title) ");
        $query->execute(['title'=>$title]);

        header("Location:index.php");
        exit();

    }
}
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include "../../include/layout/sidebar.php"; ?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">Create a category</h1>
            </div>

            <!-- Posts -->
            <div class="mt-4">
                <form method="POSt" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Category Title</label>
                        <input name="title" type="text" class="form-control" />
                        <?= !empty($invalidInputTitle) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputTitle) . "</span>" : '' ?>
                    </div>

                    <div class="col-12">
                        <button name="addCategory" type="submit" class="btn btn-primary">
                            CREATE
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<!-- Footer -->
<?php include "../../include/layout/footer.php"; ?>