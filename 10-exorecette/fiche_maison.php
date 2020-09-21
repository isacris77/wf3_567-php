<?php
// <!-- ------------------------------------TRAITEMENT PHP -->

// Connexion Ã  la BDD
$pdo = new PDO('mysql:host=localhost;dbname=IMMO', 
'root', 
'',     
array(
 PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' )) ;


 //------------------dÃ©claration des variables------------------------
 $contenu = '';
 $photo_bdd='';

 // -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}

debug($_POST);

// --------------------------------------------------------





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

    <title>Nos biens immobiliers</title>
</head>



<body>

    

             
<!-- ************************************ ICI le contenu spÃ©cifique Ã  la page ********************************************************* -->   
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link " href="liste_maison.php">Liste des biens</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="ajout_maison.php">Ajouter un bien</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">fiche produit</a>
  </li>
 
</ul>
</nav>                 











                    
<!-- *****************************************footer************************************************** -->
                    



<footer>
    <div class="container">
         <hr>

         <div class="row text-center">
                <div class="col">
                 <!-- ICI le contenu spÃƒÂ©cifique ÃƒÂ  la page -->
                    <p>&copy; Zaza Immobilier - <?php echo date('Y'); ?></p>
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