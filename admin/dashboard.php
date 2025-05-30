<?php
    include('../components/connect.php');
    
    session_start();
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header("Location: admin_login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    
</head>
<body>
<?php 
    include ("../components/admin_header.php");     
?>
<section class="dashboard">
    <h1 class="heading">Bảng điều khiển</h1>
    <div class="box-container">
        <div class="box">
            <h3>welcome!</h3>
            <?php
                    
                        echo '<p>'.$_SESSION['name'].'</p>';
                    
                ?>
        <a href="update_profile.php" class="btn">Update Profile</a>
        </div>
        <div class="box">
        <?php
                $total_pendings = 0;
                $select_pendings = "SELECT * FROM orders WHERE payment_status ='pending'";
                $result = mysqli_query($conn, $select_pendings);
                while($row = mysqli_fetch_array($result)){
                    $total_pendings += $row['total_price'];
                }
            ?>
            <h3><span>đ</span><?php echo number_format($total_pendings); ?><span>/-</span></h3>
            <p>total pendings</p>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
        <?php
                $total_completes = 0;
                $select_completes = "SELECT * FROM orders WHERE payment_status ='completed'";
                $result = mysqli_query($conn, $select_completes);
                while($row = mysqli_fetch_array($result)){
                    $total_completes += $row['total_price'];
                }
            ?>
            <h3><span>đ</span><?php echo number_format($total_completes); ?><span>/-</span></h3>
            <p>total completes</p>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
                $select_orders = "SELECT count(id) as total FROM orders ";
                $result = mysqli_query($conn, $select_orders);
                $row = mysqli_fetch_array($result);  
                $number_of_orders = $row['total'];
            ?>
            <h3><?php echo $number_of_orders; ?></h3>
            <p>total orders</p>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php
                $select_products = "SELECT count(id) as total FROM products ";
                $result = mysqli_query($conn, $select_products);
                $row = mysqli_fetch_array($result);  
                $number_of_products = $row['total'];
            ?>
            <h3><?php echo $number_of_products; ?></h3>
            <p>Products added</p>
            <a href="products.php" class="btn">see products</a>
        </div>
    

        <div class="box">
            <?php
                $select_users = "SELECT count(id) as total FROM users ";
                $result = mysqli_query($conn, $select_users);
                $row = mysqli_fetch_array($result);  
                $number_of_users = $row['total'];
            ?>
            <h3><?php echo $number_of_users; ?></h3>
            <p>Users acounts</p>
            <a href="users_accounts.php" class="btn">see users</a>
        </div>

        <div class="box">
            <?php
                $select_admin = "SELECT count(id) as total FROM admin ";
                $result = mysqli_query($conn, $select_admin);
                $row = mysqli_fetch_array($result);  
                $number_of_admin = $row['total'];
            ?>
            <h3><?php echo $number_of_admin; ?></h3>
            <p>total admin</p>
            <a href="admin_accounts.php" class="btn">see admin</a>
        </div>

        <div class="box">
            <?php
                $select_messages = "SELECT count(id) as total FROM messages ";
                $result = mysqli_query($conn, $select_messages);
                $row = mysqli_fetch_array($result);  
                $number_of_messages = $row['total'];
            ?>
            <h3><?php echo $number_of_messages; ?></h3>
            <p>total messages</p>
            <a href="messages.php" class="btn">see messages</a>
        </div>
    </div>    

</section>













<!-- liên kết tệp js tùy chỉnh -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>