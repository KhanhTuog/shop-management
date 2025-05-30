<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    }
    include ('components/wishlist_cart.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="products">

   <h1 class="heading">category</h1>

   <div class="box-container">

    <?php
        $category = $_GET['category'];
        $select_products = "SELECT * FROM products WHERE name LIKE '%".$category."%'"; 
        
        $result_product = mysqli_query($conn,$select_products);

        
        if(mysqli_num_rows($result_product) > 0){
            while($row = mysqli_fetch_array($result_product)){
    ?>
    <form action="" method="POST" class="box">
        <input type="hidden" name="pid" value="<?= $row['id']; ?>">
        <input type="hidden" name="name" value="<?= $row['name']; ?>">
        <input type="hidden" name="price" value="<?= $row['price']; ?>">
        <input type="hidden" name="image" value="<?= $row['image_01']; ?>">
        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?php echo $row['id']; ?>" class="fas fa-eye"></a>
        <img src="upload_img/<?php echo $row['image_01']; ?>" alt="">
        <div class="name"><?php echo $row['name']; ?></div>
        <div class="flex">
            <div class="price"><span>đ</span><?= number_format($row['price']); ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
        </div>
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>
    <?php
        }
    }else{
        echo '<p class="empty">no products found!</p>';
    }
    ?>

   </div>

</section>
   






    <script src="javascript/script.js"></script>
</body>
</html>