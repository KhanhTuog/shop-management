<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_messages = "DELETE FROM messages WHERE id = $delete_id";
        $result_delete = mysqli_query($conn,$delete_messages);
        header("Location: messages.php");
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
<section class="messages">
    <h1 class="heading">new messages</h1>
    <div class="box-container">

        <?php
            $select_messages = "SELECT * FROM messages";
            $result_messages = mysqli_query($conn,$select_messages);

            $count_messages = "SELECT count(id) as tong FROM messages";
            $result_count = mysqli_query($conn, $count_messages);
            $dong = mysqli_fetch_array($result_count);  
            $number_of_messages = $dong['tong'];
            if($number_of_messages > 0){
                while($row = mysqli_fetch_array($result_messages)){

        ?>
        <div class="box">
            <p>user id : <span><?php echo $row['user_id']; ?></span></p>
            <p>name  : <span><?php echo $row['name']; ?></span></p>
            <p>number : <span><?php echo $row['number']; ?></span></p>
            <p>email : <span><?php echo $row['email']; ?></span></p>
            <p>messages : <span><?php echo $row['message']; ?></span></p>
            <a href="messages.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Xóa tin nhắn này?')">
                delete</a>
        </div>
        <?php
              }
            } else{
                echo '<p class="empty">Bạn không có tin nhắn nào!</p>';
            }   
        ?>
    </div>

</section>

    




    <script src="../js/admin_script.js"></script>
</body>
</html>