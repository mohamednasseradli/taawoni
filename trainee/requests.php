<?php 
    include('../functions.php');

    if (isset($_GET['status']) )
    {

        $requests    = getRequestsTrainee($_SESSION['id'], $_GET['status']);
        
    } else {

        header('location:./home.php');
    }
    if (isset($_POST['affirm-org']))
    {
        affirmOrg($_SESSION['id'], $_POST['org_id']);
    }
    

    include('../trainee/includes/header.php');
    include('../trainee/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">الطلبات</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <a href="?status=1" class="text-success border d-inline-block w-100 p-2 ">الطلبات المقبولة</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="?status=-1" class="text-success border d-inline-block w-100 p-2">الطلبات المرفوضة</a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="?status=0" class="text-success border d-inline-block w-100 p-2">الطلبات المنتظرة</a>
                    </div>
                </div>
                <?php if (isset($requests)) {
                    foreach ($requests as $request) { ?>
                    <div class="row text-center p-2 shadow-sm">
                        <div class="col-4">
                            الجهة: 
                            <?=$request['org_name']?>
                        </div>
                        <div class="col-4">
                            التاريخ: 
                            <?=$request['date']?>
                        </div>
                        <div class="col-4">
                            الحالة:
                            <?php if ($request['status'] == 0) { ?>

                                <span class="text-warning">منتظرة</span>

                            <?php } elseif ($request['status'] == 1) { ?>
                                <span class="text-success">مقبولة</span>
                                <!-- <?=var_dump($_SESSION['affirmedOrg'])?> -->
                                <?php if ($_SESSION['affirmedOrg'] == null) {?>
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="org_id" value="<?=$request['org_id']?>">
                                        <button name="affirm-org" class="btn btn-primary">اعتماد</button>
                                    </form>
                                <?php } else { ?>
                                    <?php if($request['org_id'] == $_SESSION['affirmedOrg']) {
                                        echo '<span class="text-primary"> معتمدة </span>';
                                    } ?>
                                <?php } ?>
                            <?php } elseif ($request['status'] == -1) { ?>

                                <span class="text-danger">مرفوضة</span>

                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    }?>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>