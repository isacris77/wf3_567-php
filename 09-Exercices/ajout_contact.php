<?php
/* 1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)


	  

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 


	   
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	5- Si une photo est uploadée, ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site.

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
 $contenu = '';
 $photo_bdd='';


// -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}

debug($_POST); // A faire de suite après avec fait le html pour voir ce que l'on récupère



if(!empty($_POST)){ // si le formulaire a été envoyé


// nom
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom'])  > 50) { 
        $contenu.= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 50 caractères.</div>';
      }

// prenom

      if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom'])  > 50) { 
        $contenu.= '<div class="alert alert-danger">Le prenom doit contenir entre 2 et 20 caractères.</div>';
      }

// telephone      

      if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) { 
        $contenu.= '<div class="alert alert-danger">Le téléphone est invalide.</div>';
      }


// type de contact

      if(!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille'   && $_POST['type_contact'] != 'professionnel' &&  $_POST['type_contact'] != 'autre')) {
        $contenu.= '<div>Le type de contact est invalide.</div>';
      
      }

// email      

      if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 255 ){ 
    $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';
     } 

// s'il n'y a plus de message d'erreur, on insère le contact en BDD:       
     
      if (empty($contenu)){

        // je traite la photo uniquement s'il n'y a pas d'erreur sur le formulaire:
            
            if(!empty($_FILES['photo']['name'])){ // s'il y a un fichier en cours d'uplaod

                $photo_bdd = 'photo/'. $_FILES['photo']['name'] ; // chemin + nom du fichier de la photo que l'on met en BDD. Ne pas oublier de créer le dossier "photo"
                copy($_FILES['photo']['tmp_name'],  $photo_bdd); // copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement défini par $photo_bdd

            }
            debug($_FILES);


        // echappement des données du formulaire

        $_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES); // transforme les chevrons en entités HTML pour eviter les risques XSS et CSS . ENT_QUOTES pour ajouter les guillements à transformer en entités HTMl 
        $_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
        $_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
        $_POST['type_contact'] = htmlspecialchars($_POST['type_contact'], ENT_QUOTES);
        $_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);

        // ou alors avec une foreach
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        }


        // on prépare la requete
        $resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo ) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo ) ");

        $succes = $resultat ->execute(array(
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':telephone' => $_POST['telephone'],
            ':email' => $_POST['email'],
            ':type_contact' => $_POST['type_contact'],
            ':photo'         => $photo_bdd, // attention la photo ne provient pas de $_POST mais de $_FILES que l'on traite à part de $_POST ci dessus
            
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

    <title>Repertoire</title>
</head>



<body>

    

             
<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->                    
                   

<h1 class="m-4 ">Ajout de contact</h1>  

<?php
    echo $contenu; // les echo toujours dans le body
?>

<form class="m-4" method="post" action="" enctype="multipart/form-data"> <!-- enctype pour que le formulaire puisse envoyer le fichier uploadé-->

    <div><label for="nom">Nom</label></div>
    <div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? '';?>"></div>  <!-- ici la value permet de maintenir la valeur dans le formulaire -->
    

    <div><label for="prenom">Prénom</label></div>
    <div><input type="text" name="prenom" id="prenom" ></div>

    <div><label for="telephone">Telephone</label></div>
    <div><input type="text" name="telephone" id="telephone" ></div>

    <div ><label for="email">Email</label></div>
    <div class="mb-4"><input type="text" name="email" id="email" ></div>

    <div><label for="type_contact">Type de contact</label></div>
     <div>
        <select name="type_contact" id="type_contact">
            <option value="ami">Ami</option>
            <option value="famille">Famille</option>
            <option value="professionnel">Professionnel</option>
            <option value="autre">Autre</option>
        </select>
     </div>


        <div class="mt-4"><label for="photo">Photo</label></div>
        <!-- 5 - Upload de photos -->
        <input type="file" name="photo" id="photo" ><!-- on n'oublie pas l'attribut enctype="multipart/form-datasur la balise form  -->

    <div class="mt-4"><input type="submit"  value="S'inscrire" class="btn btn-info"></div>

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