
                                        <!-- chi tiết bình luận-->


<?php
include('header.php');
// include('../function.php');
$details= null;
if (isset($_GET['iddetails']) && !isset($_GET['iddelete'])) {
    $details = $_GET['iddetails'];
} elseif (isset($_GET['iddelete']) && isset($_GET['iddetails'])) {
    $details = $_GET['iddetails'];
    $iddelete = $_GET['iddelete'];
    action("DELETE FROM Comment WHERE id = '$iddelete'");
    header("Location:detailsCom.php?iddetails=$details");
}
$stt = 0;
?>

<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Chi tiết bình luận</h3>
    <table style="width:100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh sản phẩm</th>
                <th>Chi tiết bình luận</th>
                <th>Ngày bình luận</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (selectDb("SELECT * FROM Comment WHERE id_product = '$details'") as $row) {
                foreach (selectDb("SELECT * FROM product WHERE id = '$details'") as $item) {
                    ?>
                    <tr>
                        <td><?= $stt += 1 ?></td>
                        <td><img src="../public/images/<?= $item['images'] ?>" alt="" width="100px" height="100px"></td>
                        <td><?= $row['content'] ?></td>
                        <td><?= $row['date_add'] ?></td>
                        <td>
                            <a href="detailsCom.php?iddelete=<?= $row['id'] ?>&iddetails=<?=$details ?>" class="btn btn-primary" onclick="return confirm('Bạn muốn xóa bình luận này?')">Xóa</a>

                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <a href="comment.php" class="btn btn-danger" style="margin-top:20px">Quay lại</a>

</div>

</div>