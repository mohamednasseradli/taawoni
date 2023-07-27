<?php
include('../functions.php');

if (isset($_GET['accept']) && isset($_GET['org-id'])) {
    $acceptOrg  = acceptOrg($_GET['org-id']);
    if ($acceptOrg) {
        header('location: ./orgs.php');
    } else {

        $error  = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
    }
}

if (isset($_POST['reject'])) {

    $rejectOrg  = rejectOrg($_POST['org-id'], $_POST['rejection-reason']);
    if ($rejectOrg) {
        header('location: ./orgs.php');
    } else {

        $error  = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
    }
}
if (isset($_POST['block-org'])) {
    $blockOrg  = blockOrg($_POST['org_id']);
    if ($blockOrg) {
        header('location: ./orgs.php');
    } else {

        $error  = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
    }
}


$orgs       = getOrgs();

include('../admin/includes/header.php');
include('../admin/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5"> الجهات</h2>
                <!-- Printing Error Message if it exists -->
                <?php if (isset($error)) {
                    echo $error;
                } ?>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد</th>
                                <th>الجوال</th>
                                <th>نوع الجهة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($orgs)) {
                                $i = 1;
                                foreach ($orgs as $org) { ?>

                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $org['name'] ?></td>
                                        <td><?= $org['email'] ?></td>
                                        <td><?= $org['phone'] ?></td>
                                        <td><?= $org['org_type'] ?></td>
                                        <td>
                                            <?php
                                            if ($org['status'] == 0) { ?>

                                                <a href="?accept&org-id=<?= $org['id'] ?>" class="btn btn-primary">قبول</a>

                                                <!-- <a href="?delete&org-id=<?= $org['id'] ?>" class="btn btn-danger">رفض</a> -->
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    رفض
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <form action="" method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">سبب الرفض؟</h5>
                                                                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" name="rejection-reason" class="form-control" placeholder="اكتب سبب الرفض">
                                                                    <input type="hidden" name="org-id" value="<?= $org['id'] ?>">
                                                                </div>
                                                                <div class="modal-footer justify-content-start">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                                                    <button type="submit" name="reject" class="btn btn-danger">رفض</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } elseif ($org['status'] == 1) { ?>

                                                <span class="text-success">مقبول</span>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                                    <button name="block-org" class="btn btn-danger">حظر</button>
                                                </form>

                                            <?php } elseif ($org['status'] == -2) { ?>

                                                <span class="text-secondary">محظور</span>

                                            <?php } elseif ($org['status'] == -1) { ?>

                                                <span class="text-danger">مرفوض</span>

                                            <?php }
                                            ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>