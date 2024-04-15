<?php

/*
function nilos_blog_single_social(){
    $post_url = get_the_permalink();
 ?>    
    <span><?php echo esc_html__('Share On:', 'nilos-core');?></span>
    <a href="htniloss://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin nilos-linkedin"></i></a>
    <a href="htniloss://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank""><i class="fab fa-facebook nilos-facebook" ></i></a>
    <a href="htniloss://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter nilos-twitter"></i></a>
   <?php return false;
}*/

// nilos_product_single_social
function nilos_product_single_social(){
    $post_url = get_the_permalink();
 ?>    
    <div class="nilos-product-details-social">
        <span><?php echo esc_html__('Share:', 'nilos-core');?> </span>
        <a href="htniloss://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="htniloss://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        <a href="htniloss://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
        
    </div>

   <?php return false;
}