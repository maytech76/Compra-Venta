<?php


$mysqli=new mysqli("localhost", "root", "", "compraventa",);
if (mysqli_connect_error()) {
    echo 'conexion DB Fallida:', mysqli_connect_error();
    exit();
}


?>