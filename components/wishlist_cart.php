<?php 
    include('components/connect.php');

    if(isset($_POST['add_to_wishlist'])){
        if($user_id ==''){
            header("Location:user_login.php");
        }else{
            $pid = $_POST['pid'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image']; 

            $check_wishlist_numbers ="SELECT * FROM wishlist WHERE name ='$name' AND user_id = $user_id";
            $result_wishlist = mysqli_query($conn,$check_wishlist_numbers);
            

            $check_cart_numbers ="SELECT * FROM cart WHERE name ='$name' AND user_id = $user_id";
            $result_cart = mysqli_query($conn,$check_cart_numbers);
          

            if(mysqli_num_rows($result_wishlist) > 0){
                $message[]='Đã được thêm vào danh sách yêu thích!';
            }elseif(mysqli_num_rows($result_cart) > 0){
                $message[]='Đã được thêm vào giỏ hàng';
            }else{
                $insert_wishlist = "INSERT INTO wishlist(user_id,pid,name,price,image) VALUES
                ($user_id, $pid, '$name', $price, '$image')";
                //  echo $insert_wishlist;
                $result_insert_wishlist = mysqli_query($conn,$insert_wishlist);
                $message[]='added to wishlist';
            }
        }
    }

    if(isset($_POST['add_to_cart'])){

        if($user_id == ''){
           header('location:user_login.php');
        }else{
     
            $pid = $_POST['pid'];
          
            $name = $_POST['name'];
            
            $price = $_POST['price'];
            
            $image = $_POST['image'];
            
            $qty = $_POST['qty'];
            
            $size = $_POST['size'];
            
        
            $check_cart_numbers ="SELECT * FROM cart WHERE name ='$name' AND user_id = $user_id";
            $result_cart_number = mysqli_query($conn,$check_cart_numbers);
            $count_cart = "SELECT count(id) as total FROM cart";
            $result_count_cart = mysqli_query($conn,$count_cart);
            $dong = mysqli_fetch_array($result_count_cart);  
            $number_of_cart2 = $dong['total'];
        
            if(mysqli_num_rows($result_cart_number) > 0){
                $message[] = 'đã được thêm vào giỏ hàng!';
            }else{
            
                $check_wishlist_numbers = "SELECT * FROM wishlist WHERE name = '$name' AND user_id = $user_id";
                $result_wishlist_numbers = mysqli_query($conn,$check_wishlist_numbers); 
                
            
                if(mysqli_num_rows($result_wishlist_numbers) > 0){
                    $delete_wishlist ="DELETE FROM wishlist WHERE name = '$name' AND user_id = $user_id";
                    $result_delete_wishlist = mysqli_query($conn, $delete_wishlist);
                }
        
                $insert_cart = "INSERT INTO cart(user_id, pid, name, price, quantity,size, image) VALUES
                ($user_id, $pid, '$name', $price, $qty, $size, '$image')";
                $result_insert_cart = mysqli_query($conn,$insert_cart);
                $message[] = 'added to cart!';
              
           }
     
        }
     
     }
?>