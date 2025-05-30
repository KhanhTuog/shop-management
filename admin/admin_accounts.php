<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_admin = "DELETE FROM admin WHERE id = $delete_id";
        $result_delete = mysqli_query($conn,$delete_admin);
        header("Location: admin_accounts.php");
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
    <h1 class="heading">admins accounts</h1>
    <div class="box-container">
        <div class="box">
            <p>Register new admin</p>
            <a href="register_admin.php" class="option-btn">register</a>
        </div>

    <?php 
        $select_acount= "SELECT * FROM admin";
        $result = mysqli_query($conn, $select_acount);

        $count_acount = "SELECT count(id) as tong FROM admin";
        $result_count = mysqli_query($conn, $count_acount);
        $dong = mysqli_fetch_array($result_count);  
        $number_of_acount = $dong['tong'];
        if($number_of_acount > 0){
            while($row = mysqli_fetch_array($result)){     
    ?>
    <div class="box">
        <p>admin id: <?php echo $row['id']; ?></p>
        <p>user name: <?php echo $row['name']; ?></p>
        <div class="flex-btn">
            <a href="admin_accounts.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Xóa tài khoản này?')">
                delete
            </a>
            
            <?php
                if($row['id'] == $admin_id){
                    echo '<a href="update_profile.php" class="option-btn">update</a>';
                }
            ?>
        </div>
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