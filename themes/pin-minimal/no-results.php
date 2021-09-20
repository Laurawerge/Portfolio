<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pin Minimal
 */
?>
<header>
	<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'pin-minimal'); ?></h1>
</header>
<div class="blog-post"><?php if (is_home() && current_user_can('publish_posts')): ?>
<p>
<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'pin-minimal' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif (is_search()): ?>
	<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pin-minimal'); ?></p>
	<?php get_search_form(); ?>
    <?php
	else: ?>
	<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pin-minimal'); ?> </p>
	<?php get_search_form(); ?>
<?php endif; ?>