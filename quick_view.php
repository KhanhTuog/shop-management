<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    }
    include 'components/wishlist_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quick view</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="quick-view">

   <h1 class="heading">quick view</h1>

    <?php
        $pid = $_GET['pid'];
        $select_products = "SELECT * FROM `products` WHERE id = $pid"; 
        $result_products = mysqli_query($conn,$select_products);
        if(mysqli_num_rows($result_products) > 0){
        while($row = mysqli_fetch_array($result_products)){
    ?>
    <form action="" method="POST" class="box">
      <input type="hidden" name="pid" value="<?= $row['id']; ?>">
      <input type="hidden" name="name" value="<?= $row['name']; ?>">
      <input type="hidden" name="price" value="<?= $row['price']; ?>">
      <input type="hidden" name="image" value="<?= $row['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="upload_img/<?= $row['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="upload_img/<?= $row['image_01']; ?>" alt="">
               <img src="upload_img/<?= $row['image_02']; ?>" alt="">
               <img src="upload_img/<?= $row['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $row['name']; ?></div>
            <div class="flex">
               <div class="price"><span>đ</span><?= number_format($row['price']); ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="flex">
               <div class="name"> size </div>
               <select name="size" class="drop-down1">
                            
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                        </select>
            </div>
            <div class="details"><?= $row['details']; ?></div>
            <div class="flex-btn">
               <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</section>
   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>