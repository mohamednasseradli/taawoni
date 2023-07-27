<?php 
        include('../functions.php');
    
        if ($_SERVER['REQUEST_METHOD'] === "POST")
        {
            // Calling Auth Function
            $login  = authAdmin($_POST['email'], $_POST['password']);
            if ($login)
            {
                header('location: ./dashboard.php'); // redirecting to home page
                
            } else {
    
                $login_error    = '<div class="alert alert-danger"> بريد الكتروني أو كلمة مرور غير صحيحة </div>';
            }
        }
    include('../admin/includes/header.php'); ?>
    <div class="home-page mt-md-0 mt-5">
        <div class="container vh-100">
        <div class="row h-100 d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="contact-form px-3 py-5 bg-white rounded-3 shadow">
                    <h3 class="text-success fw-bold text-center mb-3">الدخول للوحة التحكم</h3>
                    <!-- Printing Login Error if it exists -->
                    <?php if (isset($login_error)) { echo $login_error;}?> 
                    <form action="" method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" name="email" class="form-control border-0 border-bottom p-3" required placeholder="البريد الالكتروني">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <input type="password" name="password" class="form-control border-0 border-bottom p-3" required placeholder="كلمة المرور">
                                </div>
                                <div class="text-center">
                                    <input type="submit" value="تسجيل الدخول" class="btn btn-outline-success rounded-pill w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php include('../admin/includes/footer.php'); ?>