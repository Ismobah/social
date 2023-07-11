<?php 
include 'db.php' ;
if (isset($_GET['username'])) {
	$id = $_GET['username'];
	$req = "DELETE FROM users WHERE username='$id' ";
	$resultat = mysqli_query($conn, $req);
	if ($resultat) {
        //echo "Produit ajouté avec succes !";
		header("location: login.php");
	}
}


?>