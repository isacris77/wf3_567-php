<?php


// --------------------------------------
// CAS PRATIQUE / FORMULAIRE POUR POSTER DES COMMENTAIRES
// FORMULAIRE avec un espace pour les commentaires des internautes
// Objectif: protègr la requête SQL dont les données viennent de l'internaute 

/* CREATION DE LA BDD
    nom de la BDD: dialogue
    nom de le table: commentaire
    champs/colonnes : id_commentaire INT PK AI
                        pseudo VARCHAR(50)
                        message TEXT
                        date_enregistrement DATETIME

*/    

// print_r($_POST);

// 2. Connexion à la BDD et traitement de $_POST:

   $pdo = new PDO('mysql:host=localhost;dbname=dialogue', // driver mysql, serveur de la BDD (host), nom de la BDD (dbname) Ã  changer
               'root', // pseudo de la BDD
               '',     // mdp de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option 1 : on affiche les erreurs SQL 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' )) ;

if(!empty($_POST)){ // si le formulaire a été envoyé


    //5. Traitement contre les failles XSS (javascript) et les failles CSS: on parle d'échapper les données.
    // Pour l'exemple on injecte ce css : <style>body{display:none;}</style>
    // pour s'en prémunir, nous faisons: 

    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
     $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES); // cette fonction prédéfinie convertit les caractères spéciaux ( <, >, & et les "") en entités HTML ( le < devient &lt, le > devient &gt, les guillements deviennent &quot.....). 


    //........................

    //Insertion en BDD : nous inserrons le message en BDD avec une requete qui n'est pas protégée contre les injections et qui n'acceptent pas les apostrophes :

    // $resultat = $pdo->query("INSERT INTO commentaire(pseudo, date_enregistrement, message) VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')"); // ici on insere directement dans la requete des données qui viennent d'un formulaire sans avoir pris de précaution


    // 4. Nous faisons l'injection SQL SUIVANTE '); DELETE FROM commentaire; #
    // cette injection a pour effet de vider la table

    // Pour s'en prémunir, nous faisons la requete préparée suivante(en commentant la requete précedente): 

    $resultat = $pdo->prepare("INSERT INTO commentaire(pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message) ");

    $resultat->execute(array(
        ':pseudo' => $_POST['pseudo'],
        ':message' => $_POST['message'],

    ));


    // Avec la requete préparée, on constate que l'injection SQL est neutralisée. Par ailleurs, on peut mettre des apostrophes dans le formulaire
    // COMMENT CA MARCHE? le fait d emettre des marqueurs dans la requete évite que les instructions SQL d'origine et injectées se concatènent. Ces instructions ne n'exécutent donc plus ensemble .En liant les marqueurs vides à leur valeur dans execute(), les instructions SQL injectées sont neutralisées par cette méthode qui les rend innoffensives. La BDD ne les exécute donc pas



}; // fin du if(!empty($_POST))



// 1. Le formulaire

?>
<h1>Votre message</h1>

<form action="" method="post">
        <div><label for="pseudo">Pseudo</label></div>
        <div><input type="text" name="pseudo" id="value" value="<?php echo $_POST['pseudo'] ?? '';  ?>"></div>

        <div><label for="message"></label></div>
        <div><textarea  name="message" id="message" cols="30" rows="10"></textarea><?php echo $_POST['message']?? '';    ?></div>

        <div><input type="submit" ></div>
</form>


<?php
// 3. Affichage des commentaires
$resultat=$pdo->query(" SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H-%i-%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC ");

//DATE_FORMAT en SQL permet de reformater une date et l'heure.

echo '<h2>' . $resultat->rowCount() . 'commentaires </h2>';

while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC) ) {
    echo '<div>Par '. $commentaire['pseudo'] . ' le '. $commentaire['datefr'] . ' à ' . $commentaire['heurefr']. '</div>';

    echo '<div>'. $commentaire['message'] . '</div><hr>';

}





