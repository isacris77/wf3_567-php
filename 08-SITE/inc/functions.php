<?php
//FONCTIONS DU SITE 


function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}


//-----------
// fonction qui indique si l'internaute est connecté

function estConnecte(){
    if (isset($_SESSION['membre'])){ // si membre existe dans la session c'est que l'internaute est passé par la page de connexion avec les bons pseudos et mdp


        return true; // il est connecté

    }   else{
            return false; // il n'est pas connecté
    }

}


//fonction qui indique si le membre connecté est administrateur 

function estadmin(){ // si le membre est connecté alors on regarde son statut dans la session. S'il vaut 1 alors il est bien admin. 
    if (estconnecte() && $_SESSION['membre']['statut'] == 1 ){
        return true; // le membre est admin connecté
    } else{
        return false; // il ne l'est pas 
    }
}


//----------
// fonction qui exécute les requetes

function executeRequete($requete, $param = array()){ // le parametre $requete recoit une requete SQL. le paramètre $param  recoit un tableau avec les marqueurs associés à leur valeur. Dans le cas où ce tableau n'est pas fourni, $param prend un array() vide par défaut.

    // Echappement des données avec htmlspecialchars():
    foreach ($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars($valeur); // on prend la valeur de $param que l'on passe dans htmlspecialchars() pour transformer les chevrons en entités HTML qui neutralisent les balises <style> et <script> éventuellement injectées dans le formulaire. Evite les risques XSS et CSS. Puis on range cette valeur échapée dans son emplacement d'origine qui est $param[$indice].
    }

    global $pdo; // permet d'accèder à la variable $pdo qui est déclarée dans init.php autrement dit dans l'espace global ( nous sommes ici dans un espace local). 

    $resultat = $pdo->prepare($requete); // on prepare la requete reçue dans $requete
    $succes = $resultat->execute($param); // puis on l'execute en lui donnant le tableau qui associe les marqueurs à leur valeur 

    // var_dump($succes); //execute() renvoie tjs un booléen : true quand la requete a marché, sinon false 
    
    if($succes){ // si $succes contient true (la requete a marché), je retourne alors $resultat avec le jeu qui contient le jeu de résultat du SELECT (object PDOStatement)

        return $resultat;

    } else {
        return false; // si erreur sur la requete , on retourne false
    }
}


// -------------------
//fonction qui calcule le TOTAL du panier

function montantTotal(){

    $total =0;

    for ($i=0; $i <  count($_SESSION['panier']['id_produit']); $i++) { 
       $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on mutiplie la quantité par le prix à chaque tour de boucle que l'on ajoute dans $total avec l'opérateur  += pour le pas écraser la dernière valeur
    }
        return $total;
}