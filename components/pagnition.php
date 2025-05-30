<nav aria-label="Page navigation example" >
        <ul class="pagination " style="display:flex; justify-content:center;">
    <?php
        if($page > 3){
            $first_page = 1;
            echo '<li class="page-item"><a href="products.php?page='.$first_page.'"class="page-link" tabindex="-1" >First</li></a>';
        }
        if($page > 1){
            $prev_page = $page - 1;  
            echo '<li class="page-item"><a href="products.php?page='.$prev_page.'"class="page-link"  >Prev</li></a>';
        }
        for($i=1; $i <= $sotrang; $i++){
            if($i != $page){
                if($i > $page - 3 && $i < $page + 3 ){
                    echo '<li class="page-item"><a href="products.php?page='.$i.'"class="page-link"  >'.$i.'</li></a>';
                }else{
                    echo '<li class="page-item"><a href="products.php?page='.$i.'"class="page-link"  ><strong>'.$i.'</strong></li></a>';
                }
            }
            if($page < $sotrang - 1 ){
                $next_page = $page + 1;
                echo '<li class="page-item"><a href="products.php?page='.$next_page.'" class="page-link" >next</li></a>';
            }
            if($page < $sotrang - 3){
                $end_page = $sotrang;
                echo '<li class="page-item"><a href="products.php?page='.$end_page.'" class="page-link" >Last</li></a>';
            }
            
        }
        
    ?>
        </ul>
    </nav>