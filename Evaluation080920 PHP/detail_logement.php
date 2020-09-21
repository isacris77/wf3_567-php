<?php




$pdo = new PDO('mysql:host=localhost;dbname=immobilier', 
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



if (isset($_GET['id_logement'])) {  
  
   
    $_GET['id_logement']= htmlspecialchars($_GET['id_logement'], ENT_QUOTES); 
  

  $resultat = $pdo->prepare("SELECT * FROM logement WHERE id_logement= :id_logement");
   $resultat ->execute(array('id_logement'=>$_GET['id_logement']) ); 


      $contact = $resultat->fetch(PDO::FETCH_ASSOC);  

     
  
      
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

    <title>Detail du logement</title>
</head>



<body>

<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->   

<?php



if (empty($contact)){
    echo '<p>Logement inexistant</p>';
    
} else{

  extract($contact);

}

?>

<h1>Detail du logement</h1>

<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $photo?>" alt="Card image cap"> 
  <!-- ou : ................src="'.echo $photo.'" -->
  <div class="card-body">
    <h5 class="card-title"><?php echo $titre ?></h5>
    <h4 class="card-title"><?php echo $adresse ?></h4>
    <p class="card-text"><?php echo $ville ?></p>
    <p class="card-text"><?php echo $cp ?></p>
    <p class="card-text"><?php echo 'le bien fait ' .$surface. ' m2' ?></p>
    <p class="card-text"><?php echo 'le bien est estimé à '.$prix. ' euros' ?></p>
    <p class="card-text"><?php echo 'il s\'agit d\'une ' . $type ?></p>
    <p class="card-text"><?php echo $description ?></p>
    <a href="#" class="btn btn-primary">Plus de details</a>
  </div>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
