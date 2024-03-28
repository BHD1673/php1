<?php

echo $_SESSION['msg'] ?? "";
unset($_SESSION['msg']);

if($_SESSION['user'] ?? false) {
    header('LOCATION: index.php');
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            echo "Vui lòng điền đầy đủ thông tin!";
        } else {
            $user = pdo_query_one("SELECT * FROM user WHERE username = ?", $username);
            
            if ($user) {
                if ($password === $user['password']) {
                    echo "Đăng nhập thành công!";
                    $_SESSION['user'] = $user;
                    setcookie('user', $user['username'], 86400);
                    header('LOCATION: index.php');
                    exit;
                } else {
                    echo "Mật khẩu không chính xác!";
                }
            } else {
                echo "Tên đăng nhập không tồn tại!";
            }
        }
    } else {
        echo "Đã xảy ra lỗi khi xử lý yêu cầu!";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Đăng nhập</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        <a href="index.php?act=dangky" class="btn btn-primary">Chưa có tài khoản ? Đăng ký luôn</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
