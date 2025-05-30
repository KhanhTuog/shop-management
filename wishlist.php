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
        $wishlist_id = $_POST['wishlist_id'];
        $delete_wishlist_item = "DELETE FROM wishlist WHERE id = $wishlist_id";
        $result_delete_item = mysqli_query($conn,$delete_wishlist_item);
     }
     
     if(isset($_GET['delete_all'])){
        $delete_wishlist_all = "DELETE FROM wishlist WHERE user_id = $user_id";
        $result_delete_all = mysqli_query($conn,$delete_wishlist_all);
        header('location:wishlist.php');
     }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="products">

        <h3 class="heading">your wishlist</h3>

        <div class="box-container">

        <?php
            $total = 0;
            $select_wishlist = "SELECT * FROM wishlist WHERE user_id = $user_id ";
            $result_wishlist = mysqli_query($conn,$select_wishlist);
            if(mysqli_num_rows($result_wishlist) > 0){
                while($row = mysqli_fetch_array($result_wishlist)){
                    $total += $row['price'];  
        ?>
        <form action="" method="POST" class="box">
            <input type="hidden" name="pid" value="<?= $row['pid']; ?>">
            <input type="hidden" name="wishlist_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="name" value="<?= $row['name']; ?>">
            <input type="hidden" name="price" value="<?= $row['price']; ?>">
            <input type="hidden" name="image" value="<?= $row['image']; ?>">
            <a href="quick_view.php?pid=<?= $row['pid']; ?>" class="fas fa-eye"></a>
            <img src="upload_img/<?= $row['image']; ?>" alt="">
            <div class="name"><?= $row['name']; ?></div>
            <div class="flex">
                <div class="price">đ<?= number_format($row['price']); ?>/-</div>
                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                <input type="hidden" name="size" value="36">
            </div>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            <input type="submit" value="delete " onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
        </form>
        <?php
            }
        }else{
            echo '<p class="empty">your wishlist is empty</p>';
        }
        ?>
        </div>

        <div class="wishlist-total">
            <p>grand total : <span>đ<?= number_format($total) ; ?>/-</span></p>
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="wishlist.php?delete_all" class="delete-btn <?= ($total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
        </div>

    </section>

   





    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>