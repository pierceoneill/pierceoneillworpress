<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nilos
 */

$nilos_audio_url = function_exists( 'get_field' ) ? get_field( 'nilos_post_audio' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('nilos_post_gallery') : '';
$nilos_video_url = function_exists( 'get_field' ) ? get_field( 'nilos_post_video' ) : NULL;



$nilos_blog_single_social = get_theme_mod( 'nilos_blog_single_social', true );
$blog_tag_col = $nilos_blog_single_social ? 'col-xl-8 col-lg-6' : 'col-xl-12';

if ( is_single() ) : ?>
<!-- details start -->
<article id="post-<?php the_ID();?>" <?php post_class( 'nl-postbox-details-article' );?>>
    <?php get_template_part( 'template-parts/blog/blog-details-meta' ); ?>
    
    <div class="news-details__img">
        <?php if ( has_post_format('image') ): ?>
        <!-- if post has image -->
        <?php if ( has_post_thumbnail() ): ?>
        <div class="nl-postbox-details-thumb">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </div>
        <?php endif;?>


        <!-- if post has video -->
        <?php elseif ( has_post_format('video') ): ?>
            <?php if ( has_post_thumbnail() ): ?>
            <div class="nl-postbox-details-thumb nl-postbox-details-video">

                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>

                <?php if(!empty($nilos_video_url)) : ?>
                <a href="<?php print esc_url( $nilos_video_url );?>" class="nl-postbox-video-btn popup-video"><i
                        class="fas fa-play"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>


        <!-- if post has audio -->
        <?php elseif ( has_post_format('audio') ): ?>
        <?php if ( !empty( $nilos_audio_url ) ): ?>
        <div class="nl-postbox-details-thumb nl-postbox-details-audio">
            <?php echo wp_oembed_get( $nilos_audio_url ); ?>
        </div>
        <?php endif; ?>

        <!-- if post has gallery -->
        <?php elseif ( has_post_format('gallery') ): ?>
        <?php if ( !empty( $gallery_images ) ): ?>
        <div class="nl-postbox-thumb nl-postbox-slider swiper-container p-relative">
            <div class="swiper-wrapper">
                <?php foreach ( $gallery_images as $key => $image ): ?>
                <div class="nl-postbox-slider-item swiper-slide">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
                <?php endforeach;?>
            </div>
            <div class="nl-postbox-nav">
                <button class="nl-postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                <button class="nl-postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
            </div>
        </div>
        <?php endif; ?>
        <!-- defalut image format -->
        <?php else: ?>
            <?php if ( has_post_thumbnail() ): ?>
                <div class="nl-postbox-details-thumb">
                    <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                </div>
            <?php endif;?>
        <?php endif;?>
    </div>
    
    <div class="nl-postbox-details-article-inner">

        <!-- content start -->
        <?php the_content(); ?>

        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'nilos' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
    </div>

    <?php if(has_tag() OR $nilos_blog_single_social) :?>
    <div class="nl-postbox-details-share-wrapper">
        <div class="row">
            <div class="<?php echo esc_attr($blog_tag_col); ?>">
                <div class="nl-postbox-details-tags tagcloud">
                    <?php print nilos_get_tag(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>

</article>
<!-- details end -->
<?php else: ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'nl-postbox-item format-image mb-50 transition-3' );?>>
    <div class="news-page__single">
        <!-- if post has thumbnail -->
        <?php if ( has_post_format('image') ): ?>
        <?php if ( has_post_thumbnail() ): ?>
        <div class="news-page__img">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>

        <!-- if post has video -->
        <?php elseif ( has_post_format('video') ): ?>
        <?php if ( has_post_thumbnail() ): ?>
        <div class="news-page__img nl-postbox-video p-relative">

            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>

            <?php if(!empty($nilos_video_url)) : ?>
            <a href="<?php print esc_url( $nilos_video_url );?>" class="nl-postbox-video-btn popup-video"><i
                    class="fas fa-play"></i></a>
            <?php endif; ?>

        </div>
        <?php endif; ?>

        <!-- if post has audio -->
        <?php elseif ( has_post_format('audio') ): ?>

        <?php if ( !empty( $nilos_audio_url ) ): ?>
        <div class="news-page__img nl-postbox-audio p-relative">
            <?php echo wp_oembed_get( $nilos_audio_url ); ?>
        </div>
        <?php endif; ?>

        <!-- if post has gallery -->
        <?php elseif ( has_post_format('gallery') ): ?>
        <?php if ( !empty( $gallery_images ) ): ?>
        <div class="news-page__img nl-postbox-slider swiper-container p-relative">
            <div class="swiper-wrapper">
                <?php foreach ( $gallery_images as $key => $image ): ?>
                <div class="nl-postbox-slider-item swiper-slide">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
                <?php endforeach;?>
            </div>
            <div class="nl-postbox-nav">
                <button class="nl-postbox-slider-button-next"><i class="fal fa-arrow-right"></i></button>
                <button class="nl-postbox-slider-button-prev"><i class="fal fa-arrow-left"></i></button>
            </div>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <?php if ( has_post_thumbnail() ): ?>
        <div class="news-page__img">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="news-page__content">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
            <h3 class="news-page__title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>
        </div>
    </div>
</article>
<?php endif;?>
