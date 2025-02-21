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
      <?php foreach($categories as $category): ?>
       
          <li class="list-group-item">
            <a href="index.php?category=<?= $category['id'] ?>" class="link-body-emphasis text-decoration-none" ><?= $category['title'] ?></a>
          </li>
        
      <?php endforeach ?>
    <?php endif ?>
    </ul>
  </div>

  <!-- Subscribue Section -->
  <div class="card mt-4">
    <div class="card-body">
      <p class="fw-bold fs-6">Subscription</p>

      <form>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" />
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" />
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-secondary">
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