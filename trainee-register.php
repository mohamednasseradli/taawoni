<?php 
    include('./functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        if (traineeEmailExists($_POST['email']))
        {
            $error      = '<div class="alert alert-danger"> البريد الالكتروني مسجل بالفعل</div>';

        } elseif (traineePhoneExists($_POST['phone']))
        {
            $error      = '<div class="alert alert-danger"> رقم الهاتف  مسجل بالفعل</div>';
            
        } else {

            $filename   = rand(100000, 999999) . '.pdf';

            $uplaod     = storeCv($filename, $_FILES['trainee_cv']);

            if ($uplaod) 
            {
                // Registering Trainee
                $register   = registerTrainee(
                    [
                        'name'          => $_POST['name'],
                        'phone'         => $_POST['phone'],
                        'email'         => $_POST['email'],
                        'password'      => sha1($_POST['password']),
                        'speciality'    => $_POST['speciality'],
                        'sex'           => $_POST['sex'],
                        'cv'            => $filename,
                        'average'       => $_POST['average'],
                        ]
                    );
                if ($register)
                {
        
                    $success    = '<div class="alert alert-success"> تم التسجيل بنجاح سيتم توجيهك لتسجيل الدخول</div>';
                    header('refresh:3;url=./trainee-login.php');

                } else {
                    
                    $error      = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
                }

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
                    <h3 class="text-success fw-bold text-center mb-3">التسجيل كمتدرب</h3>
                    <!-- Printing Success Message if it exists -->
                    <?php if (isset($success)) { echo $success;}?> 
                    <!-- Printing Error Message if it exists -->
                    <?php if (isset($error)) { echo $error;}?> 
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="name" class="form-control border-0 border-bottom p-3" required placeholder="اسم المتدرب">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" name="phone" class="form-control border-0 border-bottom p-3" pattern="[0-9]{1,10}" required placeholder="رقم الجوال">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!-- <input type="text" name="speciality" class="form-control border-0 border-bottom p-3" required placeholder="التخصص"> -->
                                    <select name="sex" id="" class="form-control border-0 border-bottom text-secondary p-3">
                                        <option disabled selected hidden>الجنس</option>
                                        <option value="ذكر">ذكر</option>
                                        <option value="أنثى">أنثى</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!-- <input type="text" name="speciality" class="form-control border-0 border-bottom p-3" required placeholder="التخصص"> -->
                                    <select name="speciality" id="" class="form-control border-0 border-bottom text-secondary p-3">
                                        <option disabled selected hidden>التخصص</option>
                                        <option value="تمويل">تمويل</option>
                                        <option value="تسويق">تسويق</option>
                                        <option value="محاسبة">محاسبة</option>
                                        <option value="إدارة عامه">إدارة عامة</option>
                                        <option value="نظم معلومات إدارية">نظم معلومات إدارية</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="trainee-cv" id="trainee-cv-label" class="text-muted form-control border-0 border-bottom p-3">السيرة الذاتية</label>
                                    <input type="file" name="trainee_cv" id="trainee-cv" class="form-control border-0 border-bottom p-3 d-none" accept=".pdf" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" name="average" class="form-control border-0 border-bottom p-3" required placeholder="المعدل">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" name="email" class="form-control border-0 border-bottom p-3" required placeholder="البريد الالكتروني">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="password" pattern=".{6,}" name="password" class="form-control border-0 border-bottom p-3" required placeholder="كلمة المرورل 6 أحرف على الاقل">
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