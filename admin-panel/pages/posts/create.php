<?php
include "../../include/layout/header.php";

$categories = $db->query('SELECT * FROM categories');

$invalidInputTitle = "";
$invalidInputAuthor = "";
$invalidInputImage = "";
$invalidInputBody = "";

if (isset($_POST['addPost'])) {

    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = "Title is required !";
    } elseif (empty(trim($_POST['author']))) {
        $invalidInputAuthor = "Author is required !";
    } elseif (empty(trim($_FILES['image']['name']))) {
        $invalidInputImage = "Image is required !";
    } elseif (empty(trim($_POST['body']))) {
        $invalidInputBody = "Text is required !";
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $categoryId = $_POST['categoryId'];

        $imageName = time() . "_" . $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];

        // var_dump($imageName);

        $moveUploaded = move_uploaded_file($tempName, "../../../uploads/posts/$imageName");

        if ($moveUploaded) {
            $postInsert =  $db->prepare("INSERT INTO posts(title, author, category_id, body, image) VALUES(:title, :author, :category_id, :body, :image)");
            $postInsert->execute(['title' => $title, 'author' => $author, 'category_id' => $categoryId, 'body' => $body, 'image' => $imageName]);

            header("Location:index.php");
            exit();

        } else {
            echo "Upload Failed";
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">Create a post</h1>
            </div>

            <!--Create Posts -->
            <div class="mt-4">
                <form method="POST" enctype="multipart/form-data" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Title</label>
                        <input name="title" type="text" class="form-control" />
                        <?= !empty($invalidInputTitle) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputTitle) . "</span>" : ""; ?>

                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Author</label>
                        <input name="author" type="text" class="form-control" />
                        <?= !empty($invalidInputAuthor) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputAuthor) . "</span>" : ""; ?>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Category</label>
                        <select name="categoryId" class="form-select">
                            <?php if ($categories->rowCount() > 0) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                <?php endforeach ?>
                            <?php endif ?>


                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="formFile" class="form-label">Post Image</label>
                        <input name="image" class="form-control" type="file" />
                        <?= !empty($invalidInputImage) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputImage) . "</span>" : ""; ?>
                    </div>

                    <div class="col-12">
                        <label for="formFile" class="form-label">Post Text</label>
                        <textarea
                            name="body"
                            class="form-control"
                            rows="6"></textarea>
                        <?= !empty($invalidInputBody) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputBody) . "</span>" : ""; ?>
                    </div>

                    <div class="col-12">
                        <button name="addPost" type="submit" class="btn btn-primary">
                            CREATE
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