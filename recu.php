<?php
require_once 'db.php';
// base de donnée ==========================================>
if (isset($_GET['id']) && $_GET['id']>0 && !empty($_GET['id'])) {
// sécurité de la page ====================================>
   if ($_GET['id'] == $_SESSION['id']) {

    $select = $con->prepare('SELECT * FROM facturation WHERE num_recu=?');
    $select->execute(array($_GET['réçu']));
    $r = $select->fetch();
       $select_c = $con->prepare('SELECT * FROM personnel WHERE id = ?');
       $select_c->execute(array($_GET['id']));
       $c_n = $select_c->fetch();
       
       ?>
   
        <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="../css/bootstrap.min.css" >
       <link rel="stylesheet" href="../print.css" media="print">
       <title>Réçu | Entreprise</title>
   </head>
   <body>
       <script src="js/jquery.js"></script>
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="flex">
                   <img src="../img/banniere.jpg" alt="" >
                   <b><p>Cistech | Entreprise de Vente </p></b>
                   <p>Contact : 91-59-59-14/98852436 </p>
                   <p>E.mail : francisalaphia5@gmail.com</p>
                   </div>
                   <div class="text-center">
                   <header class=" popover-header">
                       <h3>Votre reçu Mr/Mme <?=$r['name_client'];?></h3>
                   </header>
                   </div>
                   

                   <table class="table table-bordered print">
                       <thead>
                           <tr>
                               <th>
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

                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>
                               <?=$r['num_recu'];?>
                               </td>
                               <td>
                               <?=$r['name_article'];?>
                               </td>
                               <td>
                                   
                                   <?=$r['name_client'];?><?=" "?><?=$r['pseudo_client'];?>
                                   
                               </td>
                               <td>
                               <?=$r['prix'];?>
                               </td>
                           </tr>
                       </tbody>

                   </table>
                   <table class="table table-bordered print">
                       <thead>
                           <tr>
                                <th>
                                    Montant Versé
                                </th>
                                <th>
                                    Prix de l'article
                                </th>
                                <th>
                                Monnaie  
                                </th>   
                           </tr>                  
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                  <?=$_SESSION['montant']?>
                                </td>
                            
                                <td>
                                <?=$r['prix'];?>
                                </td>
                                <td>
                                  <?= $_SESSION['montant'] - $r['prix']?>
                                </td>
                            </tr>

                        </tbody>
                        
                        
                   </table>
                   <div class="alert-danger alert">
                       <div class="text-center">
                       
                         <b><p>PAYER</p></b>
                       </div>
                   </div>

                   <h4>Signature</h4><br>
                
                   <p>Nom du caissier : <b><?=$c_n['identifiant']?></b></p>
                  
               </div>
               <div class="col-5">
                  
                   </div>
                  
               </div>
           </div>
           <div class="text-center">
           
            <button id="btn" onclick="window.print()" class="btn btn-primary">Imprimer
           
           </button></a>
           
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
    img{
    height:100px ;
    border-radius: 50%;
    
}
.flex {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;


}
.alert p{
    text-transform: uppercase;
    font-stretch: semi-expanded;
    font-size: 25px;
}

</style>