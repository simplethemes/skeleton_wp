<?php
/**
 * Skeleton Theme Customizer
 */

function skeleton_options($name, $default = false) {
	$options = ( get_option( 'skeleton_options' ) ) ? get_option( 'skeleton_options' ) : null;

	// return the option if it exists
	if ( isset( $options[ $name ] ) ) {
		return apply_filters( 'skeleton_options_$name', $options[ $name ] );
	}

	// return default if nothing else
	return apply_filters( 'skeleton_options_$name', $default );
}

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 */

function skeleton_customize_register( $wp_customize ) {

	// custom textarea control
	class Skeleton_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	// custom info text
	class Skeleton_Customize_Infotext_Control extends WP_Customize_Control {
	    public $type = 'infotext';
	    public function render_content() {
	        ?>
	        <p class="description"><?php echo( $this->label ); ?></p>
	        <?php
	    }
	}

	// Begin options

	$wp_customize->get_setting( 'blogname' )->transport = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'colors');

	$wp_customize->add_section( 'title_tagline' , array(
		'title'       => __( 'Site Title &amp; Tagline', 'smpl' ),
		'priority'    => 10
	) );


	// Header
	$wp_customize->add_section( 'skeleton_logotype' , array(
		'title'       => __( 'Header', 'smpl' ),
		'priority'    => 20,
		'description' => 'Upload a logo to replace the default site name in the header',
	) );
	$wp_customize->add_setting( 'skeleton_options[logotype]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logotype', array(
		'label'        => __( 'Logo', 'smpl' ),
		'section'    => 'skeleton_logotype',
		'settings'   => 'skeleton_options[logotype]',
	) ) );


	// Custom Background
	$wp_customize->add_section( 'background_image', array(
	     'title'          => __( 'Background', 'smpl' ),
	     'theme_supports' => 'custom-background',
	     'priority'       => 30,
	) );
	$wp_customize->add_setting('skeleton_options[body_bg_color]', array(
		'default' => 'F7F7F7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg_color', array(
		'label' => __('Background Color', 'smpl'),
		'section' => 'background_image',
		'settings' => 'skeleton_options[body_bg_color]',
	)));


	// Layout Preferences
	$wp_customize->add_section( 'skeleton_layout' , array(
		'title'       => __( 'Layout Preferences', 'smpl' ),
		'priority'    => 40,
		'description' => 'Select preferred container maximum layout width.',
	) );
	$wp_customize->add_setting( 'skeleton_options[layout]', array(
		'capability' => 'edit_theme_options',
		'default'   => '960',
		'type' => 'option'
	) );
	$wp_customize->add_control( 'layout', array(
		'settings' => 'skeleton_options[layout]',
		'label'   => __( 'Layout', 'smpl' ),
		'section' => 'skeleton_layout',
		'type'    => 'radio',
		'choices'    => array(
			'960' => '960px',
			'1140' => '1140px',
			'1200' => '1200px'
		)
	));


	// Sidebar Column Select

	$wp_customize->add_setting('skeleton_options[layout_info]');
	$wp_customize->add_control( new Skeleton_Customize_Infotext_Control($wp_customize, 'layout_info', array(
		'label' => __('Adjust the sidebar and content width.<br />The total number of columns should be 16.', 'smpl'),
		'section' => 'skeleton_layout',
		'settings' => 'skeleton_options[layout_info]',
	)));

	$wp_customize->add_setting('skeleton_options[sidebar_width]', array(
        'default'        => 'five',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'sidebar_width', array(
        'settings' => 'skeleton_options[sidebar_width]',
        'label'   => 'Sidebar Width:',
        'section' => 'skeleton_layout',
        'type'    => 'select',
        'choices' => array(
            'one'	=> '1 Column',
            'two'	=> '2 Columns',
            'three'	=> '3 Columns',
            'four'	=> '4 Columns',
            'five'	=> '5 Columns',
            'six'	=> '6 Columns',
            'seven'	=> '7 Columns',
            'eight' => '8 Columns'
        ),
    ));


	// Main Column Select
	$wp_customize->add_setting('skeleton_options[content_width]', array(
        'default'        => 'eleven',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'content_width', array(
        'settings' => 'skeleton_options[content_width]',
        'label'   => 'Content Width:',
        'section' => 'skeleton_layout',
        'type'    => 'select',
        'choices'    => array(
            'one'	 => '1 Column',
            'two'	 => '2 Columns',
            'three'	 => '3 Columns',
            'four'	 => '4 Columns',
            'five'	 => '5 Columns',
            'six'	 => '6 Columns',
            'seven'	 => '7 Columns',
            'eight'  => '8 Columns',
            'nine'	 => '9 Columns',
            'ten'	 => '10 Columns',
            'eleven' => '11 Columns',
            'twelve' => '12 Columns',
            'thirteen' => '13 Columns'
        ),
    ));


	// Sidebar Position
	$wp_customize->add_setting('skeleton_options[sidebar_position]', array(
        'default'        => 'right',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'sidebar_position', array(
        'settings' => 'skeleton_options[sidebar_position]',
        'label'   => 'Sidebar Position:',
        'section' => 'skeleton_layout',
        'type'    => 'select',
        'choices'    => array(
            'left' => 'Left',
            'right' => 'Right'
        ),
    ));



	// Fonts
	$available_fonts = array(
			'Sans-Serif' => 'Sans-Serif',
			'Serif' => 'Serif',
			'Rokkitt' => 'Rokkitt',
			'Kameron' => 'Kameron',
			'Abel' => 'Abel',
			'Alice' => 'Alice',
			'Aller' => 'Aller',
			'Andada' => 'Andada',
			'Arbutus+Slab' => 'Arbutus Slab',
			'Arvo' => 'Arvo',
			'Brawler' => 'Brawler',
			'Cambo' => 'Cambo',
			'Cookie' => 'Cookie',
			'Droid+Sans' => 'Droid Sans',
			'Droid+Serif' => 'Droid Serif',
			'Fenix' => 'Fenix',
			'Judson' => 'Judson',
			'Josefin+Slab' => 'Josefin Slab',
			'Ledger' => 'Ledger',
			'Libre+Baskerville' => 'Libre Baskerville',
			'Lora' => 'Lora',
			'Lato' => 'Lato',
			'Mako' => 'Mako',
			'Marck+Script' => 'Marck Script',
			'Maven+Pro' => 'Maven Pro',
			'Neuton' => 'Neuton',
			'Ovo' => 'Ovo',
			'Open+Sans' => 'Open Sans',
			'PT+Sans' => 'PT Sans',
			'PT+Serif+Caption' => 'PT Serif',
			'Roboto' => 'Roboto',
			'Ubuntu' => 'Ubuntu',
			'Vollkorn' => 'Vollkorn'
			);
	$wp_customize->add_section( 'skeleton_fonts' , array(
		'title'       => __( 'Typography', 'smpl' ),
		'priority'    => 50,
		'description' => 'Set main website font',
	) );
	$wp_customize->add_setting( 'skeleton_options[heading_font]', array(
		'capability' => 'edit_theme_options',
		'default'   => 'Sans-Serif',
		'type' => 'option'
	) );
	$wp_customize->add_setting( 'skeleton_options[body_font]', array(
		'capability' => 'edit_theme_options',
		'default'   => 'Sans-Serif',
		'type' => 'option'
	) );
	$wp_customize->add_control( 'heading_font', array(
		'settings' => 'skeleton_options[heading_font]',
		'label'   => __( 'Heading Font:', 'smpl' ),
		'section' => 'skeleton_fonts',
		'type'    => 'select',
		'choices'  => $available_fonts
	));
	$wp_customize->add_control( 'body_font', array(
		'settings' => 'skeleton_options[body_font]',
		'label'   => __( 'Body Font:', 'smpl' ),
		'section' => 'skeleton_fonts',
		'type'    => 'select',
		'choices'  => $available_fonts
	));


	// Body Text Color
	$wp_customize->add_setting('skeleton_options[body_text_color]', array(
		'default' => '333333',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text_color', array(
		'label' => __('Body Text Color', 'smpl'),
		'section' => 'skeleton_fonts',
		'settings' => 'skeleton_options[body_text_color]',
	)));


	// Link Color
	$wp_customize->add_setting('skeleton_options[link_color]', array(
		'default' => '3376ea',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label' => __('Link Color', 'smpl'),
		'section' => 'skeleton_fonts',
		'settings' => 'skeleton_options[link_color]',
	)));


	// Link Hover Color
	$wp_customize->add_setting('skeleton_options[link_hover_color]', array(
		'default' => '3376ea',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label' => __('Link Hover Color', 'smpl'),
		'section' => 'skeleton_fonts',
		'settings' => 'skeleton_options[link_hover_color]',
	)));


	// Colors
	$wp_customize->add_section( 'skeleton_colors', array(
		'title'    => __( 'Colors', 'smpl' ),
		'priority' => 60,
	) );
	// Primary Color
	$wp_customize->add_setting('skeleton_options[primary_color]', array(
		'default' => '375199',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
		'label' => __('Primary Brand Color', 'smpl'),
		'section' => 'skeleton_colors',
		'settings' => 'skeleton_options[primary_color]',
	)));


	// Secondary Color
	$wp_customize->add_setting('skeleton_options[secondary_color]', array(
		'default' => 'be3243',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
		'label' => __('Secondary Brand Color', 'smpl'),
		'section' => 'skeleton_colors',
		'settings' => 'skeleton_options[secondary_color]',
	)));



	// Header & Footer Extras
	$wp_customize->add_section( 'skeleton_extras', array(
		'title'    => __( 'Extras', 'smpl' ),
		'priority' => 70,
		'description' => 'Use the fields below to add some simple text (such as a phone number or copyright) to the header and footer areas.',
	) );

	// Header Extras
	$wp_customize->add_setting('skeleton_options[header_extras]', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new Skeleton_Customize_Textarea_Control($wp_customize, 'header_extras', array(
		'label' => __('Header Extras Text', 'smpl'),
		'section' => 'skeleton_extras',
		'settings' => 'skeleton_options[header_extras]',
	)));

	// Footer Extras
	$wp_customize->add_setting('skeleton_options[footer_extras]', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new Skeleton_Customize_Textarea_Control($wp_customize, 'footer_extras', array(
		'label' => __('Footer Extras Text', 'smpl'),
		'section' => 'skeleton_extras',
		'settings' => 'skeleton_options[footer_extras]',
	)));

}

add_action( 'customize_register', 'skeleton_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skeleton_customize_preview_js() {
	wp_enqueue_script( 'skeleton_customizer', get_template_directory_uri() . '/javascripts/customizer.js', array( 'jquery','customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'skeleton_customize_preview_js' );
add_action( 'admin_menu', 'skeleton_remove_menu_pages', 999 );
function skeleton_remove_menu_pages() {
		remove_submenu_page( 'themes.php', 'custom-background');
}
add_action( 'admin_bar_menu', 'skeleton_remove_admin_bar_pages', 999 );
function skeleton_remove_admin_bar_pages($wp_admin_bar) {
		$wp_admin_bar->remove_node( 'background' );
}
