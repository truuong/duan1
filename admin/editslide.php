<?php
include('header.php');
// include('../function.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach (selectDb("SELECT * FROM slideshow WHERE id = '$id'") as $row) {
        $title = isset($row['title']) ? $row['title'] : '';
        $link = isset($row['link']) ? $row['link'] : '';
        $detail = isset($row['detail']) ? $row['detail'] : '';
        $status = isset($row['status']) ? $row['status'] : '';
        $img = isset($row['img']) ? $row['img'] : '';
    }
}else{
    header("Location:slideshow.php");
}
if (isset($_POST['submit'])) {
    $title_new = $_POST['title'];
    $link_new = $_POST['link'];
    $details_new = $_POST['details'];
    $status_new = $_POST['status'];
    $img_new = $_FILES['img'];

    if (isset($_FILES['img']) && $_FILES['img']['name']) {
        $maxSize = 800000;
        $upload = true;
        $dir = "../public/images/slide/";
        $target_file = $dir . basename($img_new['name']);
        $type = pathinfo($target_file, PATHINFO_EXTENSION);
        $allowtypes    = array('jpg', 'png', 'jpeg');
        if ($img_new["size"] > $maxSize) {
            $error = "File ảnh quá lớn. Vui lòng chọn ảnh khác";
            $upload = false;
        } elseif (!in_array($type, $allowtypes)) {
            $error = "Chỉ được upload các định dạng JPG, PNG, JPEG";
            $upload = false;
        } else {
            $imgname = uniqid() . "-" . $img_new['name'];
            var_dump($imgname);
            move_uploaded_file($img_new['tmp_name'], $dir . $imgname);
            try {
                action("UPDATE  slideshow SET img = '$img_new',title = '$title_new',link = '$link_new',detail =' $details_new',status= '$status_new' WHERE id = '$id'");
                header("Location:slideshow.php");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }else{
        action("UPDATE  slideshow SET title = '$title_new',link = '$link_new',detail =' $details_new',status= '$status_new' WHERE id = '$id'");
        header("Location:slideshow.php");
    }
}

?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Thêm mới Slideshow</h3>
    <?php if (isset($error)) { ?>
        <p class="alert alert-danger"><?= $error ?></p>
    <?php

    } ?>
    <form method="post" id="slide" enctype="multipart/form-data">
        <label>Hình ảnh</label>
        <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
        <img id="avatar" class="thumbnail" width="300px" height="200px" src="../public/images/slide/<?= $img ?>">
        <label for="">Tiêu đề</label> <br>
        <input type="text" name="title" value="<?= $title ?>"> <br> <br>
        <label for="">Đường dẫn</label> <br>
        <input type="text" name="link" value="<?= $link ?>"> <br> <br>
        <label for="details">Mô tả chi tiết</label>
        <textarea class="summernote" name="details"><?= $detail ?></textarea>
        <label for="details">Trạng thái</label>
        <select name="status">
            <option value="0">Hiển thị</option>
            <option value="1">Ẩn</option>
        </select> <br> <br>
        <button type="submit" name="submit" class="btn btn-danger">Cập nhật</button>
        <a href="slideshow.php" class="btn btn-primary">Quay lại</a>
    </form>
</div>

</div>
<?php include('footer.php') ?>