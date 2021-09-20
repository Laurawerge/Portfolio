<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Pin Minimal
 */
get_header();
/**
 * Show the slider in front page section
 */
$pin_minimal_hideslide = get_theme_mod('hide_slides', 1);
if (!is_home() && is_front_page())
	{
	if ($pin_minimal_hideslide == '')
		{
		$pin_minimal_slidepages = array();
		for ($pin_minimal_sld = 10; $pin_minimal_sld < 13; $pin_minimal_sld++)
			{
			$pin_minimal_mod = absint(get_theme_mod('page-setting' . $pin_minimal_sld));
			if ('page-none-selected' != $pin_minimal_mod)
				{
				$pin_minimal_slidepages[] = $pin_minimal_mod;
				}
			}
		if (!empty($pin_minimal_slidepages)):
			$pin_minimal_args = array(
				'posts_per_page' => 3,
				'post_type' => 'page',
				'post__in' => $pin_minimal_slidepages,
				'orderby' => 'post__in'
			);
			$pin_minimal_query = new WP_Query($pin_minimal_args);
			if ($pin_minimal_query->have_posts()):
				$pin_minimal_sld = 10;
?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
 	<div class="slider-halfshadow"></div>
    <div class="slider-shadow"></div>
    <div id="slider" class="nivoSlider">
      <?php
				$pin_minimal_i = 0;
				while ($pin_minimal_query->have_posts()):
					$pin_minimal_query->the_post();
					$pin_minimal_i++;
					$pin_minimal_slideno[] = $pin_minimal_i;
					$pin_minimal_slidetitle[] = get_the_title();
					$pin_minimal_slidedesc[] = get_the_excerpt();
					$pin_minimal_slidelink[] = esc_url(get_permalink());
					if (has_post_thumbnail()) { ?>
	          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr($pin_minimal_i); ?>" />
          	  <?php } else {  ?>
          	  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/no_slide.jpg" title="#slidecaption<?php echo esc_attr($pin_minimal_i); ?>" /><?php } $pin_minimal_sld++; endwhile; ?>
    		</div>
	  		<?php
				$pin_minimal_k = 0;
				foreach($pin_minimal_slideno as $pin_minimal_sln)
				{ ?>
    		<div id="slidecaption<?php echo esc_attr($pin_minimal_sln); ?>" class="nivo-html-caption">
      		<div class="slide_info">
        	<h2><?php echo esc_html($pin_minimal_slidetitle[$pin_minimal_k]); ?></h2>
        	<p><?php echo esc_html($pin_minimal_slidedesc[$pin_minimal_k]); ?></p>
        	<div class="clear"></div>
        	<?php $pin_minimal_slide_button = get_theme_mod('slide_button');
				  if (!empty($pin_minimal_slide_button)) { ?>
       			 <a class="slide_more" href="<?php echo esc_url($pin_minimal_slidelink[$pin_minimal_k]); ?>"><?php echo esc_html($pin_minimal_slide_button); ?> </a>
        	<?php } ?>
      </div>
    </div>
	    <?php
		$pin_minimal_k++;
		wp_reset_postdata();
		} 
		endif;
		endif; ?>
  </div>
  <div class="clear"></div>
</section>
<?php
		}
	} 
wp_reset_postdata(); ?>
<div class="clear"></div>




    <?php if ('posts' == get_option('show_on_front')) { ?>
    <div class="container">
  <div id="skipp-content">  
  <div class="page_content">
    <section class="site-main">
      <div class="blog-post">
        <?php
		if (have_posts()):
		// Start the Loop.
		while (have_posts()):
			the_post();
			/*
			* Include the post format-specific template for the content. If you want to
			* use this in a child theme, then include a file called called content-___.php
			* (where ___ is the post format) and that will be used instead.
			*/
			get_template_part('content', get_post_format());
		endwhile;
		// Previous/next post navigation.
		the_posts_pagination(array(
			'mid_size' => 2,
			'prev_text' => esc_html__('Back', 'pin-minimal') ,
			'next_text' => esc_html__('Next', 'pin-minimal') ,
		));
	else:
		// If no content, include the "No posts found" template.
		get_template_part('no-results', 'index');
	endif;
?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php get_sidebar(); ?>
    <div class="clear"></div>
      </div>
      </div>
  <!-- site-aligner --> 
</div>
<!-- content -->
    <?php
	}
  else
	{
?>
    <section class="site-main fullway" id="sitefull">
      <div id="skipp-content">
      <div class="blog-post">
        <?php
	if (have_posts()):
		// Start the Loop.
		while (have_posts()):
			the_post();
			/*
			* Include the post format-specific template for the content. If you want to
			* use this in a child theme, then include a file called called content-___.php
			* (where ___ is the post format) and that will be used instead.
			*/
			the_content();
			wp_link_pages(array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'pin-minimal') . '</span>',
				'after' => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'pin-minimal') . ' </span>%',
				'separator' => '<span class="screen-reader-text">, </span>',
			));
?>
        <div class="clear"></div>
        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()):
				comments_template();
			endif;
		endwhile;
		// Previous/next post navigation.
		the_posts_pagination(array(
			'mid_size' => 2,
			'prev_text' => esc_html__('Back', 'pin-minimal') ,
			'next_text' => esc_html__('Next', 'pin-minimal') ,
		));
	else:
		// If no content, include the "No posts found" template.
		get_template_part('no-results', 'index');
	endif;
?>
      </div>
      </div>
      <!-- blog-post --> 
    </section>
    <?php
	}	
?>
   <div class="clear"></div>
<?php get_footer(); ?>