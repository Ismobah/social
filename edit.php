<?php
include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.7.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-k9r9QOWlPYCzVP7H3ijW5KqwOv6WnKwYwtTXoX3YpH6BdBvOfdp1EEcGqDpl4Gztky7D7l+IyNJzAdxVeMkI7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eN BvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<!-- codes HTML -->

<?php
if(isset($_GET['username'])){
    $id=$_GET['username'];
    $req="SELECT * FROM users WHERE username='$id'";
    $line=mysqli_query($conn,$req);
    if($line){
        if($row=mysqli_fetch_assoc($line)){?>
<div class="container">
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 500px;">
	
	<form method="POST" action="edit.php" enctype="multipart/form-data">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i>nom</span>
		 </div>
        <input name="nom" class="form-control" placeholder="Full name" type="text" value="<?php echo $row['username'];?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i>Email </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email" value="<?php echo $row['email'];?>">
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i>image</span>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label"></label>
            <input type="file" class="form-control" name="img" value="<?php echo $row['profil'];?>">
        </div></div>
	</div> <!--form-group end.// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i>create password </span>
		</div>
        <input class="form-control" name="mdp" placeholder="Create password" type="password" value="<?php echo $row['password'];?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i>Repeat password </span>
		</div>
        <input class="form-control" name="rmdp" placeholder="Repeat password" type="password" value="<?php echo $row['password'];?>">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" name="modif">Modifier  </button>
    </div>                                                              
</form>
</article>
</div> 

</div> 
<?php 
    }
    }
}?>


<br><br>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
<?php
if (isset($_POST['modif'])) {
    $id=$_GET['username'];
	$nom=$_POST['username'];
	$cmdp=$_POST['rmdp'];
	$Email=$_POST['email'];
	$mdp=$_POST['mdp'];
	$name=$_FILES['img']['name'];
    $dest = "image/".$name;
    move_uploaded_file($_FILES['img']['tmp_name'],$dest);
	if ($mdp==$cmdp) {
	  $secure=hash_hmac("sha256", $mdp, "cle");
	  $mdp_secure=password_hash($secure,PASSWORD_DEFAULT);
	$sql1="UPDATE users SET username='$nom',email='$Email',profil='$name',password='$mdp_secure' WHERE username='$id'";
	  $resultat=mysqli_query($conn,$sql1);
	  if ($resultat) {
		header("location:login.php");
	  }
	}
  
  }
  
?>
