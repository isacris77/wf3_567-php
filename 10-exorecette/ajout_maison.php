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

if(!empty($_POST)){ // si le formulaire a bien été envoyé. je verifie tous les champs

        // type de bien 

        if(!isset($_POST['type_bien']) || ($_POST['type_bien'] !='m')  && ($_POST['type_bien'] != 'a')){
             $contenu .= '<div class="alert alert-danger">Le type de bien n\'est pas pris en compte</div>';
        }

        // ville 
        if(!isset($_POST['ville']) || strlen($_POST['ville']) < 2){
               $contenu .= '<div class="alert alert-danger">La ville n\'est pas valide</div>';

        }

        //code_postal
        if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
            $contenu.= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
      }


        // adresse
        if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse'])  > 50) { 
            $contenu.= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';
          }

        // nbr de pièces
        if(!isset($_POST['nbrpiece']) || ($_POST['nbrpiece'] !='1')  && ($_POST['nbrpiece']) != '2' && ($_POST['nbrpiece']) != '3' && ($_POST['nbrpiece']) != '4' && ($_POST['nbrpiece']) != '5' && ($_POST['nbrpiece']) != '6+'){
            $contenu .= '<div class="alert alert-danger">Le nombre de pièce n\'est pas pris en compte</div>';
        }  
        
        // superficie
        if(!isset($_POST['m2']) ){
            $contenu .= '<div class="alert alert-danger">La superficie  n\'est pas valide</div>';
        } 

        // plus de message d'erreur, insertion en bdd

        if(empty($contenu)){

            // traitement photo
                if(!empty($_FILES['photo']['name'])){

                    $photo_bdd = 'photo/'.$_FILES['photo']['name'];

                    copy($_FILES['photo']['tmp_name'], $photo_bdd);

                }
// debug($_FILES);

                // echappement des donnes du formulaire

                $_POST['type_bien'] = htmlspecialchars($_POST['type_bien'], ENT_QUOTES);
                $_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);
                $_POST['code_postal'] = htmlspecialchars($_POST['code_postal'], ENT_QUOTES);
                $_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
                $_POST['nbrpiece'] = htmlspecialchars($_POST['nbrpiece'], ENT_QUOTES);
                $_POST['m2'] = htmlspecialchars($_POST['m2'], ENT_QUOTES);

                // on prépare la requete

                $resultat = $pdo->prepare("INSERT INTO bien_immo (type_bien, ville, code_postal, adresse, nbrpiece, m2, photo) VALUES (:type_bien, :ville, :code_postal, :adresse, :nbrpiece, :m2, :photo)");

                $succes = $resultat->execute(array(
                    ':type_bien'        =>$_POST['type_bien'],
                    ':ville'              =>$_POST['ville'],
                    ':code_postal'        =>$_POST['code_postal'],
                    ':adresse'        =>$_POST['adresse'],
                    ':nbrpiece'        =>$_POST['nbrpiece'],
                    ':m2'        =>$_POST['m2'],
                    ':photo'    =>$photo_bdd,

                ));

                if($succes){

                  $contenu .= ' <div class ="alert alert-success">Le bien a été enregistré.</div>';
                } else { // sinon dans le cas contraire, la variable nous a retourné false
                    
                    $contenu .= ' <div class ="alert alert-danger">Erreur lors de l\'enregistrement du bien </div>';
               
               }



        } // fin du if $contenu

} // fin du if $ post



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
    <a class="nav-link" href="fiche_maison.php">fiche produit</a>
  </li>
 
</ul>
</nav>                 

<H2 class="m-4">Ajouter un bien</H2>


<?php
echo $contenu;
?>

<form class="m-4 col-8" method="post" action="" enctype="multipart/form-data">

<select class="mb-4 col-8" name="type_bien" id="type_bien">

            <option selected >Type de bien</option>
            <option value="m">Maison</option>
            <option value="a">Appartement</option>
         
    </select>
    



    <div><label class="mb-2" for="ville">Ville</label></div>
    <div><input class="mb-4 col-8" type="text" name="ville" id="ville" value=""></div>

    <div><label for="code_postal">Code Postal</label></div>
    <div><input type="text" name="code_postal" id="code_postal" value=""></div>

    <div><label for="adresse">Adresse</label></div>
    <div><textarea class="mb-4 col " name="adresse" id="adresse"  rows="5"></textarea></div>

    <select class="mb-4 col-8" name="nbrpiece" id="nbrpiece">
        <option selected>Nombre de pièces</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6+">>6 et +</option>
    </select>

    <div><label for="m2">Superficie du bien</label> </div> 
    <input  class="mb-4 col-8" id="m2"  type="text" name="m2" value="">
    <small id="m2" class="text-muted">m2</small>

    <div ><label  for="photo">Photo</label></div>
    <input  class="mb-4 col-8 " type="file" name="photo" id="photo" >

  
    <input class="col-8 btn btn-primary btn-lg btn-block " col-8 type="submit" value="valider">





</form>









                    
<!-- *****************************************footer************************************************** -->
                    





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>