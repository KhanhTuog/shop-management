<?php
    session_start();   
    include('components/connect.php');
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $kq = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($kq);
    
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        $update_profile = "UPDATE users SET name = $name, email = $email WHERE id =  $user_id";
        $result_profile = mysqli_query($conn, $update_profile);

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
                $update_password = "UPDATE users SET password='$new_password' WHERE id = $user_id";
                $result_pass = mysqli_query($conn,$update_password);
                $message[] = 'password update succesfull!';
            }else{
                $message[]='Please enter the new password !';

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
    <title>update profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="form-container">

        <form action="" method="post">
            <h3>update now</h3>
            <input type="hidden" name="prev_pass" value="<?php echo $row['password']; ?>">
            <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" value=
            "<?php echo $row['name']; ?>" >
            <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" 
            value="<?php echo $row['email']; ?>" >
            <input type="password" name="old_password" placeholder="enter your old password" maxlength="20"  class="box" >
            <input type="password" name="new_password" placeholder="enter your new password" maxlength="20"  class="box" >
            <input type="password" name="confirm_password" placeholder="confirm your new password" maxlength="20"  class="box" >
            <input type="submit" value="update now" class="btn" name="submit">
        </form>

</section>

   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>