<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="login_css.css">
   <style>
      .have{
         text-align: center;
         font-size: 20px;
         color: skyblue;
      }
   </style>
</head>
<body>
<section class="flex" style="padding:10px;height:113px">
   <a href="home.php" class="logo"><img src="logo.png" width="300" height="100"></a>
   </section>
<section class="form-container login-box">
   <form action="" method="post">
   <div class="user-box">
      <h2>Login</h2>
      <input type="email" name="email" required placeholder="enter your email" class="box user-box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" class="box user-box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
   </div>
      <input type="submit" value="login now" name="submit" class="btn">
      <p class="have">Don't have an account? <a href="register.php">register now</a></p>
   </form>
</section>
<!-- <?php include 'components/footer.php'; ?>  -->
<script src="script.js"></script>
</body>
</html>