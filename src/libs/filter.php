/*
Ce code définira une fonction appelée "filter" qui prend en entrée 3 tableaux:

$data: Tableau de données à filtrer.
$fields: Tableau de règles de filtrage pour les champs de données. Chaque entrée de ce tableau est associée à un champ de données et définit les règles de filtrage pour ce champ.
$messages: Tableau optionnel de messages d'erreur pour la validation.
La fonction "filter" effectue les étapes suivantes:

Extraction des règles de nettoyage et de validation à partir du tableau de règles de filtrage.
Nettoyage des données en utilisant la fonction "sanitize" avec les règles de nettoyage extraites.
Validation des données nettoyées en utilisant la fonction "validate" avec les règles de validation extraites et les messages d'erreur optionnels.
Retourne un tableau comprenant les données nettoyées et les erreurs de validation éventuelles.

 */

<?php


function filter(array $data, array $fields, array $messages = []): array
{
    $sanitization = [];
    $validation = [];

   
    foreach ($fields as $field => $rules) {
        if (strpos($rules, '|')) {
            [$sanitization[$field], $validation[$field]] = explode('|', $rules, 2);
        } else {
            $sanitization[$field] = $rules;
        }
    }

    $inputs = sanitize($data, $sanitization);
    $errors = validate($inputs, $validation, $messages);

    return [$inputs, $errors];
}