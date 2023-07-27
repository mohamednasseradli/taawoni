<?php 
    include('../functions.php');

    $orgs           = getTrainedAtOrgs($_SESSION['id']);
    $orgsRatings    = getOrgsRatings();
    
    include('../trainee/includes/header.php');
    include('../trainee/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">الجهات التي تم التدرب بها</h2>
                <div class="row">
                    <?php if (isset($orgs)) {
                        foreach ($orgs as $org) { ?>
                        <div class="col-md-6">
                            <a href="../trainee/add-rating.php?org-id=<?=$org['org_id']?>" class="org text-muted text-center fs-2 shadow rounded d-block py-4 px-3">
                                <?=$org['name']?>
                            </a>
                        </div>
                        <?php }
                    }?>
                </div>
            </div>
        </div>
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">تقييمات الجهات</h2>
                <div class="row">
                <?php if (isset($orgsRatings)) {
                    foreach ($orgsRatings as $orgsRating) { ?>
                        <div class="row p-md-3 mb-3">
                            <div class="col-6">
                                <div class="fw-bold fs-4">المتدرب: <?=$orgsRating['trainee_name']?></div>
                                <div class="text-muted">التاريخ:  <?=$orgsRating['date']?></div>
                                <p class="mt-3">
                                <?=$orgsRating['description']?>
                                </p>
                            </div>
                            <div class="col-6 flex-column d-flex align-items-center justify-content-center text-warning fs-1" >
                                <h3 >الجهة</h3>
                                <div>
                                    <?=$orgsRating['org_name']?>
                                </div>
                                <div class="fs-5">
                                    <?php for ($i=1; $i <= $orgsRating['rating']; $i++) { ?>
                                        <span><i class="fa-solid fa-star"></i></span>
                                    <?php } for ($i =1; $i <= 5 - $orgsRating['rating']; $i++) { ?>
                                            <span><i class="fa-regular fa-star"></i></span>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div> 
                    <?php }
                }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>