<?php 
    include('../functions.php');

    $orgs   = getAvailableOrgs();
    
    include('../trainee/includes/header.php');
    include('../trainee/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">الجهات المتاحة</h2>
                <div class="row">
                    <?php if (isset($orgs)) {

                        foreach ($orgs as $org) { ?>
                        <div class="col-md-6">
                            <a href="../trainee/apply-date.php?org-id=<?=$org['id']?>" class="org text-muted text-center fs-2 shadow rounded d-block py-4 px-3">
                                <?=$org['name']?>
                            </a>
                        </div>
                        <?php }
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>