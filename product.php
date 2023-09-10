<?php
session_start();
include "db_conn.php";
include "functions.php";

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM proizvodi WHERE id = $productId";
    $result = $spoj->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}

$spoj->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script>
        function showAlert() {
            alert('Proizvod <?php echo $product['name']; ?> je dodan u košaricu');
        }
    </script>
</head>
<body>
    <header>
		<?php include 'header.php'; ?>

	</div>
    </header>

    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p>Cijena: <?php echo $product['price']; ?>€</p>

                <form action="product.php?id=<?php echo $product['id']; ?>" method="POST">
                    <label for="quantity">Količina:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">

                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">

                    <button type="submit" id="add_to_cart_btn" onclick="showAlert()">Dodaj u košaricu</button>
                </form>
            </div>

</body>
</html>
