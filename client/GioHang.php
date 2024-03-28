
<h1 class="mt-5 mb-4">Giỏ hàng</h1>

    <div class="row">
      <div class="col">
        <table class="table">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
            </tr>
          </thead>
          <tbody id="cart-items">
            <?php 
            $sql = "SELECT * FROM shopping_cart WHERE user_id = " . $_SESSION["user"]["id"] . ";";
            $cart_items = pdo_query($sql);
            foreach ($cart_items as $item) {
                echo "<tr>";
                echo "<td>" . $item["item_id"] . "</td>";
                echo "<td>" . $item["quantity"] . "</td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>