<?php


/* le fichier init sera inclus dans tous les scripts (hors INCLUSIONS).
Pour initialiser : 
- connexion à la BDD
- la création ou l'ouverture de la session
- la définition du chemin du site sur le serveur 
- l'inclusion du fichier functions.php

*/

// Connexion à la BDD
   $pdo = new PDO('mysql:host=localhost;dbname=site_commerce', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) Ã  changer
               'root', // pseudo de la BDD
               '',     // mdp de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option 1 : on affiche les erreurs SQL 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' )) ;


// création ou ouverture de sesion
session_start();


// chemin du site 

define('RACINE_SITE', '/PHP/08-SITE/'); // on indique ici les dossiers dans lesquels se situe le site à partir de localhost. cela permet de créer des chemins absolus à partir de localhost (caractérisés par le  / au début). Ils sont utilisés notamment dans header.php qui peut etre inclus dans des fichiers appartenant à des dossiers ou des sous-dossiers différents: par conséquent les chemins relatifs vers les sources changeraient , alors que les chemins absolus sont les mêmes

// variables d'affichage
$contenu ='';

// inclusions des fonctions
require_once 'functions.php';
