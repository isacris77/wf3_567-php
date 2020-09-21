<h1>Les commerciaux et leur salaire</h1>

<?php

// 1 - Dans une liste <ul><li> le prénom, le nom et le salaire des commerciaux (1 commercial par <li>). Pour cela, vous faites une requete préparée


// 2 - Affichez le nombre de commerciaux


# 1 CONNEXION A LA BDD

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) à changer
               'root', // pseudo de la BDD
               '',     // mdp de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option 1 : on affiche les erreurs SQL 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : on définit le jeu de caractères des échanges avec la BDD
               )
);

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

# 2  REQUETE

$service = 'commercial';
$resultat = $pdo->prepare("SELECT *FROM employes WHERE service =:service"); 
$resultat->bindParam(':service', $service);
$resultat->execute();
// debug($resultat);

echo '<ul>';

     while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){
        // debug($employe);
        echo '<li>'. $employe['prenom'] .' ' . $employe['nom'] . ' '. $employe['salaire']. 'euros</li>';
      }


echo '</ul>'; 
// Nombre de commerciaux
echo "nombres d'employes : " . $resultat->rowCount() . '<br>'; 




