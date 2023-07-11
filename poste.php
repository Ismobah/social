<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>poste</title>
</head>
<body>
    <form action="ajout.php" method="POST" class="container" enctype="multipart/form-data">
        <div class="mb-3" >
            <label for="exampleFormControlTextarea1" class="form-label">Texte</label>
            <textarea class="form-control" type="text" name="texte" rows="3"></textarea>
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" class="form-control" name='image'>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary" name="ajouter">ajouter</button>
        </div>
    </form>   
</body>
</html>