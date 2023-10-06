<?php
namespace App;

class Task{
    protected $id;
    protected $titulo;
    protected $descripcion;

    protected static $db;
    protected static $columnasDB = ['id','titulo','descripcion'];
    protected static $errores = [];

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
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }   
        return $sanitizado; 
     }

     /*Identificar errores */
     public static function getErrores(){
        return self::$errores;
     }

     /*Validar errores */
     public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Titulo necesario";            
        }
        if(!$this->descripcion){
            self::$errores[] = "Descripcion necesaria";            
        }
        return self::$errores;
     }
    /*Crear*/
     public function crear(){
        //asignamos los datos sanitizados
        $atributos = $this -> sanitizarDatos();
        //creamos la consulta sql
        $query = "INSERT INTO tasks(";
        $query .= join (', ',array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '",array_values($atributos));
        $query .= "' );";
        //resultado 
        $resultado = self::$db->query($query);
        if($resultado){
            header('location: /tasklist/index.php');
        }
     }
     /*Read*/
     public static function all(){
        $query = "SELECT * FROM tasks;";
        $result = self::consultarSql($query);
        return $result;
     } 

     public static function consultarSql($query){
        $result = self::$db->query($query);
        $array=[];
        while( $row=$result->fetch_assoc()){
            $array[]=self::crearObjeto($row);
        }
        $result->free();
        return $array;
     }

     protected static function crearObjeto($registro){
        $objeto = new self;
        foreach($registro as $key => $value){
            if(property_exists($objeto,$key))
                $objeto->$key = $value;
        }
        return $objeto;
     }
     /*Update*/
}