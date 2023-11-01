<?php
include('header.php');
// include_once('function.php');
if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
	header("Location:index.php");
}
if (isset($_POST['login'])) {
	$email = $_POST['mail'];
    $phone = $_POST['phone'];
	$check = "SELECT * FROM user WHERE email = '$email' AND phone = '$phone' AND active = :active AND permission=:permission";
	$count = $conn->prepare($check);
	$count->execute(array(
		'permission' => 1,
		'active' => 1
	));
	$check_admin = "SELECT * FROM user WHERE email = '$email' AND phone  = '$phone' AND permission= :permission AND active = :active ";
	$cout_admin = $conn->prepare($check_admin);
	$cout_admin->execute(array(
		':permission' => 0,
		':active' => 1
	));
	if ($cout_admin->rowCount() > 0) {
		$_SESSION['admin'] = $email;
        unset($_SESSION['admin']);
        header("Location:pass.php");
	} elseif ($count->rowCount() > 0) {
		$_SESSION['user'] = $email;
        unset($_SESSION['user']);	
        header("Location:pass.php");
	} else {
		$error = "Email hoặc số điện thoại chưa đúng!!!";
	}
}
?>
<div class="container">

	<div class="account_grid">
		<div class=" login-right">
			<h3>Quên mật khẩu</h3>
			<?php if (isset($error)) { ?>
				<p class="alert alert-danger"><?= $error ?></p>
			<?php
			} else {
				echo "<p></p>";
			} ?>
			<form id="login" method="POST">
				<div>
					<span>Email<label>*</label></span>
					<input type="text" name="mail" required>
				</div>
				<div>
                    <span>Số điện thoại<label>*</label></span>
					<input type="number" name="phone" required>
				</div>
                <?php
						if (isset($_SESSION['admin'])) { ?>
							<li class="profile"><a href="#"><?= $_SESSION['admin'] ?></a>
								<ul class="">
									<li><a href="profile.php?email=<?= $_SESSION['admin'] ?>">Thông tin</a></li> <br>
								</ul>

							</li>
						<?php

						} elseif (isset($_SESSION['user'])) { ?>
							<li class="profile"><a href="#"><?= $_SESSION['user'] ?></a>
								<ul class="profiles">
									<li><a href="profile.php?email=<?= $_SESSION['user'] ?>">Thông tin</a></li> <br>
								</ul>
							</li>
						<?php
						}
						?>
                	
			</form>



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