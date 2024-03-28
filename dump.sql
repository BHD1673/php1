-- Create item in shopping cart
INSERT INTO shopping_cart (user_id, item_id, quantity) VALUES (user_id_value, item_id_value, quantity_value);

-- Read items in shopping cart for a user
SELECT * FROM shopping_cart WHERE user_id = user_id_value;

-- Update quantity of an item in shopping cart
UPDATE shopping_cart SET quantity = new_quantity WHERE user_id = user_id_value AND item_id = item_id_value;

-- Delete an item from shopping cart
DELETE FROM shopping_cart WHERE user_id = user_id_value AND item_id = item_id_value;

-- Place an order
INSERT INTO orders (user_id, total_amount) VALUES (user_id_value, total_amount_value);

-- Read orders for a user
SELECT * FROM orders WHERE user_id = user_id_value;

-- Update order details
UPDATE orders SET total_amount = new_total_amount WHERE id = order_id_value;

-- Cancel an order
DELETE FROM orders WHERE id = order_id_value;

-- Add items to an order
INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (order_id_value, item_id_value, quantity_value, price_value);

-- Read items in an order
SELECT * FROM order_items WHERE order_id = order_id_value;

-- Update quantity or price of an item in an order
UPDATE order_items SET quantity = new_quantity, price = new_price WHERE order_id = order_id_value AND item_id = item_id_value;

-- Remove an item from an order
DELETE FROM order_items WHERE order_id = order_id_value AND item_id = item_id_value;
