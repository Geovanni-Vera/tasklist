<?php
//incluimos las funciones
require __DIR__.'\funciones.php';
//incluimos la base de datos
require __DIR__.'\config\database.php';
//importamos el autoloader
require __DIR__.'\..\clases\task.php';
//usamos el namespace
use App\Task;
//conectar  a la base de datos
$db = conectarDB();
//seteamos la base de datos en la clase tasklist
Task::setDB($db);