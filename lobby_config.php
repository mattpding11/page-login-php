<?php

require 'connection.php';

session_start();

$message = '';

$pass = $_SESSION['pass'];


if(!empty($_POST['client_id'])){

    $client_id = $_POST['client_id'];

    $sql_verify_code = mysqli_query($conn,"SELECT client_id FROM CLIENT WHERE client_id = $client_id ");
    
    if($sql_verify_code && $client_id == $pass){



        $client_direction = $_POST['client_direction'];
        $client_phone = $_POST['client_phone'];
        $client_name = $_POST['client_name'];
        $client_email = $_POST['client_email'];
        $client_nro_dni = $_POST['client_nro_dni'];
        $client_date_birth = $_POST['client_date_birth'];
        $client_registration_date = $_POST['client_registration_date'];
        $client_topic_interest = $_POST['client_topic_interest'];

        
        
        if ( !empty($_POST['client_direction'])){
            $sql_update = "UPDATE CLIENT SET client_direction = '$client_direction'   WHERE client_id = '$client_id'";
            
        $sql_result= mysqli_query($conn,$sql_update);

        }
         if(!empty($_POST['client_phone'])) {
            $sql_update = "UPDATE CLIENT SET client_phone = '$client_phone'  WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
         }
        if(!empty($_POST['client_name'])){
            $sql_update ="UPDATE CLIENT SET client_name =  '$client_name'   WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
        }
         if(!empty($_POST['client_email'])){
            $sql_update = "UPDATE CLIENT SET client_email = '$client_email'   WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
         }
         if(!empty($_POST['client_nro_dni'])){
            $sql_update = "UPDATE CLIENT SET client_nro_dni = '$client_nro_dni'   WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
         }
        if(!empty($_POST['client_date_birth'])) {
            $sql_update = "UPDATE CLIENT SET client_date_birth =  '$client_date_birth'   WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
        }
        if(!empty($_POST['client_registration_date'])) {
            $sql_update = "UPDATE CLIENT SET client_registration_date =  '$client_registration_date'   WHERE client_id = '$client_id'";
            $sql_result= mysqli_query($conn,$sql_update);
        }
        if(!empty($_POST['client_topic_interest']) ){
            $sql_update = "UPDATE CLIENT SET client_topic_interest = '$client_topic_interest'   WHERE client_id = '$client_id";
            $sql_result= mysqli_query($conn,$sql_update);
        }
        if($sql_result){
            $message = "<font color='#1B5E20'> ACTUALIZACION EXITOSA </font>";
        }else{
            $message = "<font color='#D50000'> ACTUALIZACION FALLIDA </font>";
        }

     }else{
        $message = "<font color='#D50000'> CODIGO INCORRECTO </font>";
    }

   
   
}else{

    
if (empty($_POST['client_id']) && empty($_POST['client_direction']) && empty($_POST['client_phone']) 
&& empty($_POST['client_name']) && empty($_POST['client_email']) && empty($_POST['client_nro_dni'])
&& empty($_POST['client_date_birth']) && empty($_POST['client_registration_date']) 
&& empty($_POST['client_topic_interest'])  ){
    
}else{
    $message = "<font color='#D50000'> ¡DEBE INGRESAR EL ID PARA ACTUALIZAR! </font>";
}

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link href="https://fonts.googleapis.com/css?family=Gelasio&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/style.css" >
  
</head>
<body >
<header>
    
    <a href="lobby.php"><img id="logo_lobby_config" src="assets/css/images/logo.png" alt="logo"></a>
    <nav id="nav_lobby_config">
        <ul >
            <li>  <a  href="lobby.php"><img id="logo_lobby_back"  src="assets/css/images/logo_config_back.png" alt="logo config back"></a> </li>
        </ul>
       
    </nav>
    

</header>

<h1 > Modificar datos personales </h1>
<h4>Ingrese el dato o los datos que quiera cambiar</h4>
<?php if(!empty($message)): ?>
<p> <?= $message ?> </p>
<?php endif; ?>

<section>

<form action="lobby_config.php" method="post"> 
<input type="password" name="client_id" placeholder="Codigo">
    <input type="text" name="client_name" placeholder="Nombre">
     <input type="text" name="client_email" placeholder="Correo">
    <input type="text" name="client_direction" placeholder="Direccion">
    <input type="text" name="client_phone" placeholder="Telefono">
    <input type="text" name="client_nro_dni" placeholder="Numero de DNI">
    <input type="text" id="datepicker-1" name="client_date_birth" placeholder="Fecha de nacimiento" >
    <input type="text" id="datepicker-2"  name="client_registration_date" placeholder="Fecha de inscripcion">
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/jquery-ui.min.js"></script>
			<script src="assets/js/datepicker-es.js"></script>
			<script>
                $("#datepicker-1").datepicker($.datepicker.regional[ "es" ]);
                $("#datepicker-2").datepicker($.datepicker.regional[ "es" ]);
            </script>
     <input type="text" name="client_topic_interest" placeholder="Tema de interes">

    <input type="submit" value="Actualizar">
    
</form>

</section>




<footer> &copy; 2019 CD </footer>
</body>
</html>