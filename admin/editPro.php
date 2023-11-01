<?php include('header.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $imgname = null;
    foreach (selectDb("SELECT * FROM product WHERE id = '$id'") as $row) {
        $name = isset($row['name']) ? $row['name'] : '';
        $price = isset($row['price']) ? $row['price'] : '';
        $sale = isset($row['sale']) ? $row['sale'] : '';
        $total = isset($row['total']) ? $row['total'] : '';
        $cate = isset($row['id_cate']) ? $row['id_cate'] : '';
        $intro = isset($row['intro']) ? $row['intro'] : '';
        $details = isset($row['detail']) ? $row['detail'] : '';
        $date = isset($row['date_add']) ? $row['date_add'] : '';
        $img = isset($row['images']) ? $row['images'] : '';
    }
    if (isset($_POST['updatePro'])) {
        $name_new = $_POST['name'];
        $price_new = $_POST['price'];
        $sale_new = $_POST['sale'];
        $total_new = $_POST['total'];
        $intro_new = $_POST['intro'];
        $details_new = $_POST['details'];
        $date_new = date("Y/m/d");
        if (isset($_FILES['img']) && $_FILES['img']['name']) {
            $img_new = $_FILES['img'];
            $maxSize = 800000;
            $upload = true;
            $dir = "../public/images/";
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
                move_uploaded_file($img_new['tmp_name'], $dir . $imgname);
                action("UPDATE product SET name='$name_new', price= '$price_new',sale='$sale_new',total = '$total_new',
                    intro='$intro_new',detail='$details_new',date_add='$date_new',images='$imgname' WHERE id = '$id'");
                header("Location:index.php");
            }
        } else {
            action("UPDATE product SET name='$name_new', price= '$price_new',sale='$sale_new',total = '$total_new',
                intro='$intro_new',detail='$details_new',date_add='$date_new' WHERE id = '$id'");
            header("Location:index.php");
        }
    }

    foreach (selectDb("SELECT * FROM category WHERE id =" . $cate) as $item) {
        $cate_id = $item['name'];
    }
} else {
    header("Location:index.php");
}
?>

<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Cập nhật sản phẩm</h3>
    <?php
    if (isset($error)) { ?>
        <p class="alert alert-danger"><?= $error ?></p>
    <?php

    }
    ?>
    <form method="POST" id="addPro" enctype="multipart/form-data">

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <label for="name">Tên sản phẩm</label> <br>
            <input type="text" name="name" value="<?= $name ?>"> <br><br>
            <label for="price">Giá sản phẩm</label> <br>
            <input type="number" name="price" value="<?= $price ?>"> <br><br>
            <!-- <label for="img">Hình ảnh</label> <br>
            <input type="file" name="img" value="<?= $img ?>"> <br><br> -->
            <label>Ảnh sản phẩm</label>
            <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
            <img id="avatar" class="thumbnail" width="300px" height="200px" src="../public/images/<?= $img ?>">
            <label for="sale">Giảm giá</label> <br>
            <input type="number" name="sale" value="<?= $sale ?>"> <br><br>
            <label for="total">Số lượng</label> <br>
            <input type="number" name="total" value="<?= $total ?>"> <br><br>
            <label for="cate">Danh mục</label> <br>
            <select name="cate" disabled>
                <option value="<?= $cate_id ?>"><?= $cate_id ?></option>
            </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <label for="intro">Giới thiệu sản phẩm</label>
            <textarea class="summernote" name="intro">
                    <?= $intro ?>
                </textarea> <br>
            <label for="details">Chi tiết sản phẩm</label>
            <textarea class="summernote" name="details">
                <?= $details ?>
                </textarea>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align:center;margin-top:50px">
            <button type="submit" class="btn btn-success" name="updatePro">Cập nhật</button>
            <a href="index.php" class="btn btn-danger">Quay lại</a>
        </div>

    </form>

</div>

</div>

<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
<?php include('footer.php') ?>