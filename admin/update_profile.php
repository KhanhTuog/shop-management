<?php
    include('../components/connect.php');
    session_start();
    
    $admin_id = $_SESSION['admin_id'];
    
    $sql = "SELECT * FROM admin WHERE id=$admin_id";
    $kq = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($kq);
    
    
    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header("Location: admin_login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name']; 
        $update_name = "UPDATE admin SET name='$name' WHERE id = $admin_id";
        $result_name = mysqli_query($conn, $update_name);

        $empty_pass = '';
        $prev_pass = $row['password'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        if($old_password == $empty_pass){
            $message[]='Please enter old password!';
        } elseif($old_password != $prev_pass){
            $message[]='Old password not matched !';
        } elseif($new_password != $confirm_password){
            $message[]='Confirm password not matched !';
        }  else{
            if($new_password != $empty_pass){  
                $update_password = "UPDATE admin SET password='$new_password' WHERE id = $admin_id";
                $result_pass = mysqli_query($conn,$update_password);
                $message[] = 'password update succesfull!';
            }else{
                $message[]='Please enter ther new password !';

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
    <title>Update profile</title>
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
    <form action="update_profile.php" method="POST">
            <h3>update profile</h3>
            <input type="hidden" name="prev_pass" value="<?php echo $row['password']; ?>">
            <input type="text" name="name" maxlength="20" require placeholder = "Enter your username" class="box" value=
            "<?php echo $row['name']; ?>">
            <input type="password" name="old_password" maxlength="20"  placeholder = "Enter your old password" class="box">
            <input type="password" name="new_password" maxlength="20"  placeholder = "Enter your new password" class="box">
            <input type="password" name="confirm_password" maxlength="20"  placeholder = "Confirm your new password" class="box">
            <input type="submit" value="update now" name="register" class="btn">
    </form>
</section>














<!-- liên kết tệp js tùy chỉnh -->
<script src="../js/admin_script.js"></script>
    
</body>
</html>