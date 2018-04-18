<?php

    try{
        $db =  new PDO ('mysql:host=localhost;dbname=portfolio','root','');
        // récupérer le résultat dans un tableau associatif
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }catch(Exception $e) {
        echo "impossible de se connecter à la base de donnée ! ";
       // pour avoir plus d'information sur l'erreur :
        $e->getMessage();
        die();
    }
