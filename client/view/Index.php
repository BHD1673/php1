<?php

?>


<div class="container">
    <h2>Danh sách sản phẩm</h2>
    <div class="row">
        <?php
        $items = pdo_query("SELECT * FROM items");
        foreach ($items as $item) {
            ?>
            <div class="col-md-4">
                <div class="item-box">
                    <img src="uploads/<?php echo $item['image_url']; ?>" class="img-fluid" style="width: 100px;" alt="<?php echo $item['name']; ?>">
                    <h3><?php echo $item['name']; ?></h3>
                    <p>Giá sản phẩm: <?php echo $item['price']; ?>VNĐ</p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
