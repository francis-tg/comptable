<?php
// ---------- connection à la base de donnée ----------------------//
require_once 'pages/db.php';
// =============Protection de la page ==========================>
if (isset($_GET['id']) && $_GET['id']>0 && !empty($_GET['id'])) {
    if ($_GET['id'] == $_SESSION['id']) {

        // Selection de tous les article ========================>
        $select_article = $con->query('SELECT * FROM articles ');
          // Selection des prix de tous les article ========================>
          

          $n = "TG-";
          for ($i=0; $i <8 ; $i++) { 
              $n = "TG-".$i.rand(1000, 500);
              $n++;
          }
        if (isset($_POST['submit'])) {
            extract($_POST);
            $_SESSION['montant'] = $montant_versé;
            //   Variable pour calcul =====================================>
            if (isset($_POST['produits'])) {
                $article_s = $_POST['produits'];
                $select_article_price = $con->prepare('SELECT * FROM articles WHERE name_article = ?');
                $select_article_price->execute(array($article_s));
                $article_price = $select_article_price->fetch();
                $_SESSION['price'] = $article_price['prix'];
            }
            // $sel_num_art = $con->prepare('SELECT * FROM facturation WHERE name_client = ? && date_achat = ?');
            // $sel_num_art->execute(array($name, $date_achat));
            // $ver_num_art = $sel_num_art->rowCount();
            // if ($sel_num_art == 1) {
            //     $update = $con->prepare('UPDATE facturation SET num_recu = ? WHERE name_client = ? && date_achat = ?');
            //     $update->execute(array($name, $date_achat));
            // }else{
            if (isset($_POST['name'], $_POST['pseudo'], $_POST['date_achat'],$_POST['addresse']) && !empty($_POST['name']) && !empty($_POST['pseudo']) && !empty($_POST['date_achat'])) {
              $insert = $con->prepare('INSERT INTO facturation (name_client, pseudo_client, addresse,date_achat, name_article,num_recu, prix, id_caisier) VALUES (?,?,?,?,?,?,?,?)');
              $insert->execute(array($name, $pseudo, $addresse, $date_achat, $produits, $num,$article_price['prix'],$_GET['id']));
              
              
              
            // }
        }

        }
        
        
        
        

        
        
        
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Facturation | Entreprise</title>
            <link rel="stylesheet" href="css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">

            <div class="row">   
            
           <div class="col-md-6">
           <form action="" method="post">
           <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <!-- c'est alléatoire -->
                    <span class="input-group-text" id="basic-addon1">Numero de reçu</span> 
                </div>
                <input type="text" name="num" id="" class="form-control" readonly value="<?=$n?>" aria-label="Username" aria-describedby="basic-addon1" aria-required="TRUE" required>
               
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nom complet du client</span>
                </div>
                <input type="text" name="pseudo" id="" class="form-control" placeholder="Nom du client" aria-label="Username" aria-describedby="basic-addon1" aria-required="TRUE" required>
                <input type="text" name="name" id="" class="form-control" placeholder="prenom du client" aria-label="Username" aria-describedby="basic-addon1" aria-required="TRUE" required>
                </div>
                
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <label for="inputGroupSelect02" class="input-group-text">Produits</label>
                    </div>
                    
                        
                        <select name="produits" id="inputGroupSelect02" class="custom-select">
                        <option value="">Nom du produit</option>
                        <?php while ($article = $select_article->fetch()) {?>
                        <option  value="<?=$article['name_article']?>"><?=$article['name_article']?></option>
                       
                        <?php $_SESSION['article'] = $article['name_article']; } ?>
                    </select>
                  
                    
                    
                </div>
                <div class="alert-warning">
                    <p>Activé en cas de promotion</p>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <label for="inputGroupSelect02" class="input-group-text">Promotion</label>
                    </div>
                    <select name="" id="inputGroupSelect02" class="custom-select" disabled>
                        <option value="" disabled>0%</option>
                        <option value="20%">Télévision</option>
                        <option value="30%">Frigo</option>
                        <option value="15%r">Un ventilateur</option>
                        <option value="10%x">Un moulinex</option>
                        <option value="15%">Un micro-onde</option>
                    </select>
                    
                </div>
            
            </div>
            <!-- row -->
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name="addresse" id="" required aria-describedby="basic-addon1" aria-label="Username" class="form-control">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Addresse client</span>
                    </div>
                </div>
                <?php
                
                ?>
                
                <div class="input-group mb-3">
                    <input type="date" name="date_achat" id="" required aria-describedby="basic-addon1" aria-label="Username" class="form-control" placeholder="Prix" value="<?=DATE("")?>">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Date</span>
                    </div>
                </div>
                <div class="alert-warning">
                <p>Activé en cas de promotion</p>
               </div>
                <div class="input-group mb-3">
                    <input disabled type="text" name="" id="" required aria-describedby="basic-addon1" aria-label="Username" class="form-control" placeholder="Prix promotionnel">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Fcfa</span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input  type="text" name="montant_versé" id="" required aria-describedby="basic-addon1" aria-label="Username" class="form-control" placeholder="Montant versé">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Fcfa</span>
                    </div>
                </div>
                
            </div>
            
            <button type="submit" style="width: 400px;" name="submit" class="btn btn-primary">Enrégistrer</button>
            <a href="pages/recu.php?id=<?=$_SESSION['id']?>&réçu=<?=$num?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">Imprimer reçu</a>
            <div class="text-center">
                <a href="pages/print.php?id=<?=$_SESSION['id']?>" class="btn btn-dark">Récapituatif de jour</a>
            </div>
            <div class="alert-danger" role="alert">
                <p>Il est obligatoire d'imprimer le Récapituatif</p>
            </div>
            

            </div>

                </form>
            

            </div>
            </div>
        </body>
        </html>


        <?php  }else{?>
            <title>Error 404</title>
            <h1>Une erreur s'est produite Clicker <a href="index.php">ici</a></h1>
     <?php   }
 }else {?>
    <title>Error 404</title>
    <h1>Une erreur s'est produite Clicker <a href="index.php">ici</a></h1>
<?php }?>
<style>
    .btn{
        margin-left: 25rem;
    }
</style>