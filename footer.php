<div class="footer" style="background-color: rgb(248, 244, 248);margin-top: 40px">
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-cate">
					<a href="index.php"><img src="public/images/logo.png" alt=" " width="180" height="180"/></a>
				</div>
				<div class="footer-bottom-cate">
					<h6><a href="contact.php">Liên hệ</a></h6>
					<ul>
					</ul>
				</div>
				<div class="footer-bottom-cate">
				<h6><a href="about.php">Giới thiệu</a></h6>
				</div>
				<div class="footer-bottom-cate">
				<h6><a href="#">Địa chỉ</a></h6>
				KV. Thới Hòa P. Thới An TP. Cần Thơ
				</div>
			</div>
			</div>
			
		</div>
		<script type="text/javascript">
			$(function () {
				var menu_ul = $('.menu > li > ul'),
					menu_a = $('.menu > li > a');
				menu_ul.hide();
				menu_a.click(function (e) {
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
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
		 </script>
		<script src="public/js/jquery.wmuSlider.js"></script>
		<script>
			$('.example1').wmuSlider();         
		</script>
</body>

</html>
