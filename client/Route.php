<?php 
function xuLyHanhDong($hanhDong) {
    switch ($hanhDong) {
        case "dangnhap":
            hienThiDangNhap();
            break;
        case "dangky":
            hienThiDangKy();
            break;
        case "dangxuat":
            dangXuat();
            break;
        case 'chitiettaikhoan':
            hienThiChiTietTaiKhoan();
            break;
        default:
            hienThiTrangChu();
            break;
    }
}

