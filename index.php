<?php include('header.php');
?>
<div class="container">
	<div class="shoes-grid">
		<!-- <a href="single.php"> -->
		<div class="wrap-in">
			<div class="wmuSlider example1 slide-grid">
				<div class="wmuSliderWrapper">
					<?php foreach (selectDb("SELECT * FROM slideshow WHERE status=0") as $tow) { ?>
						<article style="position: absolute; width: 100%; opacity: 0;">
							<div class="banner-matter" style="height:500px">
								<div class="col-md-5 banner-bag">
									<a href="<?= $tow['link'] ?>"> <img class="img-responsive " width="200px" height="300px" src="public/images/slide/<?= $tow['img'] ?>" alt=" " /></a>
								</div>
								<div class="col-md-7 banner-off">

									<label><?= $tow['title'] ?></label>
									<p><?= $tow['detail'] ?> </p>
									<a href="<?= $tow['link'] ?>" class="btn btn-primary">Tìm hiểu thêm</a>
								</div>

								<div class="clearfix"> </div>
							</div>

						</article>
					<?php

					} ?>
				</div>
				</a>
			</div>
		</div>
		<!-- </a> -->

		<div class="products">
			<h5 class="latest-product">Sản phẩm mới về</h5>
			<a class="view-all" href="new.php">Xem tất cả<span> </span></a>
		</div>
		<div class="row">

			<?php
			foreach (selectDb("SELECT * FROM product ORDER BY id DESC LIMIT 0,3") as $row) { ?>

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border:1px solid #cdcdcd">
						<a href="single.php?id=<?= $row['id'] ?>&cate=<?= $row['id_cate'] ?>"><img class="img-responsive chain" style="width:200px;height:300px" src="public/images/<?= $row['images'] ?>" alt="" /></a>
						<span style="position:absolute;top:5px;right:10px;color:red;font-size:30px;font-family:Chilanka"><?= $row['sale'] ?>%</span>
						<div class="grid-chain-bottom" style="text-align: center">
							<h6><a href="single.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h6>
							<div class="star-price">
								<span class="actual"><?= number_format($row['price'] - ($row['price'] * ($row['sale'] / 100))) . "đ" ?></span>
								<span class="reducedfrom"><?= number_format($row['price']) ?>đ</span><br>
								<a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>

								<div class="clearfix"> </div>
							</div>
						</div>
					</div>

				</div>

			<?php

			}
			?>

		</div>
		<div class="products">
			<h5 class="latest-product">Sản phẩm được yêu thích nhất</h5>
			<a class="view-all" href="love.php">Xem tất cả<span> </span></a>
		</div>
		<div class="row">

			<?php
			foreach (selectDb("SELECT * FROM product ORDER BY view DESC LIMIT 0,3") as $row) { ?>

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border:1px solid #cdcdcd">
						<a href="single.php?id=<?= $row['id'] ?>&cate=<?= $row['id_cate'] ?>"><img class="img-responsive chain" style="width:200px;height:300px" src="public/images/<?= $row['images'] ?>" alt="" /></a>
						<span style="position:absolute;top:5px;right:10px;color:red;font-size:30px;font-family:Chilanka"><?= $row['sale'] ?>%</span>
						<div class="grid-chain-bottom" style="text-align: center">
							<h6><a href="single.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h6>
							<div class="star-price">
								<span class="actual"><?= number_format($row['price'] - ($row['price'] * ($row['sale'] / 100))) . "đ" ?></span>
								<span class="reducedfrom"><?= number_format($row['price']) ?>đ</span><br>
								<p><?= $row['view'] ?> Lượt xem</p>
								<a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>

								<div class="clearfix"> </div>
							</div>
						</div>
					</div>

				</div>

			<?php

			}
			?>

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
	<div class="sub-cate">
		<a href="#"><img src="public/images/bannerQC.png" alt="" width="100%"></a>
	</div>


	<div class="clearfix"> </div>
</div>
<?php include('footer.php') ?>