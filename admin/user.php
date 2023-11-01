<?php
include('header.php');
// include('../function.php');
?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Quản Tài khoản</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Quyền</th>
                <th>Trạng thái</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach (selectDb("SELECT * FROM user") as $item) { ?>
                <tr>
                    <td><?= $stt += 1 ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['phone'] ?></td>
                    <td><?= ($item['permission'] == 1) ? 'Khách hàng' : 'Admin' ?></td>
                    <td><?= ($item['active'] == 1) ? 'Hoạt động' : 'Bị khóa' ?></td>
                    <td>
                        <a href="edituser.php?id=<?= $item['id'] ?>" class="btn btn-danger">Cập nhật</a>
                    </td>
                </tr>
            <?php

            }
            ?>

        </tbody>
    </table>

</div>

</div>
<?php include('footer.php') ?>