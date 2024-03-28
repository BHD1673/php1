<?php 
$items = pdo_query("SELECT
`items`.`id`,
`items`.`name`,
`items`.`price`,
`items`.`image_url`,
`categories`.`id` AS iddanhmuc,
`categories`.`name` AS tendanhmuc
FROM
`items`
LEFT JOIN `categories` ON `items`.`category_id` = `categories`.`id`;");
?>
<div class="container">
        <h1>Quản lý mặt hàng</h1>
        <a href="admin.php?act=hienthidanhmuc" class="btn btn-primary">Xem danh mục</a>
        <div class="card mt-4">
            <div class="card-header">
                Tất Cả Mặt Hàng
            </div>
            <a href="admin.php?act=themsanpham" class="btn btn-primary">Thêm sản phẩm</a>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Danh Mục</th>
                            <th>Ảnh</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['price'] ?></td>
                                <td><img src="uploads/<?= $item['image_url'] ?>" alt="<?= $item['image_url'] ?>" style="width: 100px";></td>
                                <td><?= $item['tendanhmuc'] ?></td>
                                <td>
                                    <a href="admin.php?act=capnhatsanpham&id=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="admin.php?act=xoasanpham&id=<?= $item['id'] ?>" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Bạn có chắc chắn muốn xóa mặt hàng này?');">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>