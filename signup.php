<?php

  require 'database.php';
  //Creamos una nueva conceccion mediante mysqli ya que la generada por PDO no es compatible con llamados a filas fijas.
  $connectionli=mysqli_connect('fdb27.125mb.com','3785630_stressy','Iot2021_01','3785630_stressy');
  $message = '';
  
  
  function buscaRepetido($user,$conexion){
  $sql="SELECT * from users where email='$user'"; //Declaramos la seleccion de todas (*) las filas en nuestra tabla 'users' evaluando solo los emails
  $result=mysqli_query($conexion,$sql);//Generamos la orden de llamada, esta se hace solo una vez.

	if(mysqli_num_rows($result) > 0){// Esto me devuelve el numero de resultados de coincidencia.
		return 1;
	}else{
		return 0;
	}
  }
  

  if (!empty($_POST['email']) && !empty($_POST['password'])&& buscaRepetido($_POST['email'],$connectionli)==0) {//Evaluo no esta vacio y no esta repetido el user 
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado con exito';
    } else {
      $message = 'Lo sentimos, ah ocurrido un error, intente nuevamente';
    }
  } else if (!empty($_POST['email']) && !empty($_POST['password'])) {//Evaluo no esten vacios los cmapos de email y contraseña
    $message = 'Lo sentimos, el usuario ya existe, intenta con otro';
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrese</h1>
    <span>o <a href="login.php">Inicie sesión con una cuenta existente</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su email">
      <input name="password" type="password" placeholder="Ingrese su Contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme su contraseña">
      <input type="submit" value="Registrarse">
    </form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="background-color: rgb(47,47,47); color: white">
<footer class="container-fluid bg-4 text-center">
<br>
<br>
  <p>Stressy es un proyecto diseñado por Juan Andres Quiñonez, Jesus Puenayan y Juan Morales<br> <br> <a href="">https://web.facebook.com/Stressy-100499235514598?_rdc=1&_rdr</a></p>
  <br>
  <br>
  <br>
</footer>
</div>
  </body>
</html>
