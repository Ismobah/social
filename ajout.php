<?php 
session_start();
include 'db.php';
if(isset($_POST['ajouter'])){
    $user=$_SESSION['id'];
	$texte=$_POST['texte'];
    $name=$_FILES['image']['name'];
    $dest = "image/".$name;
    move_uploaded_file($_FILES['image']['tmp_name'],$dest);

	$req1="INSERT INTO posts (user_id,picture,content) VALUES ('$user','$name','$texte')";
	$resultat=mysqli_query($conn,$req1);

	if($resultat){
		
		header("location:index.php");
	}

}

if (isset($_POST['inscrire'])) {
	$nom=$_POST['nom'];
	$cmdp=$_POST['rmdp'];
	$Email=$_POST['email'];
	$mdp=$_POST['mdp'];
	$name=$_FILES['img']['name'];
    $dest = "image/".$name;
    move_uploaded_file($_FILES['image']['tmp_name'],$dest);
	if ($mdp==$cmdp) {
	  $secure=hash_hmac("sha256", $mdp, "cle");
	  $mdp_secure=password_hash($secure,PASSWORD_DEFAULT);
	$sql1="INSERT INTO users(username,email,profil,password)VALUES('$nom','$Email','$name','$mdp_secure')";
	  $resultat=mysqli_query($conn,$sql1);
	  if ($resultat) {
		$line = $nom . ',' . $Email . ',' . date('Y-m-d H:i:s') . PHP_EOL;
		file_put_contents("file.txt",$line,FILE_APPEND);
		header("location:login.php");
	  }
	}
  
  }
  
?>