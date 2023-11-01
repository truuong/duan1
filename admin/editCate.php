

                                                <!-- chi tiết danh mục-->


<?php include('header.php') ?>
<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach (selectDb("SELECT * FROM category WHERE id = '$id'") as $item) {
        $name = isset($item['name']) ? $item['name'] : '';
    }
    if (isset($_POST['updateCate'])) {
        $name_new = $_POST['category'];
        action("UPDATE category SET name = '$name_new' WHERE id = '$id'");
        header('Location:category.php');
    }
}else{
    header("Location:category.php");
}


?>

    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <h3 style="text-align:center">Quản trị danh mục</h3>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?php if (isset($error)) { ?>
                <p class="alert alert-danger"><?= $error ?></p>
            <?php

            } ?>
            <form method="POST">
                <label for="category">Danh mục</label> <br>
                <input type="text" name="category" placeholder="Danh mục" style="width:100%;height:30px;border-radius:5px;border:1px solid #cdcdcd" required value="<?= $name ?>"> <br><br>
                <button type="submit" name="updateCate" class="btn btn-primary">Cập nhật</button>
                <a href="category.php" class="btn btn-danger">Quay lại</a>
            </form>
        </div>


    </div>

</div>
<?php include('footer.php') ?>