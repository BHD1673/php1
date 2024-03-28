<?php


if (!$_SESSION['user']) {
    header('LOCATION: index.php?act=dangnhap');
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function addToCart($item_id) {
    $_SESSION['cart'][] = $item_id;
}

if (isset($_GET['act']) && $_GET['act'] == 'themgiohang' && isset($_GET['id'])) {
    $item_id = $_GET['id'];
    addToCart($item_id);
}

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
                    <img src="<?php echo $item['image_url']; ?>" class="img-fluid" style="width: 100px;" alt="<?php echo $item['name']; ?>">
                    <h3><?php echo $item['name']; ?></h3>
                    <p>Price: $<?php echo $item['price']; ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
