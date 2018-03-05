<?php
/**
 * Alzira Theme Customizer
 *
 * @package Alzira
 */

function alzira_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );
    $wp_customize->get_section( 'header_image' )->panel = 'alzira_header_panel';
    $wp_customize->get_section( 'header_image' )->priority = '13';
    $wp_customize->get_section( 'title_tagline' )->priority = '9';
    $wp_customize->get_section( 'title_tagline' )->title = __('Site title/tagline/logo', 'alzira');
    $wp_customize->get_section( 'colors' )->title = __('General', 'alzira');
    $wp_customize->get_section( 'colors' )->panel = 'alzira_colors_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';

    //Divider
    class Alzira_Divider extends WP_Customize_Control {
         public function render_content() {
            echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
         }
    }
    //Titles
    class Alzira_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }    
    //Titles
    class Alzira_Theme_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }


    //___General___//
    $wp_customize->add_section(
        'alzira_general',
        array(
            'title'         => __('General', 'alzira'),
            'priority'      => 8,
        )
    );
    //Top padding
    $wp_customize->add_setting(
        'wrapper_top_padding',
        array(
            'default' => __('83','alzira'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_top_padding',
        array(
            'label'         => __( 'Page wrapper - top padding', 'alzira' ),
            'section'       => 'alzira_general',
            'type'          => 'number',
            'description'   => __('Top padding for the page wrapper (the space between the header and the page title)', 'alzira'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
            ),            
        )
    );
    //Bottom padding
    $wp_customize->add_setting(
        'wrapper_bottom_padding',
        array(
            'default' => __('100','alzira'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_bottom_padding',
        array(
            'label'         => __( 'Page wrapper - bottom padding', 'alzira' ),
            'section'       => 'alzira_general',
            'type'          => 'number',
            'description'   => __('Bottom padding for the page wrapper (the space between the page content and the footer)', 'alzira'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
            ),            
        )
    );
    //___Header area___//
    $wp_customize->add_panel( 'alzira_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header area', 'alzira'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'alzira_header_type',
        array(
            'title'         => __('Header type', 'alzira'),
            'priority'      => 10,
            'panel'         => 'alzira_header_panel', 
            'description'   => __('You can select your header type from here. After that, continue below to the next two tabs (Header Slider and Header Image) and configure them.', 'alzira'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'slider',
            'sanitize_callback' => 'alzira_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'alzira'),
            'section'     => 'alzira_header_type',
            'description' => __('Select the header type for your front page', 'alzira'),
            'choices' => array(
                'slider'    => __('Full screen slider', 'alzira'),
                'image'     => __('Image', 'alzira'),
                'core-video'=> __('Video', 'alzira'),
                'nothing'   => __('No header (only menu)', 'alzira')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'alzira_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'alzira'),
            'section'     => 'alzira_header_type',
            'description' => __('Select the header type for all pages except the front page', 'alzira'),
            'choices' => array(
                'slider'    => __('Full screen slider', 'alzira'),
                'image'     => __('Image', 'alzira'),
                'core-video'=> __('Video', 'alzira'),
                'nothing'   => __('No header (only menu)', 'alzira')
            ),
        )
    );    
    //___Slider___//
    $wp_customize->add_section(
        'alzira_slider',
        array(
            'title'         => __('Header Slider', 'alzira'),
            'description'   => __('You can add up to 5 images in the slider. Make sure you select where to display your slider from the Header Type section found above. You can also add a Call to action button (scroll down to find the options)', 'alzira'),
            'priority'      => 11,
            'panel'         => 'alzira_header_panel',
        )
    );
    //Mobile slider
    $wp_customize->add_setting(
        'mobile_slider',
        array(
            'default'           => 'responsive',
            'sanitize_callback' => 'alzira_sanitize_mslider',
        )
    );
    $wp_customize->add_control(
        'mobile_slider',
        array(
            'type'        => 'radio',
            'label'       => __('Slider mobile behavior', 'alzira'),
            'section'     => 'alzira_slider',
            'priority'    => 99,
            'choices' => array(
                'fullscreen'    => __('Full screen', 'alzira'),
                'responsive'    => __('Responsive', 'alzira'),
            ),
        )
    );    
    //Speed
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default' => __('4000','alzira'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'slider_speed',
        array(
            'label' => __( 'Slider speed', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'number',
            'description'   => __('Slider speed in miliseconds. Use 0 to disable [default: 4000]', 'alzira'),       
            'priority' => 7
        )
    );
    $wp_customize->add_setting(
        'textslider_slide',
        array(
            'sanitize_callback' => 'alzira_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'textslider_slide',
        array(
            'type'      => 'checkbox',
            'label'     => __('Stop the text slider?', 'alzira'),
            'section'   => 'alzira_slider',
            'priority'  => 9,
        )
    );
    //Image 1
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 's1', array(
        'label' => __('First slide', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_1',
        array(
            'default' => get_template_directory_uri() . '/images/1.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_1',
            array(
               'label'          => __( 'Upload your first image for the slider', 'alzira' ),
               'type'           => 'image',
               'section'        => 'alzira_slider',
               'settings'       => 'slider_image_1',
               'priority'       => 11,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_1',
        array(
            'default' => __('Welcome to Alzira','alzira'),
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_1',
        array(
            'label' => __( 'Title for the first slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_1',
        array(
            'default' => __('Feel free to look around','alzira'),
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_1',
        array(
            'label' => __( 'Subtitle for the first slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 13
        )
    );           
    //Image 2
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 's2', array(
        'label' => __('Second slide', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 14
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_2',
        array(
            'default' => get_template_directory_uri() . '/images/2.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_2',
            array(
               'label'          => __( 'Upload your second image for the slider', 'alzira' ),
               'type'           => 'image',
               'section'        => 'alzira_slider',
               'settings'       => 'slider_image_2',
               'priority'       => 15,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_2',
        array(
            'default' => __('Ready to begin your journey?','alzira'),
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_2',
        array(
            'label' => __( 'Title for the second slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 16
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_2',
        array(
            'default' => __('Click the button below','alzira'),
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_2',
        array(
            'label' => __( 'Subtitle for the second slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 17
        )
    );    
    //Image 3
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 's3', array(
        'label' => __('Third slide', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 18
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_3',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_3',
            array(
               'label'          => __( 'Upload your third image for the slider', 'alzira' ),
               'type'           => 'image',
               'section'        => 'alzira_slider',
               'settings'       => 'slider_image_3',
               'priority'       => 19,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_3',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_3',
        array(
            'label' => __( 'Title for the third slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 20
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_3',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_3',
        array(
            'label' => __( 'Subtitle for the third slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 21
        )
    );            
    //Image 4
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 's4', array(
        'label' => __('Fourth slide', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 22
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_4',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_4',
            array(
               'label'          => __( 'Upload your fourth image for the slider', 'alzira' ),
               'type'           => 'image',
               'section'        => 'alzira_slider',
               'settings'       => 'slider_image_4',
               'priority'       => 23,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_4',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_4',
        array(
            'label' => __( 'Title for the fourth slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 24
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_4',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_4',
        array(
            'label' => __( 'Subtitle for the fourth slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 25
        )
    );    
    //Image 5
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 's5', array(
        'label' => __('Fifth slide', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 26
        ) )
    );    
    $wp_customize->add_setting(
        'slider_image_5',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_5',
            array(
               'label'          => __( 'Upload your fifth image for the slider', 'alzira' ),
               'type'           => 'image',
               'section'        => 'alzira_slider',
               'settings'       => 'slider_image_5',
               'priority'       => 27,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'slider_title_5',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_title_5',
        array(
            'label' => __( 'Title for the fifth slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 28
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'slider_subtitle_5',
        array(
            'default' => '',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_subtitle_5',
        array(
            'label' => __( 'Subtitle for the fifth slide', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 29
        )
    );
    //Header button
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'hbutton', array(
        'label' => __('Call to action button', 'alzira'),
        'section' => 'alzira_slider',
        'settings' => 'alzira_options[info]',
        'priority' => 30
        ) )
    );     
    $wp_customize->add_setting(
        'slider_button_url',
        array(
            'default' => '#primary',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'slider_button_url',
        array(
            'label' => __( 'URL for your call to action button', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 31
        )
    );
    $wp_customize->add_setting(
        'slider_button_text',
        array(
            'default' => __('Click to begin','alzira'),
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'slider_button_text',
        array(
            'label' => __( 'Text for your call to action button', 'alzira' ),
            'section' => 'alzira_slider',
            'type' => 'text',
            'priority' => 32
        )
    );         
    //___Menu style___//
    $wp_customize->add_section(
        'alzira_menu_style',
        array(
            'title'         => __('Menu style', 'alzira'),
            'priority'      => 15,
            'panel'         => 'alzira_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'alzira_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'alzira'),
            'section' => 'alzira_menu_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'alzira'),
                'static'   => __('Static', 'alzira'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'alzira_sanitize_menu_style',
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu style', 'alzira'),
            'section'   => 'alzira_menu_style',
            'choices'   => array(
                'inline'     => __('Inline', 'alzira'),
                'centered'   => __('Centered (menu and site logo)', 'alzira'),
            ),
        )
    );
    //Header image size
    $wp_customize->add_setting(
        'header_bg_size',
        array(
            'default'           => 'cover',
            'sanitize_callback' => 'alzira_sanitize_bg_size',
        )
    );
    $wp_customize->add_control(
        'header_bg_size',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Header background size', 'alzira'),
            'section' => 'header_image',
            'choices' => array(
                'cover'     => __('Cover', 'alzira'),
                'contain'   => __('Contain', 'alzira'),
            ),
        )
    );
    //Header height
    $wp_customize->add_setting(
        'header_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '300',
        )       
    );
    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'header_image',
        'label'       => __('Header height [default: 300px]', 'alzira'),
        'input_attrs' => array(
            'min'   => 250,
            'max'   => 600,
            'step'  => 5,
        ),
    ) );
    //Disable overlay
    $wp_customize->add_setting(
        'hide_overlay',
        array(
            'sanitize_callback' => 'alzira_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_overlay',
        array(
            'type'      => 'checkbox',
            'label'     => __('Disable the overlay?', 'alzira'),
            'section'   => 'header_image',
            'priority'  => 12,
        )
    );    
    //Logo Upload
    $wp_customize->add_setting(
        'site_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
               'label'          => __( 'Upload your logo', 'alzira' ),
               'type'           => 'image',
               'section'        => 'title_tagline',
               'priority'       => 12,
            )
        )
    );

    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'alzira'),
            'priority' => 13,
        )
    );  
    // Blog layout
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'alzira'),
        'section' => 'blog_options',
        'settings' => 'alzira_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'alzira_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'alzira'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'classic'           => __( 'Classic', 'alzira' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'alzira' ),
                'masonry-layout'    => __( 'Masonry (grid style)', 'alzira' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'alzira_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'alzira'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'content', array(
        'label' => __('Content/excerpt', 'alzira'),
        'section' => 'blog_options',
        'settings' => 'alzira_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content posts
    $wp_customize->add_setting(
      'full_content_home',
      array(
        'sanitize_callback' => 'alzira_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on the home page.', 'alzira'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'sanitize_callback' => 'alzira_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on all archives.', 'alzira'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '55',
        )       
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt length', 'alzira'),
        'description' => __('Choose your excerpt length. Default: 55 words', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
    //Meta
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'alzira'),
        'section' => 'blog_options',
        'settings' => 'alzira_options[info]',
        'priority' => 17
        ) )
    ); 
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'alzira_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on index, archives?', 'alzira'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'alzira_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Hide post meta on singles?', 'alzira'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    //Featured images
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'alzira'),
        'section' => 'blog_options',
        'settings' => 'alzira_options[info]',
        'priority' => 21
        ) )
    );     
    //Index images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'sanitize_callback' => 'alzira_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on index, archives etc.', 'alzira'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'sanitize_callback' => 'alzira_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on single posts', 'alzira'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );




    //___Footer___//
    $wp_customize->add_section(
        'alzira_footer',
        array(
            'title'         => __('Footer', 'alzira'),
            'priority'      => 18,
        )
    );
    //Front page
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'alzira_sanitize_fw',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'alzira'),
            'section'     => 'alzira_footer',
            'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'alzira'),
            'choices' => array(
                '1'     => __('One', 'alzira'),
                '2'     => __('Two', 'alzira'),
                '3'     => __('Three', 'alzira'),
                '4'     => __('Four', 'alzira')
            ),
        )
    );



    //___Fonts___//
    $wp_customize->add_section(
        'alzira_fonts',
        array(
            'title' => __('Fonts', 'alzira'),
            'priority' => 15,
            'description' => __('Google Fonts can be found here: google.com/fonts. See the documentation if you need help in selecting Google Fonts: athemes.com/documentation/alzira', 'alzira'),
        )
    );
    //Body fonts title
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'alzira'),
        'section' => 'alzira_fonts',
        'settings' => 'alzira_options[info]',
        'priority' => 10
        ) )
    );    
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Source+Sans+Pro:400,400italic,600',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'alzira' ),
            'section' => 'alzira_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Source Sans Pro\', sans-serif',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'alzira' ),
            'section' => 'alzira_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts title
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'alzira'),
        'section' => 'alzira_fonts',
        'settings' => 'alzira_options[info]',
        'priority' => 13
        ) )
    );      
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Raleway:400,500,600',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'alzira' ),
            'section' => 'alzira_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Raleway\', sans-serif',
            'sanitize_callback' => 'alzira_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Font family', 'alzira' ),
            'section' => 'alzira_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );
    //Font sizes title
    $wp_customize->add_setting('alzira_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'alzira'),
        'section' => 'alzira_fonts',
        'settings' => 'alzira_options[info]',
        'priority' => 16
        ) )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'alzira_fonts',
        'label'       => __('Site title', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'alzira_fonts',
        'label'       => __('Site description', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );  
    // Nav menu
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'alzira_fonts',
        'label'       => __('Menu items', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );           
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '52',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'alzira_fonts',
        'label'       => __('H1 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '42',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'alzira_fonts',
        'label'       => __('H2 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'alzira_fonts',
        'label'       => __('H3 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '25',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'alzira_fonts',
        'label'       => __('H4 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'alzira_fonts',
        'label'       => __('H5 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'alzira_fonts',
        'label'       => __('H6 font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'alzira_fonts',
        'label'       => __('Body font size', 'alzira'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );

    //___Colors___//
    $wp_customize->add_panel( 'alzira_colors_panel', array(
        'priority'       => 19,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Colors', 'alzira'),
    ) );
    $wp_customize->add_section(
        'colors_header',
        array(
            'title'         => __('Header', 'alzira'),
            'priority'      => 11,
            'panel'         => 'alzira_colors_panel',
        )
    );
    $wp_customize->add_section(
        'colors_sidebar',
        array(
            'title'         => __('Sidebar', 'alzira'),
            'priority'      => 12,
            'panel'         => 'alzira_colors_panel',
        )
    );
    $wp_customize->add_section(
        'colors_footer',
        array(
            'title'         => __('Footer', 'alzira'),
            'priority'      => 13,
            'panel'         => 'alzira_colors_panel',
        )
    );    
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#d65050',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'alzira'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 11
            )
        )
    );
    //Menu bg
    $wp_customize->add_setting(
        'menu_bg_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg_color',
            array(
                'label' => __('Menu background', 'alzira'),
                'section' => 'colors_header',
                'priority' => 12
            )
        )
    );     
    //Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'alzira'),
                'section' => 'colors_header',
                'settings' => 'site_title_color',
                'priority' => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'alzira'),
                'section' => 'colors_header',
                'priority' => 14
            )
        )
    );
    //Top level menu items
    $wp_customize->add_setting(
        'top_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'top_items_color',
            array(
                'label' => __('Top level menu items', 'alzira'),
                'section' => 'colors_header',
                'priority' => 15
            )
        )
    );
    //Menu items hover
    $wp_customize->add_setting(
        'menu_items_hover',
        array(
            'default'           => '#d65050',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
        	'menu_items_hover',
            array(
                'label' => __('Menu items hover', 'alzira'),
                'section' => 'colors_header',
                'priority' => 15
            )
        )
    );

    //Sub menu items color
    $wp_customize->add_setting(
        'submenu_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_items_color',
            array(
                'label' => __('Sub-menu items', 'alzira'),
                'section' => 'colors_header',
                'priority' => 16
            )
        )
    );
    //Sub menu background
    $wp_customize->add_setting(
        'submenu_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_background',
            array(
                'label' => __('Sub-menu background', 'alzira'),
                'section' => 'colors_header',
                'priority' => 17
            )
        )
    );
    //Mobile menu
    $wp_customize->add_setting(
        'mobile_menu_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mobile_menu_color',
            array(
                'label' => __('Mobile menu button', 'alzira'),
                'section' => 'colors_header',
                'priority' => 17
            )
        )
    );    
    //Slider text
    $wp_customize->add_setting(
        'slider_text',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'slider_text',
            array(
                'label' => __('Header slider text', 'alzira'),
                'section' => 'colors_header',
                'priority' => 18
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Body text', 'alzira'),
                'section' => 'colors',
                'priority' => 19
            )
        )
    );    
    //Sidebar backgound
    $wp_customize->add_setting(
        'sidebar_background',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_background',
            array(
                'label' => __('Sidebar background', 'alzira'),
                'section' => 'colors_sidebar',
                'priority' => 20
            )
        )
    );
    //Sidebar color
    $wp_customize->add_setting(
        'sidebar_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sidebar_color',
            array(
                'label' => __('Sidebar color', 'alzira'),
                'section' => 'colors_sidebar',
                'priority' => 21
            )
        )
    );
    //Footer widget area
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => '#252525',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_background',
            array(
                'label' => __('Footer widget area background', 'alzira'),
                'section' => 'colors_footer',
                'priority' => 22
            )
        )
    );
    //Footer widget color
    $wp_customize->add_setting(
        'footer_widgets_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_color',
            array(
                'label' => __('Footer widget area color', 'alzira'),
                'section' => 'colors_footer',
                'priority' => 23
            )
        )
    );
    //Footer background
    $wp_customize->add_setting(
        'footer_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background',
            array(
                'label' => __('Footer background', 'alzira'),
                'section' => 'colors_footer',
                'priority' => 24
            )
        )
    );
    //Footer color
    $wp_customize->add_setting(
        'footer_color',
        array(
            'default'           => '#666666',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            array(
                'label' => __('Footer color', 'alzira'),
                'section' => 'colors_footer',
                'priority' => 25
            )
        )
    );
    //Rows overlay
    $wp_customize->add_setting(
        'rows_overlay',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'rows_overlay',
            array(
                'label'         => __('Rows overlay', 'alzira'),
                'section'       => 'colors',
                'description'   => __('[DEPRECATED] Please use the color option from Edit Row > Design > Overlay color', 'alzira'),
                'priority'      => 26
            )
        )
    );


    //___Theme info___//
    $wp_customize->add_section(
        'alzira_themeinfo',
        array(
            'title' => __('Theme info', 'alzira'),
            'priority' => 139,
            'description' => '<p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('1. Documentation for Alzira can be found ', 'alzira') . '<a target="_blank" href="http://athemes.com/documentation/alzira/">here</a></p><p style="padding-bottom: 10px;border-bottom: 1px solid #d3d2d2">' . __('2. A full theme demo can be found ', 'alzira') . '<a target="_blank" href="http://demo.athemes.com/alzira/">here</a></p>',         
        )
    );
    $wp_customize->add_setting('alzira_theme_docs', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Alzira_Theme_Info( $wp_customize, 'documentation', array(
        'section' => 'alzira_themeinfo',
        'settings' => 'alzira_theme_docs',
        'priority' => 10
        ) )
    );  

}
add_action( 'customize_register', 'alzira_customize_register' );

/**
 * Sanitize
 */
//Header type
function alzira_sanitize_layout( $input ) {
    $valid = array(
        'slider'    => __('Full screen slider', 'alzira'),
        'image'     => __('Image', 'alzira'),
        'core-video'=> __('Video', 'alzira'),
        'nothing'   => __('Nothing (only menu)', 'alzira')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Text
function alzira_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Background size
function alzira_sanitize_bg_size( $input ) {
    $valid = array(
        'cover'     => __('Cover', 'alzira'),
        'contain'   => __('Contain', 'alzira'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Footer widget areas
function alzira_sanitize_fw( $input ) {
    $valid = array(
        '1'     => __('One', 'alzira'),
        '2'     => __('Two', 'alzira'),
        '3'     => __('Three', 'alzira'),
        '4'     => __('Four', 'alzira')
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Sticky menu
function alzira_sanitize_sticky( $input ) {
    $valid = array(
        'sticky'     => __('Sticky', 'alzira'),
        'static'   => __('Static', 'alzira'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Blog Layout
function alzira_sanitize_blog( $input ) {
    $valid = array(
        'classic'    => __( 'Classic', 'alzira' ),
        'fullwidth'  => __( 'Full width (no sidebar)', 'alzira' ),
        'masonry-layout'    => __( 'Masonry (grid style)', 'alzira' )

    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Mobile slider
function alzira_sanitize_mslider( $input ) {
    $valid = array(
        'fullscreen'    => __('Full screen', 'alzira'),
        'responsive'    => __('Responsive', 'alzira'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Menu style
function alzira_sanitize_menu_style( $input ) {
    $valid = array(
        'inline'     => __('Inline', 'alzira'),
        'centered'   => __('Centered (menu and site logo)', 'alzira'),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
//Checkboxes
function alzira_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alzira_customize_preview_js() {
	wp_enqueue_script( 'alzira_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'alzira_customize_preview_js' );
