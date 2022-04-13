<?php

require 'connection.php';

session_start();

$message = '';


if( !empty($_POST['client_name']) && !empty($_POST['client_id']) ){

    $client_id = $_POST['client_id'];
    $client_name = $_POST['client_name'];

    $sql_verify_account = mysqli_query($conn,"SELECT client_id,client_name FROM CLIENT WHERE client_id = '$client_id' AND client_name = '$client_name'");


    if(mysqli_num_rows($sql_verify_account) > 0 ){
        $_SESSION['username'] = $client_name;
        $_SESSION['pass'] = $client_id;
        header('location: lobby.php');

    }else{
        $message = "<font color='#D50000'> Codigo o nombre incorrectos, porfavor ingreselos de nuevo </font>";
        
    }

}else{
    if( !empty($_POST['client_name']) || !empty($_POST['client_id']) ){
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

    <input type="text" name="client_name" placeholder="Nombre">
    <input type="password" name="client_id" placeholder="Codigo">
    <input  type="submit" value="Ingresar">
   
</form>
<?php if(!empty($message)): ?>
<p> <?= $message ?> </p>
<?php endif; ?>
<p class="subtext"> ¿ No tienes cuenta ? <a  href="signup.php"> Registrarme </a> </p> 
<footer> &copy; 2019 CD </footer>
</body>
</html>