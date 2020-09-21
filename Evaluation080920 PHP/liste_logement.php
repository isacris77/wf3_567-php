<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/


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




// -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}

// debug($_POST); 




$resultat = $pdo->query("SELECT * FROM logement");
// debug($resultat);

while($contact = $resultat->fetch(PDO::FETCH_ASSOC)){ 
    $contenu.= '<tr>';

    foreach ($contact as $indice=>$valeur){ 

        if($indice == 'photo') { 
            $contenu.= '<td><img src="'. $valeur.'" style="width:80px"></td>';

        } else { 
            $contenu.='<td>' . $valeur . '</td>'; 
        }

    }

    $contenu.='<td>
    <a href="detail_logement.php?id_logement='. $contact['id_logement'].'">Voir</a>
</td>'; 


   
    $contenu.='</tr>';
}


    
    

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

    <title>Liste des logements</title>
</head>



<body>

<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->   


<h1 class="mt-4"> liste </h1>

<table class="table">

    <tr>

        <th>id_logement</th>
        <th>titre</th>
        <th>adresse</th>
        <th>ville</th>
        <th>cp</th>
        <th>surface</th>
        <th>prix</th>
        <th>photo</th>
        <th>Type</th>
        <th>description</th>
        <th>voir</th>

    </tr>

    <?php

    echo $contenu;



    ?>
    




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>