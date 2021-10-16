<!--
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Operaciones que vamos a emplear para realizar acciones con la base de datos
-->
<?php
    include 'configuraciónBBDD.php';
    class Consulta
    {
        public $mysqli;
        public $resultado;
        //Conexion base de datos
        function __construct()
        {
            $this->mysqli = new mysqli(servidor, usuario, password, basedatos);
            if($this->mysqli->connect_error){
                echo 'Error de conexion';
            }
        }
        //Preparacion de la consulta
        function hacerConsultas($sql)
        {
            $this->resultado = $this->mysqli->query($sql);
        }
        //Consultas Select
        function comprobarSelect()
        {
            return $this->resultado->num_rows;
        }
        //Consultas de actualizacion Insert, Delete, Update
        function comprobar(){
            return $this->mysqli->affected_rows;
        }
        //Extraccion de los datos de cada consulta
        function extraerFilas(){
            return $this->resultado->fetch_array();
        }
        //Comprobación de inicio de sesión de los usuarios
        function inicioSesion($correo, $password){
            //echo password_hash('1234',PASSWORD_DEFAULT);
            //Consulta a la base de datos
            $consulta = "SELECT * FROM colaborador WHERE correo=? ;";
            //Preparamos la consulta
            $consulta2 = $this->mysqli->prepare($consulta);
            $consulta2->bind_param("s",$correo);
            //Ejecutamos la consulta
            $consulta2->execute();
            //Obtenemos el resultado de la consulta
            $resultado=$consulta2->get_result();
            //Comprobamos usuario y contraseña
            if($resultado->num_rows>0){
                /*$hash_password=password_hash($password, PASSWORD_DEFAULT);*/
                $fila = $resultado->fetch_array();
                if(password_verify($password,$fila["password"])){
                    return true;
                }
            }
        }
        //Comprobación de la especificación del número de error
        function numeroError(){
            return $this->mysqli->errno;
        }
        //Comprobación de errores generales
        function comprobarError(){
            $errno=$this->numeroError();
            if($errno==1062){
                $error="<span class='error'>ERROR: DATO REPETIDO</span><br>";
            }else{
                $error=$this->mysqli->error;
            }
            return $error;
        }
    }
?>
