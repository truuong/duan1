<?php
include('header.php');
// include_once('function.php');
if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
	header("Location:index.php");
}

if (isset($_POST['login'])) {
	$email = $_POST['mail'];
	$password = ($_POST['pass']);
	$check = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND active = :active AND permission=:permission";
	$count = $conn->prepare($check);
	$count->execute(array(
		'permission' => 1,
		'active' => 1
	));
	$check_admin = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND permission= :permission AND active = :active ";
	$cout_admin = $conn->prepare($check_admin);
	$cout_admin->execute(array(
		':permission' => 0,
		':active' => 1
	));
	if ($cout_admin->rowCount() > 0) {
		$_SESSION['admin'] = $email;
		header("Location:admin/index.php");
	} elseif ($count->rowCount() > 0) {
		$_SESSION['user'] = $email;
		header("location:index.php");
	} else {
		$error = "Email hoặc mật khẩu chưa đúng hoặc tài khoản của bạn đã bị khóa!";
	}
}
?>
<div class="container">

	<div class="account_grid">
		<div class=" login-right">
			<h3>Đăng nhập</h3>
			<?php if (isset($error)) { ?>
				<p class="alert alert-danger"><?= $error ?></p>
			<?php
			} else {
				echo "<p>Nếu bạn đã có tài khoản vui lòng đăng nhập bên dưới</p>";
			} ?>
			<form id="login" method="POST">
				<div>
					<span>Email<label>*</label></span>
					<input type="text" name="mail" required>
				</div>
				<div>
					<span>Password<label>*</label></span>
					<input type="password" name="pass">
				</div>
				<input type="checkbox" name="remember" id="" style="width:20px;height:15px">Ghi nhớ tài khoản
				<button type="submit" name="login" class="btn btn-danger" style="margin-left:100px">Đăng nhập</button>
			</form>
			<a class="forgot" href="resetpass.php">Quên mật khẩu?</a>
		</div> <br><br>
		<div class=" login-left">

			<p>Nếu bạn chưa có tài khoản. Vui lòng đăng ký <a href="register.php">Tại đây?</a></p>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left">
			<h3 class="cate">Danh mục</h3>
			<ul class="menu">
				<li>
					<ul class="kid-menu">
						<?php foreach (selectDb("SELECT * FROM category") as $row) { ?>
							<li><a href="product.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></li>
						<?php

						} ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
<?php include('footer.php') ?>