<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_info = get_the_author_meta( 'nilos_write_by');
    $facebook_url = get_the_author_meta( 'nilos_facebook' );
    $twitter_url = get_the_author_meta( 'nilos_twitter' );
    $linkedin_url = get_the_author_meta( 'nilos_linkedin' );
    $instagram_url = get_the_author_meta( 'nilos_instagram' );
    $youtube_url = get_the_author_meta( 'nilos_youtube' );
    $nilos_write_by = get_the_author_meta( 'nilos_write_by' );
    $author_bio_avatar_size = 180;
    if ( $author_data != '' ):
?>

    <div class="nl-postbox-details-author d-sm-flex align-items-start" data-bg-color="#F4F7F9">
        <div class="nl-postbox-details-author-thumb">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>  
            </a>
        </div>
        <div class="nl-postbox-details-author-content">
            <span><?php echo esc_html__( 'Written by', 'nilos' ); ?></span>
            <h5 class="nl-postbox-details-author-title">
                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php print esc_html($author_info); ?></a>
            </h5>
            <p><?php the_author_meta( 'description' );?></p>

            <div class="nl-postbox-details-author-social">
                <?php if(!empty($facebook_url)) :?>
                <a href="<?php echo esc_url($facebook_url); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif; ?>

                <?php if(!empty($twitter_url)) :?>
                <a href="<?php echo esc_url($twitter_url); ?>"><i class="fa-brands fa-twitter"></i></a>
                <?php endif; ?>

                <?php if(!empty($linkedin_url)) :?>
                <a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                <?php endif; ?>

                <?php if(!empty($instagram_url)) :?>
                <a href="<?php echo esc_url($instagram_url); ?>"><i class="fa-brands fa-instagram"></i></a>
                <?php endif; ?>

                <?php if(!empty($youtube_url)) :?>
                <a href="<?php echo esc_url($youtube_url); ?>"><i class="fa-brands fa-youtube"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif;?>
