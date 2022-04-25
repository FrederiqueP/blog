#TODO

On va partir sur le blog !!
Première mission : créer un formulaire de création d'article. Les articles seront stockés dans un fichier article.json. 
Un article contiendra pour commencer : 
- title : (input type text) titre de l'article
- abstract : (textarea) le résumé de l'article
- content : (textarea) contenu complet de l'article
- image : (input type text) nom du fichier image (le fichier sera stocké dans un dossier images) 
- createdAt : (pas de champ dans le formulaire! On ajoutera la date du jour automatiquement en PHP) date de création de l'article (au format américain yyyy-mm-dd) 
On aura donc sur le formulaire de création d'article 4 champs pour le moment : title, abstract, content et image
On part sur une arbo similaire à ce qu'on a fait sur la newsletter, je vais simplement appeler mes fichiers add_article.php et add_article.phtml

On se réserve l'index.php pour la page d'accueil du site
Tant qu'on garde cette structure, dans vos fichiers .php vous aurez toujours en premier l'inclusion des dépendances le cas échéant, et tout en bas l'inclusion du fichier de template.
.
Les grandes étapes : 
- - - - - - - - - - - - - - - - -
1°) Affichage du formulaire : construction du code HTML du formulaire d'ajout d'article dans le fichier de template add_article.phtml
2°) Traitement des données du formulaire en cas de soumission 

Validation 
- - - - - - - - - - 
- champ title obligatoire
- champ content obligatoire
-> L'image est facultative
-> Le résumé est facultatif : s'il n'est pas présent on prendra le début du contenu de l'article (150 premiers caractères)

Attention : comme on a plusieurs champ dans le formulaire, les messages d'erreurs pourront être stockés dans un tableau associatif dont les clés seront les noms des champs : 
$errors['title'] = 'Le champ "Titre" est obligatoire';
Rappel : on teste dans un premier temps la validation serveur en PHP, puis quand c'est OK on peut ajouter la validation client avec les attributs HTML 5 comme required

<textarea> voir https://developer.mozilla.org/en-US/docs/Web/HTML/Element/textarea

On pourra reprendre les 2 fonctions utilitaires  saveJSON() et loadJSON() qui permettent respectivement d'enregistrer et de lire des données dans un fichier JSON
On pourra créer aussi une fonction getAllArticles()  qui récupèrera tous les articles du fichier JSON
Enfin une fonction addArticle() qui s'occupera d'enregistrer un nouvel article

Remarque : pour la newsletter on n'avait qu'une seule information à enregistrer, l'email. Ici on a plusieurs informations (5 avec la date du jour)
Il semble donc pertinent comme la suggérer @LAM David de stocker ces informations dans un tableau associatif. 
$article = [
  'title' => ...,
  'content' => ...,
  'abstract' => ...,
  'image' => ...,
  'createdAt' => ...
];

Ce tableau associatif qui représente UN article sera ajouté dans le grand tableau contenant tous les articles... 
$allArticles[] = $article;


Ajouter la date du jour aux articles dans une clé createdAt . Regarder en PHP la classe DatetimeImmutable...


Pour ajouter la date de création de l'article, on peut créer la date du jour au format américain yyyy-mm-dd grâce à la classe DatetimeImmutable et à sa méthode format()
$today = new DateTimeImmutable();

$article = [
    'title' => $title,
    'abstract' => $abstract,
    'content' => $content,
    'image' => $image,
    'createdAt' => $today->format('Y-m-d')
];




Prochaine mission : Page d'accueil
- - - - - - - - - - - - - - - - - - - - - - - - - - - 
-> Afficher le résumé des articles : titre, résumé (ou les 150 premiers caractères du contenu si le résumé est absent), image et la date de l'article
-> home.php / home.phtml
Le fichier home.php va aller chercher tous les articles, puis on va les afficher dans le template home.phtml

Note : il existe des systèmes de gestion de bases de données entièrement basés sur le format JSON comme MongoDB (très utilisé avec NodeJS mais qui possède aussi une API PHP!) 



Attention : la fonction json_decode() par défaut va transformer les objets JSON en objets PHP de la classe stdClass. Si on veut retrouver nos tableaux associatifs de départ, on doit le préciser dans le deuxième paramètre de la fonction json_decode(). Dans notre fonction loadJSON() on va faire : 
return json_decode($jsonData, true);
---> en précisant 'true' deuxième paramètre on dit oui je veux des tableaux associatifs

--->
Sur Firefox:
Pour la qualité de l'affichage des var_dump() et des erreurs il faut activer l'extension xdebug qui par défaut n'est pas activée avec Laragon...


Sur la syntaxe alternative de PHP : https://www.php.net/manual/fr/control-structures.alternative-syntax.php
--->
Syntaxe alternative en remplaçant "{"
                            par ":"
                      et "}" par endforeach ou endif

---> Expression ternaire abrège le code suivant
if ($toto > 10) {
    echo 'toto';
} else {
    echo 'titi';
}
// Expression ternaire
($toto > 10) ? echo 'toto' : echo 'titi'

--> 
si la valeur était nulle utiliser les "??"
<p><?=$article['abstract']??'contenu';?></p>

-->
lipsum.com

--> 
doc php pour fonction chaine de caractère : "substr"
pour la fonction "trim" après la saisie il s'agit de supprimer les espaces avant et après la chaine de caractères


--> la Date 
convention de nomage toutes les dates avec suffixe 'At' , exemple 'createAt
utilisation de la class Date() avec le mot clé 'new'
DateTimeImmutable()
immutable pour dire que l'objet ne sera jamais affecté par les méthode appliquées
rien dans les paranthèses signifie : la date du jour

--> <small></small> pour écrire en petit

--> la fonction "isset"
teste si la variable vaut 'null' dans   
    1) initialisation des variables du fichier php
$error = null;
    2) puis dans le html on teste avec isset
<main class="project container">

    <form action="index.php" method="POST">

        <?php if(isset($error)): ?>
            <aside>
                    <p class="message error"><?=$error; ?></p>
            </aside>
        <?php endif; ?>


Pour les images pour l'instant on a un simple champ de type text dans lequel on écrit le nom du fichier image, par exemple "manif.jpg". Ensuite dans le template HTML on vient écrire le nom du fichier dans la source de la balise <img> : 
<img src="images/<?=$article['image'];?>" alt="">
Le fichier image a directement été copié dans le dossier images pour l'instant.
c:>...>php>blog>images>manif.jpg

On verra plus tard comment uploader l'image directement à partir du formulaire avec un champ de type file !
