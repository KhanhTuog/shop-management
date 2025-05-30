<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
    }
    if(isset($_POST['update_payment'])){   
        $order_id = $_POST['order_id'];
        $payment_status = $_POST['payment_status'];
        $update_payment = "UPDATE orders SET payment_status='$payment_status' WHERE id=$order_id";
        $result_update = mysqli_query($conn,$update_payment);
        // echo $update_payment;
       
        $message[]= 'Tình trạng thanh toán được cập nhật!';     
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_order = "DELETE FROM orders WHERE id = $delete_id";
        $result_delete = mysqli_query($conn,$delete_order);
        header("Location: placed_orders.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php 
    include ("../components/admin_header.php");   
?>

<section class="placed-orders">
    <h1 class="heading"> Placed orders</h1>
    <div class="box-container">
    
    <?php
        $select_orders = "SELECT * FROM orders";
        $result_orders = mysqli_query($conn,$select_orders);

        $count_orders = "SELECT count(id) as tong FROM orders";
        $result_count = mysqli_query($conn, $count_orders);
        $dong = mysqli_fetch_array($result_count);  
        $number_of_products = $dong['tong'];

        if($number_of_products > 0){
            while($row = mysqli_fetch_array($result_orders)){ 
    ?>
    <div class="box">
        <p>user_id <span><?php echo $row['user_id']; ?></span></p>
        <p>placed on <span><?php echo $row['placed_on']; ?></span></p>
        <p>name <span><?php echo $row['name']; ?></span></p>
        <p>email  <span><?php echo $row['email']; ?></span></p>
        <p>number  <span><?php echo $row['number']; ?></span></p>
        <p>address  <span><?php echo $row['address']; ?></span></p>
        <p>total products  <span><?php echo $row['total_products']; ?></span></p>
        <p>size  <span><?php echo $row['size']; ?></span></p>
        <p>total price  <span>đ<?php echo number_format($row['total_price']); ?></span></p>
        <p>payment method  <span><?php echo $row['method']; ?></span></p> 
        <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
            <select name="payment_status" class="drop-down">
                <option  selected disabled><?php echo $row['payment_status']; ?></option>
                <option value="pending">pending</option>
                <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
                <input type="submit" value="update" class="btn" name="update_payment">
                <a href="placed_orders.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Xóa đơn đặt hàng này?')">
                            delete
                        </a>
            </div>
        </form>
    </div>
    <?php 
        }
    }else{
        echo '<p class="empty">Chưa có đơn hàng nào được đặt!</p>';
    }
    ?>
    </div>
</section>

    




    <script src="../js/admin_script.js"></script>
</body>
</html>