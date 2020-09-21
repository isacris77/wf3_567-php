<?php

//Exercice
/*

ok   1- Seul l'administrteur doit avoir accès à cette page, les autres sont redirigés vers la page de connexion

2- Afficher tous les membres inscrits dans une table HTML avec toutes les infos du membres sauf son mot de passe. Vous ajouter une colonne action

3- Affichez le nombre de membres inscrits 

4- Dans la colonne actioin, ajoutez un lien "supprimer" pour supprimer un membre inscrit, sauf vous meme qui êtes connecté

5- Dans la colonne action, ajoutez un lien pour pouvoir modifier le statut des membres pour en faire un admin ou un membre, sauf vous meme qui êtes connecté



*/


require_once '../inc/init.php';

//-------------------------------------------------TRAITEMENT PHP--------------------------
// 1 - restriction d'accès aux administrateurs

if(!estAdmin())  { // si membre non admin ou non connecté, on le renvois vers connexion.php
    header('location:../connexion.php'); // attention au ../
    exit();

}



//-------------------------------------------------AFFICHAGE --------------------------
require_once '../inc/header.php';

$resultat = executeRequete("SELECT *FROM membre");
$contenu .= '<p>Nombres de produits dans la boutique: ' . $resultat->rowCount() . '</p>';

debug($membre);























require_once '../inc/footer.php';