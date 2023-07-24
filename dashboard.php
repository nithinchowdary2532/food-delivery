<?php
include 'connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <style>
      a{
         text-decoration: none;
      }
      .box{
         height:200px;
         opacity: 0.7;
      }
      .btn{
         font-size:20px;  

      }
      .dashboard{
         background-image: url('https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.enukesoftware.com%2Fblog%2Fbest-subscription-based-food-delivery-apps-in-2017.html%2Fflat-lay-free-food-service-arrangement-with-background-mock-up_23-2148421300&psig=AOvVaw3Ifg1XvDqA5FHZVbc4F7Ek&ust=1686990541378000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCODlwM-vx_8CFQAAAAAdAAAAABAI');
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-size: 100% 100%;
         height: 130%;
      }
      .text{
         opacity:1;
         font-weight: 100;
      }
   </style>

</head>
<body>

<div class="parent">
<?php include 'admin_header.php' ?>
<section class="dashboard">
   <h1 class="heading" style="padding-top: 20px;">dashboard</h1>
   <div class="box-container">
      <div class="row" style="margin-top: 40px;">
   <div class="box col ">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn btn-primary">update profile</a>
   </div>
   <div class="box col btn-sm">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><span>₹</span><?= $total_pendings; ?><span>/-</span></h3>
      <p class="text">total pendings</p>
      <a href="placed_orders.php" class="btn btn-primary">see orders</a>
   </div>

   <div class="box col">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>₹</span><?= $total_completes; ?><span>/-</span></h3>
      <p class="text">total completes</p>
      <a href="placed_orders.php" class="btn btn-primary">see orders</a>
   </div>
    
   <div class="box col">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p class="text">total orders</p>
      <a href="placed_orders.php" class="btn btn-primary">see orders</a>
   </div>
   </div>

   <div class="row" style="margin-top:40px;margin-bottom:20px;">
   <div class="box col">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p class="text">products added</p>
      <a href="products.php" class="btn btn-primary">see products</a>
   </div>

   <div class="box col">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p class="text">users accounts</p>
      <a href="users_accounts.php" class="btn btn-primary">see users</a>
   </div>

   <div class="box col">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p class="text">admins</p>
      <a href="admin_accounts.php" class="btn btn-primary">see admins</a>
   </div>

   <div class="box col">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p class="text">new messages</p>
      <a href="messages.php" class="btn btn-primary">see messages</a>
   </div>
   </div>
   </div>
      </div>

</section>
<script src="admin_script.js"></script>

</body>
</html>