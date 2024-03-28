<?php

$categories = pdo_query("SELECT * FROM categories");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $image = $_FILES['image'];
    $image_url = $image['name'];

    if (empty($name) || empty($price) || empty($category_id) || empty($image_url)) {
        echo "Vui lòng điền đầy đủ thông tin.";
    } else {
        if ($image['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $allowed_types = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowed_types)) {
                echo "Chỉ cho phép tải lên các file JPG, JPEG, PNG và GIF.";
            } elseif ($image["size"] > 5000000) { 
                echo "File quá lớn. Vui lòng tải lên file nhỏ hơn 5MB.";
            } else {
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO items (name, price, category_id, image_url) VALUES (?, ?, ?, ?)";
                    pdo_execute($sql, $name, $price, $category_id, $image_url);
                    header("Location: admin.php");
                } else {
                    echo "Đã xảy ra lỗi khi tải lên hình ảnh.";
                }
            }
        } else {
            echo "Vui lòng chọn một hình ảnh.";
        }
    }
}
?>

<div class="card">
    <div class="card-header">
        Thêm Mặt Hàng Mới
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="category">Danh mục:</label>
                <select class="form-control" id="category" name="category_id" required>
                    <option value="">Chọn Danh Mục</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Mặt Hàng</button>
        </form>
    </div>
</div>