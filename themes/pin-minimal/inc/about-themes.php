<?php
// about theme info
add_action('admin_menu', 'pin_minimal_abouttheme');
function pin_minimal_abouttheme()
	{
	add_theme_page(esc_html__('Theme Info', 'pin-minimal') , esc_html__('Theme Info', 'pin-minimal') , 'edit_theme_options', 'pin_minimal_guide', 'pin_minimal_mostrar_guide');
	}
// guidline for about theme
function pin_minimal_mostrar_guide()
	{
// custom function about theme customizer
	$return = add_query_arg(array());
?>
<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 99%; text-align:center;}
}
</style>
<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:10px; border-bottom:1px solid #ccc; margin-bottom:15px; margin-top:10px;">
			  <?php esc_html_e('Theme Info', 'pin-minimal'); ?>
		   </div>
           <div style="text-align:center; font-weight:bold;">
				<a href="<?php echo esc_url(PIN_MINIMAL_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'pin-minimal'); ?></a> | 
				<a href="<?php echo esc_url(PIN_MINIMAL_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'pin-minimal'); ?></a> | 
				<a href="<?php echo esc_url(PIN_MINIMAL_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'pin-minimal'); ?></a>
                <div style="height:5px"></div>
			</div>
          <p><?php
	esc_html_e('Pin Minimal is a minimalistic template using material and flat styled UI for any type of interior design, architecture, portfolio, creative, photography, videography, multipurpose using powerful and flexible Elementor builder. Can be used by web design consulting agencies, software, IT, digital computer and infographics website usage.', 'pin-minimal'); ?></p>
	<a href="<?php
	echo esc_url(PIN_MINIMAL_PRO_THEME_URL); ?>"><img src="<?php
	echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.jpg" alt="" /></a>
	</div><!-- .col-left -->
	<!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>