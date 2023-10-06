<?php 

function conectarDB(){
    $db = new mysqli("localhost","root","root","tasklist");
    if(!$db){
        echo "Error de conexion";
        exit;
    }
    return $db;
}

