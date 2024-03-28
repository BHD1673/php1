<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    try {
        pdo_execute("INSERT INTO categories (name) VALUES (?)", $category_name);
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
                <label for="category_name">Tên danh mục:</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
        </form>
    </div>