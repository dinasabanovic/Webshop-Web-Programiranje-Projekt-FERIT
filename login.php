<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['k_ime']) && isset($_POST['lozinka'])) {

	function validate($data){
     $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['k_ime']);
	$pass = validate($_POST['lozinka']);

	if (empty($uname)) {
		header("Location: index.php?error=Niste unijeli email adresu");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Niste unijeli lozinku");
	    exit();
	}else{
		$sql = "SELECT * FROM korisnici WHERE user_name=?";
		$stmt = $spoj->prepare($sql);
		$stmt->bind_param("s", $uname);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($db_userid, $db_firstname, $db_lastname, $db_username, $db_paswordHASH, $db_address, $db_city, $db_postalcode);


		if ($stmt->num_rows === 1) {
			$stmt->fetch();
			if (password_verify($pass, $db_paswordHASH)) {
				$_SESSION['id'] = $db_userid;
				$_SESSION['user_name'] = $db_username;
				$_SESSION['first_name'] = $db_firstname;
                $_SESSION['last_name'] = $db_lastname;
                $_SESSION['address'] = $db_address;
                $_SESSION['city'] = $db_city;
                $_SESSION['postal_code'] = $db_postalcode;
				header("Location: home.php");
				exit();
			}else{
				header("Location: index.php?error=Neispravna lozinka");
				exit();
			}
		}else{
			header("Location: index.php?error=Neispravna email adresa");
			exit();
		}
		$spoj->close();
	}
	
}else{
	header("Location: index.php");
	exit();
}
?>
