<?php

if (!isset($db)) {
    die("Fehler: Datenbankverbindung nicht vorhanden.");
}

$sliders = $db->query("SELECT * FROM `posts_slider`");


// if(empty($sliders)){
//     die("sliders daten sind nicht vorhanden!");
// }else{
// echo "<pre>";
// print_r($sliders->fetchAll());
// }


// foreach ($sliders as $slider) {
//     // print_r($slider['post_id']);
//     $postId = $slider['post_id'];
//     $post = $db->query("SELECT * FROM posts WHERE id = $postId");
//     echo "<pre>";
//     print_r($post->fetch());
// }



?>


<section>

    <div id="carousel" class="carousel slide">
        <div class="carousel-indicators">
            <button
                type="button"
                data-bs-target="#carousel"
                data-bs-slide-to="0"
                class="active"></button>
            <button
                type="button"
                data-bs-target="#carousel"
                data-bs-slide-to="1"></button>
            <button
                type="button"
                data-bs-target="#carousel"
                data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner rounded">

            <?php if ($sliders->rowCount() > 0) : ?>
                <?php foreach ($sliders as $slider) : ?>
                    <?php

                    $postId = $slider['post_id'];
                    // $post = $db->query("SELECT * FROM `posts` WHERE id = $postId")->fetch();
                    $postStmt = $db->prepare("SELECT * FROM `posts` WHERE id = ?");
                    $postStmt->execute([$postId]);
                    $post = $postStmt->fetch();
                    // echo "<pre>";
                    // print_r($post["image"]);

                    // Falls kein Post gefunden wurde, diesen Slider überspringen
                    if (!$post) {
                        echo "<!-- Fehler: Kein Post mit ID $postId gefunden! -->";
                        continue;
                    }


                    ?>

                    <div class="carousel-item overlay carousel-height <?= (!empty($slider["active"]) && $slider["active"] == 1) ? 'active' : '' ?>">

                        <img src="./uploads/posts/<?=$post["image"]?>" class="d-block w-100 " alt="post-image" />

                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $post['title'] ?></h5>
                            <p>
                                <?= substr($post['body'], 0, 200) . ".." ?>

                            </p>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <button
        class="carousel-control-prev "
        type="button"
        data-bs-target="#carousel"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button
        class="carousel-control-next "
        type="button"
        data-bs-target="#carousel"
        data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

   