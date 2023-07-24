<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="admin_header.css" rel="stylesheet">
   <link href="style.css" rel="stylesheet">
</head>
<body>
<header class="header">

<section class="flex" style="padding:10px;height:113px">
   <a href="home.php" class="logo"><img src="logo.png" width="300" height="100"></a>
   <nav class="navbar">
      <ul>
         <li>
            <a href="home.php" class="link">home</a>
         </li>
         <li>
            <a href="about.php" class="link">about</a>
         </li>
         <li>
            <a href="menu.php" class="link">menu</a>
         </li>
         <li>
            <a href="orders.php" class="link">orders</a>
         </li>
         <li>
            <a href="contact.php" class="link">contact</a>
         </li>
      </ul>
   </nav>

   <div class="icons">
      <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
      ?>
      <a href="search.php"><i class="fa fa-search fa-lg" aria-hidden="true"></i></i></a>
      <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
      <div id="user-btn" class="fas fa-user"></div>
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p class="name"><?= $fetch_profile['name']; ?></p>
      <div class="flex">
         <a href="profile.php" class="btn">profile</a>
         <a href="user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>
      <p class="account">
         <a href="login.php">login</a> or
         <a href="register.php">register</a>
      </p> 
      <?php
         }else{
      ?>
         <p class="name">please login first!</p>
         <a href="login.php" class="btn">login</a>
      <?php
       }
      ?>
   </div>
   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>
   </section>
</header>
</body>
</html>
