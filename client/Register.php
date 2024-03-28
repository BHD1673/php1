<?php

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
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if($check !== false) {
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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

?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Đăng ký</div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh đại diện</label>
                            <input type="file" name="image" id="">
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
