<?php
//definimos constantes con direcciones de la carpeta template
define('TEMPLATES_URL',__DIR__ . '/templates');
//definimos constaantes de la carpeta funciones
define('FUNCIONES_URL',__DIR__ . 'funciones.php');

function incluirTemplate(string $nombre,bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//sanitizar datos formularios
function sanitizar($html):string{
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}