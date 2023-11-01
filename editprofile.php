<?php include('header.php') ?>
<?php
// if(!isset($_SESSION['user'])|| !isset($_SESSION['admin'])){
// 	header("Location:index.php");
// }
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    if (isset($_POST['updatePass'])) {
        $pass = md5($_POST['pass']);
        $passnew = md5($_POST['passnew']);
        $passconfirm = md5($_POST['passconfirm']);
        if ($passnew != $passconfirm) {
            $error = "Nhập lại mật khẩu chưa chính xác!";
        } else {
            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
            $check = $conn->prepare($sql);
            $check->execute();
            if ($check->rowCount() > 0) {
                action("UPDATE user SET password = '$passnew'");
                $error = "Đổi mật khẩu thành công!";
            } else {
                $error = "Mật khẩu sai vui lòng thử lại!";
            }
        }
    }
}else{
    header("Location:index.php");
}

?>
<div class="container">

    <div class="register">
        <form method="POST" id="register">
            <div class="register-top-grid">
                <?php
                if (isset($error)) { ?>
                    <p class="alert alert-danger"><?= $error ?></p>
                <?php

                }
                ?>
                <div class="mation">
                    <span>Mật khẩu cũ<label>*</label></span>
                    <input type="password" name="pass" required><br>
                    <span>Mật khẩu mới<label>*</label></span>
                    <input type="password" name="passnew" required><br>
                    <span>Nhập lại mật khẩu<label>*</label></span>
                    <input type="password" name="passconfirm" required><br>
                </div>
                <div class="clearfix"> </div>
            </div>
            <button type="submit" name="updatePass" class="btn" style="background-color:salmon">Cập nhật</button>
            <a href="index.php" class="btn btn-primary">Quay lại</a>
        </form>
        <div class="clearfix"> </div>
    </div>
    <div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left">
			<h3 class="cate">Danh mục</h3>
			<ul class="menu">
				<li>
					<ul class="kid-menu">
                        <?php foreach(selectDb("SELECT * FROM category") as $row){?>
                            <li><a href="product.php?id=<?=$row['id'] ?>"><?=$row['name'] ?></a></li>
                            <?php

                        } ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php include('footer.php') ?>