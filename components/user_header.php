<?php 
  
  if(isset($message)){
      foreach ($message as $message){
          echo '  <div class="message">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
      }
  }
?>
<header class="header">
  
  <section class="flex">
      <a href="home.php" class="logo">S<span>hoping</span></a>

      <nav class="navbar">
          <a href="home.php">home</a>
          <a href="about.php">about</a>
          <a href="orders.php">orders</a>
          <a href="shop.php">shop</a>
          <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
          <?php 
            $wishlist_items = "SELECT * FROM wishlist WHERE user_id= $user_id";
            // echo $wishlist_items;
            $result_wishlist_items = mysqli_query($conn,$wishlist_items);
            $count_wishlist = "SELECT count(id) as total FROM wishlist WHERE user_id= '$user_id' ";
            $result_count_wishlist = mysqli_query($conn,$count_wishlist);
            $dong = mysqli_fetch_array($result_count_wishlist);   
            $number_of_wishlist = $dong['total'];
            

            $cart_items = "SELECT * FROM cart WHERE user_id= $user_id";
            // echo $cart_items;
            $result_cart_items = mysqli_query($conn,$cart_items);
            $count_cart = "SELECT count(id) as total FROM cart WHERE user_id= '$user_id' ";
            $result_count_cart = mysqli_query($conn,$count_cart);
            $dong = mysqli_fetch_array($result_count_cart);  
            $number_of_cart = $dong['total'];
          ?>
          <div id="menu-btn" class="fas fa-bars"></div>
          <a href="search_page.php"><i class="fas fa-search"></i></a>
          <?php
              if(isset($_SESSION['name'])){
          ?> 
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $number_of_wishlist; ?>)</span></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $number_of_cart; ?>)</span></a>
            <?php }else{ ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(0)</span></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(0)</span></a>
            <?php } ?>
            <div id="user-btn" class="fas fa-user"></div>

      </div>
      <div class="profile">
         <?php
         
              if(isset($_SESSION['name'])){
          ?> 
          <p><?php 
            echo '<p>'.$_SESSION['name'].'</p>'; 
              ?>
          </p>
      <a href="update_user.php" class="btn">update profile</a>
      <div class="flex-btn">
          <a href="user_register.php" class="option-btn">register</a>
          <a href="user_login.php" class="option-btn">login</a>
       </div>
       <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
       <?php
          }else{
       ?>
       <p>please login or register first!</p>
       <div class="flex-btn">
          <a href="user_register.php" class="option-btn">register</a>
          <a href="user_login.php" class="option-btn">login</a>
       </div>
      <?php
          }
      ?>
      </div>

  </section>
</header>