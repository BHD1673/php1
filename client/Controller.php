<?php 
function hienThiDangNhap() {
    require_once "client/Login.php";
}

function hienThiDangKy() {
    require_once "client/Register.php";
}

function hienThiTrangChu() {
    require_once "client/TrangChu (1).php";
}

function hienThiChiTietTaiKhoan() {
    require_once "client/ChiTietTaiKhoan.php";
}

function hienThiGioHang() {
    require_once "client/GioHang.php";
}

function dangXuat() {
    session_destroy();
    header("LOCATION: index.php");
}


