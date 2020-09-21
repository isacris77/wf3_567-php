<?php


// <!-- ------------------------------------TRAITEMENT PHP -->
// Connexion à la BDD


$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 
'root', 
'',     
array(
 PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' )) ;

//------------------déclaration des variables------------------------
$contenu = '';
$photo_bdd='';





// -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}



debug($_POST); 



if(!empty($_POST)){ 

    // titre
    if (!isset($_POST['titre']) || strlen($_POST['titre']) < 6 || strlen($_POST['titre'])  > 255) { 
        $contenu.= '<div class="alert alert-danger">Le titre doit contenir entre 6 et 255 caractères.</div>';
      }
    
      // adresse
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 6 || strlen($_POST['adresse'])  > 255) { 
        $contenu.= '<div class="alert alert-danger">Le adresse doit contenir entre 6 et 255 caractères.</div>';
      } 

  
    // ville

      if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'])  > 20) { 
        $contenu.= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
      }
   
      
    // cp
       
    if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])) {
        $contenu.= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
     }

    //surface
        if (!isset($_POST['surface'])) { 
        $contenu.= '<div class="alert alert-danger">La surface ne peut pas être inférieur à 10m2.</div>';
      }


     //prix
         if (!isset($_POST['prix']) ) { 
        $contenu.= '<div class="alert alert-danger">Le prix ne peut pas être inférieur à 10euros.</div>';
      }  

     
        // type de contact

        if(!isset($_POST['type']) || ($_POST['type'] != 'location' && $_POST['type'] != 'vente'   &&  $_POST['type'] != 'autre')) {
        $contenu.= '<div>Le type de bien est invalide.</div>';
        } 

    // description
         if (!isset($_POST['description']) || strlen($_POST['description']) < 6 || strlen($_POST['description'])  > 255) { 
         $contenu.= '<div class="alert alert-danger">La description doit comprendre entre 6 et 255 caractères.</div>';
         } 
      
        
        

    
   
    // s'il n'y a plus de message d'erreur, on insère le contact en BDD:       
         
          if (empty($contenu)){
    
         
                
                if(!empty($_FILES['photo']['name'])){ 
    
                    $photo_bdd = 'photo/'. $_FILES['photo']['name'] ; 
                    copy($_FILES['photo']['tmp_name'],  $photo_bdd); 
    
                }
                // debug($_FILES);
    
    
            // echappement des données du formulaire
    
            $_POST['titre'] = htmlspecialchars($_POST['titre'], ENT_QUOTES); 
            $_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
            $_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);
            $_POST['cp'] = htmlspecialchars($_POST['cp'], ENT_QUOTES);
            $_POST['surface'] = htmlspecialchars($_POST['surface'], ENT_QUOTES);
            $_POST['prix'] = htmlspecialchars($_POST['prix'], ENT_QUOTES);
            $_POST['type'] = htmlspecialchars($_POST['type'], ENT_QUOTES);
            $_POST['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES);
    
          
    
            // on prépare la requete
            $resultat = $pdo->prepare("REPLACE INTO logement (titre, adresse, ville, cp, surface,  prix, photo,  type, description ) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)");
    
            $succes = $resultat ->execute(array(
                ':titre' => $_POST['titre'],
                ':adresse' => $_POST['adresse'],
                ':ville' => $_POST['ville'],
                ':cp' => $_POST['cp'],
                ':surface' => $_POST['surface'],
                ':prix' => $_POST['prix'],
                ':photo'         => $photo_bdd,
                ':type' => $_POST['type'],
                ':description' => $_POST['description']
               
                
            ));
    
    
            if ($succes) { // si la variable contient true ( returné par la méthode execute() ) alors c'est que la requete a marché 
                            $contenu .= ' <div class ="alert alert-success">Le contact a été enregistré.</div>';
                        
                        } else { // sinon dans le cas contraire, la variable nous a retourné false
                        
                             $contenu .= ' <div class ="alert alert-danger">Erreur lors de l\'enregistrement du contact </div>';
                        
                        }
       
            
    
          } //fin du if empty contenu
    
    
    } // fin du if not empty $_POST
    






?>




<!-- ------------------------------------AFFICHAGE ----------------------------------->
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Bien immobilier</title>
</head>



<body>

    

             
<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->                    
                   

<h1 class="m-4 ">Ajout d'un bien immobilier</h1> 

<?php
    echo $contenu; 
?>


<form method="post" action="" class="m-4" enctype="multipart/form-data">






    <div><label for="titre">Titre</label></div>
    <div><input class="mb-4"type="text" required="required" name="titre" id="titre" ></div>
    <!--  -->
    <div><label for="adresse">Adresse</label></div>
    <div><textarea class="mb-4 col" name="adresse" id="adresse"  rows="5" required="required"></textarea></div>
    <!--  -->
    <div><label class="mb-2" for="ville">Ville</label></div>
    <div><input class="mb-4 col-8" type="text" required="required" name="ville" id="ville" value=""></div>
    <!--  -->
    <div><label for="cp">Code Postal</label></div>
    <div><input type="text" required="required" name="cp" id="cp" value=""></div>
    <!--  -->
    <div><label for="surface">Surface</label> </div> 
    <input  class="mb-4 col-8" id="surface"  type="text" required="required" name="surface" value="" 
  ><small id="m2" class="text-muted">m2</small>
    <!--  -->
    
    <div><label for="prix">Prix</label></div>
    <div> <input type="text" required="required" name="prix" id="prix" value="" ></div>

    <!--  -->
    <div class="mt-4"><label for="photo">Photo</label></div>        
    <input type="file" name="photo" id="photo" >

    <div><label for="type">Type de bien</label></div>
     <div>
        <select name="type" id="type">
            <option value="location" <?php  if(isset($logement['type'])  && $logement['type'] =='location') echo 'selected' ?>>location</option>
            <option value="vente" <?php  if(isset($logement['type'])  && $logement['type'] =='vente') echo 'selected' ?>>vente</option>
         
        </select>
     </div>

     <div><label for="description">Description</label></div>
    <div> <textarea  name="description" id="description" cols="30" row="10"></textarea></div>

    <div><input type="submit"  value="S'inscrire" class="btn btn-info"></div>












</form>

















                    
<!-- *****************************************footer************************************************** -->
                    



<footer>
    <div class="container">
         <hr>

         <div class="row text-center">
                <div class="col">
                 <!-- ICI le contenu spÃ©cifique Ã  la page -->
                    <p>&copy; Repertoire - <?php echo date('Y'); ?></p>
                </div>
         </div>
    </div>            
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>