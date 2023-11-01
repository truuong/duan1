<?php include('header.php');?>
<div class="container">

	<!---->
	<div class="main">
		<div class="reservation_top">
			<div class=" contact_right">
				<h3>Liên hệ</h3>
				<div class="contact-form">
					<form method="post" action="contact-post.html">
						<textarea name="contact">Liên hệ với chúng tôi</textarea>
						<input type="submit" value="Gửi">
						<div class="clearfix"> </div>
					</form>
				</div>
			</div>
		</div>
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
<!---->
<?php include('footer.php') ?>