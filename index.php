<?php
require_once 'pages/db.php';
if (isset($_POST['submit'])) {
    # code...

if (isset($_POST['pseudo'], $_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {
    extract($_POST);
    $select = $con->prepare('SELECT * FROM personnel WHERE identifiant = ? AND password=?');
    $select->execute(array($pseudo, $password));
    $verify = $select->rowCount();
    $si = $select->fetch();
    $_SESSION['id'] = $si['id'];
    if ($verify == 1) {
        header('location: donne.php?id='.$_SESSION['id']);
    }else {
        $err = "Oups!! Votre mot de passe n'est pas correct, rééssayer ou si vous l'avez oublié contacter <a>l\'admininstrateur</a>";
    }
}else {
    $err = "Ooups!!! <br> Les champs sont vides";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptable | Entreprise</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">
   <div class="row">
       <div class="col-md-5">
           <div class="toast-header bg-dark">
               <h3 style="color:aliceblue">Se connecter | Personnel</h3>
           </div>
       <form action="" method="post">
           <?php if (isset($err)) {?>
              <div class="alert-danger alert " role="alert">
                  <div class="alert-heading">
                      <h3>Erreur</h3>
                      <hr>
                  </div>
                <p>
                 <?=$err?>
                 
                </p>
              </div>
         <?php  }?>
       <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Identifiant</span>
        </div>
        <input type="text" name="pseudo" id="" class="form-control" placeholder="Identifiant" aria-label="Username" aria-describedby="basic-addon1" aria-required="TRUE" required>
        </div>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Mot de passe</span>
        </div>
        <input type="password" name="password" id="" class="form-control" placeholder="Mot de passe" aria-label="Username" aria-describedby="basic-addon1" aria-required="TRUE" required>
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-outline-primary" name="submit">Connectez-vous</button>
        </div>
       </form>
       </div>
       <div class="col-md-6">
           <div class="alert alert-success" role="alert">
               
                  <h2>Bonjour! Heureux de vous revoir</h2>

                  <div class="mb-0">
                      <p>
                          Chers personnel  vous recevrez des messages ou notifications ici 
                      </p>
                  </div>
                  <hr>

                  <h2>
                      Messages
                  </h2><br>
                  <div class="mb-2">
                    <?php if (isset($msg['message'])) {?>
                        <?=$msg['message']?>
                   <?php } ?>
                  </div>
               
           </div>
       </div>
   </div>
</div>
    
</body>
</html>
<style>
    .row{
        margin-top: 10rem;
    }
    body{
        background: #444d;
    }
</style>