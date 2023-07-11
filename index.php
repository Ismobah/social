<?php 
session_start();
if (!isset($_SESSION['id'])) {
  header("location:login.php");
}
include 'db.php';


if (isset($_POST['inscrire'])) {
  $nom=$_POST['nom'];
  $Email=$_POST['Email'];
  $img=$_FILES['img']['name'];
  $dest="include/images/". $img;
  move_uploaded_file($_FILES ['img']['tmp_name'],$dest);
  $sql1="INSERT INTO user(username,Email,profil)VALUES('$user,'$Email','$img')";
    $resultat=mysqli_query($conn,$sql1);
    if ($resultat){
      // echo "utilisateur ajouté avec succes !"; 
       header("location: login.php");
    }
  }







if(isset($_GET['id']) && isset($_GET['user_id'])){
  $postid = $_GET['id'];
  $userid = $_GET['user_id'];

  // Échapper les valeurs pour éviter les injections SQL
  $escapedPostid = mysqli_real_escape_string($conn, $postid);
  $escapedUserid = mysqli_real_escape_string($conn, $userid);

  // Requête pour sélectionner les lignes dans la table "likes"
  $sql = "SELECT * FROM likes WHERE user_id='$escapedUserid' AND post_id='$escapedPostid'";
  $resultat = mysqli_query($conn, $sql);
  $rowcount = mysqli_num_rows($resultat);

  // Si aucune ligne n'existe, insérer une nouvelle ligne dans la table "likes"
  if($rowcount <= 0){
    $ins = "INSERT INTO likes (user_id, post_id) VALUES ('$escapedUserid', '$escapedPostid')";
    $result = mysqli_query($conn, $ins);
    header("location:index.php");
  }else{
    $sup="DELETE FROM likes WHERE user_id='$escapedUserid' AND post_id='$escapedPostid'";
    $resultat=mysqli_query($conn,$sup);
    header("location:index.php");
  }
}
function countTableById($id, $conn) {
  $query = "SELECT COUNT(*) FROM likes WHERE post_id = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
      $row = mysqli_fetch_row($result);
      return $row[0];
  } else {
      return 0;
  }
}

if (isset($_POST['commenter'])) {
  $contenu = $_POST['content'];
  $postid = $_GET['id_post'];
  $userid = $_SESSION['id'];
  $ins = "INSERT INTO comments (user_id, post_id, content) VALUES ($userid, $postid, '$contenu')";
  $result = mysqli_query($conn, $ins);
  if ($result) {
    header("Location: index.php");
    exit();
  }
  
}

function getcommetBypost($id,$conn)
{
  $sql = "SELECT c.id, c.content, u.username, u.profil FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.post_id = $id";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    return $result;
  } else {
    return null;
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.7.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-k9r9QOWlPYCzVP7H3ijW5KqwOv6WnKwYwtTXoX3YpH6BdBvOfdp1EEcGqDpl4Gztky7D7l+IyNJzAdxVeMkI7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eN BvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
<style>
body{margin-top:20px;}

body {
    color: #6c7293;
}

.profile-navbar .nav-item .nav-link {
  color: #6c7293;
}

.profile-navbar .nav-item .nav-link.active {
  color: #464dee;
}

.profile-navbar .nav-item .nav-link i {
  font-size: 1.25rem;
}

.profile-feed-item {
  padding: 1.5rem 0;
  border-bottom: 1px solid #e9e9e9;
}
.img-sm {
    width: 43px;
    height: 43px;
}
</style>

</head>
<body>
  <header class="align-items-left">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
   <a class="navbar-brand" href="#">Mon Réseau Social</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarsupportedcontent align-items-left">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="#">Accueil</a>
       </li>
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="profil.html">Profil</a>
       </li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="login.php">Connexion</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="deconnex.php"><i class="fa-duotone fa-arrow-up-left-from-circle">Deconnexion</i></a></li>
          </ul>
        </li>
       <li class="nav-item align-items-left">
         <a class="nav-link text-left" href="inscri.php">S'insrire</a>
       </li>
     </ul>
       <div>
         <img class="rounded-circle" style="width: 15px;" src="data:image/jpeg;base64,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" alt="">
       </div>
         <div class="ml-2">
         <h5 class="nav-link" >Mario</h5>
       </div>
  
   </div>
 </nav>
 
   </header>
<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            <?php

            $sqls="SELECT * FROM users WHERE id = {$_SESSION['id']}";
            $resultat= mysqli_query($conn, $sqls);
            ?>
              <div class="row">
              <?php while($rows = mysqli_fetch_assoc($resultat)): ?>
                <div class="col-lg-4">
                  <div class="border-bottom text-center pb-4">
                    <img src="image/<?php echo $rows["profil"]; ?>" class="img-lg rounded-circle mb-3">
                    <div class="mb-3">
                      <h3><?php echo $rows['username'];?></h3>
                      
                    </div>
                    <a class="btn btn-info" href="edit.php?username=<?php echo $rows['username']; ?>">Editer <i class="fa-sharp fa-regular fa-pen-to-square"></i></a>
					          <a class="btn btn-danger" href="delete.php?username=<?php echo $rows['username']; ?>">Supprimer <i class="fa-solid fa-trash-can"></i></a>
                  </div> 
                </div>
                <?php endwhile?>
                <div class="col-lg-8">
                  <div class="mt-4 py-2 border-top border-bottom">
                    <ul class="nav profile-navbar">
                      <li class="nav-item">
                        <a class="nav-link" href="poste.php">
                          <i class="mdi mdi-account-outline"></i>
                          poste
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="#">
                          <i class="mdi mdi-newspaper"></i>
                          Feed
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <i class="mdi mdi-calendar"></i>
                          Agenda
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <i class="mdi mdi-attachment"></i>
                          Resume
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="profile-feed">
                      <?php
                      $sql=" SELECT u.username, u.profil, p.picture, p.content,p.id FROM posts p INNER JOIN users u ON p.user_id = u.id";
                      $result = mysqli_query($conn, $sql);
                      if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <div class="d-flex align-items-start profile-feed-item">
                        <img src="image/<?php echo $row["profil"]; ?>" alt="profile" class="img-sm rounded-circle">
                        <div class="ml-4">
                          <h6>
                           <?php echo $row["username"]; ?>
                            <small class="ml-4 text-muted"><i class="mdi mdi-clock mr-1"></i>10 hours</small>
                          </h6>
                          <p>
                            <?php echo $row["content"];?>
                          </p>
                          <img src="image/<?php echo $row["picture"]; ?>" alt="sample" style="width: 500px" class="rounded mw-300">
                          <div class="card-body">                                
                              <div class="d-flex justify-content-around">
                                <a href="index.php?id=<?php echo $row['id']; ?>&user_id=<?php echo $_SESSION['id']; ?>" class="card-link"><i class="far fa-heart"></i> J'aime <span><?php echo countTableById($row['id'], $conn); ?></span></a>
                                <a href="#" class="d-block justify-content-center"  class="card-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="far fa-comment"></i> Commenter</a>
                                <ul class="dropdown-menu" style="width: 400px;">
                                  <?php
                                    $commentsResult = getcommetBypost($row['id'], $conn);
                                    while ($comment = mysqli_fetch_assoc($commentsResult)):
                                  ?>
                                  <li><a class="dropdown-item" href="#"><?=$comment['content']?></a></li>
                                  <?php endwhile ?>
                                </ul>
                                <div class="dropdown">
                                <a href="#" class="card-link dropdown-toggle" id="share-dropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-share"></i> partager</a>
                                <ul class="dropdown-menu" aria-labelledby="share-dropdown">
                                  <li><a class="dropdown-item" href="#" onclick="shareOnFacebook()"><i class="fab fa-facebook"></i>Facebook</a></li>
                                  <li><a class="dropdown-item" href="#" onclick="shareOnWhatsApp()"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                                  <li><a class="dropdown-item" href="#" onclick="shareOnTwitter()"><i class="fab fa-twitter"></i> Twitter</a></li>
                                </ul>
                              </div>

                              <script>
                              function shareOnFacebook() {
                                var url = encodeURIComponent(window.location.href);
                                var fbShareUrl = "https://www.facebook.com/sharer.php?u=" + url;
                                window.open(fbShareUrl);
                              }

                              function shareOnWhatsApp() {
                                var url = encodeURIComponent(window.location.href);
                                var title = encodeURIComponent("<?php echo $row['content']; ?>");
                                var waShareUrl = "whatsapp://send?text=" + title + " " + url;
                                window.open(waShareUrl);
                              }

                              function shareOnTwitter() {
                                var url = encodeURIComponent(window.location.href);
                                var title = encodeURIComponent("<?php echo $row['content']; ?>");
                                var twShareUrl = "https://twitter.com/intent/tweet?url=" + url + "&text=" + title;
                                window.open(twShareUrl);
                              }


                              </script>

                              </div>
                                <hr>
                                <form action="index.php?id_post=<?=$row['id'];?>" method="post" >
                                  <div class="input-group">
                                    <input type="text" class="form-control" name="content" placeholder="Commenter">
                                    <div class="input-group-append">
                                      <button class="btn btn-success" name="commenter" type="submit"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                  </div>  
                                </form>
                              </div>
                        </div>
                      </div>
                      <?php
                        } // Fin de la boucle while
                      } // Fin de la condition if
                      ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

