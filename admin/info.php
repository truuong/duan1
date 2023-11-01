<?php
include('header.php');
// include('../function.php');
// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     action("DELETE FROM info WHERE id= '$id'");
//     header("Location:info.php");
// }
?>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <h3 style="text-align:center">Quản Trị Info</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Logo</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Gmail</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                foreach (selectDb("SELECT * FROM info") as $item) { ?>
                    <tr>
                        <td><?= $stt += 1 ?></td>
                        <td><img src="../public/images/<?=$item['logo'] ?>" width="100px" height="100px" alt=""></td>
                        <td><?=$item['phone'] ?></td>
                        <td><?=$item['address'] ?></td>
                        <td><?=$item['gmail'] ?></td>
                        <td>
                            <a href="editInfo.php?id=<?=$item['id']?>" class="btn btn-danger">Cập nhật</a>
                        </td>
                    </tr>
                <?php

                }
                ?>

            </tbody>
        </table>

    </div>

</div>
<?php include ('footer.php') ?>