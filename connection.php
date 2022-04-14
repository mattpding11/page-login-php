<?php 

   
$host ='localhost';
$username = ''; # Nombre de usuario base de datos mysql
$password = ''; # Contraseña de usuario
$database = "DB";

    $conn = mysqli_connect($host,$username,$password,$database);
   
    if($conn){
        echo "<font size = '5' color='green'>".'Conexion Exitosa'."</font>";
    }else{
        echo "<font size = '5' color='red'>".'Conexion Errada'."</font>";
    }
?>
