Dashboard : page d'accueil de l'administration qui va lister les articles sous forme de tableau

On aura des boutons pour modifier et supprimer les articles
Et un bouton pour accéder au formulaire de création d'article

Pour chaque article on affichera : titre, date de création, l'image


Fichiers : admin.php et admin.phtml


---> on commence à avoir beacoup de code il va falloir "factoriser " les templates au lieu pour le moment de les recopier à chaque nouvelle page



=> Les traitements pour le dashboard sont les mêmes que pour la page d'accueil : récupérer tous les articles (vous pouvez faire un copier/coller !) C'est seulement l'affichage qui va changer.

Formulaire de modification  : ça va beaucoup ressembler au formulaire de création d'article, sauf que : 
- on va pré remplir le formulaire avec les données de l'article qu'on veut modifier
- au lieu d'ajouter un nouvel article dans le tableau d'article, on va mettre à jour l'article existant
Cibler l'article à modifier : comme pour la page Article, il va falloir cibler l'article à modifier en transmettant son identifiant dans le lien de modification...
On fera des fichier edit_article.php et edit_article.phtml


Suppression d'article
Pour la suppression on n'aura juste un fichier delete_article.php, on n'aura pas de template, car il n'y a pas de "page" de suppression, l'article est simplement supprimé et on reste sur le dashboard admin. 
Cibler l'article à supprimer: comme pour la modification, il va falloir cibler l'article à supprimer en transmettant son identifiant dans le lien de suppression...


--> css fontasome
https://cdnjs.com/libraries/font-awesome
https://cdnjs.com/


Formulaire de modification  : ça va beaucoup ressembler au formulaire de création d'article, sauf que : 
- on va pré remplir le formulaire avec les données de l'article qu'on veut modifier. On aura donc besoin de transmettre l'id dans les liens de modifications
- au lieu d'ajouter un nouvel article dans le tableau d'article, on va mettre à jour l'article existant. Il faudra donc également transmettre l'id de l'article à modifier au moment de la soumission du formulaire
Cibler l'article à modifier : comme pour la page Article, il va falloir cibler l'article à modifier en transmettant son identifiant dans le lien de modification...
On fera des fichier edit_article.php et edit_article.phtml
On prévoit une fonction editArticle(string $idArticle) 
.

Vous pouvez reprendre la trame du fichier add_article.php, et ajouter la sélection des données de l'article, que vous pouvez reprendre du fichier article.php !

Dans le Google Doc que je vous ai mis sur classroom sur les formulaires, vous avez un paragraphe sur comment pré remplir les champs en fonction de leur type

---> attention avec textarea pas de value, écrire le texte entre la balise ouvrante et la balise fermante


- champs <input> : attribut value, sauf pour les radio et les checkbox (attribut checked)
- champ <textarea> : texte directement entre les balises 
- champ <select> : attribut selected sur l'option concernée


--> par Benoit
Article récent très intéressant sur la gestion de la taille des images : https://www.smashingmagazine.com/2020/03/setting-height-width-images-important-again/


--->Modifier un élément du tableau
    . récupérer le tableau
$article = getOneArticle($id);
    .modifier un élément du tableau avec une valeur dans l'index
$tab[index] = quelquechose
    . à partir du grand tableau de tous les articles
$articles[$index]['title'] =$title;
    . mettre à jour un article parmi les articles
$articles[$index] = $article

--- quand je ne mets pas d'indice je rajoute un élément au tableau --- sinon je modifie l'élément  à l'indice indiqué

$articles = getAllArticles();
foreach ($articles as $index => $article) {
    if ($article['id'] == $idArticle) {
        $articles[$index]['title'] = $title;
    }
}

ne pas faire tout de suite la redirection tant que l'on est en test , on reste sur la page
si la modification s'est bien apssée on va vers la page admin.php


--> teste de l'id dans l'url
cherche si la clé 'id' existe dans le tableau $_GET
ou le tableau $_GET contient un éalamnt de valeur 'id'
// Validation du paramètre id de l'URL
if (!array_key_exists('id', $_GET) || !$_GET['id']) 



Suppression d'article
Pour la suppression on n'aura juste un fichier delete_article.php, on n'aura pas de template (page pthml) , car il n'y a pas de "page" de suppression, l'article est simplement supprimé et on reste sur le dashboard admin. 
.
Cibler l'article à supprimer: comme pour la modification, il va falloir cibler l'article à supprimer en transmettant son identifiant dans le lien de suppression...
On prévoit une fonction deleteArticle(string $idArticle) 
- - - - - - - - - - - - - 
Après ça on aura terminé le CRUD  (Create Read Update Delete) sur les articles !! Je vous proposerai ensuite de faire un peu d'algo et d'implémenter le tri à bulles pour classer les articles du plus récent au plus ancien (sur la page d'accueil et la page admin) dans une fonction bubbleSortArticles()
- - - - - - - - - - - - - 

Remarque : pour la suppression, il va falloir regarder comment supprimer un élément d'un tableau en PHP... plusieurs solution, la meilleure sera celle qui ne laissera pas de "trou" dans les indices du tableau


--> 
    $arrayName est un paramètre obligatoire. C’est le tableau dont les éléments seront supprimés.
    $startingIndex est l’index de l’élément que nous souhaitons supprimer.
    $numOfElements est le nombre d’éléments que nous voulons supprimer de l’index de départ.
    $array2Name est un tableau d’éléments que nous voulons ajouter.
array_splice($flowers, 4, 3);

La fonction intégrée array_diff() trouve la différence entre deux ou plusieurs tableaux

Quand on travaille dans un tableau on évite de modifier le tableau que l'on est en train de parcourir
initialiser une variable qui stocke l'indice de l'élément à supprimer

---> stricte egalité ou différence
if ($indexToDelete !== null) {
    . quand 0 est un entier alors ce n'est pas 'null'
    . on peut utiliser isnull


--->
dans fonction deleteArticle(string $idArticle)
il est nécessaire de parcourir le tableau avec foreach pour récupérer l'indice du tableau , on ne le connait pas on ne connait que l'identifiant de l'article


---> 
un peu de javascript
gestionnaire d'évenement au click pour tous les boutons supprimer

---> 
attribut 'defer' pour charger le script avant l'affichage de la page 
<script src="js/admin.js" defer></script>

--->
modifier le comportement du navigateur pour éviter de perdre la page 
event.preventDefault();
   . quand je clique sur un lien il ne se passe rien, je epux demander une confirmation

--->
en javascript
window.location     
     . comme la redirection en php 
header('Location: admin.php');

if (window.confirm('Êtes-vous certain de vouloir supprimer cet article ?')) {
    . affiche une boite de dialogue avec 'ok' ou 'annuler' 
