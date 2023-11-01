<?php
include('header.php');
// include('../function.php');
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $details = $_POST['details'];
    $status = 0;
    $img = $_FILES['img'];
    $maxSize = 800000;
    $upload = true;
    $dir = "../public/images/slide/";
    $target_file = $dir . basename($img['name']);
    $type = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowtypes    = array('jpg', 'png', 'jpeg');
    if ($img["size"] > $maxSize) {
        $error = "File ảnh quá lớn. Vui lòng chọn ảnh khác";
        $upload = false;
    } elseif (!in_array($type, $allowtypes)) {
        $error = "Chỉ được upload các định dạng JPG, PNG, JPEG";
        $upload = false;
    } else {
        $imgname = uniqid() . "-" . $img['name'];
        var_dump($imgname);
        move_uploaded_file($img['tmp_name'], $dir . $imgname);
        try {
            action("INSERT INTO slideshow (img,title,detail,status,link) VALUES 
                ('$imgname','$title','$details','$status','$link')");
            header("Location:slideshow.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Thêm mới Slideshow</h3>
    <?php if(isset($error)){?>
        <p class="alert alert-danger"><?=$error ?></p>
        <?php

    } ?>
    <form method="post" id="slide" enctype="multipart/form-data">
        <label>Hình ảnh</label>
        <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
        <img id="avatar" class="thumbnail" width="300px" height="200px" src="../public/images/new.png">
        <label for="">Tiêu đề</label> <br>
        <input type="text" name="title"> <br> <br>
        <label for="">Đường dẫn</label> <br>
        <input type="text" name="link"> <br> <br>
        <label for="details">Mô tả chi tiết</label>
        <textarea class="summernote" name="details"></textarea>
        <button type="submit" name="submit" class="btn btn-danger">Thêm mới</button>
    </form>
</div>

</div>
<?php include('footer.php') ?>