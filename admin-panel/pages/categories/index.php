<?php
include "../../include/layout/header.php";

$categories = $db->query("SELECT * FROM `categories` ORDER BY id DESC");

if (isset($_GET['action']) && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $query =$db->prepare("DELETE FROM `categories` WHERE id = :id");
    $query->execute([':id'=>$categoryId]);

    header("Location:index.php");
    exit();
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
                <h1 class="fs-3 fw-bold">Categories</h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="./create.html" class="btn btn-sm btn-dark">
                        Create category
                    </a>
                </div>
            </div>

            <!-- Categories -->
            <div class="mt-4">
                <div class="table-responsive small">
                    <?php if ($categories->rowCount() > 0): ?>
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Edit or Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <th><?= $category['id'] ?></th>
                                        <td><?= $category['title'] ?></td>
                                        <td>
                                            <a
                                                href="./edit.html"
                                                class="btn btn-sm btn-outline-dark">Edit</a>
                                            <a
                                                href="index.php?action=delete&id=<?= $category['id'] ?>"
                                                class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-danger">There is no category yet!</div>
                    <?php endif ?>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Footer -->
<?php include "../../include/layout/footer.php"; ?>