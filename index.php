<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form class="login-form" action="login.php" method="post">
		<h2>Podaci za prijavu:</h2>
		<?php 
		if (isset($_GET['error'])) { 
		?>
		<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>Email</label>
		<input type="text" name="k_ime" placeholder="Email"><br>

		<label>Lozinka</label>
		<input type="password" name="lozinka" placeholder="Password"><br>

		<button class="subbtn" type="submit">Prijava</button>

		<div>
		<a href="registracija.php">Registriraj se</a>
	    </div>
		</form>
</body>
</html>