
<?php 
require 'connection.php' ;


$message = '';
$message2 = '';


if (!empty($_POST['client_id']) && !empty($_POST['client_direction']) && !empty($_POST['client_phone']) 
&& !empty($_POST['client_name']) && !empty($_POST['client_email']) && !empty($_POST['client_nro_dni'])
&& !empty($_POST['client_date_birth']) && !empty($_POST['client_registration_date']) 
&& !empty($_POST['client_topic_interest'])  ){

    $client_id = $_POST['client_id'];
    $client_direction = $_POST['client_direction'];
    $client_phone = $_POST['client_phone'];
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_nro_dni = $_POST['client_nro_dni'];
    $client_date_birth = $_POST['client_date_birth'];
    $client_registration_date = $_POST['client_registration_date'];
    $client_topic_interest = $_POST['client_topic_interest'];

    $sql_reset1 = "ALTER TABLE CLIENT AUTO_INCREMENT = 0";
    $sql_reset2 = "ALTER TABLE RENTAL AUTO_INCREMENT = 0";
    $sql_reset3 = "ALTER TABLE SANCTION AUTO_INCREMENT = 0";
    $sql_reset4 = "ALTER TABLE RENTALDETAIL AUTO_INCREMENT = 0";
    $sql_reset5 = "ALTER TABLE CD AUTO_INCREMENT = 0";
    $result_reset = mysqli_query($conn,$sql_reset1);
    $result_reset = mysqli_query($conn,$sql_reset2);
    $result_reset = mysqli_query($conn,$sql_reset3);
    $result_reset = mysqli_query($conn,$sql_reset4);
    $result_reset = mysqli_query($conn,$sql_reset5);


    $sql_verify_registry = mysqli_query($conn,"SELECT client_id,client_email FROM CLIENT WHERE 
    client_id = '$client_id' OR client_email = '$client_email' ");
    if(mysqli_num_rows($sql_verify_registry) > 0 ){
        echo "<script>
         alert('El codigo o email ya estan resgistrados, porfavor cambielos');
         window.history.go(-1);
         </script>";
         exit;
    }else{

        $sql_insert = "INSERT INTO CLIENT (client_id, client_direction, client_phone,client_name,client_email,
        client_nro_dni,client_date_birth,client_registration_date,client_topic_interest) 
    VALUES ('$client_id','$client_direction','$client_phone','$client_name','$client_email',
    '$client_nro_dni','$client_date_birth','$client_registration_date','$client_topic_interest') ";

    $result = mysqli_query($conn,$sql_insert);

    if($result){
        $sql_insert = "INSERT INTO RENTAL (fk_client_id) SELECT client_id FROM CLIENT WHERE client_id = '$client_id' ";
        $result = mysqli_query($conn,$sql_insert);
        if($result){
            $sql_insert = "INSERT INTO SANCTION (fk_client_id,fk_rental_id) SELECT fk_client_id,rental_id FROM RENTAL WHERE fk_client_id = '$client_id' ";
            $result = mysqli_query($conn,$sql_insert);
            if($result){
                $sql_insert = "INSERT INTO CD (cd_id) SELECT fk_client_id FROM RENTAL WHERE fk_client_id = '$client_id' ";
                $result = mysqli_query($conn,$sql_insert);
                $sql_insert = "INSERT INTO RENTALDETAIL (fk_rental_id, fk_cd_id) SELECT rental_id,fk_client_id FROM RENTAL WHERE fk_client_id = '$client_id' ";
                $result = mysqli_query($conn,$sql_insert);
                if($result){
                    $message = "<font color='#1B5E20'> REGISTRO EXITOSO </font>";
                    header("refresh:1; index.php");
                }else{
                    $message = "<font color='#D50000'> REGISTRO FALLIDO #4 </font>";
                }
            }else{
                $message = "<font color='#D50000'> REGISTRO FALLIDO #3 </font>";
            }

        }else{
            $message = "<font color='#D50000'> REGISTRO FALLIDO #2 </font>";
        }

  }else{

      $message = "<font color='#D50000'> REGISTRO FALLIDO #1 </font>";
  }
    }
}else{

    if (!empty($_POST['client_id']) || !empty($_POST['client_direction']) || !empty($_POST['client_phone']) 
    || !empty($_POST['client_name']) || !empty($_POST['client_email']) || !empty($_POST['client_nro_dni'])
    || !empty($_POST['client_date_birth']) || !empty($_POST['client_registration_date']) 
    || !empty($_POST['client_topic_interest'])  ){
     $message2 =  "<font color='#FF6D00'> No pueden quedar campos vacios </font>";
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
    <title>Registro</title>
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

<h1>Crear Cuenta</h1> 

<?php if(!empty($message)): ?>
<p> <?= $message ?> </p>
<?php endif; ?>

<form action="signup.php" method="post">

    <input type="password" name="client_id" placeholder="Codigo">
    <input type="text" name="client_direction" placeholder="Direccion">
    <input type="text" name="client_phone" placeholder="Telefono">
    <input type="text" name="client_name" placeholder="Nombre">
    <input type="text" name="client_email" placeholder="Correo">
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

    <input type="submit" value="Registrarse">
    
</form>
<?php if(!empty($message2)): ?>
     <?= $message2 ?> 
    <?php endif; ?>

<p class='subtext'> ¡Ya tengo cuenta! <a class="subtext_link" href="index.php"> Iniciar sesión</a> </span> </p> 

 <footer> &copy; 2019 CD </footer>

</body>
</html>
