Enoncé suite exercice Blog
Page Article
- - - - - - - - - - - -
L'étape suivante sera de créer la page Article : quand je clique sur un lien "Lire la suite", je souhaite arriver sur une nouvelle page qui affiche le contenu complet de l'article sur lequel j'ai cliqué. 
Première question : comment savoir sur quel article je me trouve ? Comment identifier les articles ? Et comment transmettre cette information dans le lien "Lire la suite" ? 
Il faudra ensuite créer de nouveaux fichiers pour la page Article, article.php et article.phtml. Le contrôleur article.php sera chargé d'aller chercher l'article à afficher dans le fichier JSON. Ce sera l'occasion de faire une nouvelle fonction getOneArticle().
On affichera ensuite les données de l'article dans le template article.phtml.


On commence par créer les fichiers article.php et article.phtml pour gérer la page Article

--->
plutot qu'utiliser l'indice du tableau 
<?php foreach ($articles as $article): ?> avec index=>

on génère un identifiant unique avec plus d'entropie , le random
et un hashage , en sortie un "sha"
$article = [
        'id' => sha1(uniqid(rand(), true)),
        'title' => $title,
        'abstract' => $abstract,



--->Le terme entropie signifiant « transformation ». Il caractérise le degré de désorganisation, ou d'imprédictibilité, du contenu en information d'un système


Pour identifier de manière unique et invariante les article, on crée des identifiants uniques aléatoires grâce à une combinaisons de fonctions PHP. On va créer un "sha1", le système d'identifiants utilisés par git pour les commits !

dans articles.json
[{"id":"94cfc5011b05d6c14d709a4d3e6f62a2043bc602","title":"Mon article", 

--> pour tester
sur la page home.phtml on survole sur le lien 'lire la suite' et en bas à gauche du navigateur on voit localhost/....'id'

Cet identifiant est ensuite transmis dans les liens "Lire la suite", dans la chaine de requête : 
<a href="article.php?id=<?=$article['id'];?>">Lire la suite</a>

On va aller ensuite dans le contrôleur de la page Article article.php, où on va :
- récupérer l'identifiant présent dans la chaîne de requête (ou l'url)
- aller chercher à partir de cet identifiant l'article en question ( créer une fonction get one article)

Pour aller chercher un article à partir de son identifiant, on peut créer une fonction getOneArticle() qui prendra l'identifiant en paramètre : 
function getOneArticle(string $id)
{
  // ...
}
On placera cette fonction dans le fichier functions.php

Rappel : pour récupérer des données transmises dans l'URL dans la chaîne de requête, on utilise la super globale $_GET.

$_GET contient un tableau associatif dont les clés sont le nom des paramètres transmis. Si j'ai un paramètre "id" dans l'URL je vais le récupérer de cette façon : 
$idArticle = $_GET['id'];


J'ai créé un dépôt Github avec mon code : https://github.com/oliviermeunier/greta-live-gr9
Vous pouvez le cloner puis faire des pull pour récupérer les mises à jour !
GitHub
GitHub - oliviermeunier/greta-live-gr9
Contribute to oliviermeunier/greta-live-gr9 development by creating an account on GitHub.


Si vous avez terminé la page Article, vous pouvez regarder : 
- comment afficher les articles triés par date de création décroissante sur la page d'accueil 
- commencer le dashboard admin : la page d'accueil de l'admin qui va afficher sous forme de tableau la liste des articles, avec des boutons pour modifier et supprimer les articles existants, et un bouton pour accéder au formulaire de création d'article. On créera des fichiers admin.php et admin.phtml. 
.
Recherche de l'article dans getOneArticle() : 
Pour trouver l'article qui correspond à un identifiant, on doit parcourir le tableau d'articles et comparer l'id de chaque article avec l'id qu'on recherche.
Si c'est le bon id, bingo, on retourne l'article ! 
.
Remarque : je vous conseille également de créer un dépôt github pour votre blog afin de le retrouver facilement quand on retournera au Greta la semaine prochaine.
.

---> validation
// Validation du paramètre id de l'URL
if (!array_key_exists('id', $_GET) || !$_GET['id']) {
    
    http_response_code(404);
    echo 'Article introuvable';
    exit;
}
exit arrête l'exécution du script , c'est plus fort que le return
il n'arrive pas jusqu'à l'include du template

--> le point d'interrogation devant array pour si null
function getOneArticle(string $idArticle): ?array


---> 
/**
 * Récupère UN article à partir de son identifiant
 * @param string $idArticle - L'identifiant de l'article à récupérer
 * @return null|array - null si l'id n'existe pas, sinon retourne l'
 */
function getOneArticle(string $idArticle): ?array
{
    // Traitements : récupérer les articles
    $articles = getAllArticles();
    foreach ($articles as $article) {
        if ($article['id'] == $idArticle) {
            return $article;
        }
    }
     return null;
}


---> CRUD gestion administration des articles


