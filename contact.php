<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $msg = $_POST['msg'];

        $select_message = "SELECT * FROM messages WHERE name ='$name' AND email= '$email' AND number = $number AND message = '$msg'";
        $result_message = mysqli_query($conn,$select_message);

        if(mysqli_num_rows($result_message) > 0){
            $message[] = 'đã gửi tin nhắn!';
        }else{
            $insert_message = "INSERT INTO messages(user_id, name, email, number, message) 
            VALUES($user_id,'$name','$email',$number,'$msg' )";
            $result_insert = mysqli_query($conn,$insert_message);

            $message[] = 'đã gửi tin nhắn thành công!';
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="contact">

        <form action="" method="POST">
            <h3>get in touch</h3>
            <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
            <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
            <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
            <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
    </section>
   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>