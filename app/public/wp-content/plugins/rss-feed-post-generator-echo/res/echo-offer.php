<?php
   function echo_recommendations()
   {
   update_option('coderevolution_settings_viewed', 1);
   ?>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
   <div>
      <div>
         <h3>
            <?php echo esc_html__("Our Recommendations", 'rss-feed-post-generator-echo');?>: 
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Some general recommendations, to help boost the ROI of this plugin and your website.", 'rss-feed-post-generator-echo');
                     ?>
               </div>
            </div>
         </h3>
         <hr/>
         <b>
            <ol>
               <li>
                  <h2><?php echo esc_html__("Import premium unique content for more organic traffic:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("To import good quality unique content, we recommend that you use a premium text spinning service with the plugin (can be configured from 'Main Settings' page)", 'rss-feed-post-generator-echo');?> - <a href="https://www.youtube.com/watch?v=JuXt8aT-5Jc" target="_blank"><?php echo esc_html__("tutorial video", 'rss-feed-post-generator-echo');?></a>. 
                  <br/><?php echo esc_html__("Supported premium spinners:", 'rss-feed-post-generator-echo');?><br/><br/>
                  <table class="cr_width_auto">
                     <tr class="cdr-dw-tr">
                        <td class="cdr-dw-td">The Best Spinner&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="cdr-dw-td-value"><a href="https://paykstrt.com/10313/38910" target="_blank"><?php echo esc_html__("Sign up now", 'rss-feed-post-generator-echo');?></a></td>
                     </tr>
                     <tr class="cdr-dw-tr">
                        <td class="cdr-dw-td">SpinRewriter&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="cdr-dw-td-value"><a href="https://www.spinrewriter.com/?ref=24b18" target="_blank"><?php echo esc_html__("Sign up now", 'rss-feed-post-generator-echo');?></a></td>
                     </tr>
                     <tr class="cdr-dw-tr">
                        <td class="cdr-dw-td">WordAI&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="cdr-dw-td-value"><a href="https://wordai.com/?ref=h17f4" target="_blank"><?php echo esc_html__("Sign up now", 'rss-feed-post-generator-echo');?></a></td>
                     </tr>
                  </table>
               </li>
               <li>
                  <h2><?php echo esc_html__("Earn a side income from your blog:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("To earn a side income using our plugins, you can try using", 'rss-feed-post-generator-echo');?> <a href="http://join-shortest.com/ref/ff421f2b06?user-type=new" target="_blank"><?php echo esc_html__("Shorte.st link shortener", 'rss-feed-post-generator-echo');?></a>. <?php echo esc_html__("It can be configured from plugin's 'Main Settings'", 'rss-feed-post-generator-echo');?> - <a href="https://www.youtube.com/watch?v=XFZmzLKddV4" target="_blank"><?php echo esc_html__("tutorial video", 'rss-feed-post-generator-echo');?></a>.
               </li>
               <li>
                  <h2><?php echo esc_html__("Create a multilingual blog:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("To create a multilingual blog, we recommend that you use", 'rss-feed-post-generator-echo');?> <a href="https://wpml.org/?aid=238195&affiliate_key=ix3LsFyq0xKz" target="_blank">WPML</a>. <?php echo esc_html__("If you just wish to import content in a language, and translate it to another language automatically, our plugins also support Google Translate to achieve this.", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("Like our plugin? Want more?", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("Check our", 'rss-feed-post-generator-echo');?> <a href="//1.envato.market/coderevolution" target="_blank"><?php echo esc_html__("plugin portfolio from CodeCanyon", 'rss-feed-post-generator-echo');?></a>. <?php echo esc_html__("We release periodically new plugins that complement our existing ones, so this list of plugins is worth following. We also have a private plugin marketplace, check it", 'rss-feed-post-generator-echo');?> <a href="https://coderevolution.ro/shop/" target="_blank"><?php echo esc_html__("here", 'rss-feed-post-generator-echo');?></a>.
               </li>
               <li>
                  <h2><?php echo esc_html__("All our plugins, at a Mega price:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("If you enjoy our work and want to get more of it, check our", 'rss-feed-post-generator-echo');?> <a href="//1.envato.market/MegaBundle" target="_blank">Mega 'All-My-Items-Bundle'</a> - <?php echo esc_html__("which is possibly the largest plugin bundle on CodeCanyon. It includes all our plugins (and also all our future plugins), at a 95% discount - so it is really a great deal.", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("Learn more about WordPress (beginners to advanced):", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("To learn more about WordPress (or maybe WordPress plugin development), check", 'rss-feed-post-generator-echo');?> <a href="https://coderevolution.teachable.com/" target="_blank"><?php echo esc_html__("our online courses on", 'rss-feed-post-generator-echo');?> Teachable</a>. <?php echo esc_html__("They provide great value for starters with WordPress, but also for WordPress junior developers. You can also become our", 'rss-feed-post-generator-echo');?> <a href="https://teachable.com/affiliates" target="_blank"><?php echo esc_html__("affiliate on Teachable", 'rss-feed-post-generator-echo');?></a> <?php echo esc_html__("to earn income from course sales you generate.", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("Learn more about how to create your first internet business (or even earn with it):", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("To learn more about how to start your own internet business from scratch, check", 'rss-feed-post-generator-echo');?> <a href="https://coderevolution.ro/startup-kit/index.html" target="_blank"><?php echo esc_html__("our e-book on this subject", 'rss-feed-post-generator-echo');?></a>. <?php echo esc_html__("You can also become our", 'rss-feed-post-generator-echo');?> <a href="https://www.clickbank.com/affiliate-network/" target="_blank"><?php echo esc_html__("affiliate on Clickbank", 'rss-feed-post-generator-echo');?></a> <?php echo esc_html__("to earn income from e-book sales you generate.", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("If you are looking for a cool theme:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("If you are looking for a cool new theme that best fits this plugin, we recommend", 'rss-feed-post-generator-echo');?> <a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=50837_5_1_16" target="_blank"><?php echo esc_html__("Divi theme", 'rss-feed-post-generator-echo');?></a> <?php echo esc_html__("by", 'rss-feed-post-generator-echo');?> <a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=50837_1_1_3" target="_blank">ElegantThemes</a>.
               </li>
               <li>
                  <h2><?php echo esc_html__("Earn more by becoming our affiliate:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("You can also become our affiliate (for CodeCanyon items and also for private marketplace items), to earn from the sales you generate for our plugins", 'rss-feed-post-generator-echo');?> <a href="https://coderevolution.ro/referral/" target="_blank"><?php echo esc_html__("more info here", 'rss-feed-post-generator-echo');?></a>.
               </li>
               <li>
                  <h2><?php echo esc_html__("Check the video tutorials for our plugins:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("For video tutorials, subscribe to our", 'rss-feed-post-generator-echo');?> <a href="https://www.youtube.com/channel/UCVLIksvzyk-D_oEdHab2Lgg" target="_blank"><?php echo esc_html__("YouTube channel", 'rss-feed-post-generator-echo');?></a> - <?php echo esc_html__("we post periodically new video tutorials over there also.", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("Check our blog and get a free e-book:", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("For more updates, tips and tricks follow our", 'rss-feed-post-generator-echo');?> <a href="https://coderevolution.ro/blog/" target="_blank"><?php echo esc_html__("blog", 'rss-feed-post-generator-echo');?></a> + <?php echo esc_html__("subscribe to our newsletter from our blog, and as a bonus, you will get the 'YouTube Caption Scraper' plugin, for free!", 'rss-feed-post-generator-echo');?>
               </li>
               <li>
                  <h2><?php echo esc_html__("Our social networks (for more tips and news):", 'rss-feed-post-generator-echo');?></h2>
                  <?php echo esc_html__("Follow us for even more:", 'rss-feed-post-generator-echo');?> <a href="//codecanyon.net/user/coderevolution/follow" target="_blank">Envato</a>, <a href="https://www.patreon.com/coderevolution" target="_blank">Patreon</a>, <a href="https://www.facebook.com/CodeRevolution.envato/" target="_blank">Facebook</a>, <a href="https://twitter.com/code2revolution" target="_blank">Twitter</a>, <a href="https://ro.pinterest.com/CodeRevolution2envato/" target="_blank">Pinterest</a>, <a href="https://www.instagram.com/coderevolution_envato/" target="_blank">Instagram</a>, <a href="https://www.linkedin.com/company/coderevolution/" target="_blank">LinkedIn</a>, <a href="https://www.youtube.com/channel/UCVLIksvzyk-D_oEdHab2Lgg" target="_blank">YouTube</a>.
               </li>
            </ol>
         </b>
      </div>
   </div>
</div>
<?php
   }
   ?>