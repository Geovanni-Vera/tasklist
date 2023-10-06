<?php
namespace App;

class Task{
    protected $id;
    protected $titulo;
    protected $descripcion;

    protected static $db;
    protected $columnasDB = ['id','titulo','descripcion'];
    protected $errores = [];

    public function __construct($args=[])
    {
        $this->id = $args['id'];
        $this->titulo=$args['titulo'];
        $this->descripcion= $args['descripcion'];
    }
    /*Conexion a base de datos*/
    public static function setDB($database){
        self::$db=$database;
    }

    /*Identificar los atributos de la base de datos */
    public function atributos(){
        $atributos=[];
        foreach (self::$columnasDB as $col) {
            if($col === 'id')continue;
            $atributos[$col]=$this->$col;
        }
        return $atributos;
    }
    /*Sanitizar los datos de entrada del formulario*/
     public function sanitizarDatos(){
        $atributos = $this->atributos();
     }
    /*Crear*/

}