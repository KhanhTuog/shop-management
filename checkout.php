<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
        header('Location: home.php'); 
    }
    include ('components/wishlist_cart.php');

    if(isset($_POST['order'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $address = $_POST['address'];
        $total_products = $_POST['total_products'];
        $total_price = $_POST['total_price'];
        $size = $_POST['size'];
        
       
        $check_cart = "SELECT * FROM cart WHERE user_id = $user_id";
       
        $result = mysqli_query($conn,$check_cart);
        
        if(mysqli_num_rows($result) > 0){

            $insert_order = "INSERT INTO orders(user_id, name, number, email, method, address, total_products,size, total_price, payment_status) 
            VALUES($user_id,'$name',$number,'$email','$method','$address','$total_products',$size ,$total_price,'pending')";
            $result_order = mysqli_query($conn,$insert_order);


            $delete_cart = "DELETE FROM cart WHERE user_id = $user_id";
            $result_delete = mysqli_query($conn,$delete_cart);

            $message[] = 'đặt hàng thành công!';
        }else{
            $message[] = 'Giỏ của bạn trống trơn';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="checkout-orders">

        <form action="" method="POST">

            <h3>your orders</h3>

            <div class="display-orders">
            <?php
                $grand_total = 0;
                $cart_items = array();
                $cart_items = '';
                $select_cart = "SELECT * FROM cart WHERE user_id = $user_id";
                $result_cart = mysqli_query($conn,$select_cart);
                if(mysqli_num_rows($result_cart) > 0){
                    while($row = mysqli_fetch_array($result_cart)){
                        $cart_items = $row['name'].' ('.$row['price'].' x '. $row['quantity'].') - ';
                        $total_products = $cart_items;
                        $grand_total += ($row['price'] * $row['quantity']);
                        $hienthi = number_format($row['price']);
                        
            ?>  
            
                <p> <?= $row['name']; ?> <span>(<?= 'đ'.$hienthi.'/- x '. $row['quantity'].'/-size:'.$row['size'] ; ?>)</span> </p>
                <input type="hidden" name="size" value="<?= $row['size']; ?>">
            <?php
            
                    }
                }else{
                    echo '<p class="empty">Giỏ hàng của bạn đang trống!</p>';
                }
            ?>
                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>" >
            
                
                <div class="grand-total"> total : <span>đ<?= number_format($grand_total); ?></span></div>
            </div>

            <h3>place your orders</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Tên người nhận:</span>
                    <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
                </div>
                <div class="inputBox">
                    <span>SĐT :</span>
                    <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Phương thức thanh toán :</span>
                    <select name="method" class="box" required>
                        <option value="cash on delivery">Thanh toán khi nhận hàng</option>
                        <option value="credit card">credit card</option>
                        <option value="paytm">internet banking</option>
                    </select>
                </div>
                <div class="inputBox" style="width:100%">
                    <span>Địa chỉ nhận hàng  :</span>
                    <input type="text" name="address" placeholder="e.g. địa chỉ" class="box" maxlength="100" required>
                </div>
                
               
                
               
                
            </div>

            <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="đặt hàng">

        </form>

    </section>

   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>