<?php
/**
 * Correct Lite Theme Customizer
 *
 * @package Pin Minimal
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pin_minimal_customize_register( $wp_customize ) {
	//Add a class for titles
    class pin_minimal_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#e4a62b',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','pin-minimal'),			
			 'description'	=> esc_html__('More color options in PRO Version','pin-minimal'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => esc_html__('Slider Settings', 'pin-minimal'),
            'priority' => null,
            'description'	=> esc_html__('Slider Display When Frontpage Is Selected. Featured Image Size Should be ( 1400 X 830 ) More slider settings available in PRO Version','pin-minimal'),		
        )
    );
	
	$wp_customize->add_setting('page-setting10',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting10',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide one:','pin-minimal'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting11',array(
			'default' => '0',
			'capability' => 'edit_theme_options',			
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting11',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide two:','pin-minimal'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting12',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting12',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide three:','pin-minimal'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('slide_button',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_button',array(
			'label'	=> esc_html__('Add Slide Button Title Here','pin-minimal'),
			'section'	=> 'slider_section',
			'setting'	=> 'slide_button'
	));	
	
	//Slider hide
	$wp_customize->add_setting('hide_slides',array(
			'sanitize_callback' => 'wp_validate_boolean',
			'default' => true,
	));	 

	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',    	 
		   'label'	=> esc_html__('Check To Hide Slider','pin-minimal'),
    	   'type'      => 'checkbox'
     )); // Slider Section		
	
	// Header Number Box Start
	$wp_customize->add_section('header_phone_number',array(
			'title'	=> esc_html__('Header Phone Number','pin-minimal'),					
			'priority'		=> null
	));
	
	$wp_customize->add_setting('header_number_heading',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('header_number_heading',array(
			'label'	=> esc_html__('Add Phone Number Top Title','pin-minimal'),
			'section'	=> 'header_phone_number',
			'setting'	=> 'header_number_heading'
	));		
	
	$wp_customize->add_setting('header_number_phone',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('header_number_phone',array(
			'label'	=> esc_html__('Add Phone Number','pin-minimal'),
			'section'	=> 'header_phone_number',
			'setting'	=> 'header_number_phone'
	));	

	// Hide Header Button
	$wp_customize->add_setting('hide_phone_number',array(
			'sanitize_callback' => 'pin_minimal_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_phone_number', array(
    	   'section'   => 'header_phone_number',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','pin-minimal'),
    	   'type'      => 'checkbox'
     )); 	
	 // Hide Header Button	
	 
	 // Header Number Box End
	 
// Footer Box Start

	$wp_customize->add_section('footer_boxbar',array(
			'title'	=> esc_html__('Footer Box','pin-minimal'),					
			'priority'		=> null
	));
	
    $wp_customize->add_setting( 'footer_logo_thumb', array(
        'default' => '', 
        'sanitize_callback' => 'esc_url_raw'
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo_thumb_control', array(
        'label'	=> esc_html__('Footer Logo','pin-minimal'),
        'section' => 'footer_boxbar',
        'settings' => 'footer_logo_thumb',
        'button_labels' => array(// All These labels are optional
                    'select' => 'Select Logo',
                    'remove' => 'Remove Logo',
                    'change' => 'Change Logo',
                    )
    )));
	
	$wp_customize->add_setting('footer_logo_thumb_url',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('footer_logo_thumb_url',array(
			'label'	=> esc_html__('Footer Logo Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'footer_logo_thumb_url'
	));		

	$wp_customize->add_setting('facebook_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('facebook_link',array(
			'label'	=> esc_html__('Add Facebook Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'facebook_link'
	));	
	$wp_customize->add_setting('twitter_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitter_link',array(
			'label'	=> esc_html__('Add Twitter Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'twitter_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> esc_html__('Add Linkedin Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'linked_link'
	));
	
	$wp_customize->add_setting('youtube_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('youtube_link',array(
			'label'	=> esc_html__('Add Youtube Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'youtube_link'
	));	
	
	$wp_customize->add_setting('instagram_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('instagram_link',array(
			'label'	=> esc_html__('Add Instagram Link','pin-minimal'),
			'section'	=> 'footer_boxbar',
			'setting'	=> 'instagram_link'
	));		

	// Hide Footer Info Box
	$wp_customize->add_setting('hide_footer_boxbar',array(
			'sanitize_callback' => 'pin_minimal_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_footer_boxbar', array(
    	   'section'   => 'footer_boxbar',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','pin-minimal'),
    	   'type'      => 'checkbox'
     )); 	
	 // Hide Footer Info Box	
     
// Footer Box End     	 
}
add_action( 'customize_register', 'pin_minimal_customize_register' );

function pin_minimal_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//setting inline css.
function pin_minimal_custom_css() {
    wp_enqueue_style(
        'pin-minimal-custom-style',
        get_template_directory_uri() . '/css/custom_script.css'
    );
        $color = esc_html(get_theme_mod( 'color_scheme' )); //E.g. #FF0000
		$header_text_color = esc_attr(get_header_textcolor());
		
        $custom_css = "
                #sidebar ul li a:hover,
					.cols-3 ul li a:hover, .cols-3 ul li.current_page_item a,					
					.phone-no strong,					
					.left a:hover,
					.blog_lists h4 a:hover,
					.recent-post h6 a:hover,
					.postmeta a:hover,
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,
					.sitenav ul li:hover > ul li a:hover,
					.sitenav .sub-menu li a:hover,
					.sitenav .children li a:hover,
					.site-navigation .menu a:hover, .site-navigation .menu a:focus,
					.phonenumber-button:hover,
					.recent-post .morebtn:hover{
                        color: {$color};
                }
				
                .pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.wpcf7 input[type='submit'],					
					.social-icons a:hover,
					.benefitbox-4:hover .benefitbox-title,
					.slide_info .slide_more:hover,
					input.search-submit{
                        background-color: {$color};
                }
				
				.logo h2, .logo p{
					color: #$header_text_color;
				}
				";
        wp_add_inline_style( 'pin-minimal-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'pin_minimal_custom_css' );         

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pin_minimal_customize_preview_js() {
	wp_enqueue_script( 'pin_minimal_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pin_minimal_customize_preview_js' );