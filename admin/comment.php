

                                                    <!--bình luận-->


<?php
include('header.php');
// include('../function.php');
?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Quản trị bình luận</h3>
    <table class="table table-hover" style="text-align:center">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Sản phẩm bình luận</th>
                <th>Số bình luận</th>
                <th>Bình luận gần nhất</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach (selectDb("SELECT DISTINCT id_product FROM Comment") as $item) {
                $id_sp = $item['id_product'];
                foreach (selectDb("SELECT * FROM product WHERE id= '$id_sp'") as $value) {
                    $tong = total("SELECT COUNT(*) FROM Comment WHERE id_product = '$id_sp'");
                    foreach (selectDb("SELECT * FROM Comment WHERE id_product='$id_sp' ORDER BY id DESC LIMIT 1 ") as $row) {
                        ?>
                        <tr>
                            <td><?= $stt += 1 ?></td>
                            <td> <img src="../public/images/<?= $value['images'] ?>" alt="" width="100px" height="100px"></td>
                            <td><?= $tong ?></td>
                            <td><?= $row['date_add'] ?></td>
                            <td>
                                <a href="detailsCom.php?iddetails=<?= $id_sp ?>" class="btn btn-danger">Xem chi tiết</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>

        </tbody>
    </table>

</div>

</div>