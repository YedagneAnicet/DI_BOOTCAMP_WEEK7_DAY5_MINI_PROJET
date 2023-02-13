/*
bon ce code définit plusieurs fonctions utilitaires pour une application PHP.

view : une fonction pour inclure les vues (fichiers PHP) dans les pages du site web.

error_class : une fonction pour déterminer si un champ a des erreurs et renvoyer la classe correspondante pour la mise en forme.

is_post_request et is_get_request : des fonctions pour déterminer le type de la requête HTTP.

redirect_to : une fonction pour rediriger l'utilisateur vers une URL spécifiée.

redirect_with : une fonction pour rediriger l'utilisateur avec des données stockées dans la session.

redirect_with_message : une fonction pour rediriger l'utilisateur avec un message flash.

session_flash : une fonction pour obtenir des données flash enregistrées dans la session.
 */

<?php


function view(string $filename, array $data = []): void
{
    // create variables from the associative array
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}



function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}


function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}


function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}


function redirect_to(string $url): void
{
    header('Location:' . $url);
    exit;
}


function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}


function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS)
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}

function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}
