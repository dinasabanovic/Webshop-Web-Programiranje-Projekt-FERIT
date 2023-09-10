<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<?php include 'header.php'; ?>
	</header>

	<h2 id="welcome">Dobro došli, <?php echo $_SESSION['first_name'], ' ', $_SESSION['last_name']; ?>!</h2>

	<h2 id="new">NOVO</h2>

	<div class="items-grid">
		<?php
		include "db_conn.php";

		$sql = "SELECT * FROM proizvodi ORDER BY id DESC LIMIT 3";
		$result = $spoj->query($sql);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<div class='item'>";
				echo "<a href='product.php?id=".$row["id"]."'>";
				echo "<img src='".$row["image"]."' alt='Product Image'>";
				echo "<h3>".$row["name"]."</h3>";
				echo "<p>Price: ".$row["price"]."</p>";
				echo "</a>";
				echo "</div>";
			}
		} else {
			echo "<p>No available products.</p>";
		}

		$spoj->close();
		?>
	</div>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
