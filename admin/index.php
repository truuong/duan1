<?php include('header.php');
// include('../function.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	action("DELETE FROM product WHERE id = '$id'");
}

if (!isset($_GET['product'])) {
	$product = 1;
} else {
	$product = $_GET['product'];
}
$data = 8;
$sql = "SELECT count(*) FROM `product`";
$result = $conn->prepare($sql);
$result->execute();
$number = $result->fetchColumn();
$page = ceil($number / $data);
$tin = ($product - 1) * $data;
?>



<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
	<h3 style="text-align:center">Quản trị sản phẩm</h3>
	<a href="addPro.php" class="btn btn-success">Thêm mới sản phẩm</a>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Stt</th>
				<th>Tên</th>
				<th>Hình ảnh</th>
				<th>Giảm giá</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Danh mục</th>
				<th>Quản lý</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stt = 0;
			foreach (selectDb("SELECT * FROM product ORDER BY id DESC LIMIT $tin,$data") as $item) {
				foreach (selectDb("SELECT * FROM category WHERE id=" . $item['id_cate']) as $row) {
					?>
					<tr>
						<td><?= $stt += 1 ?></td>
						<td><?= $item['name'] ?></td>
						<td><img src="../public/images/<?= $item['images'] ?>" width="50px" height="50px" alt=""></td>
						<td><?= $item['sale'] . '%' ?></td>
						<td><?= number_format($item['price']) . 'VNĐ' ?></td>
						<td><?= $item['total'] ?></td>
						<td><?= $row['name'] ?></td>

						<td>
							<a href="editPro.php?id=<?= $item['id'] ?>" class="btn btn-danger">Sửa</a>
							<a href="index.php?id=<?= $item['id'] ?>" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn xóa chứ?')">Xóa</a>
						</td>
					</tr>
			<?php
				}
			}
			?>

		</tbody>
	</table>
	<?php
	for ($t = 1; $t <= $page; $t++) { ?>
		<a name="" id="" class="btn btn-primary" href="index.php?product=<?= $t ?>" role="button"><?= $t ?></a>
	<?php

	}
	?>
</div>

</div>
<?php include('footer.php') ?>