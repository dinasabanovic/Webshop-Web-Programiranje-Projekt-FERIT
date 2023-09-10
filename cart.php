<?php
session_start();

include "functions.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {

    echo "<h2>Vaša košarica je prazna.</h2>";
    echo '<a href="products.php">Pregledajte proizvode.</a>';
    exit();
}

$totalPrice = 0;
$totalQuantity = 0;

foreach ($_SESSION['cart'] as $productId => $quantity) {
    $product = getDetails($productId);

    $totalPrice += $product["price"] * $quantity;
}

if (isset($_POST['update_quantity']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <?php include 'header.php'; ?>
</header>

<div class="cart-items">
    <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
        <?php $product = getDetails($productId); ?>
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="<?php echo $product['image']; ?>" alt="Product Image">
            </div>
            <div class="cart-item-details">
                <div class="name-and-price">
                    <h3><?php echo $product['name']; ?></h3>
                    <p class="price">Cijena: <?php echo $product['price']; ?>€</p>
                </div>
                <div class="quantity">
                    <form action="cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <label for="quantity">Količina:</label>
                        <input type="number" name="quantity" id="quantity-input"<?php echo $productId; ?>
                               value="<?php echo $quantity; ?>">
                        <input type="submit" id="update_quantity" value="Ažuriraj količinu">
                    </form>
                </div>
                <div class="cart-item-actions">
                    <a href="cart.php?remove=true&id=<?php echo $productId; ?>" id="removeButton">Ukloni</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <p id="total-price">Ukupna cijena: <?php echo $totalPrice; ?>€</p>
    <form action="placeOrder.php" method="post" class="order">
        <input type="submit" id="buyProducts" value="Kupi proizvode">
    </form>
</div>
</body>
</html>

