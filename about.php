<?php include('header.php') ?>
    <h2>
    X-Shop là một chuỗi các siêu thị nhỏ trên khắp cả nước Việt nam, kinh doanh đa dạng các mặt hàng khác nhau như quần áo, đồng hồ, túi xách. Hiện chưa có website giới thiệu các sản phẩm đến người tiêu dùng. Họ cũng không thu nhận được các phản hồi từ người tiêu dùng về các mặt hàng để cải tiến và nâng cao chất lượng nhằm phục vụ khách hàng ngày một tốt hơn.	
    </h2>
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
