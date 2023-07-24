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
   <title>header</title>
   <link href="admin_header.css" rel="stylesheet">
   <link href="style.css" rel="stylesheet">
</head>
<body>
   

<header class="header">
   <section class="flex" style="padding:10px;height:113px">
      <a href="dashboard.php" class="logo"><img src="logo.png" width="300" height="100"></a>

      <nav class="navbar">
         <ul>
            <li>
               <a href="dashboard.php" class="link">home</a>
            </li>
            <li>
               <a href="products.php" class="link">products</a>
            </li>
            <li>
               <a href="placed_orders.php" class="link">orders</a>
            </li>
            <li>
               <a href="admin_accounts.php" class="link">admins</a>
            </li>
            <li>
               <a href="users_accounts.php" class="link">users</a>
            </li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
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