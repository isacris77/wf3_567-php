<?php

require_once '../inc/init.php';
//-------------------------------------------------TRAITEMENT PHP--------------------------
// 1 - restriction d'accès aux administrateurs

if(!estAdmin())  { // si membre non admin ou non connecté, on le renvois vers connexion.php
    header('location:../connexion.php'); // attention au ../
    exit();

}

// 4 - ENREGISTREMENT DU PRODUIT EN BDD
debug($_POST);

if(!empty($_POST)) { // si le formulaire a été envoyé !

    // ici il faudrait mettre tous les controles sur le formulaire autrement dit 11 champs donc 11 controles

    $photo_bdd=''; // par défaut la photo en bdd est vide 

    // 9 - suite : modification de la photo:

        if(isset($_POST['photo_actuelle'])){ // si existe photo_actuelle dans $_POST C'est que nosu sommes en train de modifier le produit avec sa photo . on remet l'URL de la photo en bdd:

            $photo_bdd= $_POST['photo_actuelle'];

        }








 // 5 - suite : traitement de la photo
//  debug($_FILES); // $_FILESest une superglobale qui représente l'input type"file" d'un formulaire. l'indice photo correspond à l'attribut name de l'input. les autres indices du sous tableau sont prédéfinis.: "name" pour nom du fichier , "type"//our type du fichie( image ); tmp_name pour l'adresse du cfichier temporaire en cours d'upload , error pour le code erreur de téléchargement, "size" pour la taille de du fichier uploadé


 if(!empty($_FILES['photo']['name'])) {  // si un fichier est encours d'upload 
    $fichier_photo = $_FILES['photo']['name']; // nom de la photo
    $photo_bdd = 'photo/'. $fichier_photo; // chemin relatif de la photo qui est enregistré en bdd et qui nous servira pour l'attribut "src " des balises images ( les photos sont copiées dans le dossier "photo" ligne suivante )

    copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // cette fonction prédéfinie enregistre le fichier qui est temporairement à l'adresse tmp_name vers le répertoire dont le chemin est .../photo/fichier_photo.jpg

 }
    // insertion en BDD: 
    $requete= executeRequete("REPLACE INTO produit VALUE(:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", array(

    ':id_produit'    => $_POST['id_produit'],
    ':reference'     => $_POST['reference'],
    ':categorie'     => $_POST['categorie'],
    ':titre'         => $_POST['titre'],
    ':description'   => $_POST['description'],
    ':couleur'       => $_POST['couleur'],
    ':taille'        => $_POST['taille'],
    ':public'        => $_POST['public'],
    ':photo'         => $photo_bdd,
    ':prix'          => $_POST['prix'],
    ':stock'         => $_POST['stock'],
    
)); // REPLACE INTO fait un insert quand l'ID donné n'exite pas (0).Il se comporte comme un update qund l'ID donné existe

if ($requete) { // si execute requete a retourné un objet PDOStatement, donc implicitement evalué à true, alors c'est que la requete a marché 
    $contenu .= ' <div class ="alert alert-success">Le produit a été enregistré.</div>';

} else { // sinon dans le cas contraire, executerequete nous a retourné false

     $contenu .= ' <div class ="alert alert-danger">Erreur lors de l\'enregistrement </div>';

}


} // fin du if(!empty($_POST))


//8 - remplissage du formulaire de modification
//debug($_GET);

if(isset($_GET['id_produit'])) { // si "id_produit" est dans l'URL c'est que nous avons demandé la modification du produit: on sélectionne les infos du produit pour l'afficher dans le formulaire

    $resultat = executeRequete(" SELECT * FROM produit WHERE id_produit= :id_produit ", array(':id_produit' => $_GET['id_produit']));

        $produit= $resultat->fetch(PDO::FETCH_ASSOC); // on fetch le produit sans boucle while car il y a qu'un seul par identifiant.

        // debug($produit);


}



//-------------------------------------------------AFFICHAGE --------------------------
require_once '../inc/header.php';
// 2 - liens de navigation

?>
<h1 class="mt-4">Gestion Boutique</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link ">Affichage des produits</a></li>
    <li><a href="formulaire_boutique.php" class="nav-link active">Formulaire produit</a></li>
</ul>

<?php

echo $contenu;

// 3 - Formulaire d'ajout ou de modification de produit
?>
<form action="" method="post" enctype="multipart/form-data"> <!-- l'attribut enctype spécifie que le formulaire envoie des données binaires (fichier) et du texte (champs de formulaire): permet d'uploader une photo -->


    <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit']?? 0;   ?>"> <!-- ce champ est necessaire pour la modification ou la création d'un produit car on a besoin de l'ID pour la requete SQL . Nous mettons 0 par défaut en value pour que le REPLACE se comporte comme un INSERT et insère le produit en BDD. type "hidden" pour cacher le champ ou nous mettons l'ID du produit existant pour que le replace se comporte comme un UPDATE.-->
    <div><label for="reference">Référence</label></div>
    <div> <input type="text" name="reference" id="reference" value="<?php echo $produit['reference'] ?? '';   ?>"></div>

    <div><label for="categorie">Catégorie</label></div>
    <div> <input type="text" name="categorie" id="categorie" value="<?php echo $produit['categorie'] ?? '';   ?>"></div>

    <div><label for="titre">Titre</label></div>
    <div> <input type="text" name="titre" id="titre" value="<?php echo $produit['titre']?? '';   ?>"></div>

    <div><label for="description">Description</label></div>
    <div> <textarea name="description" id="description" cols="30" row="10"><?php echo $produit['description']?? '';   ?></textarea></div>

    <div><label for="couleur">Couleur</label></div>
    <div> <input type="text" name="couleur" id="couleur" value="<?php echo $produit['couleur']?? '';   ?>"></div>

    <div><label for="taille" >Taille</label></div>
    <div>
        <select name="taille" id="taille">
            <option value="S" <?php  if(isset($produit['taille'])  && $produit['taille'] =='S') echo 'selected' ?>>S</option>
            <option value="M"<?php  if(isset($produit['taille'])  && $produit['taille'] =='M') echo 'selected' ?>>M</option>
            <option value="L"<?php  if(isset($produit['taille'])  && $produit['taille'] =='L') echo 'selected' ?>>L</option>
            <option value="XL"<?php  if(isset($produit['taille'])  && $produit['taille'] =='XL') echo 'selected' ?>>XL</option>
        </select>    
    </div>

    <div><label for="public" >Public</label></div>
    <div>
        <input type="radio" name="public" value="m" checked>Masculin
        <input type="radio" name="public" value="f"<?php  if(isset($produit['public'])  && $produit['public'] =='f') echo 'checked' ?> >Féminin
    </div>

     <div><label for="photo" >Photo</label></div>
     <!-- 5 - Upload de photos -->
    <input type="file" name="photo" id="photo" ><!-- on n'oublie pas l'attribut enctype="multipart/form-data sur la balise form  -->

    <!-- 9 - modification de la photo -->
    <?php
    
    if(isset($produit['photo'])) { // si nous sommes en train de modifier le produit, nous affichons la photo actuellement en BDD: 
        echo '<p>Photo actuelle du produit</p>';
        echo '<img src= "../'.$produit['photo'].'"  style="width: 90px">';
        echo '<input type= "hidden" name="photo_actuelle" value="'.$produit['photo'] .'" >';


    }
    ?>

    <div><label for="prix">Prix</label></div>
    <div> <input type="text" name="prix" id="prix" value="<?php echo $produit['prix']?? '';   ?>"></div>

    <div><label for="stock">Stock</label></div>
    <div> <input type="text" name="stock" id="stock" value="<?php echo $produit['stock']?? '';   ?>"></div>

    <hr>

    <div><input type="submit" value="enregistrer" class="btn btn-info"></div>

      




</form>







<?php

require_once '../inc/footer.php';