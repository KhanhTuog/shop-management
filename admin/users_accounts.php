<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_user = "DELETE FROM users WHERE id = $delete_id";
        $result_user = mysqli_query($conn,$delete_user);

        $delete_order = "DELETE FROM orders WHERE user_id = $delete_id";
        $result_order = mysqli_query($conn,$delete_order);

        $delete_cart = "DELETE FROM cart WHERE user_id = $delete_id";
        $result_cart = mysqli_query($conn,$delete_cart);

        $delete_wishlist = "DELETE FROM wishlist WHERE user_id = $delete_id";
        $result_wishlist = mysqli_query($conn,$delete_delete_wishlist);

        $delete_messages = "DELETE FROM messages WHERE user_id = $delete_id";
        $result_wishlist = mysqli_query($conn,$delete_messages);

        header("Location: users_accounts.php"); 
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
<section class="accounts">
    <h1 class="heading">user accounts</h1>
    <div class="box-container">
        

    <?php 
        $select_acount= "SELECT * FROM users";
        $result = mysqli_query($conn, $select_acount);

        $count_acount = "SELECT count(id) as tong FROM users";
        $result_count = mysqli_query($conn, $count_acount);
        $dong = mysqli_fetch_array($result_count);  
        $number_of_acount = $dong['tong'];
        if($number_of_acount > 0){
            while($row = mysqli_fetch_array($result)){     
    ?>
    <div class="box">
        <p>user id: <?php echo $row['id']; ?></p>
        <p>username: <?php echo $row['name']; ?></p>
        <a href="users_accounts.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Xóa tài khoản này?')">
                delete
            </a>
    </div>
    <?php
           }
        }else{
            echo '<p class="empty">Không có tài khoản!</p>';
        }
    ?>
    </div>

</section>

    




    <script src="../js/admin_script.js"></script>
</body>
</html>