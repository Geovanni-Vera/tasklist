<?php
//incluimos las funciones
require 'funciones.php';
//incluimos la base de datos
require 'config/database.php';
//importamos el autoloader
require '../clases/task.php';
//usamos el namespace
use App\Task;
//conectar  a la base de datos
$db = conectarDB();
//seteamos la base de datos en la clase tasklist
Task::setDB($db);