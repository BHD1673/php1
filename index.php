<?php
session_start();
require_once("conn.php");
require_once('client/Route.php');
require_once('client/Controller.php');
require_once('helper.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB BÁN ĐẦU HÀNG VIỆT NAM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .img {
            max-width: 300px;
            height: auto;
        }
    </style>
</head>

<body id="page-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Web báng hàn</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] !== null) : ?>
                        <?php if ($_SESSION['user']['role'] == 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">Vào trang admin</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=chitiettaikhoan">Chi tiết tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=dangxuat">Đăng xuất</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=dangnhap">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?act=dangky">Đăng ký</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <?php
        echo $_SESSION['msg']['update_info'] ?? "";
        unset($_SESSION['msg']);

        if (isset($_GET['act'])) {
            $hanhDong = $_GET['act'];
            xuLyHanhDong($hanhDong);
        } else {
            hienThiTrangChu();
        }
        ?>
</body>

</html>