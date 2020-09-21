<?php

//MEMO

// 1- Connexion à la BDD
// 2- Requete SQL
// 3- fetch + while, ou fetchall + foreach
// 4- Affichage 





//APACHE pour interpréter un fichier 

//  Quelle est la bonne syntaxe pour concaténer la variable $a et la variable $b dans la variable $c ?
$a = 'Bonjour '; 
$b = 'tout le monde'; 
// $c = ?
$c = $a . $b;


//définir une variable dont le contenu est une chaine de caractères
$montexte = 'bonjour!';

// effectuer un affichage dans PHP
echo ( string $arg1 [, string $... ]): void

//stoppe le script PHP de manière brutale en envoyant un message ?
die('Message à afficher');

//Quelle est le type de la superglobale $_GET ?
array


// A partir de ce script, quel est le bon code pour afficher "cerise" ?
$rayon['legumes'] = array('courgette','aubergine','concombre');
$rayon['fruits'] = array('banane','orange','cerise');
echo $rayon['fruits'][2];

// instructions pour boucle
for ($i=0; $i < ; $i++) { 
    # code...
}

while ($a <= 10) {
    # code...
}

foreach ($variable as $key => $value) {
    # code...
}

//Quelle fonction permet de vérifier qu'une variable est définie (même si elle est vide) ?
isset()

//Comment appelle-t-on le type de données représentant le nombre de secondes écoulées depuis le 1er Janvier 1970 ?
timestamp

//Quelle est la bonne syntaxe pour envoyer la variable message à la superglobale $_GET au serveur ?
# https://monsite.com/contact.php?message=bonjour

//Quelle superglobale récupére les données d'un formulaire ?
$_POST

//. Quand je déclare : 
$database = new PDO(...);
# qu'est ce que $database ?
# un objet symbolisant ma connexion à ma base SQL

// Quel est le bon code pour lister tous les titres des livres de ma bibliothèque ?
$livres = $database->query("SELECT titre FROM livres");

while ($livre = $livres->fetch(PDO::FETCH_ASSOC))
{
echo $livre['titre'];
}

//Après une requête de selection, comment compter le nombre de lignes renvoyées ?
$result->rowCount()

//A partir du script suivant, indiquer les 3 valeurs renvoyées :
function calculSoldes($prix, $reduc = 20)
{
$prix_solde = $prix * ( (100-$reduc) / 100 );
return $prix_solde;
}
echo calculSoldes(100);
echo calculSoldes(100,25);
echo calculSolde(100,50);

80 / 75 / Erreur