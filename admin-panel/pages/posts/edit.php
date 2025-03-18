<?php
include "../../include/layout/header.php";

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $query = $db->prepare("SELECT * FROM `posts` WHERE id = :id");
    $query->execute([':id' => $postId]);
    $post = $query->fetch();

    $categories = $db->query("SELECT * FROM categories");
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
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Author</label>
                        <input
                        name="author"
                            type="text"
                            class="form-control"
                            value="<?= $post['author'] ?>" />
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">Post Category</label>
                        <select name="categoryId" class="form-select">
                         <?php if($categories->rowCount()>0) : ?>
                            <?php foreach($categories as $category) : ?>
                                <option <?= ($category['id'] == $post['category_id'] ? 'selected' : '') ?> value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                            <?php endforeach?>
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