
<?php

require 'connection.php';

session_start();

$username = $_SESSION['username'];

$pass = $_SESSION['pass'];

$message = '';

if(!isset($username)){
    header('Location: index.php');
}else{

    $query_client_id = mysqli_query($conn, "SELECT client_id, client_name FROM CLIENT WHERE client_email = '$username'");
    $row = mysqli_fetch_assoc($query_client_id);
    $client_id = $row['client_id'];
    // echo "<script type='text/javascript'>console.log(".$client_id.")</script>";

    $message = "<h4 align='center' > BIENVENIDO, ".$row['client_name']."</h4>";
    $query_client = mysqli_query($conn,"SELECT * FROM CLIENT WHERE client_id = $client_id");
    $query_rental = mysqli_query($conn,"SELECT * FROM RENTAL WHERE fk_client_id = $client_id");
    $query_sanction = mysqli_query($conn,"SELECT * FROM SANCTION WHERE fk_client_id = $client_id");
    $query_cd = mysqli_query($conn,"SELECT * FROM CD WHERE cd_id = $client_id");
    /*
    $array_cd = mysqli_fetch_array($query_cd);
    $array_client = mysqli_fetch_array($query_client);
    $array_rental = mysqli_fetch_array($query_rental);
    $array_sanction = mysqli_fetch_array($query_sanction);
    */
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
    <link rel="stylesheet" href="assets/css/style.css" >
    <script>
        function visible(element)
            {
            var elemento = document.getElementById(element);
            elemento.style.display = "unset";
            }
            function invisible(element)
            {
            var elemento = document.getElementById(element);
            elemento.style.display = "none";
            }
    </script>
    <script>
    import {MDCDataTable} from '@material/data-table';
const dataTable = new MDCDataTable(document.querySelector('.mdc-data-table'));
    </script>
</head>
<body >
<header>
    
    <a href="lobby.php"><img id="logo_lobby" src="assets/css/images/logo.png" alt="logo"></a>
    <nav  >
        <ul>
            
            <li>  <a id="logo_config" href="lobby_config.php"><img  src="assets/css/images/logo_config.png" alt="logo config"></a> </li>
            <li>  <a id="lobby_logout" href="logout.php"> Salir </a>  </li>
        </ul>
       
    </nav>

   
</header>

<?php if(!empty($message)): ?>
 <?= $message ?> 
<?php endif; ?>


<h1 > Lista de tablas </h1>

<section>

    <div id="div1">
            <button onDblclick="invisible('t_client')" onclick="visible('t_client')" >  Mis datos personales </button> 
            <button onDblclick="invisible('t_rental')" onclick="visible('t_rental')" >Mis alquileres </button> 
            <button onDblclick="invisible('t_sanction')" onclick="visible('t_sanction')" >Mis sanciones </button> 
            <button onDblclick="invisible('t_cd')" onclick="visible('t_cd')" > Lista de CDs </button> 
    </div>

<div id="div_client">
<table id = "t_client">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Tema de interes</th>
                        <th scope="col">Fecha de registro</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    foreach($query_client as $row){ ?>
                        <tr>
                            <td> <?php echo $row['client_name']; ?></td>
                            <td> <?php echo $row['client_email']; ?></td>
                            <td> <?php echo $row['client_nro_dni']; ?></td>
                            <td> <?php echo $row['client_date_birth']; ?></td>
                            <td> <?php echo $row['client_phone']; ?></td>
                            <td> <?php echo $row['client_direction']; ?></td>
                            <td> <?php echo $row['client_topic_interest']; ?></td>
                            <td> <?php echo $row['client_registration_date']; ?></td>
                            <td> <?php echo $row['client_status']; ?></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
</div>

<div id="div_rental">
     <table id = "t_rental">
                <thead>
                    <tr>
                        <th scope="col">Fecha de renta</th>
                        <th scope="col">Valor de renta</th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    foreach($query_rental as $row){ ?>
                        <tr>
                            <td> <?php echo $row['rental_date']; ?></td>
                            <td> <?php echo $row['rental_value']; ?></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
</div>

<div id="div_sanction">
<table id = "t_sanction">
                <thead>
                    <tr>
                        <th scope="col">Tipo de penalizacion</th>
                        <th scope="col">Dias de penalizacion</th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    foreach($query_sanction as $row){ ?>
                        <tr>
                            <td> <?php echo $row['sanction_type_penalization']; ?></td>
                            <td> <?php echo $row['sanction_nrodays_penalization']; ?></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
</div>

<div id="div_cd">
<table id = "t_cd">
                <thead>
                    <tr>
                        <th scope="col">Condicion</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody >
                    <?php
                    foreach($query_cd as $row){ ?>
                        <tr>
                            <td> <?php echo $row['cd_condition']; ?></td>
                            <td> <?php echo $row['cd_location']; ?></td>
                            <td> <?php echo $row['cd_status']; ?></td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
</div>
   

</section>




<footer> &copy; 2019 CD </footer>
</body>
</html>
