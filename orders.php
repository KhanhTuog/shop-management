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
    <title>orders</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="orders">

        <h1 class="heading">placed orders</h1>

        <div class="box-container">

        <?php
            if($user_id == ''){
                echo '<p class="empty">vui lòng đăng nhập để xem đơn đặt hàng của bạn</p>';
            }else{
                $select_orders = "SELECT * FROM orders WHERE user_id = $user_id";
                $result = mysqli_query($conn,$select_orders);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
        ?>
            <div class="box">
                <p>placed on : <span><?= $row['placed_on']; ?></span></p>
                <p>name : <span><?= $row['name']; ?></span></p>
                <p>email : <span><?= $row['email']; ?></span></p>
                <p>number : <span><?= $row['number']; ?></span></p>
                <p>address : <span><?= $row['address']; ?></span></p>
                <p>payment method : <span><?= $row['method']; ?></span></p>
                <p>your orders : <span><?= $row['total_products']; ?></span></p>
                <p>size: <span><?= $row['size']; ?></span></p>
                <p>total price : <span>đ<?= number_format($row['total_price']); ?>/-</span></p>
                <p> payment status : <span style="color:<?php if($row['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $row['payment_status']; ?></span> </p>
            </div>
        <?php
        }
        }else{
            echo '<p class="empty">no orders placed yet!</p>';
        }
        }
   ?>

   </div>

</section>

   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>