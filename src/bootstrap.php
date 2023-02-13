/*
    haha ce fichier n'est pas comme tu peux le penser un fichier css mais plutôt un fichier qui est chargé en premier et qui sert de point de départ pour l'application. Le but de ce fichier est de charger les différentes bibliothèques et classes dont l'application a besoin pour fonctionner correctement.
    et ici on utilise require_once pour inclure un fichier PHP dans un autre. Il garantit que le fichier n'est inclus qu'une seule fois, même s'il est appelé plusieurs fois dans le code. Cela permet d'éviter les erreurs de redéfinition de fonction ou de classe, qui se produisent lorsqu'un même fichier est inclus plusieurs fois.Bon c'est ce que j'ai compris en lisant la docu
*/

<?php

session_start();


require_once __DIR__ . '/libs/helpers.php';
require_once __DIR__ . '/libs/flash.php';
require_once __DIR__ . '/libs/sanitization.php';
require_once __DIR__ . '/libs/validation.php';
require_once __DIR__ . '/libs/filter.php';
