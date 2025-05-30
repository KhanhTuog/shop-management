<?php
    include('../components/connect.php');
    
    session_start();
    // $admin_id = $_SESSION['admin_id'];
    // if(!isset($admin_id)){
    //     header("Location: admin_login.php");
    // }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"]; 
        $password = md5($_POST["password"]);
        $cpassword =  md5($_POST['cpassword']);
 
        
        $select = "SELECT * FROM admin WHERE name = '$name' AND password = '$password' ";
 
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $message[] ='người dùng đã tồn tại' ;
        }else {
            if($password != $cpassword){
                $message[] = 'password không chính xác!';
            }else{
                $insert_admin ="INSERT INTO admin(name,password,role) VALUES('$name','$password',0)";
                mysqli_query($conn, $insert_admin);
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
    <title>register</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    
</head>
<body>
<?php 
    include ("../components/admin_header.php");
?>
<!-- register admin -->
<section class="form-container">
    <form action="" method="POST">
            <h3>Register now</h3>
            <input type="text" name="name" maxlength="20" require placeholder = "Enter your username" class="box">
            <input type="password" name="password" maxlength="20" require placeholder = "Enter your password" class="box">
            <input type="password" name="cpassword" maxlength="20" require placeholder = "Confirm your password" class="box">
            <input type="submit" value="regiter now" name="register" class="btn">
    </form>
</section>














<!-- liên kết tệp js tùy chỉnh -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>