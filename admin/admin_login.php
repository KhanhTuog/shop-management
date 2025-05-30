<?php
    session_start();
    include('../components/connect.php');
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"]; 
        $password =md5($_POST["password"]);// pass: 111
 
        
        $sql = "SELECT * FROM admin WHERE name = '$name' AND password = '$password'";
 
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0 ){
            $row = mysqli_fetch_array($result);
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            if($row['role'] == 1){
                $_SESSION['role'] = 'admin';
                header('Location:dashboard.php');
            }else{
                $_SESSION['role'] = 'user';
                header('Location:dashboard.php');
            }
            
        }else{
            $message[] = 'user hoặc password không chính sác';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    
    <?php 
    if(isset($message)){
        foreach ($message as $message){
            echo '  <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
        }
    }
    ?>
    <section class="form-container">
        <form action="admin_login.php" method="POST">
            <h3>Login now</h3>
            <input type="text" name="name" maxlength="20" require placeholder = "Enter your username" class="box">
            <input type="password" name="password" maxlength="20" require placeholder = "Enter your password" class="box">
            <input type="submit" value="login now" name="submit" class="btn">
        </form>
    </section>
</body>
</html>
<!-- username:admin pass:admin -->
<!-- username:user00 pass:1 -->