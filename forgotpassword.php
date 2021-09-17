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

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
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

    <h2>Enter the Email of Your Account to Reset New Password</h2>
<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<div class="container">
    <div class="regisFrm">
        <form action="userAccount.php" method="post">
            <input type="email" name="email" placeholder="EMAIL" required="">
            <div class="send-button">
                <input type="submit" name="forgotSubmit" value="CONTINUE">
            </div>
        </form>
    </div>
</div>
    

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
