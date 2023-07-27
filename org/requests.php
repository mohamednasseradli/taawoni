<?php 
    include('../functions.php');
    
    if (isset($_GET['accept']) && isset($_GET['request-id']))
    {
        $acceptRequest  = acceptRequest($_GET['request-id']);

        if ($acceptRequest)
        {
            header('location: ./requests.php');
        } else {

            $error  = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
        }
    } 
    
    if (isset($_GET['reject']) && isset($_GET['request-id']))
    {
        $rejectRequest  = rejectRequest($_GET['request-id']);

        if ($rejectRequest)
        {
            header('location: ./requests.php');
        } else {

            $error  = '<div class="alert alert-danger"> حدث خطأ الرجاء المحاولة مرة أخرى</div>';
        }
    } 

    $requests       = getRequestsOrg($_SESSION['id']);

    include('./includes/header.php');
    include('../org/includes/navbar.php');
?>
<div class="home-page mt-md-0 mt-5">
    <div class="container pt-5">
        <div class="row pt-5 p-3">
            <div class="col-md-10 container bg-white shadow rounded py-5 px-3">
                <h2 class="text-success text-center mb-5"> الطلبات</h2>
                    <!-- Printing Error Message if it exists -->
                    <?php if (isset($error)) { echo $error;}?> 
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد</th>
                                <th>الجوال</th>
                                <th>التخصص</th>
                                <th>المعدل</th>
                                <th>خطاب الجامعة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($requests)) {
                                $i = 1;
                                foreach ($requests as $request) { ?>

                                    <tr>
                                        <td><?=$i?></td>
                                        <td><a href="./trainee-details.php?trainee-id=<?=$request['id']?>"><?=$request['name']?></a></td>
                                        <td><?=$request['email']?></td>
                                        <td><?=$request['phone']?></td>
                                        <td><?=$request['speciality']?></td>
                                        <td><?=$request['average']?></td>
                                        <td>
                                            <a href="../trainee/uploads/letter/<?=$request['letter']?>" download> خطاب الجامعة (اضغط للتحميل)</a>
                                        <td>
                                            <?php
                                                if ($request['status'] == 0) { ?>

                                                    <a href="?accept&request-id=<?=$request['request_id']?>" class="btn btn-primary">قبول</a>
                                                    <a href="?reject&request-id=<?=$request['request_id']?>" class="btn btn-danger">رفض</a>

                                            <?php } elseif ($request['status'] == 1) { ?>
                                                        
                                                    <span class="text-success">مقبول</span>
                                                        
                                            <?php } elseif ($request['status'] == -1) { ?>
                                                            
                                                    <span class="text-danger">مرفوض</span>

                                            <?php }
                                            ?>
                                        </td>
                                    </tr>
                                <?php }
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>