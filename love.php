<?php include('header.php');
// include('function.php');
$data = 6;
if (!isset($_GET['product'])) {
	$product = 1;
} else {
	$product = $_GET['product'];
}
$sql = "SELECT COUNT(*) FROM product";
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetchColumn();
$page = ceil($number / $data);
$tin = ($product - 1) * $data;
?>
<div class="container" style="margin-top:20px">
	<div class="row">

		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
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

		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<?php foreach (selectDb("SELECT * FROM product ORDER BY view DESC LIMIT $tin,$data") as $row) { ?>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:20px">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border:1px solid #cdcdcd;border-radius:5px">
						<a href="single.php?id=<?=$row['id']?>&cate=<?=$row['id_cate'] ?>"><img class="img-responsive chain" style="width:200px;height:300px" src="public/images/<?= $row['images'] ?>" alt="" /></a>
						<span style="position:absolute;top:5px;right:10px;color:red;font-size:30px;font-family:Chilanka"><?= $row['sale'] ?>%</span>
						<div class="grid-chain-bottom" style="text-align: center">
							<h6><a href="single.php"><?= $row['name'] ?></a></h6>
							<div class="star-price">
								<span class="actual"><?= number_format($row['price'] - ($row['price'] * ($row['sale'] / 100))) . "đ" ?></span>
                                <span class="reducedfrom"><?= number_format($row['price']) ?>đ</span><br>
                                <p><?=$row['view'] ?> Lượt xem</p>
								<a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a>

								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			<?php
			};
			?>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php
			for ($t = 1; $t <= $page; $t++) {?>
				<a href="love.php?product=<?=$t ?>" class=" btn btn-primary" style="float:left;margin-left:5px" ><?=$t ?></a>
			<?php
				
			}
			?>
			</div>
			


		</div>

	</div>
</div>
<?php include('footer.php') ?>