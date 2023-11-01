<?php include('header.php');
// include_once('function.php');
$id = null;
$id_pro = null;
$view = 1;
if(isset($_GET['id_comment'])){
	$id_cmt = $_GET['id_comment'];
	action("DELETE FROM Comment WHERE id = '$id_cmt'");
}
if (isset($_GET['id']) && isset($_GET['cate'])) {

	$id = $_GET['id'];
	$cate = $_GET['cate'];
	foreach (selectDb("SELECT * FROM product WHERE id = '$id'") as $row) {
		$id_pro  = $row['id'];
		$view += $row['view'];
		action("UPDATE product SET view='$view' WHERE id = '$id'");
	}
} 
// else {
// 	header("Location:index.php");
// }
if (isset($_SESSION['user']) && isset($_POST['comment'])) {
	$date = date("Y/m/d");
	$user = $_SESSION['user'];
	$content = $_POST['commentPro'];
	foreach (selectDb("SELECT * FROM user WHERE email = '$user'") as $row) {
		$id_user = $row['id'];
	}
	action("INSERT INTO Comment (content,id_user,id_product,date_add) VALUES ('$content','$id_user','$id_pro','$date')");
} elseif (isset($_SESSION['admin']) && isset($_POST['comment'])) {
	$date = date("Y/m/d");
	$user = $_SESSION['admin'];
	$content = $_POST['commentPro'];
	foreach (selectDb("SELECT * FROM user WHERE email = '$user'") as $row) {
		$id_user = $row['id'];
	}
	action("INSERT INTO Comment (content,id_user,id_product,date_add) VALUES ('$content','$id_user','$id_pro','$date')");
} elseif (!isset($_SESSION['user']) && isset($_POST['comment'])) {
	echo "<script>alert('Vui lòng đăng nhập trước khi bình luận!')</script>";
}
?>

<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>
</div>
</div>
</div>
<div class="container">

	<div class=" single_top">
		<div>
			<?php
			foreach (selectDb("SELECT * FROM product WHERE id = '$id'") as $row) { ?>
				<div class="single_grid">
					<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
								<a href="#">
									<img class="etalage_thumb_image" src="public/images/<?= $row['images'] ?>" width="300px" height="300px" class="img-responsive" />

								</a>
							</li>

						</ul>
						<div class="clearfix"> </div>
					</div>
					<div class="desc1 span_3_of_2">


						<h4><?= $row['name'] ?></h4>
						<div class="cart-b">
							<div class="left-n "><?= number_format($row['price'] - ($row['price'] * ($row['sale'] / 100))) . "đ" ?></div>
							<a class="now-get get-cart-in" href="#">Thêm vào giỏ hàng</a>
							<div class="clearfix"></div>
						</div>
						<h6>Tình trạng: <?= $tt = $row['total'] != 0 ? "Còn hàng" : "Hết hàng" ?></h6>
						<p><?= $row['intro'] ?></p>

					</div>
					<div class="clearfix"> </div>
				</div>


				<div class="toogle">
					<h3 class="m_3">Chi tiết sản phẩm</h3>
					<p class="m_text"><?= $row['detail'] ?></p>


				</div>
			<?php

			}
			?>

		</div>
		<h3>Bình luận</h3>

		<form action="" method="post">
			<textarea name="commentPro" id="inputcommentPro" class="form-control" rows="6" required="required"></textarea> <br>
			<button type="submit" name="comment" class="btn btn-danger">Bình luận</button>
		</form>
		<?php
		foreach (selectDb("SELECT * FROM Comment WHERE id_product = '$id' ORDER BY id DESC") as $row) {
			$id_user = $row['id_user'];
			foreach (selectDb("SELECT * FROM user WHERE id= '$id_user'") as $tow) { ?>
				<div style="margin:20px 0px;border-bottom:1px solid #cdcdcd">
					<b><?= $tow['name'] ?></b> <span style="float:right;font-size:10px"><?= $row['date_add'] ?></span>
					<p class="m_text"><?= $row['content'] ?></p>
					<?php
							if (isset($_SESSION['user'])) {
								if ($tow['email'] == $_SESSION['user']) { ?>
							<a href="single.php?id_comment=<?= $row['id'] ?>" style="font-size:10px">Xoa</a>
						<?php

									}
								} else if (isset($_SESSION['admin']))
									if ($tow['email'] == $_SESSION['admin']) { ?>
						<a href="single.php?id=<?=$id ?>&cate=<?=$cate ?>&id_comment=<?= $row['id'] ?>" style="font-size:10px" onclick="tai_lai_trang()">Xoa</a>
					<?php

							}
						?>
				</div>
		<?php

			}
		}
		?>

	</div>

	<!---->
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
	<div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left" style="padding:15px">
			<h3>Sản phẩm liên quan</h3>
			<div class="row">
				<?php foreach (selectDb("SELECT * FROM product WHERE id_cate = '$cate' ORDER BY RAND() LIMIT 3") as $row) { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border-bottom:1px solid #cdcdcd;padding:10px 0px">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<a href="single.php?id=<?= $row['id'] ?>&cate=<?= $row['id_cate'] ?>"><img src="public/images/<?= $row['images'] ?>" alt="" width="50px" height="50px"></a>
						</div>

						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<a href="single.php?id=<?= $row['id'] ?>&cate=<?= $row['id_cate'] ?>">
								<p style="margin-top:10px"><?= $row['name'] ?> </p>
							</a>
						</div>
					</div>
				<?php

				} ?>
			</div>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
<script type="text/javascript">
	$(window).load(function() {
		$("#flexiselDemo1").flexisel({
			visibleItems: 5,
			animationSpeed: 1000,
			autoPlay: true,
			autoPlaySpeed: 3000,
			pauseOnHover: true,
			enableResponsiveBreakpoints: true,
			responsiveBreakpoints: {
				portrait: {
					changePoint: 480,
					visibleItems: 1
				},
				landscape: {
					changePoint: 640,
					visibleItems: 2
				},
				tablet: {
					changePoint: 768,
					visibleItems: 3
				}
			}
		});

	});
</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<script>
        function tai_lai_trang(){
            location.reload();
        }
    </script>
<?php include('footer.php') ?>