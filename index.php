<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <title>Php blog app</title>
</head>

<body>
    <!-- div wrapper -->
    <div class="container py-3">
        <!-- header -->
        <?php
        include "./include/layout/header.php";
        ?>

        <main>
            <!-- sarousel/slider -->
            <?php
            include "./include/layout/slider.php";
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
                            <div class="col-sm-6">
                                <div class="card">
                                    <img
                                        src="./assets/images/4.jpg"
                                        class="card-img-top"
                                        alt="post-image" />
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title fw-bold">Post one </h5>
                                            <div>
                                                <span class="badge text-bg-secondary">Natural</span>
                                            </div>
                                        </div>
                                        <p class="card-text text-secondary pt-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum vitae ipsam nihil unde libero nobis? Totam rem enim vero dolore recusandae dolorem similique quam in dignissimos? Suscipit ut, perferendis quo maiores totam harum temporibus libero nemo ullam illum, eum ipsa?
                                        </p>
                                        <div
                                            class="d-flex justify-content-between align-items-center">
                                            <p class="fs-7 mb-0">Author: Max Hiry</p>
                                            <a href="single.html" class="btn btn-sm btn-dark">More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <img
                                        src="./assets/images/5.jpg"
                                        class="card-img-top"
                                        alt="post-image" />
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title fw-bold">Post two </h5>
                                            <div>
                                                <span class="badge text-bg-secondary">Others</span>
                                            </div>
                                        </div>
                                        <p class="card-text text-secondary pt-3">
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat, quasi! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum vitae ipsam nihil unde libero nobis? Totam rem enim vero dolore recusandae dolorem similique quam in dignissimos? Suscipit ut, perferendis quo maiores totam harum temporibus libero nemo ullam illum, eum ipsa?
                                        </p>
                                        <div
                                            class="d-flex justify-content-between align-items-center">
                                            <p class="fs-7 mb-0">Author: Tom Kay</p>
                                            <a href="single.html" class="btn btn-sm btn-dark">More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <img
                                        src="./assets/images/6.jpg"
                                        class="card-img-top"
                                        alt="post-image" />
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title fw-bold">Post three </h5>
                                            <div>
                                                <span class="badge text-bg-secondary">Travel</span>
                                            </div>
                                        </div>
                                        <p class="card-text text-secondary pt-3">
                                            Lorem ipsum dolor sit amet, perferendis quo maiores totam harum temporibus libero nemo ullam illum, eum ipsa?
                                        </p>
                                        <div
                                            class="d-flex justify-content-between align-items-center">
                                            <p class="fs-7 mb-0">Author: Jorg Samsi</p>
                                            <a href="single.html" class="btn btn-sm btn-dark">More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>