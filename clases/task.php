<?php

namespace App;

class Task
{
    public $id;
    public $titulo;
    public $descripcion;

    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'descripcion'];
    protected static $errores = [];

    public function __construct($args = [])
    {
        $this->id = $args['id'];
        $this->titulo = $args['titulo'];
        $this->descripcion = $args['descripcion'];
    }
    /*Conexion a base de datos*/
    public static function setDB($database)
    {
        self::$db = $database;
    }

    /*Identificar los atributos de la base de datos */
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $col) {
            if ($col === 'id') continue;
            $atributos[$col] = $this->$col;
        }
        return $atributos;
    }
    /*Sanitizar los datos de entrada del formulario*/
    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    /*Identificar errores */
    public static function getErrores()
    {
        return self::$errores;
    }

    /*Validar errores */
    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Titulo necesario";
        }
        if (!$this->descripcion) {
            self::$errores[] = "Descripcion necesaria";
        }
        if(!$this -> descripcion > 600){
            self::$errores[]="El numero maximo de caracteres es 600 ";
        }
        return self::$errores;
    }
    /*Crear*/
    public function crear()
    {
        //asignamos los datos sanitizados
        $atributos = $this->sanitizarDatos();
        //creamos la consulta sql
        $query = "INSERT INTO tasks(";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( '";
        $query .= join("', '", array_values($atributos));
        $query .= "' );";
        //resultado 
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('location: /tasklist/index.php?mensaje=1');
        }
    }
    /*Read*/
    public static function all()
    {
        $query = "SELECT * FROM tasks;";
        $result = self::consultarSql($query);
        return $result;
    }

    public static function consultarSql($query)
    {
        $result = self::$db->query($query);
        $array = [];
        while ($row = $result->fetch_assoc()) {
            $array[] = self::crearObjeto($row);
        }
        $result->free();
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new self;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key))
                $objeto->$key = $value;
        }
        return $objeto;
    }
    /*Update*/
    public static function find($id)
    {
        $query = "SELECT * FROM tasks WHERE id= $id LIMIT 1;";
        $result = self::consultarSql($query);
        return array_shift($result);
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
    public function guardar(){
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function actualizar(){
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'"; 
        }
        $query = " UPDATE tasks SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ; "; 

        $result = self::$db->query($query);

        if($result){
            header('location: /tasklist/index.php?mensaje=2');
        }
    }
    /*-------------------DELETE--------------- */
    public function eliminar()
    {
        $query = "DELETE FROM tasks WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1; ";
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /tasklist/index.php');
        }
    }
}
