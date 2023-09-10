<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$spoj = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($spoj->connect_error) {
  die("Došlo je do greške: " . $spoj->connect_error);
}
//echo "Konekcija s bazom je uspjela";
?>
