<?php
$updateCategory = pdo_query_one("SELECT * FROM categories WHERE id = ?", $_GET['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['id'];
    $category_name = $_POST['category_name'];
    try {
        pdo_execute("UPDATE categories SET name = ? WHERE id = ?", $category_name, $category_id);
        header("Location: admin.php?act=hienthidanhmuc");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<div class="container mt-5">
        <h2>Thêm danh mục sản phẩm mới</h2>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $updateCategory['id'] ?>">
                <label for="category_name">Tên danh mục:</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $updateCategory['name'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </form>
    </div>