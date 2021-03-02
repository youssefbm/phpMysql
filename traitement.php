<?php

include_once('database.php');

// verifier si le message est envoyé correctement

if(isset($_POST['envoyer'])) {
    $utilisateur = mysqli_real_escape_string($link, $_POST['utilisateur']);
    $commentaire = mysqli_real_escape_string($link, $_POST['message']);

    //adapter le time zone à votre localisation
    date_default_timezone_set('America/New_York');

    $temps = date('H:i:s', time());
    //Validation des champs avant execution de la requête

    if(empty($utilisateur) || empty($commentaire)){
        $erreur = "utilisateur ou message non valide";
        header("Location : index.php?erreur=".urlencode($erreur));
            exit();
    } 
    else {
        $query = "INSERT INTO messages (utilisateur, contenu_message) VALUES ( '$utilisateur', '$commentaire')";
        if(!mysqli_query($link,$query)){
            die ('Erreur : '.mysqli_error($link));
        } 
        else {
            header("Location : index.php");
            exit();
        } 
    }
}


