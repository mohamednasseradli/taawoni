<?php 
    include('../functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $filename   = rand(100000, 999999) . '.pdf';

        $uplaod     = storeLetter($filename, $_FILES['trainee_letter']);

        if ($uplaod) 
        {
            // Registering Trainee
            $addRequest   = addRequest(
                [
                    'trainee_id'     => $_POST['trainee_id'],
                    'org_id'         => $_POST['org_id'],
                    'letter'         => $filename,
                ]
                );
            if ($addRequest)
            {
    
                $success    = '<div class="alert alert-success"> تم ارسال الخطاب بنجاح </div>';
                header('refresh:2');

            } else {
                
                $error      = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
            }

        } else {

            $error      = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
        }
    }
    if (isset($_GET['org-id']) && intval($_GET['org-id']))
    {

        $org    = getOrg($_GET['org-id']);

    } else {

        header('location: ./available-orgs.php');

    }
    
    include('../trainee/includes/header.php');
    include('../trainee/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">التقديم</h2>
                <!-- Printing Success Message if it exists -->
                <?php if (isset($success)) { echo $success;}?> 
                <!-- Printing Error Message if it exists -->
                <?php if (isset($error)) { echo $error;}?> 
                <div class="row fs-1 fw-bold text-muted justify-content-center align-items-center">
                    موعد التقديم: 
                    <?=$org['training_date']?>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="trainee-letter" id="trainee-letter-label" class="text-muted form-control border-0 border-bottom p-3">خطاب الجامعة</label>
                                <input type="file" name="trainee_letter" id="trainee-letter" class="form-control border-0 border-bottom p-3 d-none" accept=".pdf" required>
                                <input type="hidden" name="org_id" value="<?=$org['id']?>">
                                <input type="hidden" name="trainee_id" value="<?=$_SESSION['id']?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="submit" value="التقديم" class="btn btn-success w-100 p-3">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>