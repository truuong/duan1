
                                                <!-- danh mục-->


<?php include('header.php') ?>
<?php
if (isset($_POST['addCate'])) {
    $name = $_POST['category'];
    $check = "SELECT * FROM category WHERE name='$name'";
    $cout = $conn->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        $error = "Danh mục đã tồn tại";
    } else {
        action("INSERT INTO category(name) VALUES('$name')");
        header("Location:category.php");
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    action("DELETE FROM category WHERE id = '$id'");
}
?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Quản trị danh mục</h3>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <?php if (isset($error)) { ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php

        } ?>
        <form method="POST" action="category.php">
            <label for="category">Danh mục</label> <br>
            <input type="text" name="category" placeholder="Danh mục" style="width:100%;height:30px;border-radius:5px;border:1px solid #cdcdcd" required> <br><br>
            <button type="submit" name="addCate" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>

    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

        <table class="table table-hover" border="0.5">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tên</th>
                    <th>Quản trị</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                foreach (selectDb("SELECT * FROM category") as $item) { ?>
                    <tr>
                        <td><?= $stt += 1 ?></td>
                        <td><?= $item['name'] ?></td>
                        <td>
                            <a href="editCate.php?id=<?= $item['id'] ?>" class="btn btn-danger">Sửa</a>
                            <a href="category.php?id=<?= $item['id'] ?>" class="btn btn-primary" onclick="return confirm('Bạn muốn xóa thật chứ?')">Xóa</a>
                        </td>

                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
        <!-- <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-secondary">1</button>
                    <button type="button" class="btn btn-secondary">2</button>
                    <button type="button" class="btn btn-secondary">3</button>
                    <button type="button" class="btn btn-secondary">4</button>
                </div>
            </div> -->
    </div>

</div>

</div>
<?php include('footer.php') ?>