<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
        header('Location: home.php');
    }
    include ('components/wishlist_cart.php');

    if(isset($_POST['delete'])){
        $cart_id = $_POST['cart_id'];
        $delete_wishlist_item = "DELETE FROM cart WHERE id = $cart_id";
        $result_delete_item = mysqli_query($conn,$delete_wishlist_item);
    }
     
    if(isset($_GET['delete_all'])){
        $delete_wishlist_all = "DELETE FROM cart WHERE user_id = $user_id";
        $result_delete_all = mysqli_query($conn,$delete_wishlist_all);
        header('location:wishlist.php');
    }
    if(isset($_POST['update_qty'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        $update_qty = "UPDATE cart SET quantity = $qty WHERE id = $cart_id";
        $result_qty = mysqli_query($conn,$update_qty);
        $message[] = 'Số lượng giỏ hàng được cập nhật';
    }
    if(isset($_POST['update_size'])){
        $cart_id = $_POST['cart_id'];
        $size = $_POST['size'];
        $update_size = "UPDATE cart SET size = $size WHERE id = $cart_id";
        $result_size = mysqli_query($conn,$update_size);
        $message[] = 'Size đã được cập nhật!!';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="products shopping-cart">

        <h3 class="heading">shopping cart</h3>

        <div class="box-container">

            <?php
                $total = 0;
                $select_cart = "SELECT * FROM cart WHERE user_id = $user_id";
                $result_cart = mysqli_query($conn,$select_cart);
                if(mysqli_num_rows($result_cart) > 0){
                    while($row =mysqli_fetch_array($result_cart)){
            ?>
            <form action="" method="POST" class="box">
                <input type="hidden" name="cart_id" value="<?= $row['id']; ?>">
                <a href="quick_view.php?pid=<?= $row['pid']; ?>" class="fas fa-eye"></a>
                <img src="upload_img/<?= $row['image']; ?>" alt="">
                <div class="name"><?= $row['name']; ?></div>
                <div class="flex">
                    <div class="price">đ<?= number_format($row['price']); ?>/-</div>
                    <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $row['quantity']; ?>">
                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                </div>
                
                <div class="flex">
                    <div class="name"> size 
                        <select name="size" class="drop-down">
                            <option  selected disabled><?php echo $row['size']; ?></option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                        </select>
                        
                    </div>
                    <button type="submit" class="fas fa-edit" name="update_size"></button>
                </div>
                
               
                <?php $sum = ($row['price'] * $row['quantity']); ?>
                <div class="sub-total"> total : <span>đ<?= number_format($sum); ?>/-</span> </div>
                <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
            </form>
            <?php
            $total += $sum;
                }
            }else{
                echo '<p class="empty">Giỏ hàng của bạn đang trống!</p>';
            }
            ?>
        </div>

        <div class="cart-total">
            <p> subtotal : <span>đ<?= number_format($total); ?>/-</span></p>
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="cart.php?delete_all" class="delete-btn <?= ($total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
            <a href="checkout.php" class="btn <?= ($total > 1)?'':'disabled'; ?>">proceed to checkout</a>
        </div>

    </section>
   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>