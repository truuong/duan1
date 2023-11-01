<?php include('header.php') ?>
<?php 
// if(!isset($_SESSION['user'])|| !isset($_SESSION['admin'])){
// 	header("Location:index.php");
// }
if(isset($_GET['email'])){
	$email = $_GET['email'];
	foreach(selectDb("SELECT * FROM user WHERE email='$email'") as $row){
		$name = isset($row["name"])?$row['name']:'';
		$email_pro = isset($row['email'])?$row['email']:'';
		$phone = isset($row['phone'])?$row['phone']:'';
		$address = isset($row['address'])?$row['address']:'';
		$password = isset($row['password'])?$row['password']:'';
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
					if(isset($error)){ ?>
				<p class="alert alert-danger"><?=$error ?></p>
					<?php

					}
				?>
				<div class="mation">
					<span>Họ tên<label>*</label></span>
					<input type="text" name="name" value="<?= $name ?>" required><br>
					<span>Email<label>*</label></span>
					<input type="email" name="email" value="<?=$email_pro ?>" required><br><br>
					<span>Số điện thoại<label>*</label></span>
					<input type="number" name="phone"  value="<?=$phone ?>" required><br><br>
					<span>Địa chỉ<label>*</label></span>
					<input type="text" name="address"  value="<?= $address?>" required>
					<span>Địa chỉ<label>*</label></span>
					<input type="text" name="pass"  value="<?= $password?>" required>
				</div>
				<div class="clearfix"> </div>
			</div>
			<a href="editprofile.php?email=<?=$email ?>" class="btn btn-danger">Đổi mật khẩu</a>
			<a href="index.php" class="btn btn-danger">Quay lại</a>
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