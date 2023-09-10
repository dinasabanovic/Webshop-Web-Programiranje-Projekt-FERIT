<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['k_ime']) && isset($_POST['adresa']) && isset($_POST['grad'])
&& isset($_POST['p_broj']) && isset($_POST['lozinka']) && isset($_POST['lozinka2'])) {

	function validate($data){
      $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	function validateEmail($email){
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    return false;
	  }
	  return true;
	}

	$fname = validate($_POST['ime']);
    $lname = validate($_POST['prezime']);
	$uname = validate($_POST['k_ime']);
    $address = validate($_POST['adresa']);
    $city = validate($_POST['grad']);
    $pnum = validate($_POST['p_broj']);
	$pass = validate($_POST['lozinka']);
	$pass2 = validate($_POST['lozinka2']);

	if (empty($fname)) {
		header("Location: registracija.php?error=Niste unijeli Vaše ime");
	    exit();
    }else if (empty($lname)) {
        header("Location: registracija.php?error=Niste unijeli Vaše prezime");
        exit();
	}else if (empty($uname)) {
		header("Location: registracija.php?error=Niste unijeli email adresu");
		exit();
    }else if (!validateEmail($uname)) {
        header("Location: registracija.php?error=Neispravna email adresa");
        exit();
    }else if (empty($address)) {
        header("Location: registracija.php?error=Niste unijeli adresu");
        exit();
    }else if (empty($city)) {
        header("Location: registracija.php?error=Niste unijeli grad");
        exit(); 
    }else if (empty($pnum)) {
        header("Location: registracija.php?error=Niste unijeli poštanski broj");
        exit();     
	}else if(empty($pass)){
        header("Location: registracija.php?error=Niste unijeli lozinku");
	    exit();
	}else if($pass != $pass2){
		header("Location: registracija.php?error=Niste unijeli jednake lozinke");
		exit();
	}else{
		$stmt = $spoj->prepare("SELECT user_name FROM korisnici WHERE user_name = ?");
		$stmt->bind_param("s", $uname);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) {
			header("Location: registracija.php?error=Ova email adresa se već koristi!");
			exit();
		}

		$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $spoj->prepare("INSERT INTO korisnici (first_name, last_name, user_name, password, address, city, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $fname, $lname, $uname, $hashed_pass, $address, $city, $pnum);

		$rezultat = $stmt->execute();

		if ($rezultat) {
			$_SESSION['id'] = $stmt->insert_id;
			$_SESSION['user_name'] = $uname;
			$_SESSION['first_name'] = $fname;
			$_SESSION['last_name'] = $lname;
			$_SESSION['address'] = $address;
			$_SESSION['city'] = $city;
			$_SESSION['postal_code'] = $pnum;
			if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
				echo "<script>
						alert('Hvala Vam na registraciji. Možete iskoristiti svoj kod za 15% popusta pri prvoj kupnji!');
						window.location.href = 'home.php';
					  </script>";
			} else {
				header("Location: home.php");
			}
			exit();
		} else {
			header("Location: registracija.php?error=Nešto je krenulo po zlu");
			exit();
		}
		$stmt->close();
		$spoj->close();
	}
} else {
	header("Location: index.php");
	exit();
}
?>
