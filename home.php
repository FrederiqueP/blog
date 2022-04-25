<?php 

// Inclusion des dépendances 
include 'functions.php';


// Traitements : récupérer les articles
$articles = getAllArticles();

// on teste tout de suite avec un var_dump 
// avant de voir sur html
// var_dump($articles);

// Affichage: inclusion du template
include 'home.phtml';