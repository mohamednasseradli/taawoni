<?php 
    include('./functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        if (orgEmailExists($_POST['email']))
        {
            $error      = '<div class="alert alert-danger"> البريد الالكتروني مسجل بالفعل</div>';

        } elseif (orgPhoneExists($_POST['phone']))
        {
            $error      = '<div class="alert alert-danger"> رقم الهاتف مسجل بالفعل</div>';
            
        } else {

            // Registering Trainee
            $register   = registerOrg(
                [
                    'name'          => $_POST['name'],
                    'email'         => $_POST['email'],
                    'password'      => sha1($_POST['password']),
                    'phone'         => $_POST['phone'],
                    'org_type'      => $_POST['org_type'],
                    'training_date' => $_POST['training_date'],
                ]
                );
            if ($register)
            {
    
                $success    = '<div class="alert alert-success"> تم التسجيل بنجاح سيتم توجيهك لتسجيل الدخول</div>';
                header('refresh:3;url=./org-login.php');

            } else {
                
                $error      = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
            }
        }
        
        
    }

    include('./includes/header.php'); 
    include('./includes/navbar.php');
?>
    <div class="home-page mt-md-0 mt-5">
        <div class="container vh-100">
        <div class="row h-100 d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="contact-form px-3 py-5 bg-white rounded-3 shadow  mt-5">
                    <h3 class="text-success fw-bold text-center mb-3">التسجيل كجهة</h3>
                    <!-- Printing Success Message if it exists -->
                    <?php if (isset($success)) { echo $success;}?> 
                    <!-- Printing Error Message if it exists -->
                    <?php if (isset($error)) { echo $error;}?> 
                    <form action="" method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" class="form-control border-0 border-bottom p-3" placeholder="اسم الجهة" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="phone" maxlength="10" max="9999999999" min="-999999999" class="form-control border-0 border-bottom p-3" pattern="[0-9]{1,10}" placeholder="رقم الجوال" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="org_type" class="form-control border-0 border-bottom p-3" placeholder="نوع المنشئة" required>
                                </div>
                                <div class="col-md-6 mb-3 position-relative">
                                    <span class="text-danger position-absolute mb-2" style="top: -2px;font-size:14px;">* بداية التدريب</span>
                                    <input type="date" name="training_date" class="form-control border-0 border-bottom p-3" min=<?=date('Y-m-d')?> placeholder="موعد التدريب" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" class="form-control border-0 border-bottom p-3" placeholder="البريد الالكتروني" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="password" pattern=".{6,}" name="password" class="form-control border-0 border-bottom p-3" placeholder="كلمة المرورل 6 أحرف على الاقل" required>
                                </div>
                                <div class="text-center">
                                    <input type="submit" value="التسجيل" class="btn btn-outline-success rounded-pill w-100">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php include('./includes/footer.php'); ?>