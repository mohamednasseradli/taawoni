<?php
    include('../functions.php');
    $ratings   = getRatings($_SESSION['id']);
    include('./includes/header.php');
    include('../org/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">التقييمات</h2>
                <?php if (isset($ratings)) {
                    foreach ($ratings as $rating) { ?>
                        <div class="row p-md-3 mb-3">
                            <div class="col-6">
                                <div class="fw-bold"><?=$rating['trainee_name']?></div>
                                <div class="text-muted"><?=$rating['date']?></div>
                                <p class="mt-3">
                                <?=$rating['description']?>
                                </p>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center text-warning fs-1" >
                                <?php for ($i=1; $i <= $rating['rating']; $i++) { ?>
                                    <span><i class="fa-solid fa-star"></i></span>
                                <?php } for ($i =1; $i <= 5 - $rating['rating']; $i++) { ?>
                                        <span><i class="fa-regular fa-star"></i></span>
                                <?php }
                                ?>
                            </div>
                        </div> 
                    <?php }
                }?>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>