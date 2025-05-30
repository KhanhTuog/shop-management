<?php
    session_start();   
    include('components/connect.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else {
        $user_id ='';
    }
    include ('components/wishlist_cart.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php  include ("./components/user_header.php"); ?>
    <section class="products">

        <h1 class="heading">latest products</h1>

        <div class="box-container">

    <?php
    $page = !empty($_GET['page'])?$_GET['page']:1;
    $limit = 9;
    $count_product = "SELECT count(id) as total FROM products";
    $result_count = mysqli_query($conn,$count_product);
    $dong = mysqli_fetch_array($result_count);  
    $number_of_products = $dong['total'];
    $sotrang = ceil($number_of_products / $limit);
    $start = ($page - 1) * $limit;

    $select_products = "SELECT * FROM products LIMIT $start, $limit "; 
     
    $result_product = mysqli_query($conn,$select_products);

     
    if(mysqli_num_rows($result_product) > 0){
        while($row = mysqli_fetch_array($result_product)){
    ?>
    <form action="" method="POST" class="box">
        <input type="hidden" name="pid" value="<?= $row['id']; ?>">
        <input type="hidden" name="name" value="<?= $row['name']; ?>">
        <input type="hidden" name="price" value="<?= $row['price']; ?>">
        <input type="hidden" name="image" value="<?= $row['image_01']; ?>">
        <input type="hidden" name="size" value="<?= $row['size']; ?>">

        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?php echo $row['id']; ?>" class="fas fa-eye"></a>
        <img src="upload_img/<?php echo $row['image_01']; ?>" alt="">
        <div class="name"><?php echo $row['name']; ?></div>
        <div class="flex">
            <div class="price"><span>đ</span><?= number_format($row['price']); ?><span>/-</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            
        </div>
        <div class="name"> size 
                    <select name="size" class="drop-down">
                        <!-- -->
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                    </select></div>
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>
    <?php
     }
    }else{
        echo '<p class="empty">no products adde yet!</p>';
    }
    ?>

</div>

</section>
    
<nav aria-label="Page navigation example" >
        <ul class="pagination " style="display:flex; justify-content:center;">
    <?php
        if($page > 3){
            $first_page = 1;
            echo '<li class="page-item"><a href="shop.php?page='.$first_page.'"class="page-link" tabindex="-1" >First</li></a>';
        }
        if($page > 1){
            $prev_page = $page - 1;  
            echo '<li class="page-item"><a href="shop.php?page='.$prev_page.'"class="page-link"  >Prev</li></a>';
        }
        for($i=1; $i <= $sotrang; $i++){
            if($i != $page){
                if($i > $page - 3 && $i < $page + 3 ){
                    echo '<li class="page-item"><a href="shop.php?page='.$i.'"class="page-link"  >'.$i.'</li></a>';
                }else{
                    echo '<li class="page-item"><a href="shop.php?page='.$i.'"class="page-link"  ><strong>'.$i.'</strong></li></a>';
                }
            }
            if($page < $sotrang - 1 ){
                $next_page = $page + 1;
                echo '<li class="page-item"><a href="shop.php?page='.$next_page.'" class="page-link" >next</li></a>';
            }
            if($page < $sotrang - 3){
                $end_page = $sotrang;
                echo '<li class="page-item"><a href="shop.php?page='.$end_page.'" class="page-link" >Last</li></a>';
            }
            
        }
        
    ?>
        </ul>
    </nav>
    <?php  include ("./components/footer.php"); ?>
    <script src="javascript/script.js"></script>
</body>
</html>