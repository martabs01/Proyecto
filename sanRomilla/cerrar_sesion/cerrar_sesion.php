<?php
/*
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Cerrar la sesión iniciada
*/
session_start();//Método que recoge la sesion iniciada
session_destroy();//Método que destruye la sesión iniciada
header('location:../login/login.php');//Método que redirige a la página de inicio
exit();//Método que sale de la sesión iniciada
?>
