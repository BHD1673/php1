<div class="container mt-5">
        <h2>Danh mục sản phẩm</h2>
        <a href="admin.php?act=themdanhmuc" class="btn btn-primary">Thêm danh mục mới</a>
        <a href="admin.php" class="btn btn-primary">Xem danh sách sản phẩm  </a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = pdo_query("SELECT * FROM categories");
                if ($categories) {
                    foreach ($categories as $category) {
                        echo "<tr>";
                        echo "<td>{$category['id']}</td>";
                        echo "<td>{$category['name']}</td>";
                        echo "<td>";
                        echo "<a href='admin.php?act=capnhatdanhmuc&id={$category['id']}' class='btn btn-sm btn-primary'>Sửa</a>";
                        echo "<a href='admin.php?act=xoadanhmuc&id={$category['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Xóa danh mục {$category['name']}\")'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Không có danh mục nào hết</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>