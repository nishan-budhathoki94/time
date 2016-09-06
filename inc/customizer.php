<?php
/**
 * Time Theme Customizer.
 *
 * @package Time
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function time_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel('time_header_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 90,
      'title' => __('Header Options', 'time')
   ));

   // Header Logo upload option
   $wp_customize->add_section('time_header_logo', array(
      'priority' => 1,
      'title' => __('Header Logo', 'time'),
      'panel' => 'time_header_options'
   ));

	$wp_customize->add_setting(
		'time_logo',
		array(
			'default'            => '',
			'capability'         => 'edit_theme_options',
			'sanitize_callback'  => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'time_logo',
			array(
				'label'    => esc_html__( 'Upload logo' , 'time' ),
				'section'  => 'time_header_logo',
				'setting'  => 'time_logo'
			)
		)
	);

		/****************************************Start of the Slider Options****************************************/

	// Adding Text Area Control For Use In Customizer
    class Time_Text_Area_Control extends WP_Customize_Control {

      public $type = 'text_area';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }

    }

	// Slider section
	$wp_customize->add_panel('time_slider', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 85,
      'title' => __('Slider', 'time')
    ));

	//checkbox for activating slider
    $wp_customize->add_section('time_slider_options', array(
      'priority' => 1,
      'title' => __('Slider Options', 'time'),
      'panel' => 'time_slider'
    ));

 	$wp_customize->add_setting('time_activate_slider', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'time_checkbox_sanitize'
    ));

    $wp_customize->add_control('time_activate_slider', array(
      'type' => 'checkbox',
      'label' => __('Check to activate slider.', 'time'),
      'section' => 'time_slider_options',
      'settings' => 'time_activate_slider'
    ));

    //Number of frames in slider
    $wp_customize->add_setting('time_slider_number', array(
      'default' => 5,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'time_slider_number_sanitize'
    ));

    $wp_customize->add_control('time_slider_number', array(
      'label' => __( 'Number of slides', 'time' ).'  '.__( 'Enter the number of slides you want then click save.', 'time' ),
      'section' => 'time_slider_options',
      'settings' => 'time_slider_number'
    ));

    $num_of_slides = absint(get_theme_mod( 'time_slider_number', '5' ));
    //looping for number of slides in slider
    for ( $i = 1; $i <= $num_of_slides; $i++ ) {
       // adding slider section
        $wp_customize->add_section('time_slider_number_section'.$i, array(
         'priority' => 10,
         'title' => sprintf( __( 'Image Upload #%1$s', 'time' ), $i ),
         'panel' => 'time_slider'
        ));

        // adding slider image url
        $wp_customize->add_setting('time_slider_image'.$i, array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'time_slider_image'.$i, array(
         'label' => __( 'Upload slider image.', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_image'.$i
        )));

        // adding slider title
        $wp_customize->add_setting('time_slider_title'.$i, array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
        ));

        $wp_customize->add_control('time_slider_title'.$i, array(
         'label' => __( 'Enter title for your slider.', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_title'.$i
        ));

        // adding slider description
        $wp_customize->add_setting('time_slider_text'.$i, array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'time_text_sanitize'
        ));

        $wp_customize->add_control(new Time_Text_Area_Control($wp_customize, 'time_slider_text'.$i, array(
         'label' => __( 'Enter your slider description.', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_text'.$i
        )));

        // adding slider button text
        $wp_customize->add_setting('time_slider_first_button_text'.$i, array(
         'default' => __( 'Learn more', 'time' ),
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
        ));

        $wp_customize->add_control('time_slider_first_button_text'.$i, array(
         'label' => __( 'Enter the text for first button. Default is "Learn More"', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_first_button_text'.$i
        ));

        // adding first slider button url
        $wp_customize->add_setting('time_slider_first_button_link'.$i, array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('time_slider_first_button_link'.$i, array(
         'label' => __( 'Enter link for first button(Leaving the field empty won\'t display this button)', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_first_button_link'.$i
        ));

         // adding second slider button text
        $wp_customize->add_setting('time_slider_second_button_text'.$i, array(
         'default' => __( 'Buy Now', 'time' ),
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
        ));

        $wp_customize->add_control('time_slider_second_button_text'.$i, array(
         'label' => __( 'Enter the text for second button. Default is "But Now"', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_second_button_text'.$i
        ));

        // adding second slider button url
        $wp_customize->add_setting('time_slider_second_button_link'.$i, array(
         'default' => '',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
        ));

		$wp_customize->add_control('time_slider_second_button_link'.$i, array(
         'label' => __( 'Enter link for second button(Leaving the field empty won\'t display this button)', 'time' ),
         'section' => 'time_slider_number_section'.$i,
         'setting' => 'time_slider_second_button_link'.$i
  	    ));
    }
    // End of Slider Options

   				/****************************************Sanitazation****************************************/


  // Footer section
  $wp_customize->add_panel('time_footer', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 110,
      'title' => __('Footer', 'time')
    ));

  //checkbox for activating footer
  $wp_customize->add_section('time_footer_options', array(
    'priority' => 1,
    'title' => __('Footer options', 'time'),
    'panel' => 'time_footer'
  ));

  $wp_customize->add_setting('time_activate_footer', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'time_checkbox_sanitize'
  ));

  $wp_customize->add_control('time_activate_footer', array(
    'type' => 'checkbox',
    'label' => __('Check to activate footer.', 'time'),
    'section' => 'time_footer_options',
    'settings' => 'time_activate_footer'
  ));

   // adding footer description
  $wp_customize->add_setting('time_footer_text', array(
     'default' => '',
     'capability' => 'edit_theme_options',
     'sanitize_callback' => 'time_text_sanitize'
  ));

  $wp_customize->add_control(new Time_Text_Area_Control($wp_customize, 'time_footer_text', array(
   'label' => __( 'Enter footer text.', 'time' ),
   'section' => 'time_footer_options',
   'setting' => 'time_footer_text'
  )));

  //Footer design(Color and alignment)
  $wp_customize->add_section('time_footer_design_options', array(
    'priority' => 1,
    'title' => __('Footer Design options', 'time'),
    'panel' => 'time_footer'
  ));

  $wp_customize->add_setting('time_footer_color', array(
     'default' => '#e3e3e3',
     'capability' => 'edit_theme_options',
     'sanitize_callback' => 'time_color_option_hex_sanitize',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'time_footer_color', array(
        'label' => 'Select a background color for the footer '.__('Default is : #E3E3E3','time'),
        'settings' => 'time_footer_color',
        'section' => 'time_footer_design_options'
     )));

  $wp_customize->add_setting('time_footer_text_position', array(
     'default' => '',
     'capability' => 'edit_theme_options',
     'sanitize_callback' => 'time_text_sanitize'
  ));

  $wp_customize->add_control('time_footer_text_position', array(
   'label' => __( 'Choose the footer text alignment', 'time' ),
   'type' => 'select',
   'section' => 'time_footer_design_options',
   'setting' => 'time_footer_text_position',
   'choices' => array(
        'center' => 'Center',
        'left' => 'Left',
        'Right' => 'right',
    ),
   ));

  $wp_customize->add_setting('time_primary_color', array(
     'default' => '#C83434',
     'capability' => 'edit_theme_options',
     'sanitize_callback' => 'time_color_option_hex_sanitize',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'time_primary_color', array(
        'label' => 'Select a primary color for your theme '.__('Default is: #c83434', 'time'),
        'settings' => 'time_primary_color',
        'section' => 'colors'
  )));

   $wp_customize->add_setting('time_hover_color', array(
     'default' => '#C83434',
     'capability' => 'edit_theme_options',
     'sanitize_callback' => 'time_color_option_hex_sanitize',
  ));  

  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'time_hover_color', array(
        'label' => 'Select a hover color for your theme '.__('Default is: #c83434','time'),
        'settings' => 'time_hover_color',
        'section' => 'colors'
  )));

   // Design Section
  $wp_customize->add_panel('time_design_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 90,
      'title' => __('Design', 'time')
    ));
  
  //Section for Custom CSS
  $wp_customize->add_section('time_custom_css_section', array(
    'priority' => 1,
    'title' => __('Custom Css', 'time'),
    'panel' => 'time_design_options'
  ));

  // Textarea for adding custom css
  $wp_customize->add_setting('time_custom_css_text', array(
   'default' => '',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'time_text_sanitize'
  ));

  $wp_customize->add_control(new Time_Text_Area_Control($wp_customize, 'time_custom_css_text', array(
   'label' => __( 'Enter your custom css here.', 'time' ),
   'section' => 'time_custom_css_section',
   'setting' => 'time_design_options'
  )));

    // slider number sanitize
    function time_slider_number_sanitize($input) {
      if( is_numeric( $input ) ) {
         return intval( $input );
      }
      else
         return 2;
    }

    // checkbox sanitize
    function time_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
    }

     // text-area sanitize
    function time_text_sanitize($input) {
      return wp_kses_post( force_balance_tags( $input ) );
    }

    // Color sanitization
   function time_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }


}
add_action( 'customize_register', 'time_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function time_customize_preview_js() {
	wp_enqueue_script( 'time_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'time_customize_preview_js' );
