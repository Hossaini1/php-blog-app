<?php

$categories = $db->query("SELECT * FROM `categories`");

// echo "<pre>";
// print_r($categories->fetchAll());

?>


<div class="col-lg-4">
  <!-- Sesrch Section -->
  <div class="card">
    <div class="card-body">
      <p class="fw-bold fs-6">Search blog</p>
      <form action="search.html">
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="search ..." />
          <button class="btn btn-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Categories Section -->
  <div class="card mt-4">
    <div class="fw-bold fs-6 card-header"> All blogs</div>
    <ul class="list-group list-group-flush p-0">
      <?php if ($categories->rowCount() > 0): ?>
        <?php foreach ($categories as $category): ?>

          <li class="list-group-item">
            <a href="index.php?category=<?= $category['id'] ?>" class="link-body-emphasis text-decoration-none"><?= $category['title'] ?></a>
          </li>

        <?php endforeach ?>
      <?php endif ?>
    </ul>
  </div>

  <!-- Subscribue Section -->
  <div class="card mt-4">
    <div class="card-body">
      <p class="fw-bold fs-6">Subscription</p>

      <?php

      $message="";

      if (isset($_POST['subscribe'])) {
        if (empty(trim($_POST['name']))) {
          $invalidInputName = 'Name is required!';
        }elseif(empty(trim($_POST['email']))) {
          $invalidInputEmail = 'Email is required!';
        }else{
          $name = $_POST['name'];
        $email = $_POST['email'];

        $subscribeInsert = $db->prepare("INSERT INTO `subscribers` (name,email) VALUES(:name, :email) ");
        $subscribeInsert->execute(['name' => $name, 'email' => $email]);

        $message = "Subscribed successfuly.";
        }
       

        
      }
      ?>

      <span class='form-text text-success'><?=htmlspecialchars($message)?></span>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" />
          <?= !empty($invalidInputName) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputName) . "</span>" : ""; ?>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" />
          <?= !empty($invalidInputEmail) ? "<span class='form-text text-danger'>" . htmlspecialchars($invalidInputEmail) . "</span>" : ""; ?>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-secondary" name="subscribe">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- About Section -->
  <div class="card mt-4">
    <div class="card-body">
      <p class="fw-bold fs-6">About Us</p>
      <p class="text-justify">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus sit veniam et in, quia vel fugiat nisi assumenda nam? Tempora ratione iusto modi quidem officia Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet, excepturi!
      </p>
    </div>
  </div>
</div>