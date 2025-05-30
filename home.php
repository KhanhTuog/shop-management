<?php
    session_start();   
    include('components/connect.php');
    // $user_id = $_SESSION['user_id'];
    $user_id= '';
    if(isset($_SESSION['user_id'])) {

    
        if($_SESSION['user_id']){
            $user_id = $_SESSION['user_id'];
        }
    }
    
    include ('components/wishlist_cart.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php 
    include ('components/user_header.php');
    
?>


    
        <div class="home-bg">
            
            <section class="swiper home">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="./images/product_img1.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>new adidas sneaker</h3>
                            <a href="shop.php" class="btn">Show now</a>
                        </div>
                    </div>
                   
                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="./images/product_img2.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>new nike sneaker</h3>
                            <a href="shop.php" class="btn">Show now</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="./images/product_img3.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>new newbalance sneaker </h3>
                            <a href="shop.php" class="btn">Show now</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </section>
        </div>

    
   
    <!-- home category -->
    <section class="home-category">

    <h1 class="heading">shop by category</h1>

    <div class="swiper category-slider">

    <div class="swiper-wrapper">

        <a href="category.php?category=adidas" class="swiper-slide slide">
            <img src="images/icon1.png" alt="">
            <h3>Adidas</h3>
        </a>

        <a href="category.php?category=nike" class="swiper-slide slide">
            <img src="images/icon2.png" alt="">
            <h3>nike</h3>
        </a>

        <a href="category.php?category=vans" class="swiper-slide slide">
            <img src="images/icon3.png" alt="">
            <h3>vans</h3>
        </a>

        <a href="category.php?category=new_balance" class="swiper-slide slide">
            <img src="images/icon6.png" alt="">
            <h3>newbalance</h3>
        </a>

        <a href="category.php?category=converse" class="swiper-slide slide">
            <img src="images/icon5.png" alt="">
            <h3>converse</h3>
        </a>

        <a href="category.php?category=puma" class="swiper-slide slide">
            <img src="images/icon4.png" alt="">
            <h3>puma</h3>
        </a>

    

    </div>

   <div class="swiper-pagination"></div>

   </div>

</section>
<!-- home product section -->
<section class="home-products">

   <h1 class="heading">latest products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
    $select_products = "SELECT * FROM products LIMIT 6"; 
    $result_products = mysqli_query($conn, $select_products);

    $count_product = "SELECT count(id) as total FROM products  ";
    $result_count = mysqli_query($conn,$count_product);
    $dong = mysqli_fetch_array($result_count);  
    $number_of_products = $dong['total'];
    

    if($number_of_products > 0){
        while($row = mysqli_fetch_array($result_products))
        {   
   ?>
   <form action="" method="post" class="slide swiper-slide">
        <input type="hidden" name = "pid" value="<?php echo $row['id']; ?>">
        <input type="hidden" name = "name" value="<?php echo $row['name']; ?>">
        <input type="hidden" name = "price" value="<?php echo $row['price']; ?>">
        <input type="hidden" name = "image" value="<?php echo $row['image_01']; ?>">
        <input type="hidden" name="size" value="<?= $row['size']; ?>">
        
        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?php echo $row['id']; ?>" class="fas fa-eye"></a>
        <img src="upload_img/<?php echo $row['image_01']; ?>" alt="">
        <div class="name"><?php echo $row['name']; ?></div>
        <div class="flex">
            <div  div class="price"><span>đ</span><?php echo number_format($row['price']); ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
        </div>
        
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>
   



    <?php  include ("./components/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper(".home", {
        loop:true,
        grabCursor:true,
        pagination: {
          el: ".swiper-pagination",
        },
      });

      var swiper = new Swiper(".category-slider", {
        loop:true,
        grabCursor:true,
                spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
           
          },
          768: {
            slidesPerView: 3,
            
          },
          1024: {
            slidesPerView: 4,
            
          },
        },
      });

      var swiper = new Swiper(".products-slider", {
        loop:true,
        grabCursor:true,
                spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
            550:{
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            
            },
            1024: {
                slidesPerView: 3,
            },
        },
      });
    </script>
    <script src="javascript/script.js"></script>
</body>
</html>