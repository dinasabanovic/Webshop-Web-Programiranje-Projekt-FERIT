<?php
session_start();
include "functions.php";

$_SESSION['cart'] = array();
echo "<h2>Vaša kupnja je završena. Hvala što ste kupovali u našoj trgovini!</h2>";
echo '<a href="home.php">Natrag na naslovnu</a>';
?>