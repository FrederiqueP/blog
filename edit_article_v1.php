<?php 

// Inclusion des dépendances 
include 'functions.php';

// Initialisations
$errors = [];

// Traitements : récupérer l'article à afficher
$idArticle = $_GET['id'];

// Validation du paramètre id de l'URL
if (!array_key_exists('id', $_GET) || !$_GET['id']) {
    
    http_response_code(404);
    echo 'Article introuvable';
    exit;
}


// On va chercher l'article correspondant
$article = getOneArticle($idArticle);

var_dump($article);

// On vérifie qu'on a bien récupéré un article, sinon => 404
if (!$article) {

    http_response_code(404);
    echo 'Article introuvable';
    exit; // Si pas d'article => message d'erreur et on arrête tout ! 
}

// Si le formulaire est soumis...
if (!empty($_POST)) {

    // On récupère les données du formulaire
    $title = trim($_POST['title']);
    $abstract = trim($_POST['abstract']);
    $content = trim($_POST['content']);
    $image = trim($_POST['image']);

    // On valide les données (titre et contenu obligatoires)
    if (!$title) {
        $errors['title'] = 'Le champ "Titre" est obligatoire';
    }

    if (!$content) {
        $errors['content'] = 'Le champ "Contenu" est obligatoire';
    }

    // Si tout est OK (pas d'erreurs)...
    if (empty($errors)) {

        // On enregistre l'article
        editArticle($idArticle);

        // On redirige l'internaute (pour l'instant vers une page de confirmation)
        header('Location: confirmation_modif.html');
        exit;
    }
}


// Inclusion du template
include 'edit_article.phtml';