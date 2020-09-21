<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

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




// -----------------Fonction debug----------------------------------------
 
function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}

debug($_POST); // A faire de suite après avec fait le html pour voir ce que l'on récupère



// 1- Afficher dans une table HTML la liste des contacts avec tous les champs.

// requête
$resultat = $pdo->query("SELECT * FROM contact");
debug($resultat);

while($contact = $resultat->fetch(PDO::FETCH_ASSOC)){ // a chaque tout de boucle de while, fetch() va chercher la ligne suivante qui correspond à & employé et returne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir :
    //debug($contact);
    $contenu.= '<tr>';

    foreach ($contact as $indice=>$valeur){ // cette boucle parcourt les informations du tableau $produit

        if($indice == 'photo') { // si je suis sur la colonne photo alors je mets une balise <img>
            $contenu.= '<td><img src="'. $valeur.'" style="width:80px"></td>';

        } else { // pas de balise img pour les autres colonnes
            $contenu.='<td>' . $valeur . '</td>'; 
        }

    }

    $contenu.='<td>
    <a href="detail_contact.php?id_contact='. $contact['id_contact'].'">Voir</a>
</td>'; // on envoie à la page detail_contact.php.l'identifiant du contact "id_contact". Sa valeur se trouve dans le tableau $contact qui contient un indice "id_contact" d'après le debug fait en ligne 46 


   
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

    <title>Liste des contacts</title>
</head>



<body>

<!-- ************************************ ICI le contenu spécifique à la page ********************************************************* -->   


<h1 class="mt-4"> Contact </h1>

<table class="table">

    <tr>

        <th>id_contact</th>
        <th>Nom</th>
        <th>prenom</th>
        <th>telephone</th>
        <th>email</th>
        <th>Type de contact</th>
        <th>Photo</th>
        <th>Voir></th>

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