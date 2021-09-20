<?php
/**
 * Playlist Options
 *
 * @package Scapeshot Music
 */

/**
 * Add sticky_playlist options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function scapeshot_music_sticky_playlist( $wp_customize ) {
	$wp_customize->add_section( 'scapeshot_sticky_playlist', array(
			'title' => esc_html__( 'Sticky Playlist', 'scapeshot-music' ),
			'panel' => 'scapeshot_theme_options',
		)
	);

	scapeshot_register_option( $wp_customize, array(
			'name'              => 'scapeshot_sticky_playlist_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'scapeshot_sanitize_select',
			'choices'           => scapeshot_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'scapeshot-music' ),
			'section'           => 'scapeshot_sticky_playlist',
			'type'              => 'select',
		)
	);

	scapeshot_register_option( $wp_customize, array(
			'name'              => 'scapeshot_sticky_playlist',
			'default'           => '0',
			'sanitize_callback' => 'scapeshot_sanitize_post',
			'active_callback'   => 'scapeshot_music_is_sticky_playlist_active',
			'label'             => esc_html__( 'Page', 'scapeshot-music' ),
			'section'           => 'scapeshot_sticky_playlist',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'scapeshot_music_sticky_playlist', 12 );

/** Active Callback Functions **/
if ( ! function_exists( 'scapeshot_music_is_sticky_playlist_active' ) ) :
	/**
	* Return true if sticky_playlist is active
	*
	* @since 1.0
	*/
	function scapeshot_music_is_sticky_playlist_active( $control ) {
		$enable = $control->manager->get_setting( 'scapeshot_sticky_playlist_visibility' )->value();

		return scapeshot_check_section( $enable );
	}
endif;
