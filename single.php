 <!-- header -->
 <?php

    use Dom\Comment;

    include "./include/layout/header.php";


    if (isset($_GET['post'])) {
        $postId = $_GET['post'];
        $post = $db->prepare("SELECT * FROM `posts` WHERE id = :id");
        $post->execute(['id' => $postId]);
        $post = $post->fetch();
    }
    ?>


 <main>
     <!-- Content -->
     <section class="mt-4">
         <div class="row">

             <!-- Sidebar Section -->

             <?php
                include "./include/layout/sidebar.php"
                ?>

             <!-- Posts & Comments Content -->
             <?php if (!empty($post)) : ?>
                 <div class="col-lg-8">
                     <div class="row justify-content-center">
                         <!-- Post Section -->
                         <div class="col">
                             <div class="card">
                                 <img
                                     src="./uploads//posts/<?= $post['image'] ?>"
                                     class="card-img-top"
                                     alt="post-image" />
                                 <div class="card-body">
                                     <div
                                         class="d-flex justify-content-between">
                                         <h5 class="card-title fw-bold">
                                             لورم ایپسوم
                                         </h5>
                                         <div>
                                             <?php
                                                $categoryId = $post['category_id'];
                                                $category = $db->query("SELECT * FROM `categories` WHERE id=$categoryId")->fetch();
                                                ?>
                                             <span
                                                 class="badge bg-primary"><?= $category['title'] ?></span>
                                         </div>
                                     </div>
                                     <p
                                         class="card-text text-secondary text-justify pt-3"><?= $post['body'] ?> </p>
                                     <div>
                                         <p class="fs-6 mt-5 mb-0">Author:
                                             <?= $post['author'] ?>
                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <hr class="mt-4" />

                         <!-- Comment Section -->
                         <div class="col">
                            <?php 
                            $invalidName = '';
                            $invalidComment = '';
                            $msg = '';

                            if(isset($_POST['postComment'])){
                                if (empty(trim($_POST['name']))) {
                                    $invalidName = 'Name is required!';
                                }else if (empty(trim($_POST['comment']))) {
                                    $invalidComment = 'Comment is required!';
                                }else{
                                    $name = $_POST['name'];
                                    $comment = $_POST['comment'];

                                    $commentInsert = $db->prepare("INSERT INTO `comments` (name, comment , post_id) VALUES (:name, :comment , :post_id )");
                                    $commentInsert->execute([':name'=> $name, 'comment' => $comment, 'post_id'=>$post['id']]);

                                    $msg = "Commented successfuly!";
                                }

                            }
                            
                            ?>
                             <!-- Comment Form -->
                             <div class="card">
                                 <div class="card-body">
                                     <p class="fw-bold fs-5">
                                          Post a comment
                                     </p>

                                     <form method="POST">
                                        <p class="text-success"><?= $msg ?></p>
                                         <div class="mb-3">
                                             <label class="form-label">Name</label>
                                             <input
                                                 name="name"
                                                 type="text"
                                                 class="form-control" />
                                                 <p class="form-text text-danger"><?= $invalidName ?></p>
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Comment</label>
                                             <textarea
                                                 name="comment"
                                                 class="form-control"
                                                 rows="3"></textarea>
                                                 <p class="form-text text-danger"><?= $invalidComment ?></p>

                                         </div>
                                         <button
                                             name="postComment"
                                             type="submit"
                                             class="btn btn-dark">
                                             Submit
                                         </button>
                                     </form>
                                 </div>
                             </div>

                             <hr class="mt-4" />
                             <!-- Comment Content -->
                             <?php

                                $postId = $post['id'];
                                $comments = $db->prepare("SELECT * FROM comments WHERE post_id = :id AND status = '1' ");
                                $comments->execute(["id" => $postId]);


                                ?>
                             <p class="fw-bold fs-6">Comments: <?= $comments->rowCount() ?></p>
                             <?php if ($comments->rowCount() > 0): ?>

                                 <?php foreach ($comments as $comment) : ?>

                                     <div class="card bg-light-subtle mb-3">
                                         <div class="card-body">
                                             <div
                                                 class="d-flex align-items-center">
                                                 <img
                                                     src="./assets/images/profile.png"
                                                     width="45"
                                                     height="45"
                                                     alt="user-profle"
                                                     class="card-title me-2 " />

                                                 <h5
                                                     class="card-title mb-0 text-secondary">
                                                     <?= $comment['name']; ?>
                                                 </h5>
                                             </div>

                                             <p class="card-text pt-3 pr-3">
                                                 <?= $comment['comment']; ?>
                                             </p>
                                         </div>
                                     </div>
                                 <?php endforeach ?>
                             <?php else : ?>
                                 <div class="alert alert-danger">There is no comment yet.</div>
                             <?php endif ?>


                         </div>
                     </div>
                 </div>

             <?php else : ?>

                 <div class="col-lg-8">
                     <div class="alert alert-danger">
                         There is no post!
                     </div>
                 </div>
             <?php endif ?>


         </div>
     </section>
 </main>


 <!-- Footer Section -->
 <?php
    include "./include/layout/footer.php";
    ?>