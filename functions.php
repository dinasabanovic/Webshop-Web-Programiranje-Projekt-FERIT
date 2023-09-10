<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getDetails($productId)
{
    include "db_conn.php";

    $sql = "SELECT * FROM proizvodi WHERE id = $productId";
    $result = $spoj->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $spoj->close();
        return $product;
    } else {
        return array();
    }
}

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $_SESSION['cart'][$productId] = $quantity;

    echo "<script>alert('Proizvod je dodan u košaricu');</script>";

    header("Location: cart.php");
    exit();
}

if (isset($_GET['remove']) && isset($_GET['id'])) {
    $productId = $_GET['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    header("Location: cart.php");
    exit();
}

if (isset($_POST['update_quantity']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    }
    header("Location: cart.php");
    exit();
}

?>
