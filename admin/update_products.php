<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details'];

        $update_products = "UPDATE products SET name='$name', price=$price, details='$details' WHERE id=$pid";
        $kq = mysqli_query($conn,$update_products);


        $message[]='Sản phẩm đã được cập nhật';
        

        $old_image_01 = $_POST['old_image_01'];
        $image_01 = $_FILES['image_01']['name'];
        $image_01_size = $_FILES['image_01']['size'];
        $image_01_tmp_name = $_FILES['image_01']['tmp_name']; 
        $image_01_folder = '../upload_img/'.$image_01;  

        if(!empty($image_01)){
            if($image_01_size > 2000000){
                $message[]= 'Kích thước ảnh quá lớn!!';
            }else{
                $update_image_01 = "UPDATE products SET image_01='$image_01' WHERE id=$pid";
                $result_update_image_01 = mysqli_query($conn,$update_image_01);
                move_uploaded_file($image_01_tmp_name,$image_01_folder);
                unlink('../upload_img/'.$old_image_01);
                $message[]= 'image 01 updated!!';
            }
        }

        $old_image_02 = $_POST['old_image_02'];
        $image_02 = $_FILES['image_02']['name'];
        $image_02_size = $_FILES['image_02']['size'];
        $image_02_tmp_name = $_FILES['image_02']['tmp_name']; 
        $image_02_folder = '../upload_img/'.$image_02; 

        if(!empty($image_02)){
            if($image_02_size > 2000000){
                $message[]= 'Kích thước ảnh quá lớn!!';
            }else{
                $update_image_02 = "UPDATE products SET image_02='$image_02' WHERE id=$pid";
                $result_update_image_02 = mysqli_query($conn,$update_image_02);
                move_uploaded_file($image_02_tmp_name,$image_02_folder);
                unlink('../upload_img/'.$old_image_02);
                $message[]= 'image 02 updated!!';
            }
        }

        $old_image_03 = $_POST['old_image_03'];
        $image_03 = $_FILES['image_03']['name'];
        $image_03_size = $_FILES['image_03']['size'];
        $image_03_tmp_name = $_FILES['image_03']['tmp_name']; 
        $image_03_folder = '../upload_img/'.$image_03; 

        if(!empty($image_03)){
            if($image_03_size > 2000000){
                $message[]= 'Kích thước ảnh quá lớn!!';
            }else{
                $update_image_03 = "UPDATE products SET image_03='$image_03' WHERE id=$pid";
                $result_update_image_03 = mysqli_query($conn,$update_image_03);
                move_uploaded_file($image_03_tmp_name,$image_03_folder);
                unlink('../upload_img/'.$old_image_03);
                $message[]= 'image 03 updated!!';
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
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php 
    include ("../components/admin_header.php");   
?>

<section class="update-products">
    <h1 class="heading">update products</h1>
    <?php 
        $count_products = "SELECT count(id) as tong FROM products";
        $result_count = mysqli_query($conn, $count_products);
        $dong = mysqli_fetch_array($result_count);  
        $number_of_products = $dong['tong'];
       
        $update_id = $_GET['update'];
        
        $sql = "SELECT * FROM products WHERE id = $update_id";
        $kq= mysqli_query($conn,$sql);
        
        

        if( $number_of_products > 0){
            while($row = mysqli_fetch_array($kq)){

    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
        
        <input type="hidden" name="old_image_01" value="<?php echo $row['image_01']; ?>">
        <input type="hidden" name="old_image_02" value="<?php echo $row['image_02']; ?>">
        <input type="hidden" name="old_image_03" value="<?php echo $row['image_03']; ?>">
        <div class="image-container">
            <div class="main-image">
                <img src="../upload_img/<?php echo $row['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
                <img src="../upload_img/<?php echo $row['image_01']; ?>" alt="">   
                <img src="../upload_img/<?php echo $row['image_02']; ?>" alt="">  
                <img src="../upload_img/<?php echo $row['image_03']; ?>" alt="">
            </div>
        </div>
        <span>update name</span>
        <input type="text" required placeholder="Enter product name" name="name" class="box" maxlength="100"
            value="<?php echo $row['name']; ?>">

        <span>update price</span>
        <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price"
            onkeypress="if(this.value.length == 10) return false;" name="price" value="<?php echo $row['price']; ?>"> 
            
        <span>update details</span>
        <textarea name="details" placeholder="enter product details" class="box"
            required maxlength="500" cols="30" rows="10" ><?php echo $row['details']; ?></textarea>    
    
        <span>update image 01</span>    
        <input type="file" name="image_01"
            class="box" accept="image/jpg, image/jpeg, image/png, image/webp" > 

        <span>update image 02</span> 
        <input type="file" name="image_02"
            class="box" accept="image/jpg, image/jpeg, image/png, image/webp" > 

        <span>update image 03</span>     
        <input type="file" name="image_03"
            class="box" accept="image/jpg, image/jpeg, image/png, image/webp" > 
        
        <div class="flex-btn">
            <input type="submit" value="update" class="option-btn" name="submit">
            <a href="products.php" class="option-btn">Go back</a>
        </div>
    </form>
    <?php
            
                    }
                }else{
                    echo '<p class="empty">không tìm thấy sản phẩm! </p>';
                } 
      
            ?>
</section>
    




    <script src="../js/admin_script.js"></script>
</body>
</html>