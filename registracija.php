<!DOCTYPE html>
<html>
<head>
	<title>Naslovna</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form class="registration-form" action="register.php" method="post">
     	<h2>Podaci za registraciju:</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		<label>Vaše ime</label>
     	<input type="text" name="ime" placeholder="Your First Name"><br>

        <label>Vaše prezime</label>
     	<input type="text" name="prezime" placeholder="Your Last Name"><br>

     	<label>Email</label>
     	<input type="text" name="k_ime" placeholder="Email"><br>

        <label>Adresa</label>
     	<input type="text" name="adresa" placeholder="Adress"><br>

        <label>Grad</label>
     	<input type="text" name="grad" placeholder="City"><br>

        <label>Poštanski broj</label>
     	<input type="text" name="p_broj" placeholder="Postal Number"><br>

     	<label>Lozinka</label>
     	<input type="password" name="lozinka" placeholder="Password"><br>

		<label>Ponovite lozinku</label>
     	<input type="password" name="lozinka2" placeholder="Enter password one more time"><br>

     	<button class="subbtn" type="submit">Registriraj se</button>
		 <div>
			<a href="index.php">Prijava</a>
		 </div>
     </form>
</body>
</html>