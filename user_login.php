<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    };
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $select_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
        $result_user = mysqli_query($conn,$select_user);
       
        if(mysqli_num_rows($result_user) > 0){
            $row = mysqli_fetch_array($result_user);
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
            
            if($row['role'] == 1){
                $_SESSION['role'] = 'user1';
                header('Location:home.php');
            }else{
                $_SESSION['role'] = 'user2';
                header('Location:home.php');
            }
            header("Location: home.php");
        }else{
            $message[]='Email hoặc password không chính xác';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php  include ("./components/user_header.php"); ?>
    
    <section class="form-container">

    <form action="" method="post">
        <h3>login now</h3>
        <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" >
        <input type="password" name="password" required placeholder="enter your password" maxlength="20"  class="box" >
        <input type="submit" value="login now" class="btn" name="submit">
        <p>don't have an account?</p>
        <a href="user_register.php" class="option-btn">register now</a>
    </form>

</section>
 





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>