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
					<span>Password<label>*</label></span>
					<input type="text" name="pass"  value="<?= $password?>" required>
				</div>
				<div class="clearfix"> </div>
			</div>
		</form>
		<div class="clearfix"> </div>
	</div>
<hr style="margin-bottom:300px">



<div class="sub-cate" >
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


    <?php include('footer.php') ?>
