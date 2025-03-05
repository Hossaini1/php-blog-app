 <!-- header -->
 <?php
    include "./include/layout/header.php";

    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $posts = $db->prepare('SELECT * FROM `posts` WHERE title LIKE :keyword');
        $posts->execute([':keyword' => "%$keyword%"]);
    }
    ?>

 <main>
     <!-- Content Section -->
     <section class="mt-4">
         <div class="row">


             <!-- Sidebar Section -->

             <?php
                include "./include/layout/sidebar.php"
                ?>

             <!-- Posts Content -->
             <div class="col-lg-8">
                 <div class="row">
                     <div class="col">

                         <?php if ($posts->rowCount() == 0) : ?>
                             <div class="alert alert-danger">
                                 There is not post !
                             </div>

                         <?php else : ?>
                             <div class="alert alert-secondary">
                                 All posts with keyword [ <?= $_GET['search'] ?> ]
                             </div>
                             <div class="row g-3">
                                <?php foreach($posts as $post) : ?>
                                    <?php 
                                        $categoryId = $post['category_id'];
                                        $postCategory = $db->query("SELECT * FROM `categories` WHERE id = $categoryId")->fetchAll();
                                        ?>

                                 <div class="col-sm-6">
                                 <div class="card"> 
                                <img
                                    src="./uploads/posts/<?= $post["image"] ?>"
                                    class="card-img-top"
                                    alt="post-image" />
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title fw-bold"><?= $post["title"]?></h5>
                                        <div>
                                            <span class="badge bg-primary"><?= $category['title'] ?></span>
                                        </div>
                                    </div>
                                    <p class="card-text text-secondary pt-3">
                                      <?= substr($post['body'], 0, 200) . "..." ?>
                                    </p>
                                    <div
                                        class="d-flex justify-content-between align-items-center">
                                        <p class="fs-7 mb-0">Author: <?= $post['author'] ?></p>
                                        <a href="single.html" class="btn btn-sm btn-dark">More</a>
                                    </div>
                                </div>
                            </div>

                                 </div>
                                 <?php endforeach  ?>
                             </div>
                         <?php endif ?>



                     </div>
     </section>
 </main>

 <!-- Footer Section -->
 <?php
    include "./include/layout/footer.php";
    ?>