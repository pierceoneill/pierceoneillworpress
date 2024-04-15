<?php 

add_shortcode('nilos_woo_coupon_shortcode', 'nilos_woo_coupon');

function nilos_woo_coupon(){
    
    $coupon = new WC_Coupon();

    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'asc',
        'post_type'        => 'shop_coupon',
        'post_status'      => 'publish',
    );

    $coupons = get_posts( $args );

    ?>
    
    <section class="breadcrumb__area include-bg pb-30 is-coupon-page">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title"><?php the_title(); ?></h3>
                        <?php do_action( 'woocommerce_archive_description' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="nilos-coupon-area pb-120">
        <div class="container">
            <div class="row">

                <?php foreach($coupons as $coupon) : 
                    $coupon_details = new WC_Coupon($coupon->post_title);
                    $title = $coupon->post_title;
                    $ammount = $coupon_details->get_amount();
                    $type = $coupon_details->get_discount_type();
                    $img = wp_get_attachment_image_url($coupon_details->get_meta_data()[0]->get_data()['value'], 'full');
                    $expDate = $coupon_details->get_date_expires() == null ? '' : $coupon_details->get_date_expires() ;
                    
                    $date = date("M d Y h:m:i",  strtotime($expDate));
                    $currencySymbol = get_woocommerce_currency_symbol();
                    $desc = $coupon_details->get_description();
                    $code = $coupon_details->get_code();

                    
                    // var_dump($test->date("M d Y h:m:i"));

                    $uploaded_date = new DateTime($date);
                    $current_time = new DateTime(date('y-m-d'));
                
                    $date_diff = $current_time < $uploaded_date;

                ?>
                <div class="col-xl-6">
                    <div class="nilos-coupon-item mb-30 p-relative d-md-flex justify-content-between align-items-center">
                    <span class="nilos-coupon-border"></span>
                    <div class="nilos-coupon-item-left d-sm-flex align-items-center">

                        <?php if(!empty($img)): ?>
                        <div class="nilos-coupon-thumb">
                            <img alt="logo" src="<?php echo esc_url($img); ?>">
                        </div>
                        <?php endif; ?>

                        <div class="nilos-coupon-content">

                            <?php if(!empty($title)): ?>
                            <h3 class="nilos-coupon-title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if($type === 'percent'): ?>
                            <p class="nilos-coupon-offer mb-15"><span><?php echo esc_html($ammount) . esc_html__('%', 'nilos-core');?></span><?php echo esc_html__('Off', 'nilos-core'); ?></p>
                            <?php else: ?>
                                <p class="nilos-coupon-offer mb-15"><span><?php echo esc_html($ammount) . esc_html($currencySymbol); ?></span><?php echo esc_html__('Off', 'nilos-core'); ?></p>
                            <?php endif; ?>
                            <div class="nilos-coupon-countdown" data-countdown="" data-date="<?php echo esc_attr($date); ?>">
                                <div class="nilos-coupon-countdown-inner">
                                    <ul>
                                        <li><span data-days><?php echo esc_html__('0', 'nilos-core'); ?></span><?php echo esc_html__('Days', 'nilos-core'); ?></li>
                                        <li><span data-hours><?php echo esc_html__('0', 'nilos-core'); ?></span><?php echo esc_html__('Hrs', 'nilos-core'); ?></li>
                                        <li><span data-minutes><?php echo esc_html__('0', 'nilos-core'); ?></span><?php echo esc_html__('Min', 'nilos-core'); ?></li>
                                        <li><span data-seconds><?php echo esc_html__('0', 'nilos-core'); ?></span><?php echo esc_html__('Sec', 'nilos-core'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nilos-coupon-item-right pl-20">
                        <div class="nilos-coupon-status mb-10 d-flex align-items-center">
                            <?php
                                $text = $date_diff ? 'active' : 'Expired';
                            ?>
                            <h4><?php echo esc_html__('Coupon :', 'nilos-core'); ?> <span class="<?php echo esc_attr($text); ?>"><?php echo esc_html($text); ?></span></h4>
                            
                            <?php if(!empty($desc)): ?>
                            <div class="nilos-coupon-info-details">
                                <span>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1.5C4.99594 1.5 1.75 4.74594 1.75 8.75C1.75 12.7541 4.99594 16 9 16C13.0041 16 16.25 12.7541 16.25 8.75C16.25 4.74594 13.0041 1.5 9 1.5ZM0.25 8.75C0.25 3.91751 4.16751 0 9 0C13.8325 0 17.75 3.91751 17.75 8.75C17.75 13.5825 13.8325 17.5 9 17.5C4.16751 17.5 0.25 13.5825 0.25 8.75ZM9 7.75C9.55229 7.75 10 8.19771 10 8.75V11.95C10 12.5023 9.55229 12.95 9 12.95C8.44771 12.95 8 12.5023 8 11.95V8.75C8 8.19771 8.44771 7.75 9 7.75ZM9 4.5498C8.44771 4.5498 8 4.99752 8 5.5498C8 6.10209 8.44771 6.5498 9 6.5498H9.008C9.56028 6.5498 10.008 6.10209 10.008 5.5498C10.008 4.99752 9.56028 4.5498 9.008 4.5498H9Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="nilos-coupon-info-tooltip transition-3">
                                    <p><?php echo wp_kses_post($desc); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($code)): ?>
                        <div class="nilos-coupon-date"><button><span><?php echo esc_html($code); ?></span></button></div>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php

}

?>