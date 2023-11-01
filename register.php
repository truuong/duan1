<?php include('header.php'); ?>
<?php
if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['pass']);
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$permission = 1; //user
	$active = 1; //dang hoat dong
	$check_email = "SELECT * FROM user WHERE email = '$email'";
	$check_phone = "SELECT * FROM user WHERE phone = '$phone'";
	$cout_mail = $conn->prepare($check_email);
	$cout_mail->execute();
	$cout_phone = $conn->prepare($check_phone);
	$cout_phone->execute();
	if ($cout_mail->rowCount() > 0) {
		$error = "Email này đã có người sử dụng. Vui lòng chọn Email khác! ";
	} elseif ($cout_phone->rowCount() > 0) {
		$error = "Số điện thoại này đã có người sử dụng. Vui lòng chọn Số khác khác! ";
	} else {
		action("INSERT INTO user (name,email,password,phone,address,permission,active)
		 VALUES
		  ('$name','$email','$password','$phone','$address','$permission','$active')");
		$error = "Tạo mới thành công!";

	}
}


?>
<div class="container">

	<div class="register">
		<form method="POST" id="register">
			<div class="register-top-grid">
				<h3>Tạo mới tài khoản ngay bây giờ</h3>
				<?php
				if (isset($error)) { ?>
					<p class="alert alert-danger"><?= $error ?></p>
				<?php

				}
				?>
				<div class="mation">
					<span>Họ tên<label>*</label></span>
					<input type="text" name="name" required>

					<span>Email<label>*</label></span>
					<input type="email" name="email" required>

					<span>Password<label>*</label></span>
					<input type="password" name="pass" required>
					<span>Số điện thoại<label>*</label></span>
					<input type="number" name="phone" required>
					<span>Địa chỉ<label>*</label></span>
					<input type="text" name="address" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<button type="submit" name="register" class="btn" style="background-color:salmon">Đăng ký</button>
			<a href="login.php" class="btn btn-danger">Đăng nhập</a>
		</form>
		<div class="clearfix"> </div>
	</div>
	<div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left">
			<h3 class="cate">Danh mục</h3>
			<ul class="menu">
				<li>
					<ul class="kid-menu">
						<?php foreach (selectDb("SELECT * FROM category") as $row) { ?>
							<li><a href="product.php?id=<?=$row['id'] ?>"><?= $row['name'] ?></a></li>
						<?php

						} ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php include('footer.php') ?>