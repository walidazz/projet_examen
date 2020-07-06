<?php


$dsn = 'mysql:host=localhost;dbname=search;charset=utf8mb4';
	$user = 'root';
	$pass = '';
	$bdd = new PDO($dsn,$user,$pass,[
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_EMULATE_PREPARES => false,
            ]);

            // j'aimerais faire une barre de recherche qui cherche selon le nom de l'article et la description (full text)
            $request = $bdd->prepare('SELECT id
            FROM article
      --  against va recuperer la recherche
            WHERE MATCH (title, info) AGAINST (?)');
        $request->execute(array($_POST['search']));
        $donnee = $request->fetchAll();

        echo json_encode($donnee);


  // faire une fonction ajax et le faire pointer sur l'url read.php et autre fonction sur vote.php      
// requete pour recuperer les votes read.php

// autre fichier pour envoyer le vote vote.php


?>