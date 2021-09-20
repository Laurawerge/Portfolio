<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Pin Minimal
 */
$footerlogothumb = get_theme_mod('footer_logo_thumb'); 
$footerlogothumblink = get_theme_mod('footer_logo_thumb_url'); 
$facebooklink = get_theme_mod('facebook_link'); 
$twitterlink = get_theme_mod('twitter_link');
$linkedlink = get_theme_mod('linked_link');
$youtubelink = get_theme_mod('youtube_link');
$instagramlink = get_theme_mod('instagram_link');
$hidefooterboxbar = get_theme_mod('hide_footer_boxbar', 1); 
?>
<?php if( $hidefooterboxbar == '') { ?>
<div id="footer-wrapper">
		<div class="footerarea">
            <div class="container footerinfobox">
                <?php 
				if (!empty($footerlogothumb)) { ?>
                <div class="footer-logo-thumb">
                	<?php if (!empty($footerlogothumblink)) { ?>
                	<a href="<?php echo esc_url($footerlogothumblink); ?>">
                    <?php
					}
					?>
                    <img src="<?php echo esc_url($footerlogothumb); ?>" />
                    <?php 
					if (!empty($footerlogothumblink)) { ?>
                    </a>
                    <?php } ?>
                 </div>
                 <?php } ?>
    <div class="footer-social">           
    <div class="social-icons">
		<?php 
		if (!empty($facebooklink)) { ?>
        <a title="<?php echo esc_attr__('Facebook','pin-minimal'); ?>" class="facebook" target="_blank" href="<?php echo esc_url($facebooklink); ?>"></a> 
        <?php } 		
		if (!empty($twitterlink)) { ?>
        <a title="<?php echo esc_attr__('Twitter','pin-minimal'); ?>" class="twitter" target="_blank" href="<?php echo esc_url($twitterlink); ?>"></a>
        <?php } 
		 if (!empty($linkedlink)) { ?> 
        <a title="<?php echo esc_attr__('Linkedin','pin-minimal'); ?>" class="linkedin" target="_blank" href="<?php echo esc_url($linkedlink); ?>"></a>
        <?php } ?> 
        <?php
		if (!empty($youtubelink)) { ?> 
        <a title="<?php echo esc_attr__('Youtube','pin-minimal'); ?>" class="youtube" target="_blank" href="<?php echo esc_url($youtubelink); ?>"></a>
        <?php } ?>          
        <?php
		if (!empty($instagramlink)) { ?> 
        <a title="<?php echo esc_attr__('Instagram','pin-minimal'); ?>" class="instagram" target="_blank" href="<?php echo esc_url($instagramlink); ?>"></a>
        <?php } ?>                   
      </div>
      </div> 
                <div class="clear"></div>
            </div>
        </div>
</div>
<?php } ?>
<?php 
if ( is_active_sidebar( 'footercolumn-1' ) || is_active_sidebar( 'footercolumn-2' ) || is_active_sidebar( 'footercolumn-3' ) || is_active_sidebar( 'footercolumn-4' ) ) : 
?>
<div id="footer-wrapper" aria-label="<?php esc_attr_e( 'footer', 'pin-minimal' ); ?>">
    	<div class="container footer">
            <?php if ( is_active_sidebar( 'footercolumn-1' ) ) : ?>
            <div class="cols-3 widget-column-1">  
              <?php dynamic_sidebar( 'footercolumn-1' ); ?>
            </div><!--end .widget-column-1-->                  
    		<?php endif; ?> 
			<?php if ( is_active_sidebar( 'footercolumn-2' ) ) : ?>
            <div class="cols-3 widget-column-2">  
            <?php dynamic_sidebar( 'footercolumn-2' ); ?>
            </div><!--end .widget-column-3-->
            <?php endif; ?> 
			<?php if ( is_active_sidebar( 'footercolumn-3' ) ) : ?>    
            <div class="cols-3 widget-column-3">  
            <?php dynamic_sidebar( 'footercolumn-3' ); ?>
            </div><!--end .widget-column-4-->
			<?php endif; ?> 
			<?php if ( is_active_sidebar( 'footercolumn-4' ) ) : ?>    
            <div class="cols-3 widget-column-4">  
            <?php dynamic_sidebar( 'footercolumn-4' ); ?>
            </div><!--end .widget-column-4-->
			<?php endif; ?>             
            <div class="clear"></div>
        </div><!--end .container-->          
    </div><!--end .footer-wrapper-->
<?php endif; ?>    
	<div class="copyright-wrapper">
        	<div class="container">
            	 <div class="copyright-txt"><?php esc_html_e('Copyright ', 'pin-minimal'); bloginfo('name');?></div>	
            	 <div class="design-by"><?php esc_html_e('Pinnacle Themes', 'pin-minimal');?></div>
                 <div class="clear"></div>
            </div>           
        </div>    
<?php wp_footer(); ?>
</body>
</html>