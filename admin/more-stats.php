<?php
include('../functions.php');
if (isset($_GET['speciality'])) {
    
    if ($_GET['speciality'] == 'funding')
    {
        $speciality = 'تمويل';
    }elseif ($_GET['speciality'] == 'marketing')
    {
        $speciality = 'تسويق';

    }elseif ($_GET['speciality'] == 'accounting')
    {
        $speciality = 'محاسبة';

    }elseif ($_GET['speciality'] == 'general-management')
    {
        $speciality = 'إدارة عامة';
    } else {
        
        $speciality = 'نظم معلومات إدارية';
    }

    $AcceptedTrainees       = getSpecialityAccepted($speciality);
    $RejectedTrainees       = getSpecialityRejected($speciality);
    $AffirmedOrgTrainees    = getSpecialityAffirmedOrg($speciality);
    
} else {
    header('location:stats.php');
}
include('../admin/includes/header.php');
include('../admin/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5">
                    احصائية مفصلة

                </h2>
                <div class="text-center mb-3">
                    <ul class="specialities list-group list-group-horizontal justify-content-center">
                        <li class="list-group-item border rounded-0 mx-2 current">
                            <a href="more-stats.php?speciality=accounting">
                                محاسبة

                            </a>
                        </li>
                        <li class="list-group-item border rounded-0 mx-2">
                            <a href="more-stats.php?speciality=funding">
                                تمويل

                            </a>
                        </li>
                        <li class="list-group-item border rounded-0 mx-2">
                            <a href="more-stats.php?speciality=general-management">
                                إدارة عامة

                            </a>
                        </li>
                        <li class="list-group-item border rounded-0 mx-2">
                            <a href="more-stats.php?speciality=marketing">
                                تسويق

                            </a>
                        </li>
                        <li class="list-group-item border rounded-0 mx-2">
                            <a href="more-stats.php?speciality=management-information-systems">
                                نظم معلومات إدارية

                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Printing Error Message if it exists -->
                <?php if (isset($error)) {
                    echo $error;
                } ?>
                <h3 class="text-success ">الطلاب المقبولين</h3>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="bg-success text-white">الاسم</th>
                                <th class="bg-success text-white">البريد الالكتروني</th>
                                <th class="bg-success text-white">الهاتف</th>
                                <th class="bg-success text-white">الجنس</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($AcceptedTrainees as $trainee) :?>
                                <tr>
                                    <td><?=$trainee['name']?></td>
                                    <td><?=$trainee['email']?></td>
                                    <td><?=$trainee['phone']?></td>
                                    <td><?=$trainee['gender']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <h3 class="text-danger ">الطلاب المرفوضين</h3>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="bg-danger text-white">الاسم</th>
                                <th class="bg-danger text-white">البريد الالكتروني</th>
                                <th class="bg-danger text-white">الهاتف</th>
                                <th class="bg-danger text-white">الجنس</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($RejectedTrainees as $trainee) :?>
                                <tr>
                                    <td><?=$trainee['name']?></td>
                                    <td><?=$trainee['email']?></td>
                                    <td><?=$trainee['phone']?></td>
                                    <td><?=$trainee['gender']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <h3 class="text-primary ">تم اختيار الجهة</h3>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">الاسم</th>
                                <th class="bg-primary text-white">البريد الالكتروني</th>
                                <th class="bg-primary text-white">الهاتف</th>
                                <th class="bg-primary text-white">الجنس</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($AffirmedOrgTrainees as $trainee) :?>
                                <tr>
                                    <td><?=$trainee['name']?></td>
                                    <td><?=$trainee['email']?></td>
                                    <td><?=$trainee['phone']?></td>
                                    <td><?=$trainee['gender']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const currentUrl = window.location.href;
    const aTags = document.getElementsByTagName("a");
    for (let i = 0; i < aTags.length; i++) {
        const href = aTags[i].getAttribute("href");
        if (href && currentUrl.includes(href)) {
            const parentLi = aTags[i].parentNode;
            const siblings = parentLi.parentNode.children;
            for (let j = 0; j < siblings.length; j++) {
                siblings[j].classList.remove("current");
            }
            parentLi.classList.add("current");
        }
    }
</script>
<?php include('../includes/footer.php'); ?>