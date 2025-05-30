<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    };
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);

        $select_user = "SELECT * FROM users WHERE email = '$email'";
        $result_select_user = mysqli_query($conn, $select_user);
        

        if(mysqli_num_rows($result_select_user) > 0){
            $message[] ='Email đã tồn tại' ;
        }else {
            if($password != $cpassword){
                $message[] = 'password không chính xác!';
            }else{
                $insert_user ="INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password',0)";
                mysqli_query($conn, $insert_user);
                $message[] = 'Đăng kí thành công!';
                
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php  include ("./components/user_header.php"); ?>
    <section class="form-container">

    <form action="" method="post">
        <h3>register now</h3>
        <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box">
        <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" >
        <input type="password" name="password" required placeholder="enter your password" maxlength="20"  class="box" >
        <input type="password" name="cpassword" required placeholder="confirm your password" maxlength="20"  class="box" >
        <input type="submit" value="register now" class="btn" name="submit">
        <p>already have an account?</p>
        <a href="user_login.php" class="option-btn">login now</a>
    </form>

</section>

   




<!-- pass:user01 -->
    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>