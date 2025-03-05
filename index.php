



        <!-- header -->
        <?php
        include "./include/layout/header.php";

        
        ?>

        <main>
            <!-- sarousel/slider -->
            <?php
            include "./include/layout/slider.php";

            if(isset($_GET['category'])){
                $categoryId = $_GET['category'];
                $posts = $db->prepare("SELECT * FROM `posts` WHERE category_id = :id ORDER BY id DESC ");
                $posts->execute(['id' => $categoryId]);

            } else {
            
                $posts = $db->query("SELECT * FROM `posts` ORDER BY id DESC");
            }
            
            
            // echo "<pre >";
            // print_r($posts->fetchAll())
            ?>
    
    <!-- section content -->
    <div class="container">
 
        <section class="mt-4">
            <div class="row">

                <!-- sidebar -->
                <?php
                include "./include/layout/sidebar.php"
                ?>

                <!-- Posts Content -->
                <div class="col-lg-8">
                    <div class="row g-3">
                        <?php if($posts->rowCount()>0): ?>
                            <?php foreach($posts as $post): ?>
                                <?php
                                    
                                    $categoryId = $post['category_id'];
                                    $category = $db->query("SELECT * FROM `categories` WHERE id = $categoryId")->fetch(); 
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

                        <?php endforeach ?>
                        <?php else : ?>
                            <div class="col">
                                <p class="alert alert-danger">
                                    There is no post...
                                </p>
                            </div>
                        <?php endif ?>


                    </div>
                </div>

            </div>
        </section>
    </div>
    </main>

    <!-- footer -->
    <?php
    include "./include/layout/footer.php";
    ?>

