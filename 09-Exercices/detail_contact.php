<?php
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/
// <!-- ------------------------------------TRAITEMENT PHP -->
// Connexion à la BDD


$pdo = new PDO('mysql:host=localhost;dbname=REPERTOIRE', 
'root', 
'',     
array(
 PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' )) ;

 //------------------déclaration des variables------------------------

$contenu='';


// -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}






// 1- Contrôle de l'existence du contact demandé (un contact  a pu être supprimé de la BDD...) :
// debug($_GET);

if (isset($_GET['id_contact'])) {  // si "id_contact" est dans l'URL, c'est que l'on a demandé le détail d'un contact
  
    // echappement des données
    $_GET['id_contact']= htmlspecialchars($_GET['id_contact'], ENT_QUOTES); // pour se prémunir des risques XSS et CSS ( les chevrons sont transformés en entités HTML)
  
    // preparation de la requete. ici requete préparée car elle vient de $_get qui vient de l'internaute
  $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact= :id_contact");
   $resultat ->execute(array('id_contact'=>$_GET['id_contact']) ); // on associe le marqueur à la valeur qui passe par l'URL donc dans $_GET


    // 2- Affichage et mise en forme des informations du produit :
      $contact = $resultat->fetch(PDO::FETCH_ASSOC);  // on "fetche" l'objet $résultat pour aller chercher les données du contact qui s'y trouvent 

      // debug($contact);
     
  
      
   }
// debug($resultat);









   







?>
<!-- ------------------------------------AFFICHAGE ------------------------------------------------->
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Detail du contact</title>
</head>



<body>

<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->   

<?php



if (empty($contact)){
    echo '<p>contact inexistant</p>';
    
} else{

  extract($contact);

?>

<h1>Detail du contact</h1>

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $photo ?>" alt="Card image cap"> 
  <!-- ou : ................src="'.echo $photo.'" -->
  <div class="card-body">
    <h5 class="card-title"><?php echo $nom ?></h5>
    <h4 class="card-title"><?php echo $Prenom ?></h4>
    <p class="card-text"><?php echo $telephone ?></p>
    <p class="card-text"><?php echo $email ?></p>
    <p class="card-text"><?php echo $type_contact ?></p>
    <a href="#" class="btn btn-primary">Plus de detaiLS</a>
  </div>
</div>

<?php
}


?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
