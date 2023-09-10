<?php

$totalQuantity = 0;

if (isset($_SESSION['cart'])) {
    // Calculate the total quantity in the cart
    $totalQuantity = array_sum($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&display=swap" rel="stylesheet">

</head>
<body>
    <div class="header">
        <h1>home sweet home</h1>
    </div>
    <div class="navigation">
            <a href="home.php">
                <button class="nav-button">NASLOVNA</button>
            </a>
            <a href="products.php">
                <button class="nav-button">PROIZVODI</button>
            </a>
            <a href="cart.php">
                <button class="nav-button">KOŠARICA</button>
            </a>
            <a href="logout.php">
                <button class="nav-button">ODJAVI SE</button>
            </a>
        </div>
</body>
</html>
