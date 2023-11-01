

                                                <!--sản phẩm-->


<?php include('header.php'); ?>


?>
<?php
if (isset($_POST['addPro'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale =isset($_POST['sale'])?$_POST['sale']:0;
    $total = $_POST['total'];
    $cate = $_POST['cate'];
    $intro = $_POST['intro'];
    $details = $_POST['details'];
    $date = date("Y/m/d");
    $img = $_FILES['img'];
    $view = 1;
    $maxSize = 800000;
    $upload = true;
    $dir = "../public/images/";
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
        if (move_uploaded_file($img['tmp_name'], $dir . $imgname)) { }
        $check = "SELECT * FROM product WHERE name = '$name'";
        $cout = $conn->prepare($check);
        $cout->execute();
        if ($cout->rowCount() > 0) {
            $error = "Sản phẩm đã tồn tại";
        } else {
            try {
                action("INSERT INTO product (name,images,price,date_add,detail,id_cate,sale,total,intro,view) VALUES 
                ('$name','$imgname','$price','$date','$details','$cate','$sale','$total','$intro','$view')");
                header("Location:index.php");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}

?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Thêm mới sản phẩm</h3>
    <?php
    if (isset($error)) { ?>
        <p class="alert alert-danger"><?= $error ?></p>
    <?php

    }
    ?>
    <form method="POST" id="addPro" enctype="multipart/form-data">

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <label for="name">Tên sản phẩm</label> <br>
            <input type="text" name="name" required placeholder="Tên sản phẩm"> <br><br>
            <label for="price">Giá sản phẩm</label> <br>
            <input type="number" name="price" required placeholder="Giá sản phẩm"> <br><br>
            <!-- <label for="img">Hình ảnh</label> <br>
            <input type="file" name="img" required> <br><br> -->
            <label>Ảnh sản phẩm</label>
            <input required id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
            <img id="avatar" class="thumbnail" width="300px" height="200px" src="../public/images/new.png">
            <label for="sale">Giảm giá %</label> <br>
            <input type="number" name="sale" required placeholder="Tính theo %"> <br><br>
            <label for="total">Số lượng</label> <br>
            <input type="number" name="total" required placeholder="Số lượng sản phẩm"> <br><br>
            <label for="cate">Danh mục</label> <br>
            <select name="cate" required>
                <?php
                foreach (selectDb("SELECT * FROM category") as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php

                }
                ?>
            </select>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <label for="intro">Giới thiệu sản phẩm</label>
            <textarea class="summernote" name="intro">

                </textarea> <br>
            <label for="details">Chi tiết sản phẩm</label>
            <textarea class="summernote" name="details">

                </textarea>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align:center;margin-top:50px">
            <button type="submit" class="btn btn-success" name="addPro">Thêm mới</button>
            <a href="index.php" class="btn btn-danger">Quay lại</a>
        </div>

    </form>

</div>

</div>


<?php include('footer.php') ?>