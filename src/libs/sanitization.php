/*
    Ici c'est simple le codedéfinit deux fonctions :

array_trim qui reçoit un tableau d'éléments en entrée et qui retourne un tableau avec tous les éléments de chaîne de caractères trimés (les espaces en début et fin de chaîne sont enlevés). Si un élément est un tableau, la fonction est réappliquée à ce tableau pour le trimer aussi. Les autres types d'éléments sont simplement retournés sans modification.

sanitize qui reçoit des entrées de formulaire et un ensemble de champs spécifiés (dans un tableau). Elle utilise la fonction filter_var_array pour nettoyer les données, en utilisant les filtres définis dans le tableau constant FILTERS pour le nettoyage. Si aucun champ n'est spécifié, elle utilise un filtre par défaut pour tout nettoyer. Enfin, si l'option $trim est activée, elle appelle la fonction array_trim pour retirer les espaces en début et fin de chaîne pour toutes les chaînes de caractères dans le tableau nettoyé.
*/


<?php
const FILTERS = [
    'string' => FILTER_SANITIZE_STRING,
    'string[]' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'email' => FILTER_SANITIZE_EMAIL,
    'int' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_SCALAR
    ],
    'int[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'float' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_FLAG_ALLOW_FRACTION
    ],
    'float[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'url' => FILTER_SANITIZE_URL,
];


function array_trim(array $items): array
{
    return array_map(function ($item) {
        if (is_string($item)) {
            return trim($item);
        } elseif (is_array($item)) {
            return array_trim($item);
        } else
            return $item;
    }, $items);
}


function sanitize(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): array
{
    if ($fields) {
        $options = array_map(fn($field) => $filters[$field], $fields);
        $data = filter_var_array($inputs, $options);
    } else {
        $data = filter_var_array($inputs, $default_filter);
    }

    return $trim ? array_trim($data) : $data;
}