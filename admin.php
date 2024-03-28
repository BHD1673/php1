<?php
require_once "conn.php";
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case "themdanhmuc":
            require_once "admin/ThemDanhMuc.php";
            break;
        case "xoadanhmuc":
            $categoryIdToDelete = $_GET['id'];
            pdo_execute("DELETE FROM categories WHERE id = $categoryIdToDelete");
            header("LOCATION: admin.php?act=hienthidanhmuc");
            break;
        case "capnhatdanhmuc":
            require_once "admin/CapNhatDanhMuc.php";
            break;
        case "hienthidanhmuc":
            require_once "admin/DanhMuc.php";
            break;
        case "themsanpham":
            require_once "admin/ThemSanPham.php";
            break;
        case "xoasanpham":
            $productIdToDelete = $_GET['id'];
            pdo_execute("DELETE FROM items WHERE id = $productIdToDelete");
            header("LOCATION: admin.php");
            break;
        case "capnhatsanpham":
            require_once "admin/CapNhatSanPham.php";
            break;
        case "hienthisanpham":
            require_once "admin/SanPham.php";
            break;
        default:
            hienThiTrangChuAdmin();
            break;
    }
}

function hienThiTrangChuAdmin() {
    require_once "admin/TrangChu.php";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body id="page-top">
    <a href="index.php" class="btn btn-primary">Chuyển về trang Frontend</a>
<?php 
if (isset($_GET['act'])) {
    $hanhDong = $_GET['act'];
    xuLyHanhDong($hanhDong);
} else {
    hienThiTrangChuAdmin();
}
?>
</body>
</html>