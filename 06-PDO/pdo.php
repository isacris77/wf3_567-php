<?php


//----------------------------------------
//                 PDO
//----------------------------------------
// L'extension PDO, pour PHP Data Objects, définit une interface pour accéder à une base de données depuis PHP, et permet d'y exécuter des requêtes SQL.

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//------------------------------
echo '<h2> Connexion à la BDD </h2>';
//------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) à changer
               'root', // pseudo de la BDD
               '',     // mdp de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option 1 : on affiche les erreurs SQL 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
               )
);
// $pdo est un objet qui provient de la classe prédéfinie PDO et qui représente la connexion à la base de données.


//------------------------------
echo '<h2> Requêtes avec exec() </h2>';
//------------------------------
// Nous insérons un employé :

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2020-08-26', 1500)"); 

/*
    exec() est utilisé pour la formulation de requêtes ne retournant pas de résultat : INSERT, UPDATE, DELETE.

    Valeur de retour :
        Succès : renvoie le nombre de lignes affectées
        Echec  : false
*/

echo "Nombre d'enregistrements affectés par l'INSERT : $resultat <br>";
echo "Dernier ID généré en BDD : " . $pdo->lastInsertId();

//-------

$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test'");

echo "Nombre d'enregistrements affectés par le DELETE : $resultat <br>"; 

//------------------------------
echo '<h2> Requêtes avec query() et fetch() pour un seul résultat </h2>';
//------------------------------


$resultat = $pdo->query("SELECT *  FROM employes WHERE prenom = 'Daniel'");
/* 
Au contraire de exec(), query() est utilisé pour la formulation de requetes qui retournent un ou plusieurs résultats : SELECT

Valeur de retour:

        Succès: query() retourne un objet qui provient de la classe PDOStatement
        Echec: FALSE 

*/
debug($resultat); // $resulat est le résultat de la requete de selection sous forme inexploitable directement.En effet, nous ne voyons pas les informations de DANIEL. Pour accéder à ses informations il  nous faut utiliser la méthode fetch():

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // la methode fetch() avec le parametre PDO::FETCH_ASSOC retourne un tableau associatif exploitable dont les indices correspondent au nom des champs de la requête. Ce tableau contient les données de Daniel

debug($employe);    

echo 'Je suis' . ' ' . $employe['prenom'] . ' ' . $employe['nom']  . ' ' . 'du service' . ' ' . $employe['service'] . '<br>';



// On peut aussi utiliser les méthodes suivantes :

// 1
$resultat = $pdo->query("SELECT *  FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(PDO::FETCH_NUM); // pour obtenir un tableau indexé numériquement 
debug($employe);

echo 'Je suis' . ' ' . $employe['1'] . ' ' . $employe['2']  . ' ' . 'du service' . ' ' . $employe['4'] . '<br>';

// 2
$resultat = $pdo->query("SELECT *  FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch();// pour obtenir un mélande de tableau associatif et numérique
debug($employe); 

echo 'Je suis' . ' ' . $employe['1'] . ' ' . $employe['2']  . ' ' . 'du service' . ' ' . $employe['4'] . '<br>';

// 3
$resultat = $pdo->query("SELECT *  FROM employes WHERE prenom = 'Daniel'");
$employe = $resultat->fetch(PDO::FETCH_OBJ); // retourne un objet avec le nom des champs comme propriété publiques
debug($employe);

echo 'Je suis' . ' ' . $employe->prenom . ' ' . $employe->nom . ' ' . 'du service' . ' ' . $employe->service. '<br>';

// Note: vous ne pouvez pas faire pls fetch sur le meme resultat c'est pk nous répétons ici la requete.

// Exercice: 
//Afficher le service de l'employé dont l'ID employé est 417

$resultat = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $resultat->fetch();// pour obtenir un mélande de tableau associatif et numérique
debug($employe); 

echo 'L\'employé 417 travaille au service ' . ' ' . $employe['0']. '<br>';


//------------------------------
echo '<h2> Requêtes avec query() et fetch() pour  plusieurs résultat </h2>';
//------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

echo "nombres d'employes : " . $resultat->rowCount() . '<br>'; // compte le nombre de lignes (d'employés) dans l'objet $resultat (exemple :  nombre de produits dans une boutique).
debug($resultat); 


//Comme nous avons pls lignes dans $resultat, nous devons faire une boucle pour les parcourir : 
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){ // fetch() va chercher la ligne "suivante" du jeu de résultat qu'il retourne en tableau associatif.
    // la boucle while permet de faire avancer le curseur dans la table et s'arrete quand le curseur est à la fin           des résultats ( quand fetch retourne false).

    debug($employe);  //$employe est un tableau associatif qui contient les données de 1 employé par tour de boucle.

    echo '<div>';

        echo '<div>' . $employe['prenom'] . '</div>'; 
         echo '<div>' . $employe['nom'] . '</div>'; 
          echo '<div>' . $employe['service'] . '</div>'; 
           echo '<div>' . $employe['salaire'] . '</div>'; 
            echo '<div>' . $employe['prenom'] . ' €</div>'; 
     echo '</div><hr>';

}


//------------------------------
echo '<h2> La méthode fetchAll()</h2>';
//------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$donnees = $resultat->fetchAll(PDO:: FETCH_ASSOC);  // fetchAll() retourne toutes les lignes de $resultat dans un tableau multidimensionnel : on a un tableau associatif (par employé) rangé à chaque indice numérique. Pour info , on peut aussi faire FETCH_NUM pour un sous tableau numérique, ou un fetchAll() sans paramètres pour un sous tableau numérique et associatif.
 debug($donnees);
  echo '<hr>';

// on parcourt le tableau $donnees avec une boucle foreach pour en afficher le contenu : 

foreach($donnees as $indice=> $employe){ // $employe est lui même un tableau . on accède donc à ses valeurs par les indices entre[.]
//    debug($employe);

 echo '<div>';

        echo '<div>' . $employe['prenom'] . '</div>'; 
         echo '<div>' . $employe['nom'] . '</div>'; 
          echo '<div>' . $employe['service'] . '</div>'; 
           echo '<div>' . $employe['salaire'] . '</div>'; 
            echo '<div>' . $employe['prenom'] . ' €</div>'; 
     echo '</div><hr>';
}

//------------------------------
echo '<h2>Exercices</h2>';
//------------------------------
// Afficher la liste des différents services dans une seule liste <ul> et avec un service par <li>.


//-------version fetchAll
 
$resultat = $pdo->query("SELECT DISTINCT service FROM employes "); 
$services = $resultat->fetchAll(PDO:: FETCH_ASSOC); 
 debug($services);



echo '<ul>'; // on met le UL en dehors de la boucle car on ne veut qu'une seule liste
 foreach($services as $service){ 
//    debug($services);
  
        echo '<li>' . $service['service'] . '</li>'; 
         
 }
  echo '</ul><hr>';

  //-------version en while
$resultat = $pdo->query("SELECT DISTINCT service FROM employes "); // ne pas oublier de faire la requete avant un nouveau fetch, sinon on est deja hors du jeu de résultat et donc il n'y a plus rien à récupèrer

echo '<ul>'; 

    while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){
        echo '<li>' . $employe['service'] . '</li>';
    }

echo '</ul>';    


//---------------------------
echo '<h2> Table html </h2>';
//---------------------------

// on veut afficher dynamiquement le jeu de résultat sous forme de tableau HTML


$resultat = $pdo->query("SELECT * FROM employes"); //$resultat est un abjet PDOStatement qui est retourné par la méthode query. Il contient le jeu de résultats qui répresente tous les employés.
?>

<style>
    table, th, tr, td {
        border:1px solid purple;
    }

    table{
        border-collapse:collapse;
    }
</style>

<?php
echo '<table>';
    //Affichage de la ligne d'entête

    echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Prénom</th>';
        echo '<th>Nom</th>';
        echo '<th>Sexe</th>';
        echo '<th>Service</th>';
        echo '<th>Date d\'embauche</th>';
        echo '<th>salaire</th>';
    echo '</tr>';



    //Affichage des informations qui sont dans $resultat

while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){ // a chaque tout de boucle de while, fetch() va chercher la ligne suivante qui correspond à & employé et returne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir :
    echo '<tr>';

    foreach ($employe as $donnee){ // foreach parcourt les données de l'employe, et les affiche en colonne (dans les <td>)
        echo '<td>' . $donnee . '</td>';

    }
   echo '</tr>';
};    

echo '</table>';

//---------------------------
echo '<h2> Reqûetes préparées </h2>';
//---------------------------

//Les requêtes préparées sont préconisées si vous exécutez pls la meme requête et ainsi éviter de répéter le sigle complet analyse, interprétation, exécution réalisé par le SGBD (gain de performance).

// Les requêtes préparées sont aussi utilisées pour assainir les données (se prémunir des injections SQL) => chapitre ultérieur

$nom = 'Sennard';

// Une requête préparée se réalise en 3 étapes
#1 - on prépare la requête

$resultat = $pdo->prepare("SELECT *FROM employes WHERE nom = :nom"); // prepare() permet de préparer la requete mais ne l'exécute pas . :nom est un marqueur nominatif qui est vide et attend une valeur 

#2-On lie le marqueur à sa valeur

$resultat->bindParam(':nom', $nom); // bindParam() lie le marqueur :nom à la variable $nom. Remarque: cette méthode reçoit exclusivement une variable en second argument . on ne peut pas y mettre directement une valeur 

$resultat->bindValue(':nom', 'sennard'); // bindValue lie le marqueur :nom à la valeur 'sennard'. Contrairement à bindParam(), badValue() recoit au choix une valeur ou une variable.


#3 - On exécute la requete

$resultat ->execute(); // permet d'exécuter une requete préparée avec prepare()
debug($resultat);

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo $employe['prenom']. ' ' . $employe['nom']. ' '. 'du service' .' '.  $employe['service'];

/*
    valeurs de retour:
        prepare() retourne tjs un objet PDOStatement.
        execute() : - succès : true 
                    - echec: false 

*/

//---------------------------
echo '<h2> Reqûetes préparées: point complémentaires </h2>';
//---------------------------

        echo '<h3> Le marqueur sous forme de "?" </h3> ';
        // ---------------------------------------------------------------------

        $resultat = $pdo->prepare("SELECT * FROM employes WHERE nom= ? AND prenom= ?"); // On prépare la requête avec les parties variables représentées avec des marqueurs sous forme de "?"

        $resultat->bindValue(1,'Durand'); // 1 représente le premier "?"
        $resultat->bindValue(2, 'Damien');  // 2 représente le second "?"
        $resultat->execute();



// ou encore directement dans le execute()   
$resultat -> execute(array('Durand', 'Damien')); //ici durand remplace le 1er ? et damien le 2nd   


// MEMO-----------------------------------------------

// la flèche caractèrise les objets ->
// les [ ] caractèrisent les tableaux

debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'le service est '. $employe['service'] . '<br>';


//---------------------------
echo '<h3> Lier les marqueurs nominatifs à leur valeur directement dans execute() </h3> ';
        // ---------------------------------------------------------------------

$resultat = $pdo->prepare("SELECT *FROM employes WHERE nom = :nom AND prenom = :prenom");
$resultat->execute(array(':nom'=>'CHEVEL', ':prenom'=>'Daniel'));   // on associe chaque marqueur à sa valeur directement dans un tableau. Note: Nous ne sommes pas obligés de remettre les ":" devant les marqueurs dans ce tableau.

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo 'le service est '. $employe['service'] . '<br>';


//*************************fin****************************************** */