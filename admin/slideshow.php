<?php
include('header.php');
// include('../function.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    action("DELETE FROM slideshow WHERE id= '$id'");
    header("Location:slideshow.php");
}
?>


    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <h3 style="text-align:center">Quản Trị Slideshow</h3>
        <a href="addslideshow.php" class="btn btn-primary">Thêm Slide</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Đường dẫn</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                foreach (selectDb("SELECT * FROM slideshow") as $item) { ?>
                    <tr>
                        <td><?= $stt += 1 ?></td>
                        <td><img src="../public/images/slide/<?=$item['img'] ?>" width="100px" height="100px" alt=""></td>
                        <td><?=$item['title'] ?></td>
                        <td><?=$item['detail'] ?></td>
                        <td><?=($item['status']==0)?'Show':'Ẩn' ?></td>
                        <td><?=$item['link']?></td>
                        <td>
                            <a href="editslide.php?id=<?=$item['id']?>" class="btn btn-danger">Cập nhật</a>
                            <a href="slideshow.php?id=<?=$item['id'] ?>" class="btn btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
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