
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

<header class="header">
    <section class="flex">
        <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>
        <nav class="navbar">
            <a href="dashboard.php">home</a>
            <a href="products.php">products</a>
            <a href="placed_orders.php">orders</a>
            <a href="admin_accounts.php">admin</a>
            <a href="users_accounts.php">user</a>
            <a href="messages.php">messages</a>
        </nav>
        <div class="icon">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-users"></div>
        </div>
        <div class="profile">
            <?php
                if(isset($_SESSION['name'])){
                    if($_SESSION['role'] == 'admin'){
                        echo '<p>'.$_SESSION['name'].'</p>';
                    } else{
                        echo '<p>'.$_SESSION['name'].'</p>';
                    }
                } 
                // if(isset($_SESSION['name'])){
                //     if($_SESSION['role'] == 'user'){
                //         echo '<p>'.$_SESSION['name'].'</p>';
                //     }
                // } 
                
            
            ?>
            <a href="update_profile.php" class="btn">update profile</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn">Login</a>
                <a href="register_admin.php" class="option-btn">Register</a>
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('Đăng xuất khỏi website?')" class="delete-btn">Logout</a>
        </div>
    </section>
</header>
