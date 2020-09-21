<style>

    body{
        margin-bottom: 400px;
    }

   h2{
      border-top: 1px solid navy;
      border-bottom: 1px solid navy;
      color:navy
   }
   table{
       border-collapse: collapse;
   }
  td{
       border: 1px solid #333;
       color: blue;
       padding: 2px;
   }
</style>


<?php 

// ***************************
echo '<h2> Les balises PHP </h2>';
// ***************************

?>

<?php
// pour ouvrir un passge en PHP on utilise la balise ligne 19
// pour fermer on utilise la balise suivante:
?>

<p>Ici je suis en HTML</p> 
<!-- en dehors des balises d'ouverture et de fermeture de PHP, nous pouvons écrire du HTML quand on est dans un fichier ayant une extension PHP -->

<?php
// vous n'êtes pas obligé de fermer un passage PHP en fin de script

// pour faire un commentaire
# pour faire un commentaire
/*
     pour faire des commentaires
    sur plusieurs ligne
*/

// ***************************
echo '<h2> Affichage </h2>';
// ***************************

echo 'Bonjour <br>'; # echo permet d'effectuer un affichage dans le navigateur. Nous pouvons y mettre une balise HTML sous forme de STRING (chaine de caractères). Notez que toutes les instructions se terminent par un ";". 
print 'Nous sommes jeudi <br>'; # autre instruction d'affichage dans le navigateur. 

// Autres instructions d'affichage que nous verrons plus loin:
print_r('code'); 
echo '<br>';
var_dump('code');

// ***************************
echo '<h2> Variables </h2>';
// ***************************
// Une variable est un espace mémoire qui porte un nom et qui permet de conserver une valeur.
// en PHP on représente une variable avec le signe $ 

$a = 127; # on déclare la variable a et on lui affecte la valeur 127. 
echo gettype($a); // gettype() est une fonction prédéfinie qui permet de voir le type d'une variable. Ici il s'agit d'un INTEGER (entier). 
echo '<br>';

$a = 1.5;
echo gettype($a); // ici nous avons un double = float (nombre à virgule)
echo '<br>';

$a = 'chaine de caractères';
echo gettype($a); // ici nous avons un STRING
echo '<br>';
$a = '127'; // un nombre écrit dans des quotes ou des guillements est interprété comme un string.

$a = true; // ou false
echo gettype($a); // ici nous avons un boolean (booléen)
echo '<br>';

// par convention un nom de variable commence par une minuscule, puis on met une majuscule à chaque mot(Camel Case). il peut contenir des chiffres (jamais au début) ou un _ (pas au début ni à la fin). ex: $maVariable1 ou $ma_variable1

// ***************************
echo '<h2> Guillemets et quotes </h2>';
// ***************************
$message = "Aujourd'hui"; // ou bien:
$message = 'aujourd\'hui'; // on échappe l'apostrophe dans les cotes simples

$prenom = 'John'; 
echo "Bonjour $prenom <br>"; // quand on écrit une variable dans les guillemets, elle est évaluée et son contenu est affiché: ici "john"

echo 'Bonjour $prenom <br>'; // dans les cotes simples, tout est du texte brut: c'est le nom de la variable qui est affiché. 

// ***************************
echo '<h2> Concaténation </h2>';
// ***************************
//  En PHP on concatène les élements avec le point '.'

$x = 'Bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>'; # Concaténation de variables et d'un string. On peut traduire le point de concaténation par "suivi de...". 


// ----------
// Concaténation lors de l'affectation avec l'opérateur .=

$message = '<p>Erreur sur le champs email</p>';
$message .= '<p>Erreur sur le champs téléphone</p>'; # avec l'opérateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur précédente dans la variable $message
echo $message; # on affiche donc deux messages.



// ***************************
echo '<h2> Constante </h2>';
// ***************************
// Une constante permet de conserver une valeur sauf que celle-ci ne peut pas changer. 
// cad qu'on ne pourra pas la modifier durant l'exécution du script. Utile pour conserver par ex les paramètres de connexion à la BDD.

define('CAPITALE_FRANCE', 'Paris'); // définit la constante appelé CAPITALE_FRANCE à laquelle on donne la valeur Paris. Par convention le nom des constantes et tjs en MAJUSCULES
echo CAPITALE_FRANCE. '<br>'; // affiche Paris


// autre façon de déclarer une constante:
const TAUX_CONVERSION = 6.55957; # définit la constante TAUX_CONVERSION à laquelle on donne la valeur 6.55957
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957

// Quelques contantes Magiques
echo  __DIR__ .'<br>'; // contient le chemin complet vers notre dossier
echo __FILE__ .'<br>'; //contient le chemin complet vers le fichier du dossier


//**********************exercices*************************** */

// Afficher bleu-blanc-rouge en mettant le texte de chaque de chaque couleur dans une variable
$bleu = 'Bleu';
$blanc = 'Blanc';
$rouge = 'Rouge'; 

echo $bleu.'-'.$blanc.'-'.$rouge. '<br>';
# ou 
echo "$bleu-$blanc-$rouge <br>";
# ou 

$couleurs = 'Bleu-';
$couleurs .= 'Blanc-';
$couleurs .= 'Rouge';
echo $couleurs;


//************************************************* */


// ***************************
echo '<h2> Operateurs arithmétiques </h2>';
// ***************************

$a = 10;
$b = 2;

echo $a + $b.'<br>'; // affiche 12
echo $a - $b. '<br>'; // affiche 8
echo $a * $b. '<br>'; // affiche 20
echo $a / $b. '<br>'; // affiche 5
echo $a % $b. '<br>'; // modulo. affiche 0 . modulo = reste de la division entière. ex: 3%2=1 car on a 3 billes on les répartit sur 2 joueurs. chacun en a une, il en reste donc 1

// les opérateurs arithmètiques combinés:

$a += $b; // équivaut à $a = $a + $b soit $a vaut donc à la fin 12.
echo $a.'<br>';

$a -= $b; // équivaut à $a = $a - $b soit $a= 12 - 2. donc 10.
$a *= $b; // équivaut à $a = $a * $b soit $a = 20
$a /= $b; // équivaut à $a = $a / $b soit $a = 10
$a %= $b; // équivaut à $a = $a % $b soit $a = 0

// on utilisera le += et le -= dans les paniers d'achats

// Incrémenter et décrémenter: 

$i = 0;

$i++; // incrémentation de $i par ajout de 1 : $i vaut donc à la fin 1;
$i--; // décrémentation de $i par soustraction de 1: $i vaut donc à la fin 0


// ***************************
echo '<h2> Structures conditionnelles </h2>';
// ***************************

$a = 10;
$b = 5;
$c = 2;

// if....else :

    if($a > $b) // si la condition est vraie, c'est a dire $a est bien supérieur à $b alors on entre dans les accolades qui suivent 
    {
        echo '$a est supérieur à $b <br>';
    } else { // sinon on exécute le Else
        echo 'non, c\'est $b qui est supérieur ou égal à $a <br>';
    }

//--------L'opérateur AND qui s'écrit && :

if($a > $b && $b > $c){  // si $a > $b et dans le meme temps $b > $c alors on entre dans les accollades. 
    echo 'Vrai pour les deux conditions <br>';

} 
// true && true => true 
//  false && false => false 
//  true && false => false 



// -------- l'operateur OR qui s'écrit || :

$a = 10;
$b = 5;
$c = 2;

if ($a == 9 || $b > $c ){  // si $a == (est égal) à 9 ou alors si $b > $c dans ce cas on entre dans les accolades qui suivent
    echo 'vrai pour au moins une des deux conditions <br>';

} else {
    echo 'Les deux conditions sont fausses <br>';
}
// true || true => true 
//  false || false => false 
//  true || false => true 

// ----------
// if ... elseif... else :

$a = 10;
$b = 5;
$c = 2;

if($a ==8){ # si $a est égal à 8
    echo 'réponse 1 : $a est égal à 8';
} elseif ($a != 10){ # sinon si $a est différent de 10
    echo 'réponse 2: $a est différent de 10'; 
} else { # si je n'entre pas dans le if ou dans le elseif, alors j'arrive dans le else 
    echo 'reponse 3 : $a est égal à 10 <br>';
}

//  note : le else n'est pas obligatoire ( on ne le met pas quand on en a pas besoin)
//  else n'est JAMAIS suivi d'une condition

// -----------
// l'opérateur XOR pour OU EXCLUSIF:

$question1 = 'mineur'; 
$question2 = 'je vote'; # exemple d'un questionnaire

//  les réponses de l'internaute n'étant pas cohérentes, on lui met un message :

if($question1 == 'mineur' XOR $question2 == 'je vote'){ // XOR = OU exclusif ; Seulement une des deux conditionsdoit etre valide pour entrer dans le if. si nous avons TRUE XOR TRUE cela est false il ne peux pas etre mineur ET voter
    echo 'vos réponses sont cohérentes <br>';

} else {
    echo 'les réponses ne sont pas cohérentes <br>';
}

//------------------
//  Forme dite ternaire de la condition (autre syntaxe du if)/

echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';
//  le ? remplace if et le : remplace else. on affiche le premier string si la condition est vraie, sinon le second. 


// ***************************
//  comparaison == ou ===

$varA = 1; # INTEGER
$varB = '1'; # string

if( $varA == $varB){ // avec le double == on compare uniquement la valeur 
    echo '$varA est égal à $varB en valeur <br>';
}

if( $varA === $varB){ // avec le triple === on compare la valeur ET le type
    echo 'les deux variables sont égales en valeur ET en type <br>';
} else {
    echo 'les deux variables sont différentes en valeur OU en type <br>';
}

// Rappel : le simple = est le signe d'affectation

//-------
//isset() et empty(): 
// empty() : vérifie si la variable est vide, cad 0, '', NULL, false ou non défini
// isset(): vérifie si la variable existe et a une valeur non NULL. 


$var1 = 0;
$var2 = '';

if(empty($var1)) echo '$var1 contient 0, string vide, NULL, flase ou non définie <br>'; // VRAI la variable contient 0

if (isset($var2)) echo 'la variable existe et est non NULL <br>'; // VRAI car la variable exite bien et ne contient pas NULL

// Contexte :
// empty pour vérifier les chamos de formulaire . isset pour vérifier l'existence d'un indice dans un tableau avant d'y accéder 

// -------
// L'opérateur NOT qui s'écrit "!"

$var3 = 'quelque chose';
if (!empty($var3)){ // le  ! correspond à une négation : il intervertit le sens du bolléen : !not true devient false et !false devient true. ici cela signifie que $var3 n'est pas vide
    echo 'la variable n\'est pas vide <br>'; 
}

//------
// l'opérateur ?? appelé " NULL coalescent " (PHP7)/

echo $variable_inconue ?? 'valeur par défaut <br>';

// ***************************
echo '<h2> switch </h2>';
// ***************************

// la condition switch est une autre syntaxe pour ecrire un if , elseif , else quand on veut comparer une variable à une multitude de valeur 

$langue = 'Chinois';
switch ($langue) {
    case 'français':  // on compare $langue à la valeur des "case" et exécute le code qui suit si elle correspond: 
        echo 'bonjour !';
    break; // obligatoire pour quitter le switch une fois un "case" exécuté

    case 'italien':
        echo 'Buongiorno !';
    break;

    case 'espagnol';
        echo 'Hola!';
    break;     
    
    default: // cas par défault qui est exécuté si on entre PAS dans l'un des case 
        echo 'Hello ! <br>';
    break;
}


// Exercice : vous récrivez ce switch sous forme de conditions If ...  pour obtenir le même résulat

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol') {
    echo 'Hola !';
} else {
    echo 'Hello ! <br>';
}



//-------------------------------------------------------
                 echo '<h2> Fonctions utilisateurs </h2>';
                 //------------------------------------------------------------
                // Une fonction est un morceau de code encapsulé dans des accolades  qui porte un nom. On appelle cette fonction au besoin pour exécuter le code qui s y trouve. Le fait de définir des fonctions pour ne pas se répéter s 'apelle "factoriser son code"
                // On definit puis on exécute une fonction :
                function separation() {// declaration d une fonction prevu pour ne pas recevoir d argument
                    echo '<hr>';
                }
                separation() ; // on apel notre fonction par son nom suivi d une paire de ()
                //----------------
                // Fonction avec PARAMETRES et RETURN :
                function bonjour( $prenom, $nom){ // $prenom et $nom sont des paramétres de la fonction. Ils permettent de recevoir une valeur car il s agit de variables de reception.
                    return 'Bonjour ' . $prenom . ' ' . $nom . '! <br>'; // return renvoie la chaine de caractéres "Bonjour..." à l endroit ou la fonction est appelée.
                    echo 'Cette ligne se sera pas exécutée car apres un RETURN on quitte la fonction ';
                }
                 echo bonjour('John', 'Doe'); // si la fonction attend des valeurs, il faut les lui envoyer dans le meme ordre que les parametres de reception. Les valeurs envoyes s appellent "arguments". Quand on souhaite afficher le resultat et qu il n y a pas de echo dans la fonction il faut le faire en meme temps que l apel de la fonction .
                 //----------------------------
                 $prenom = 'Pierre';
                 $nom = 'Quiroule';
                 echo bonjour($prenom , $nom); // On peut mettre des variables à la place des valeurs dans l appel d une fonction ( exemple : quand on voudra récupérer les valeurs d un formulaire).
                 // EXERCICE :
                 // Ecrivez la fonction factureEssence() qui calcule le cout total de votre facture en fonction du nombre de litres d essence que vous indiquez lors de l appel de la fonction. Cette fonction retourne la phrase "Votre facture est de x euros pour Y litres d essence." ou x et Y sont des variables. Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d essence. Vous l utiliserez donc pour calculer le total de la facture.
                 function prixLitre() {
                      return 3;
                 }
                 function facture_essence ($litres){
                     $prix = $litres * prixLitre();
                     return 'Votre facture est de ' . $prix . ' euros pour ' .    $litres .'litres d essence.';
                 }
                 $litres = '5 ';
                 echo facture_essence ($litres). '<br>';






//----------
// En PHP7 on peut préciser le type des valeurs entrantes dans  une fonction : 
function identite(string $nom, int$age){ // array, bool, float, int, string
    
    echo gettype($nom) . '<br>';
    echo gettype($age) . '<br>';
    echo $nom . ' a '. $age . ' ans <br>';
}

identite('Asterix', 60); // le type attendu est respecté, il n'y a pas d'erreur

identite('Asterix', '60'); // ici il n'y a pas de message d'erreur, cependant, le string '60' a été casté en integer (note :  si nous etions en mode strict, il y aurait une erreur)

// identite('Asterix', 'soixante'); FATAL ERROR car on passe un string qui ne peut etre transformé en integer. on commente donc la ligne pour poursuivre.

//----------
// En PHP7 on peut préciser le type des valeurs de retour que doit sortir la une fonction :
function adulte(int $age) : bool {
    if ($age>= 18){
        return true; 
    } else {
        return false; 
    }
}

var_dump(adulte(7)); // ici la fonction nous retourne bien un booléen, il n'y a donc pas d'erreur. nous faison un var_dump car il permet d'afficher le false que retourne la fonction "echo false" n'affichant rien.

//---------
// Variable locale et variable globale : 

// de l'espace local vers l'espace global : 
function jourSemaine(){

    $jour = 'vendredi'; // variable locale
    return $jour;
}

// echo $jour;  // ne fonctionne pas car cette variable n'est connu qu'a l'intérieur de la fonction
echo  '<br>' . jourSemaine() . '<br>'; // on affiche ce que nous retourne la fonction grâce à son return

// de l'espace global vers l'espace local : 
$pays = 'France'; // variable globale

function affichePays(){
    global $pays; // le mot cle global permet de récupérer une variable globale au sein de l'espace local de la fonction. on peut donc l'afficher :
    echo $pays;
}
affichePays();

// ***************************
echo '<h2> Structures itératives : les boucles </h2>';
// ***************************

// Les boucles sont destinées à repéter des lignes de code de façon automatique


//---- Boucle WHILE :

$i = 0; # on initialise à 0  une variable qui sert de compteur

while($i < 3) { # tant que $i est inférieur à 3 nous entrons dans la boucle
    echo $i . '<br>';
    $i++; // on incrémente $i à chaque tour de boucle jusqu'a 3. sans cela , la boucle serait infinie car 0 est tjs inférieur à 3.
}
echo '<br>'; 
echo '<br>'; 

// Exercice : à l'aide d'une boucle while, afficher un selecteur avec les années depuis 1920 jusqu'a 2020.
// rappel : 
echo '<select>';
    echo '<option>valeur 1</option>';
    echo '<option>valeur 2</option>';
    echo '<option>valeur..</option>';

echo '</select>' . '<br>';
echo '<br>'; 

echo '<select>';
$i = 1920;
while($i < 2021){
    echo '<option>' . $i . '</option>' . '<br>';
    $i++;
}
echo '</select>';
echo '<br>'; 
echo '<br>'; 

echo '<select>';
$i = 1920;
while($i <= date('Y')){ // avec date('y') cela se mettra directement à jour en 2021
    echo '<option>' . $i . '</option>' . '<br>';
    $i++;
}
echo '</select>';
echo '<br>'; 
echo '<br>'; 


//------------------
// La boucle do while :
// la boucle do while a la particularité de s'exécuter au moins une fois, puis tant que la condition de fin est vrai.

$j = 0;

do{
    echo 'Je fais un tour';
    $j++;

} while ($j > 10); // la condition est fausse et pourtant la boucle a tourné une fois

echo '<br>'; 
echo '<br>'; 

//-------
// La boucle for : 
// La boucle for est une autre syntaxe de la boucle while

for($i = 0; $i < 3; $i++){ # nous trouvons dans les () de for : la valeur de départ; la condition d'entrée dans la boucle; la variation de $i
    echo $i . '<br>';
}

echo '<br>'; 
echo '<br>'; 

for($i = 0; $i < 3; $i+=2){ # nous trouvons dans les () de for : la valeur de départ; la condition d'entrée dans la boucle; la variation de $i
    echo $i . '<br>';
}
echo '<br>';


// Exercice : afficher les mois de 1 à 12  dans un selecteur à l'aide d'une boucle for

echo '<select>';
for ($mois= 1; $mois <= 12 ; $mois++) { 
    echo '<option>'. $mois . '</option>'; 
}
echo '</select>';
echo '<br>';
echo '<br>';
//--------
# Il existe aussi la boucle foreach que nous verrons un peu plus loin. elle sert à parcourir les tableaux ou les objets.

//---------
# Exercice : faites une boucle for qui affiche 0 à 9 dans une table HTML sur une seul ligne. Vous faites du CSS dans la balise <style> du début pour mettre une bordure sur ce tableau


echo '<table>'; 
    echo '<tr>';

        for ($chiffre=0; $chiffre < 10 ; $chiffre++) { 
            echo '<td>' . $chiffre . '</td>';
          
        }
    echo '<tr>';
echo '</table>'; 
echo '<hr>';


// --------
// Exercice : Faites une boucle qui affiche de 0 à 9 sur la même ligne, cette ligne se répétant 10 fois, le tout dans une table HTML

echo '<table>'; 

    for($ligne = 0; $ligne < 10; $ligne++)  { # ici on repete les lignes
        echo '<tr>';

            for ($chiffre=0; $chiffre < 10 ; $chiffre++) { // ici on fait les colonnes
                echo '<td>' . $chiffre . '</td>';
            }
        echo '<tr>';
    } 

echo '</table>'; 

// ***************************
echo '<h2> Quelques fonctions prédéfinies </h2>';
// ***************************

// une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP


// strlen
$phrase = 'mettez une phrase ici';
echo strlen($phrase) . '<br>';  // affiche le nombre d'octets occupés par ce string, 1 caractère accentué comptant pour 2, les autres pour 1.

// substr
$texte = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi ab magnam rem debitis, maiores suscipit non odit sint, veniam recusandae nihil magni fugiat. Similique maiores exercitationem ab ex adipisci. Suscipit!';
echo substr($texte, 0, 20) . '...<a href="">lire la suite</a>'; // coupe le texte de la position 0 et sur 20 caractères. 

echo '<br>';

//strtolower, strtoupper, trim: 

$message = '    Hello World !          ';
echo strtolower ($message) . '<br>';  // affiche hello world en minuscules

echo '<hr>';
echo strtoupper($message) . '<br>'; // affiche tout en majuscules

echo strlen($message) . '<br>'; // on compte la longueur y compris des espaces
echo strlen(trim($message)) . '<br>'; // trim() supprimes les espaces au début et à la fin de la chaine de caractères. Puis ici on compte le résultat sans les espaces

// La documentation PHP en ligne :
// https://www.php.net LA BIBLE DU PHP


// ***************************
echo '<h2> Tableaux (arrays) </h2>';
// ***************************
// Un tableau ou encore ARRAY en anglais est déclaré comme une variable amélioré dans laquelle on stocke une multitude de valaurs . ces valeurs peuvent etre de n'importe quel type et possède un indice par défaut dont la numérotation commence à 0.
// UTILISATION: souvent on récupére des informations de la BDD, nous retrouvons sous forme de tableau

// déclarer un tableau (méthode 1)
$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges');

echo gettype($liste). '<br>'; // type array

// echo $liste; erreur de type "array to string conversion" car on ne peux pas afficher directement un tableau


echo 'var_dump et print_r';
echo '<br>';

echo '<pre>';
var_dump($liste); // affiche le contenu du tableau avec le type des valaurs 

echo '<pre>';
print_r($liste); // affiche le contenu du tableau sans le type des valeurs
echo '</pre>'; // la balise <pre> permet de formater l'affichage du print_r ou du var_dump

// Déclaration de notre fonction d'affichage : 
function debug($var){
        echo '<pre>';
            print_r($var);
        echo'</pre>';    
}

echo debug($liste);

//Autre méthode pour déclarer un tableau (methode 2):

$tab =['France', 'Italie', 'Espagne', 'Portugal']; 
debug($tab);

echo $tab[1] . '<br>'; 


// Autre méthode pour déclarer un tableau (méthode 2): 
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];
debug($tab);

echo $tab[1] . '<br>';  // pour afficher "Italie", on écrit le nom du tableau $tab suivi de l'indice de "Italie" écrit entre []

//------
// Ajouter une valeur à la fin de notre tableau $tab :
$tab[] = 'Suisse';  // les [] vides permettent d'ajouter une valeur à la fin du tableau
debug($tab); 

//------
// Tableau associatif :
// Dans un tableau associatif, on peut choisr les indices.
$couleur = array(
    'j' => 'jaune',
    'b' => 'bleu',
    'v' => 'vert'
);

// pour afficher un élément du tableau associatif :
echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // affiche "bleu"
echo "La seconde couleur est le $couleur[b] <br>";  // un tableau associatif écrit dans des guillemets perd les quotes autour de son indice

//------
// Mesurer le nombre d'éléments dans un tableau :
echo 'Taille du tableau :' . count($couleur) . '<br>';  // compte le nombre d'éléments dans le tableau, ici 3.
echo 'Taille du tableau :' . sizeof($couleur) . '<br>'; // sizeof() fait la même chose que count() dont il est un alias.



//----------------------------------
echo '<h2> Boucle foreach </h2>';
//----------------------------------
// foreach est un moyen simple de parcourir un tableau de façon automatique. Cette boucle fonctionne uniquement sur les talbeaux et les objets. Elle retourne une erreur si vous l'utiliser sur une variable d'un autre type ou non initialisée.

debug($tab);

foreach ($tab as $pays) { // la variable $pays vient parcourir la colonne des valeurs : elle prend chaque valeur successivement à chaque tour de boucle. Le mot "as" est obligatoire et fait partie de la syntaxe.
    echo $pays . '<br>'; // affiche successivement les valeurs du tableau
}

foreach ($tab as $indice => $pays) {  // quand il y a deux variables, celle qui est à gauche de la => parcourt la colonne des indices, et celle de de droite parcourt la colonne des valeurs.
    echo $indice . ' correspond à ' . $pays . '<br>';
}

//------
// Exercice : 
// - Ecrivez un tableau associatif avec les INDICES prenom, nom, email et telephone, auxquels vous associez des valeurs pour 1 contact.
// - Puis avec une boucle foreach, affichez les valeurs dans des <p>, sauf le prénom qui doit être dans un <h3>.

$contact = array(
    'prenom'    => 'Pierre',
    'nom'       => 'Name',
    'email'     => 'pierre@gamil.com',
    'telephone' => '0601020304'
);

foreach ($contact as $indice => $valeur) {
    if ($indice == 'prenom') {
        echo '<h3>Bonjour ' . $valeur . ' !</h3>';
    } else {
        echo '<p>' . $valeur . '</p>';
    }
}


//----------------------------------
echo '<h2> Tableau multidimensionnel </h2>';
//----------------------------------
// Nous parlons de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau. Chaque tableau représente une dimension.

// Déclaration d'un tableau multidimensionnel :
$tab_multi = array(
    array(
        'prenom'    => 'Julien',
        'nom'       => 'Dupon',
        'telephone' => '0612345678',
    ),
    array(
        'prenom'    => 'Nicolas',
        'nom'       => 'Duran',
        'telephone' => '0698765432',
    ),
    array(
        'prenom'    => 'Pierre',
        'nom'       => 'Dulac',
    ),
);  // il est possible de choisir le nom des indices dans un tableau multidimensionnel.
debug($tab_multi);

// Afficher la valeur "Julien" :
echo $tab_multi[0]['prenom'] . '<hr>';  // pour afficher "Julien" nous entrons d'abord dans le tableau $tab_multi, puis nous allons à son indice [0], dans lequel nous allons à l'indice ['prenom'] (les crochets sont successifs).
 
// Parcourir le tableau multidimensionnel avec une boucle for :
for ($i = 0; $i < sizeof($tab_multi); $i++) { // tant que $i est inférieur au nombre d'éléments du tableau $tab_multi (ici 3), on entre dans la boucle
    echo $tab_multi[$i]['prenom'] . '<br>'; // on passe successivement par 0 puis 1 puis 2 pour afficher les 3 prénoms
}

echo '<hr>';
//------
// Exercice : Afficher les 3 prénoms avec une boucle foreach.
foreach ($tab_multi as $indice => $contact) {
    echo $tab_multi[$indice]['prenom'] . '<br>';
}
// Autre version :
foreach ($tab_multi as $contact) {
    // debug($contact); // on voit que $contact est un array qui contient l'indice "prenom". On accède donc aux prénoms en mettant cet indice dans des [] :
    echo $contact['prenom'] . '<br>';
}


//------
// Exercice (option) : vous déclarez un tableau contenant les tailles S, M, L et XL. Puis vous les affichez dans un menu déroulant (select/option) à l'aide d'une boucle foreach.



//----------------------------------
echo '<h2> Inclusions de fichiers </h2>';
//----------------------------------

echo 'Première inclusion : ';
include 'exemple.inc.php';  // le fichier est inclus, c'est-à-dire que son code s'exécute ici. En cas d'erreur lors de l'inclusion, include génère une erreur de type "warning" et continue l'exécution du script.

echo '<br> Seconde inclusion : ';
include_once 'exemple.inc.php';  // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclut pas.

echo '<br> Troisième inclusion : ';
require 'exemple.inc.php';  // le fichier est "requis", donc obligatoire : en cas d'erreur lors de l'inclusion, require génère une erreur de type "fatal error" qui stoppe l'exécution du code.

echo '<br> Quatrième inclusion : <br>';
require_once 'exemple.inc.php';  // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclut pas.

echo '<br>' . $inclusion; // comme le fichier exemple.inc.php est inclus, on accède aux éléments qui sont déclarés à l'intérieur de celui-ci, comme les variables, les fonctions...

// La mention "inc" dans le nom du fichier précise aux développeurs qu'il s'agit d'un fichier d'inclusion, et non pas d'une page à part entière. 



//----------------------------------
echo '<h2> Introduction aux objets </h2>';
//----------------------------------
// Un objet est un autre type de données (object en anglais). Il représente un objet réel (par exemple voiture, membre, panier d'achat, produit...) auquel on peut associer des variables, appelées PROPRIETES, et des fonctions appelées METHODES.

// Pour créer des objets, il nous faut un "plan de construction" : c'est le rôle de la classe. 
// Nous créons ici une classe pour faire des objets "meubles" :
class Meuble {  // avec une majuscule 

    public $marque = 'ikea';  // $marque est une propriété. "public" précise qu'elle sera accessible partout. 

    public function prix() {  // prix() est une méthode.
        return rand(50, 200) . ' €';
    } 

}

//------
$table = new Meuble();  // new est un mot clé qui permet d'instancier la classe pour en faire un objet. L'intérêt est que notre $table bénéficie de la propriété "ikea" et de la méthode prix() définis dans la classe.

debug($table); // nous observons le type "object", le nom de sa classe "Meuble" et sa propriété "marque".

echo 'Marque du meuble : ' . $table->marque . '<br>';  // pour accéder à la propriété d'un objet, on écrit cet objet suivi de la flèche -> puis du nom de la propriété sans le $.

echo 'Prix du meuble : ' . $table->prix() . '<br>';  // pour accéder à la méthode d'un objet, on l'écrit après la flèche -> à laquelle on ajoute une paire de ().

// *************************  FIN  *************************** 











