<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /index1.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    //printf ("%s (%s)\n", $_POST['email'], $_POST['password']);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      
      
      
      if(!empty($_POST["remember"]))   
           {  
            setcookie ("email",$results['email'],time()+ (10 * 365 * 24 * 60 * 60));  
            setcookie ("password",$_POST['password'],time()+ (10 * 365 * 24 * 60 * 60));
           }  
           else  
           {  
            if(isset($_COOKIE["email"]))   
            {  
             setcookie ("email","");  
            }  
            if(isset($_COOKIE["password"]))   
            {  
             setcookie ("password","");  
            }  
           }  
      
      
      
      header("Location: /index1.php");
    } else {
      $message = 'Lo sentimos, las credecienciales no concuerdan';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Iniciar Sesion</h1>
    <span>o <a href="signup.php">Registrese aquí</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su correo electronico" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>"/>
      
      <input name="password" type="password" id="pass" placeholder="Ingrese su contraseña"  value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" />
      <input type="checkbox" onclick="myFunction()">Mostrar Contraseña<br>
      
      
      <div class="field-group">
		<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?> />
		<label for="remember-me">Recordar contraseña</label>
      </div>
      
      
      <input type="submit" value="Ingresar">
         
      
      <br>
      <br>

     <script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
        <a href="forgotpassword.php">¿Olvidaste tu Contraseña?</a>
        
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

