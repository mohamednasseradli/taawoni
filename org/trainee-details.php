<?php 
    include('../functions.php');

    if (isset($_GET['trainee-id']) && intval($_GET['trainee-id']))
    {

        $trainee    = getTrainee($_GET['trainee-id']);

    } else {

        header('location: ./available-orgs.php');

    }
    
    include('./includes/header.php');
    include('../org/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">بيانات المتدرب</h2>
                <form>
                    <div class="conatiner">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" disabled class="form-control" value="<?=$trainee['name']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" disabled class="form-control" value="<?=$trainee['phone']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" disabled class="form-control" value="<?=$trainee['email']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" disabled class="form-control" value="<?=$trainee['speciality']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" disabled class="form-control" value="<?=$trainee['average']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="../trainee/uploads/cv/<?=$trainee['cv']?>" download>السيرة الذاتية (اضغط للتحميل)</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>