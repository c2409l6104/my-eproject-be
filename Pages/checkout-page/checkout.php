<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ./login-page/login.php");
    exit();
}
$product = $_SESSION['checkout_product'] ?? null;
$cart = $_SESSION['cart'] ?? [];
$total = 0;

if ($product) {
    $total = $product['price'] * $product['quantity'];
} else {
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Checkout</title>
</head>
<body>
    <header>
        <h1>Checkout Page</h1>
    </header>
    <div class="container">
        <div class="form-section">
            <h2>Customer Information</h2>
            <form action="payment.php" method="POST">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="email" name="email" placeholder="Email">
                <textarea name="address" rows="3" placeholder="Shipping Address" required></textarea>

                <h2>Shipping Method</h2>
                <select name="shipping_method">
                    <option value="standard">Standard Delivery</option>
                    <option value="express">Express Delivery</option>
                </select>

                <h2>Payment Method</h2>
                <select name="payment_method" id="payment-method" onchange="toggleBankOptions()">
                    <option value="cod">Cash on Delivery (COD)</option>
                    <option value="bank">Bank Transfer</option>
                </select>

                <div id="bank-options" style="display: none;">
                    <label><input type="radio" name="bank_option" value="paypal"> Pay via PayPal</label><br>
                    <label><input type="radio" name="bank_option" value="linked_bank"> Linked Bank Transfer</label>
                </div>

                <h2>Discount Code</h2>
                <input type="text" name="discount" placeholder="Enter discount code">

                <h2>Order Notes</h2>
                <textarea name="note" rows="3" placeholder="Additional notes for your order (if any)"></textarea>

                <input type="hidden" name="total" value="<?php echo $total; ?>">

                <?php if ($product): ?>
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="product_quantity" value="<?php echo $product['quantity']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                <?php endif; ?>

                <button type="submit">Confirm Order</button>
            </form>
        </div>

        <div class="summary-section">
            <h2>Order Summary</h2>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                <?php
                if ($product) {
                    $item_total = $product['price'] * $product['quantity'];
                    echo "<tr>
                            <td>
                                <div class='product-info'>
                                    <img src='../img/{$product['image']}' alt='Product'>
                                    <span>{$product['name']}</span>
                                </div>
                            </td>
                            <td>{$product['quantity']}</td>
                            <td>" . number_format($product['price']) . "đ</td>
                            <td>" . number_format($item_total) . "đ</td>
                          </tr>";
                } elseif (!empty($cart)) {
                    foreach ($cart as $item) {
                        $item_total = $item['price'] * $item['quantity'];
                        echo "<tr>
                                <td>
                                    <div class='product-info'>
                                        <img src='img/{$item['image']}' alt='Product'>
                                        <span>{$item['name']}</span>
                                    </div>
                                </td>
                                <td>{$item['quantity']}</td>
                                <td>" . number_format($item['price']) . "đ</td>
                                <td>" . number_format($item_total) . "đ</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Your cart is empty</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td><strong><?php echo number_format($total); ?>đ</strong></td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        <p>@Eco Clothers</p>
    </footer>
</body>
</html>