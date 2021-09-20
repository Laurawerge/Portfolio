<?php
/*
 * This is the child theme for Scapeshot Music theme.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
function scapeshot_music_enqueue_styles() {
    // Include parent theme CSS.
    wp_enqueue_style( 'scapeshot-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );
    
    // Include child theme CSS.
    wp_enqueue_style( 'scapeshot-music-style', get_stylesheet_directory_uri() . '/style.css', array( 'scapeshot-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

	// Load the rtl.
	if ( is_rtl() ) {
		wp_enqueue_style( 'scapeshot-rtl', get_template_directory_uri() . '/rtl.css', array( 'scapeshot-style' ), $version );
	}

	// Enqueue child block styles after parent block style.
	wp_enqueue_style( 'scapeshot-music-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'scapeshot-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'scapeshot_music_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function scapeshot_music_editor_style() {
	add_editor_style( array(
			'assets/css/child-editor-style.css',
			scapeshot_fonts_url(),
			get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
		)
	);
}
add_action( 'after_setup_theme', 'scapeshot_music_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function scapeshot_music_block_editor_styles() {
	// Enqueue child block editor style after parent editor block css.
	wp_enqueue_style( 'scapeshot-music-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'scapeshot-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'scapeshot_music_block_editor_styles', 11 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function scapeshot_music_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-music';

	//Sticky Playlist
	$enable_section = get_theme_mod( 'scapeshot_sticky_playlist_visibility', 'disabled' );

	if ( scapeshot_check_section( $enable_section ) ) {
		$classes[] = 'sticky-playlist-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'scapeshot_music_body_classes', 100 );

/**
 * Change default header text color
 */
function scapeshot_music_dark_header_default_color( $args ) {
	$args['default-image'] =  get_theme_file_uri( 'assets/images/header-image.jpg' );

	return $args;
}
add_filter( 'scapeshot_custom_header_args', 'scapeshot_music_dark_header_default_color' );

/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
function scapeshot_music_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}

	$next_track_text   = esc_attr__( 'Next Track', 'scapeshot-music' );
	$prev_track_text   = esc_attr__( 'Previous Track', 'scapeshot-music' );
	$toggle_text       = esc_attr__( 'Toggle Playlist', 'scapeshot-music' );

	$next_track_icon = scapeshot_get_svg( array(
		'icon'     => 'next',
		'fallback' => true,
	) );

	$prev_track_icon = scapeshot_get_svg( array(
		'icon'     => 'prev',
		'fallback' => true,
	) );

	$toggle_icon = scapeshot_get_svg( array(
		'icon'     => 'playlist',
		'fallback' => true,
	) );

	$toggle_close = scapeshot_get_svg( array(
		'icon'     => 'close',
		'fallback' => true,
	) );

 	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};

		settings.features = settings.features || mejs.MepDefaults.features;

		settings.features.push( 'scapeshot_class' );

		MediaElementPlayer.prototype.buildscapeshot_class = function(player, controls, layers, media) {
			if ( ! player.isVideo ) {
				var container = player.container[0] || player.container;

				container.style.height = '';
				container.style.width = '';
				player.options.setDimensions = false;
			}

			if ( jQuery( '#' + player.id ).parents('#sticky-playlist-section').length ) {
				player.container.addClass( 'mejs-container mejs-sticky-playlist-container' );

				jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').addClass('displaynone');

				var volume_slider = controls[0].children[5];

				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var playlist_button =
					jQuery('<div class="mejs-playlist-button mejs-toggle-playlist ">' +
						'<button type="button" aria-controls="mep_0" title="<?php echo esc_attr( $toggle_text ); ?>"><?php echo $toggle_icon; ?><?php echo $toggle_close; ?>
						</button>' +
					'</div>')

					// append it to the toolbar
					.appendTo( jQuery( '#' + player.id ) )

					// add a click toggle event
					.on( 'click',function() {
						jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').slideToggle();
						jQuery( this ).toggleClass('is-open')
					});

					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $next_track_text ); ?>"><?php echo $next_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.on( 'click',function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $prev_track_text ); ?>"><?php echo $prev_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.on( 'click',function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			} else {
				player.container.addClass( 'mejs-container' );

				if ( jQuery( '#' + player.id ).parent().children('.wp-playlist-tracks').length > 0) {
					var play_button = controls[0].children[0];

					// Add next button after volume slider
					var next_button =
					jQuery('<div class="mejs-next-button mejs-next">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $next_track_text ); ?>"><?php echo $next_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertAfter(play_button)

					// add a click toggle event
					.on( 'click',function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-next').trigger('click');
					});

					// Add prev button after volume slider
					var previous_button =
					jQuery('<div class="mejs-previous-button mejs-previous">' +
						'<button type="button" aria-controls="' + player.id
						+ '" title="<?php echo esc_attr( $prev_track_text ); ?>"><?php echo $prev_track_icon; ?></button>' +
					'</div>')

					// insert after volume slider
					.insertBefore( play_button )

					// add a click toggle event
					.on( 'click',function() {
						jQuery( '#' + player.id ).parent().find( '.wp-playlist-prev').trigger('click');
					});
				}
			}
		}
	})();
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'scapeshot_music_mejs_add_container_class' );

/**
 * Load Customizer Options
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/sticky-playlist.php';
