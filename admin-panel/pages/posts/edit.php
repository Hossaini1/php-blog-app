<?php
include "../../include/layout/header.php";

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $query = $db->prepare("SELECT * FROM `posts` WHERE id = :id");
    $query->execute([':id' => $postId]);
    $post = $query->fetch();

    $categories = $db->query("SELECT * FROM categories");
}


$invalidInputTitle = "";
$invalidInputAuthor = "";
$invalidInputBody = "";

if (isset($_POST['editPost'])) {
    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = "Title is required !";
    } elseif (empty(trim($_POST['author']))) {
        $invalidInputAuthor = "Author is required !";
    } elseif (empty(trim($_POST['body']))) {
        $invalidInputBody = "Text is required !";
    }

    if (!empty(trim($_POST['title'])) && !empty(trim($_POST['author'])) && !empty(trim($_POST['body']))) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $categoryId = $_POST['categoryId'];


        if (!empty(trim($_FILES['image']['name']))) {
            $imageName =  time() . "_" . $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];

            $moveUnloaded = move_uploaded_file($tmpName, "../../../uploads/posts/$imageName");

            if ($moveUnloaded) {
                $postUpdate = $db->prepare("UPDATE posts SET title = :title, author = :author , category_id = :categoryId, body=:body , image= :image WHERE id = :id");
                $postUpdate->execute(['title' => $title, 'author' => $author, 'categoryId' => $categoryId, 'body' => $body, 'image' => $imageName, 'id' => $postId]);

                header("Location:index.php");
                exit();
            } else {
                echo "Update Faild!";
            }
        } else {
            $postUpdate = $db->prepare("UPDATE posts SET title = :title, author = :author , category_id = :categoryId, body=:body WHERE id = :id");
            $postUpdate->execute(['title' => $title, 'author' => $author, 'categoryId' => $categoryId, 'body' => $body, 'id' => $postId]);
        }
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <?php
        include "../../include/layout/sidebar.php";
        ?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">Edit Post</h1>
            </div>

            <!-- Posts -->
            <div class="mt-4">
                <form class="row g-4" method="POST" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Title</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            value="<?= $post['title'] ?>" />

                        <?= !empty($invalidInputTitle) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputTitle) . "</span>" : ""; ?>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Author</label>
                        <input
                            name="author"
                            type="text"
                            class="form-control"
                            value="<?= $post['author'] ?>" />
                        <?= !empty($invalidInputAuthor) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputAuthor) . "</span>" : ""; ?>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Category</label>
                        <select name="categoryId" class="form-select">
                            <?php if ($categories->rowCount() > 0) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option <?= ($category['id'] == $post['category_id'] ? 'selected' : '') ?> value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="formFile" class="form-label">Post Image</label>
                        <input name="image" class="form-control" type="file" />

                    </div>

                    <div class="col-12">
                        <label for="formFile" class="form-label">Post Text</label>
                        <textarea name="body" class="form-control" rows="8">
                        <?= $post['body'] ?>
                        <?= !empty($invalidInputBody) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputBody) . "</span>" : ""; ?>
                        
                    </textarea>
                    </div>


                    <div class="col-12 col-sm-6 col-md-4">
                        <img class="rounded" src="../../../uploads/posts/<?= $post['image'] ?>" width="300" />
                    </div>

                    <div class="col-12">
                        <button name="editPost" type="submit" class="btn btn-dark">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php";
?>