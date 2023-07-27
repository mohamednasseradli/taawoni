<?php 
    include('../functions.php');

    if (isset($_GET['org-id']) && intval($_GET['org-id']))
    {
        $org    = getOrg($_GET['org-id']);
    } else {

        header('location: ./rating.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (isset($_POST['org-id']) && isset($_POST['rating']) && isset($_POST['description']))
        {
            $addRating  = addRating(
                [
                    'trainee_id'   => $_SESSION['id'],
                    'org_id'       => $_POST['org-id'],
                    'rating'       => $_POST['rating'],
                    'description'  => $_POST['description'],
                ]
            );

            if ($addRating)
            {
                $success    = '<div class="alert alert-success"> تم ارسال تقييمك بنجاح سيتم توجيهك للصفحة الرئيسية</div>';
                header('refresh:3;url=./home.php');
            } else
            {
                $success    = '<div class="alert alert-danger">حدث خطأ الرجاء المحاولة مرة أخرى</div>';
            }
        }
    }
    
    include('../trainee/includes/header.php');
    include('../trainee/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">الجهات المتاحة</h2>
                <!-- Printing Success Message if it exists -->
                <?php if (isset($success)) { echo $success;}?> 
                <!-- Printing Error Message if it exists -->
                <?php if (isset($error)) { echo $error;}?> 
                <form action="" method="POST">
                    <input type="hidden" name="org-id" value="<?=$org['id']?>">
                    <div class="mb-3">
                        <textarea name="description" id="" cols="30" rows="5" class="form-control" required placeholder="اكتب رأيك هنا"></textarea>
                    </div>
                    
                    <div class="mb-3 fs-3 text-center rating-system" dir="ltr">
                        <label for="star-5" title="star 5" class="rating-item">
                            <i class="fa-solid fa-star"></i>
                            <input type="radio" name="rating" id="star-5" value="5" class="d-none" required>
                        </label>
                        <label for="star-4" title="star 4" class="rating-item">
                            <i class="fa-solid fa-star"></i>
                            <input type="radio" name="rating" id="star-4" value="4" class="d-none" required>
                        </label>
                        <label for="star-3" title="star 3" class="rating-item">
                            <i class="fa-solid fa-star"></i>
                            <input type="radio" name="rating" id="star-3" value="3" class="d-none" required>
                        </label>
                        <label for="star-2" title="star 2" class="rating-item">
                            <i class="fa-solid fa-star"></i>
                            <input type="radio" name="rating" id="star-2" value="2" class="d-none" required>
                        </label>
                        <label for="star-1" title="star 1" class="rating-item">
                            <i class="fa-solid fa-star"></i>
                            <input type="radio" name="rating" id="star-1" value="1" class="d-none" required>
                        </label>
                    </div>
                    <div class="text-center mb-3">
                        <input type="submit" value="نشر" class="btn btn-success w-50">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>