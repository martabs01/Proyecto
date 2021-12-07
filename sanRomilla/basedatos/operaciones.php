<?php
/*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Conexión y métodos que vamos a emplear para realizar acciones con la base de datos
     */
//Incluimos el archivo de configuración a la conexión a la base de datos para poder trabajar con ella
require_once ('configuracion.php');
//Clase donde vamos a incluir los diferentes metodos con los que trabajaremos
class consulta
{
    //Variable que define nuestra conexión a la base de datos
    public $mysqli;
    //Variable que va a guardar los resultados que obtengamos en cada metodo
    public $resultado;
    //Función que abre una nueva conexion con la base de datos
    function __construct()
    {
        //Variable que contiene los atributos necesarios pàra abrir la nueva conexión con la base de datos
        $this->mysqli = new mysqli(servidor, usuario, password, basedatos);
        //Función de error por si nos falla la conexión de la base de datos
        if($this->mysqli->connect_error){
            echo 'Error de conexion';
        }
    }
    //Función que  envía una única consulta a la base de datos
    function hacer_consultas($sql)
    {
        $this->resultado = $this->mysqli->query($sql);
    }
    //Función que obtiene el número de filas de un resultado
    function comprobar_consulta()
    {
        return $this->resultado->num_rows;
    }

    //Función que devuelve el número de filas afectadas en consultas de actualizacion (Insert,Delete,Update)
    function comprobar_actualizacion(){
        return $this->mysqli->affected_rows;
    }
    //Función que obtiene una fila de resultados
    function extraer_filas(){
        return $this->resultado->fetch_array();
    }
    //Función que realiza la comprobacion de que el correo y la contraseña del usuario con correctas
    function inicio_sesion($correo, $password){
        //echo password_hash('1234',PASSWORD_DEFAULT);
        //Consulta que se realiza a la base de datos
        $consulta = "SELECT * FROM colaborador WHERE correo=? ;";
        //Preparación de la consulta
        $consulta2 = $this->mysqli->prepare($consulta);
        $consulta2->bind_param("s",$correo);
        //Ejecutación de la consulta
        $consulta2->execute();
        //Obtención del resultado de la consulta
        $resultado=$consulta2->get_result();
        //Comprobación de que hemos obtenido un resultado
        if($resultado->num_rows>0){
            /*$hash_password=password_hash($password, PASSWORD_DEFAULT);*/
            //Obtencion de una fila de resultados de la consulta realizada
            $fila = $resultado->fetch_array();
            /*Comprobación de la contraseña del formulario con la de la base de datos
             mediente password_verify que comprueba que la contraseña coincida con un hash*/
            if(password_verify($password,$fila["password"])){
                return true;
            }
        }
    }

    //Comprobación de la especificación del número de error
    function numero_error(){
        //Método que retorna el número de error concreto
        return $this->mysqli->errno;
    }

    //Función que guarda todos las filas de la base de datos y sus datos
    var $colaborador;
    function mostrar_colaborador(){
        //Consulta a la base de datos
        $sql="SELECT * FROM colaborador";
        //Variable que guarda la realización de la consulta a la base de datos
        $resultado=$this->mysqli->query($sql);
        //Variable que guarda todos los resultados que nos devuelve
        $this->colaborador= $resultado->fetch_all(MYSQLI_ASSOC);
        //Retorno de los datos devueltos
        return $this->colaborador;
    }
    var $inscripcion;
    function mostrar_inscripcion(){
        //Consulta a la base de datos
        $sql="SELECT * FROM inscripcion";
        //Variable que guarda la realización de la consulta a la base de datos
        $resultado=$this->mysqli->query($sql);
        //Variable que guarda todos los resultados que nos devuelve
        $this->inscripcion= $resultado->fetch_all(MYSQLI_ASSOC);
        //Retorno de los datos devueltos
        return $this->inscripcion;

    }
    var $donacion;
    function mostrar_donacion(){
        //Consulta a la base de datos
        $sql="SELECT * FROM donacion";
        //Variable que guarda la realización de la consulta a la base de datos
        $resultado=$this->mysqli->query($sql);
        //Variable que guarda todos los resultados que nos devuelve
        $this->donacion= $resultado->fetch_all(MYSQLI_ASSOC);
        //Retorno de los datos devueltos
        return $this->donacion;
    }

}
//Fin de configuracion.php  (datos conexión)

