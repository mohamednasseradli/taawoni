<?php
include('sendmail.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    $sendMessage  = sendmail($name, $message, $email);

    if ($sendMessage) {
        header('location:contact.php?status=success');
        // $success = true;
    } else {
        header('location:contact.php?status=error');
        // $error = true;
    }
}

include('./includes/header.php');
include('./includes/navbar.php');

?>

<div class="home-page mt-md-0 mt-5">
    <div class="container vh-100">
        <div class="row h-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-success">
                <div class="who-we-are w-100 mb-2  mt-md-0 mt-5">
                    <h1>تريد التواصل معنا؟</h1>
                    <p class="text-muted lh-lg">
                        سنكون سعداء جدا برؤية رسالتك.
                        فقط قم بتسجيل البيانات والضغط على ارسال.
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="contact-form px-3 py-5 bg-white rounded-3 shadow">
                    <h3 class="text-success fw-bold text-center mb-3">أرسل رسالتك</h3>
                    <form action="" method="POSt">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" class="form-control border-0 border-bottom p-3" placeholder="اكتب اسمك">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" class="form-control border-0 border-bottom p-3" placeholder="البريد الالكتروني">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="message" class="form-control border-0 border-bottom p-3" id="" cols="30" rows="5" placeholder="رسالتك هنا."></textarea>
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="send-mail" value="ارسال" class="btn btn-outline-success rounded-pill w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['status'])) : ?>
    <?php if ($_GET['status'] == 'error') : ?>
        <div class="position-fixed bottom-0 end-0 mb-5 me-5" style="z-index: 9999;">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                حدث خطأ أثناء ارسال الرسالة
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['status'] == 'success') : ?>
        <div class="position-fixed bottom-0 end-0 mb-5 me-5" style="z-index: 9999;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                تم ارسال الرسالة بنجاح
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php include('./includes/footer.php'); ?>