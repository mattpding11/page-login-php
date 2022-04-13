<?php 

   
$host ='localhost';
$username = 'root';
$password = 'root';
$database = "cd_db";

    $conn = mysqli_connect($host,$username,$password,$database);
   
    if($conn){
        echo "<font size = '5' color='green'>".'Conexion Exitosa'."</font>";
    }else{
        echo "<font size = '5' color='red'>".'Conexion Errada'."</font>";
    }
?>