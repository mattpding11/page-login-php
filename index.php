<?php

require 'connection.php';

session_start();

$message = '';


if( !empty($_POST['client_email']) && !empty($_POST['client_nro_dni']) ){

    $client_nro_dni = $_POST['client_nro_dni'];
    $client_email = $_POST['client_email'];

    $sql_verify_account = mysqli_query($conn,"SELECT client_nro_dni,client_email FROM CLIENT WHERE client_nro_dni = '$client_nro_dni' AND client_email = '$client_email'");

    echo "<script>console.log($client_nro_dni)</script>";

    if(mysqli_num_rows($sql_verify_account) > 0 ){
        $_SESSION['username'] = $client_email;
        $_SESSION['pass'] = $client_nro_dni;
        header('location: lobby.php');

    }else{
        $message = "<font color='#D50000'> Codigo o nombre incorrectos, porfavor ingreselos de nuevo </font>";
        
    }

}else{
    if( !empty($_POST['client_email']) || !empty($_POST['client_nro_dni']) ){
        $message = "<font color='#FF6D00'> No pueden quedar campos vacios </font>";
    }
   
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iniciar Sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Gelasio&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/style.css" >
</head>
<body>
<header>
    <div > 
        <a href="index.php"><img src="assets/css/images/logo.png" alt="Logo"></a>
    </div>
</header>

    <h1 id="este">Iniciar sesión</h1>
<form  action="index.php" method="post">

    <input type="text" name="client_email" placeholder="Correo">
    <input type="password" name="client_nro_dni" placeholder="Codigo">
    <input  type="submit" value="Ingresar">
   
</form>
<?php if(!empty($message)): ?>
<p> <?= $message ?> </p>
<?php endif; ?>
<p class="subtext"> ¿ No tienes cuenta ? <a  href="signup.php"> Registrarme </a> </p> 
<footer> &copy; 2019 CD </footer>
</body>
</html>
