<?php
function hienThiDangNhap()
{

    echo $_SESSION['msg'] ?? "";
    unset($_SESSION['msg']);

    if ($_SESSION['user'] ?? false) {
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
    require_once "client/view/Login.php";
}

function hienThiDangKy()
{

    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $image = $_FILES["image"]["name"];

        if (empty($username)) {
            $errors[] = "Vui lòng nhập tên người dùng.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Vui lòng nhập địa chỉ email hợp lệ.";
        }

        if (strlen($password) < 8) {
            $errors[] = "Mật khẩu phải chứa ít nhất 8 ký tự.";
        }

        if (empty($image)) {
            $errors[] = "Vui lòng chọn ảnh đại diện.";
        }

        if (empty($errors)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if ($check !== false) {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $errors[] = "Xin lỗi, chỉ các tệp JPG, JPEG, PNG & GIF được phép.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $sql = "INSERT INTO user (`username`, `password`, `email`, `image_url`) VALUES (?, ?, ?, ?)";
                        pdo_execute($sql, $username, $password, $email, $target_file);
                        $_SESSION['msg'] =  "Đăng ký thành công! Giờ bạn có thể đăng nhập";
                        header("LOCATION: index.php");
                        exit;
                    } else {
                        $errors[] = "Xin lỗi, có lỗi khi tải tệp của bạn lên.";
                    }
                }
            } else {
                $errors[] = "Tệp không phải là một hình ảnh.";
            }
        }
    }
    require_once "client/view/Register.php";
}

function hienThiTrangChu()
{
    if (!$_SESSION['user']) {
        header('LOCATION: index.php?act=dangnhap');
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    function addToCart($item_id)
    {
        $_SESSION['cart'][] = $item_id;
    }

    if (isset($_GET['act']) && $_GET['act'] == 'themgiohang' && isset($_GET['id'])) {
        $item_id = $_GET['id'];
        addToCart($item_id);
    }

    require_once "client/view/Index.php";
}

function hienThiChiTietTaiKhoan()
{

    function getUserValue($id)
    {
        $sql = "SELECT * FROM `user` WHERE `id` = ?;";
        return pdo_query_one($sql, $id);
    }

    $user = getUserValue($_SESSION['user']['id']);

    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['username']) || empty($_POST['email'])) {
            $errors[] = "Vui lòng điền đầy đủ thông tin.";
        } else {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $image_url = $user['image_url'];

            if ($_FILES["image"]["error"] == 0) {
                $image_url = $_FILES['image']['name'];

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $errors[] = "Có lỗi xảy ra khi lưu ảnh.";
                }
            }

            if (empty($errors)) {
                $sql = "UPDATE `user`
                    SET `username` = ?, `email` = ?, `image_url` = ?
                    WHERE `id` = ?;";
                pdo_execute($sql, $username, $email, $image_url, $_SESSION['user']['id']);
                $_SESSION['msg']['update_info'] = "Cập nhật thông tin thành công";
                header("LOCATION: index.php");
                exit();
            }
        }
    }

    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    require_once "client/view/ChiTietTaiKhoan.php";
}

function hienThiGioHang()
{
    require_once "client/view/GioHang.php";
}

function dangXuat()
{
    session_destroy();
    header("LOCATION: index.php");
}
