<?php
    include '../components/connect.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
    header("Location: admin_login.php");
   
    }
    if(isset($_POST['add_product'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        

        $image_01 = $_FILES['image_01']['name'];
        $image_01_size = $_FILES['image_01']['size'];
        $image_01_tmp_name = $_FILES['image_01']['tmp_name']; 
        $image_01_folder = '../upload_img/'.$image_01;  

        $image_02 = $_FILES['image_02']['name'];
        $image_02_size = $_FILES['image_02']['size'];
        $image_02_tmp_name = $_FILES['image_02']['tmp_name']; 
        $image_02_folder = '../upload_img/'.$image_02; 

        $image_03 = $_FILES['image_03']['name'];
        $image_03_size = $_FILES['image_03']['size'];
        $image_03_tmp_name = $_FILES['image_03']['tmp_name']; 
        $image_03_folder = '../upload_img/'.$image_03; 

       
        
            if($image_01_size > 20000000 OR $image_02_size > 20000000 OR $image_03_size > 20000000){
                $message[]= 'Kích thước ảnh quá lớn!!';  
            } else{
                move_uploaded_file($image_01_tmp_name,$image_01_folder);
                move_uploaded_file($image_02_tmp_name,$image_02_folder);
                move_uploaded_file($image_03_tmp_name,$image_03_folder);

                $insert_product = "INSERT INTO products(name, details, price, image_01, image_02, image_03)
                VALUES('$name','$details',$price,'$image_01','$image_02','$image_03' )"; 
                
                $kq = mysqli_query($conn, $insert_product);
                
                // $result = mysqli_query($conn, $insert_product);
                $message[]= 'Sản phẩm đã được thêm thành công!';
            }
        
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_product_image = "SELECT * FROM products WHERE id=$delete_id";
        $result_delete_image = mysqli_query($conn,$delete_product_image);
        $row = mysqli_fetch_array($result_delete_image);
        
        unlink('../upload_img/'.$row['image_01']);
        unlink('../upload_img/'.$row['image_02']);
        unlink('../upload_img/'.$row['image_03']);

        $delete_product = "DELETE FROM products WHERE id=$delete_id";
        $result_products_delete = mysqli_query($conn,$delete_product);
        $delete_cart = "DELETE FROM cart WHERE id=$delete_id";
        $result_cart_delete = mysqli_query($conn,$delete_product);
        $delete_wishlist = "DELETE FROM wishlist WHERE id=$delete_id";
        $result_wishlist_delete = mysqli_query($conn,$delete_product);

        header("Location: products.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php 
    include ("../components/admin_header.php");   
?>

    <section class="add_products">
        <h1 class="heading">add products</h1>
        <form action="products.php" method="POST" enctype="multipart/form-data">
            
            <div class="flex">
                <div class="inputBox">
                    <span>product name(required)</span>
                    <input type="text" required placeholder="Enter product name" name="name" class="box" maxlength="100">
                </div>
                <div class="inputBox">
                    <span>product price(required)</span>
                    <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product size"
                     onkeypress="if(this.value.length == 10) return false;" name="price">
                </div>
                <!-- <div class="inputBox">
                    <span>product size(required)</span>
                    <input type="number" min="36" class="box" required max="43" placeholder="enter product price"
                     onkeypress="if(this.value.length == 10) return false;" name="size">
                </div> -->
                
                <div class="inputBox">
                    <span>image 01(required)</span>
                    <input type="file" name="image_01"
                     class="box" accept="image/jpg, image/jpeg, image/png, image/webp" require> 
                </div>
                <div class="inputBox">
                    <span>image 02(required)</span>
                    <input type="file" name="image_02"
                     class="box" accept="image/jpg, image/jpeg, image/png, image/webp" require> 
                </div>
                <div class="inputBox">
                    <span>image 03(required)</span>
                    <input type="file" name="image_03"
                     class="box" accept="image/jpg, image/jpeg, image/png, image/webp" require> 
                </div>
                <div class="inputBox">
                    <span>product details (required)</span>
                    <textarea name="details" placeholder="enter product details" class="box"
                     required maxlength="500" cols="30" rows="10"></textarea>
                </div>
                <input type="submit" value="add product" name="add_product" class="btn">
            </div>
        </form> 

    </section>

    <section class="show_products">
        <div class="box-container">
            
            <?php 
                $page = !empty($_GET['page'])?$_GET['page']:1;
                $limit = 6;
                $count_product = "SELECT count(id) as total FROM products";
                $result_count = mysqli_query($conn,$count_product);
                $dong = mysqli_fetch_array($result_count);  
                $number_of_products = $dong['total'];
                $sotrang = ceil($number_of_products / $limit);
                $start = ($page - 1) * $limit;

                

                $show_product = "SELECT * FROM products LIMIT $start, $limit";
                $result = mysqli_query($conn, $show_product);
               



                if($number_of_products > 0){
                    while($row = mysqli_fetch_array($result))
                    {   
            ?>
                <div class="box">
                    <img src="../upload_img/<?php echo $row['image_01']; ?>" alt="">
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="price">₫<?php echo number_format($row['price']); ?>/-</div>
                    <div class="details"><?php echo $row['details']; ?></div>
                    <div class="flex-btn">
                        <a href="update_products.php?update=<?php echo $row['id']; ?>" class="option-btn">
                            update
                        </a>
                        <a href="products.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Xóa sản phẩm này?')">
                            delete
                        </a>
                    </div>
                </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">chưa có sản phẩm nào được thêm vào! </p>';
                } 
                
            ?>
           
            
        </div>
    </section>
    <?php
        include ("../components/pagnition.php");   
    ?>


    <script src="../js/admin_script.js"></script>
</body>
</html>

    