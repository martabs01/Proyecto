<?php
    /*
        Alumno: Marta Broncano Suárez
        Asignatura: Proyecto San Romilla
        Curso: 20-21
        Descripción: Cerrar la sesión iniciada
     */
    //Funcion que recoge la sesion iniciada
    session_start();
    //Funcion que destruye la sesion iniciada
    session_destroy();
    //Funcion que redirige a la página de inicio
    header('location:../login/login.php');
    exit();
?>
