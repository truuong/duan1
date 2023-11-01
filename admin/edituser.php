<?php
include('header.php');
// include('../function.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach (selectDb("SELECT * FROM user WHERE id = '$id'") as $row) {
        $name = isset($row['name']) ? $row['name'] : '';
        $password = isset($row['password']) ? $row['password'] : '';
        $phone = isset($row['phone']) ? $row['phone'] : '';
        $email = isset($row['email']) ? $row['email'] : '';
        $permission = isset($row['permission']) ? $row['permission'] : '';
        $active = isset($row['active']) ? $row['active'] : '';
    }
    if (isset($_POST['updateuser'])) {
        $name_new = isset($_POST['name']) ? $_POST['name'] : $nane;
        $phone_new = isset($_POST['phome']) ? $_POST['phone'] : $phone;
        $email_new = isset($_POST['email']) ? $_POST['email'] : $email;
        $pass_new = empty($_POST['password']) ? $password : md5($_POST['password']);
        $active_new = isset($_POST['active']) ? $_POST['active'] : $active;
        $permission_new = isset($_POST['permission']) ? $_POST['permission'] : $permission;
        action("UPDATE user SET name='$name_new', phone='$phone_new',email= '$email_new',password='$pass_new',active='$active_new',permission='$permission_new' WHERE id = '$id'");
        header("Location:user.php");
    }
} else {
    header("Location:user.php");
}
?>


<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <h3 style="text-align:center">Cập nhật thông tin</h3>
    <form method="post" id="updateuser">
        <label for="name">Họ tên</label> <br>
        <input type="text" value="<?= $name ?>" name="name">
        <label for="phone">Số điện thoại</label> <br>
        <input type="number" value="<?= $phone ?>" name="phone">
        <label for="email">Email</label> <br>
        <input type="text" value="<?= $email ?>" name="email">
        <label for="password">Mật khẩu</label> <br>
        <input type="text" name="password"><br>
        <label for="active">Trạng thái</label> <br>
        <select name="active" style="padding:0px 20px;background:#cdcdcd;">
            <option value="1">Hoạt động</option>
            <option value="0">Khóa</option>
        </select> <br> <br>
        <label for="permission">Quyền</label> <br>
        <select name="permission" style="padding:0px 20px;background:#cdcdcd;" >
            <option value="0">Admin</option>
            <option value="1">Người dùng</option>
        </select> <br> <br>

        <button type="submit" name="updateuser" class="btn btn-danger">Cập nhật</button>
    </form>
</div>

</div>
<?php include('footer.php') ?>