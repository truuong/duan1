<div class="footer" style="background-color: rgb(248, 244, 248);margin-top: 40px">
<?php
foreach(selectDb("SELECT * FROM info LIMIT 1") as $row){?>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom-cate">
				<a href="index.html"><img src="../public/images/logo.png" alt=" " width="180" height="180"/></a>
			</div>
			<div class="footer-bottom-cate">
				<h6>Liên hệ</h6>
				<ul>
					<li>
						<p>Trường: <?=$row['address'] ?></p>
					</li>
					<li>
						<p>Sinh viên: <?=$row['name'] ?></p>
					</li>
					

				</ul>
			</div>
			<div class="footer-bottom-cate">
				<h6>Hỗ trợ</h6>
				<p>Mọi thắc mắc xin vui lòng <br> gửi mail về hòm thư: <br> <b><?=$row['gmail'] ?></b></p>
			</div>
			<div class="footer-bottom-cate">
				<h6>Bản quyền</h6>
				<p>Vui lòng liên hệ</p><b><?=$row['phone'] ?></b><br>

			</div>
		</div>
	</div>
<?php

}
?>
	
	<script type="text/javascript">
		$(function() {
			var menu_ul = $('.menu > li > ul'),
				menu_a = $('.menu > li > a');
			menu_ul.hide();
			menu_a.click(function(e) {
				e.preventDefault();
				if (!$(this).hasClass('active')) {
					menu_a.removeClass('active');
					menu_ul.filter(':visible').slideUp('normal');
					$(this).addClass('active').next().stop(true, true).slideDown('normal');
				} else {
					$(this).removeClass('active');
					$(this).next().stop(true, true).slideUp('normal');
				}
			});

		});
	</script>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="../public/js/jquery.wmuSlider.js"></script>
	<script>
		$('.example1').wmuSlider();

		function changeImg(input) {
			//Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				//Sự kiện file đã được load vào website
				reader.onload = function(e) {
					//Thay đổi đường dẫn ảnh
					$('#avatar').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function() {
			$('#avatar').click(function() {
				$('#img').click();
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('.summernote').summernote();
		});
	</script>
	</body>

	</html>