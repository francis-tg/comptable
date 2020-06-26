<?php
require_once 'db.php';
if (isset($_GET['id'])) {

   if ($_GET['id'] == $_SESSION['id']) {

    $select = $con->prepare('SELECT * FROM facturation WHERE id_caisier = ?');
    $select->execute(array($_GET['id']));

    $s_c = $con->prepare('SELECT * FROM personnel WHERE id = ?');
    $s_c->execute(array($_GET['id']));

    $caisier = $s_c->fetch();
    
    
       
       
       ?>
   
        <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="../css/bootstrap.min.css" >
       <link rel="stylesheet" href="../print1.css" media="print">
       <title>Réçu | Entreprise</title>
   </head>
   <body>
       <script src="js/jquery.js"></script>
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <table class="table table-bordered print">
                       <thead class=" bg-secondary" >
                           <tr>
                               <th >
                                Num réçu
                               </th>
                               <th>
                                   Nom de l'article

                               </th>
                               <th>
                                   Nom du client
                               </th>
                               <th>
                                   prix
                               </th>
                               <th>
                                   addresse
                               </th>
                               <th>
                                   Date d'achat
                               </th>
                           </tr>
                       </thead>
                       <tbody>
                       <?php
                               while ($r = $select->fetch()) {?>
                           <tr>
                               
                               
                                   <td class=" bg-info">
                                       <?=$r['num_recu']?>
                                   </td> 
                                
                                   <td>
                                       <?=$r['name_article']?>
                                   </td>
                                  <td>
                                      <?=$r['name_client']?>
                                      <?=$r['pseudo_client']?>
                                    </td>
                                  <td class=" bg-success">
                                      <?=$r['prix']?>
                                  </td>
                                  <td>
                                      <?=$r['addresse']?>
                                    </td>  
                                  <td>
                                      <?=$r['date_achat']?>
                                  </td>
                               
                           </tr>
                           <?php } ?>
                       </tbody>
                       

                   </table>
                   <div class="text-center">
                           <h4>Nom du caisier</h4>
                           <p><b><?=$caisier['identifiant']?></b></p>
                       </div>
               </div>
               <div class="col-5">
                  
                   </div>
                  
               </div>
           </div>
           <div class="text-center">
           <a href="pages/print.php?id=<?=$_GET['id']?>&réçu=<?=$_GET['réçu']?>"  id="btn" onclick="window.print()" class="btn btn-primary">Imprimer
           </a>
           <a href="../donne.php?id=<?=$_SESSION['id']?>" id="btn" class="btn btn-info">Retour</a>
           </div>
       </div>
   </body>
   </html>
  <?php }else{ ?>
    <title>Error 404</title>
    <title>Error 404</title>
    <h1>Une erreur s'est produite Clicker <a href="index.php">ici</a></h1>
  <?php }
}else{ ?>
    <title>Error 404</title>
    <title>Error 404</title>
    <h1>Une erreur s'est produite Clicker <a href="index.php">ici</a></h1>
<?php } ?>
<style>
    
   
</style>