<?php
include('../functions.php');
include('../admin/includes/header.php');
include('../admin/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5"> احصائية</h2>
                <!-- Printing Error Message if it exists -->
                <?php if (isset($error)) {
                    echo $error;
                } ?>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="bg-secondary"></th>
                                <th class="bg-primary text-white">المقبولين</th>
                                <th class="bg-danger text-white">المرفوضين</th>
                                <th class="bg-info text-white">تم اختيار الجهة</th>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">
                                    <a href="more-stats.php?speciality=accounting" class="text-white d-block ">
                                        محاسبة
                                    </a>
                                </th>
                                <td><?=count(getSpecialityAccepted('محاسبة'))?></td>
                                <td><?=count(getSpecialityRejected('محاسبة'))?></td>
                                <td><?=count(getSpecialityAffirmedOrg('محاسبة'))?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">
                                    <a href="more-stats.php?speciality=funding" class="text-white d-block ">
                                        تمويل
                                    </a>
                                </th>
                                <td><?=count(getSpecialityAccepted('تمويل'))?></td>
                                <td><?=count(getSpecialityRejected('تمويل'))?></td>
                                <td><?=count(getSpecialityAffirmedOrg('تمويل'))?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">
                                    <a href="more-stats.php?speciality=marketing" class="text-white d-block ">
                                        تسويق
                                    </a>
                                </th>
                                <td><?=count(getSpecialityAccepted('تسويق'))?></td>
                                <td><?=count(getSpecialityRejected('تسويق'))?></td>
                                <td><?=count(getSpecialityAffirmedOrg('تسويق'))?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">
                                    <a href="more-stats.php?speciality=general-adminstration" class="text-white d-block ">
                                        إدارة عامة
                                    </a>
                                </th>
                                <td><?=count(getSpecialityAccepted('إدارة عامة'))?></td>
                                <td><?=count(getSpecialityRejected('إدارة عامة'))?></td>
                                <td><?=count(getSpecialityAffirmedOrg('إدارة عامة'))?></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">
                                    <a href="more-stats.php?speciality=management-information-systems" class="text-white d-block ">
                                        نظم معلومات إدارية
                                    </a>
                                </th>
                                <td><?=count(getSpecialityAccepted('نظم معلومات إدارية'))?></td>
                                <td><?=count(getSpecialityRejected('نظم معلومات إدارية'))?></td>
                                <td><?=count(getSpecialityAffirmedOrg('نظم معلومات إدارية'))?></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>