<?php
include 'connect.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
include 'add_cart.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <style>
      .{
         padding-top: 60%;
      }
      .btn{
         margin-left: 250px;
         margin-top: 100px;
      }
   .carousel {
      position: relative;
      display: flex;
      overflow: hidden;
      width: 100%;
      height: 400px;
   }
   .slide {
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      transition: opacity 1s ease-in-out;
   }

   .slide.active {
      opacity: 1;
   }
   .text {
      flex-basis: 50%;
      padding: 20px;
   }
   .image {
      flex-basis: 50%;
      text-align: center;
   }
   .image img {
      max-height: 120%;
      max-width: 120%;
   }
   .timer {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
   }
h3{
   font-size: 60px;
   margin-left: 30%;
   margin-top: 18%;
   
   
}
.onli{
   font-size: 2rem;
   position: absolute;
  top: 33%;
  right: 63.5%;
  transform: translate(0, -50%);
  padding: 10px;
  color: grey;
}
.but{
   margin-left: 400px;
}

</style>

</head>
<body>

<?php include 'user_header.php'; ?>


<div class="carousel">
    <div class="slide active">
      <div class="text">
      <span class="onli">order online</span>
        <h3>Roasted Chicken</h3>
        <a href="menu.html" class="btn but">see menus</a>
      </div>
      <div class="image">
        <img src="user_portal\roast.jpg" alt="Slide 1 Image">
      </div>
    </div>
    <div class="slide">
      <div class="text">
      <span class="onli">order online</span>
        <h3 style="margin-left: 40%;">Hot Fry Wings</h3>
        <a href="menu.html" class="btn but">see menus</a>
      </div>
      <div class="image">
        <img src="user_portal\hotwings.jpeg" width="509px" height="339px"  alt="Slide 2 Image">
      </div>
    </div>
    <div class="slide">
      <div class="text">
      <span class="onli">order online</span>
        <h3 style="margin-left: 40%;">Feast Pizza</h3>
        <a href="menu.html" class="btn but">see menus</a>
      </div>
      <div class="image">
        <img src="user_portal\ExtravaganZZa-Feast-Pizza-.jpg" width="509px" height="339px" alt="Slide 3 Image">
      </div>
    </div>
  </div>
<section class="category">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <a href="category.php?category=Non-Vegeterian" class="box">
         <img src="user_portal\non-veg.jpeg" alt="">
         <h3>Non-Vegeterian</h3>
      </a>

      <a href="category.php?category=vegeterian" class="box">
         <img src="user_portal\Vegetarian-Mapo-Tofu.webp" alt="">
         <h3>vegeterian</h3>
      </a>

      <a href="category.php?category=drinks" class="box">
         <img src="user_portal\drinks.jpeg" alt="">
         <h3>drinks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="user_portal\pizza.jpeg" alt="">
         <h3>pizza and Burgers</h3>
      </a>

   </div>

</section>




<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src=<?= $fetch_products['image']; ?> alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
   </div>

</section>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="script.js"></script>
<script>
        const slides = document.querySelectorAll('.slide');
        const delay = 3000; // Change this value to adjust the delay between slides
        
        let currentSlide = 0;
        
        function showSlide() {
          for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
          }
          slides[currentSlide].classList.add('active');
          currentSlide++;
          if (currentSlide >= slides.length) {
            currentSlide = 0;
          }
          setTimeout(showSlide, delay);
        }
        
        showSlide();
        
      </script>

</body>
</html>