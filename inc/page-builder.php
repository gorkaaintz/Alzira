<?php
/**
 * Page builder support
 *
 * @package Alzira
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function alzira_theme_widgets($widgets) {
	$theme_widgets = array(
		'Alzira_Services_Type_A',
		'Alzira_Services_Type_B',
		'Alzira_List',
		'Alzira_Facts',
		'Alzira_Clients',
		'Alzira_Testimonials',
		'Alzira_Skills',
		'Alzira_Action',
		'Alzira_Video_Widget',
		'Alzira_Social_Profile',
		'Alzira_Employees',
		'Alzira_Latest_News',
		'Alzira_Portfolio'
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('alzira-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'alzira_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function alzira_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Alzira Theme Widgets', 'alzira'),
		'filter' => array(
			'groups' => array('alzira-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'alzira_theme_widgets_tab', 20);

/* Replace default row options */
function alzira_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'alzira'),
		'type' => 'color',
		'priority' => 3,
		'group'	   => 'design'		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'alzira'),
		'type' => 'measurement',
		'description' => __('Add a value in the field to change the top/bottom row padding, otherwise 100px will be applied by default', 'alzira'),
		'priority' => 4,
		'group'	   => 'layout'
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'alzira'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'alzira'),
		'priority' => 5,
		'group'	   => 'design'		
	);		

	$fields['color'] = array(
		'name' => __('Color', 'alzira'),
		'type' => 'color',
		'description' => __('Color of the row.', 'alzira'),
		'priority' => 7,
		'group'	   => 'design'	
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'alzira'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'alzira'),
		'priority' => 8,
		'group'		=> 'design'
	);

	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'alzira'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'alzira'),		
		'options' 	  => array(
			'' 				=> __('Default', 'alzira'),
			'mob-pad-0' 	=> __('0', 'alzira'),
			'mob-pad-15'    => __('15px', 'alzira'),
			'mob-pad-30'    => __('30px', 'alzira'),
			'mob-pad-45'    => __('45px', 'alzira'),
		),
		'priority'    => 21,
		'group'	   => 'layout'		
	);
	$fields['overlay'] = array(
	    'name'        => __('Disable row overlay?', 'alzira'),
	    'type'        => 'checkbox',
	    'group'       => 'design',
	    'priority'    => 14,
	);
	$fields['overlay_color'] = array(
	    'name'        => __('Overlay color', 'alzira'),
	    'type'        => 'color',
	    'default'	  => '#000000',
	    'group'       => 'design',
	    'priority'    => 15,
	);

	return $fields;
}
//remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'alzira_row_styles');

/* Filter for the styles */
function alzira_row_styles_output($attr, $style) {
	//$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['data-hasbg'] = 'hasbg';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}

	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if ( empty($style['overlay']) ) {
    	$attr['data-overlay'] = 'true';
	}
	if ( !empty($style['overlay_color']) ) {
    	$attr['data-overlay-color'] = esc_attr($style['overlay_color']);		
	}

	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'alzira_row_styles_output', 10, 2);

/**
 * Page builder widget options
 */
function alzira_custom_widget_style_fields($fields) {
	$fields['content_alignment'] = array(
	    'name'        => __('Content alignment', 'alzira'),
		'type' 		  => 'select',
	    'group'       => 'design',
		'options' => array(
			'left' => __('Left', 'alzira'),
			'center' => __('Center', 'alzira'),
			'right' => __('Right', 'alzira'),
		),
		'default'	  => 'left',
	    'description' => __('This setting depends on the content, it may or may not work', 'alzira'),
	    'priority'    => 10,
	);	
	$fields['title_color'] = array(
	    'name'        => __('Widget title color', 'alzira'),
	    'type'        => 'color',
	    'default'	  => '#443f3f',
	    'group'       => 'design',
	    'priority'    => 11,
	);	
	$fields['headings_color'] = array(
	    'name'        => __('Headings color', 'alzira'),
	    'type'        => 'color',
	    'default'	  => '#443f3f',
	    'group'       => 'design',
	    'description' => __('This applies to all headings in the widget, except the widget title', 'alzira'),
	    'priority'    => 12,
	);

  return $fields;
}
add_filter( 'siteorigin_panels_widget_style_fields', 'alzira_custom_widget_style_fields');

/**
 * Output page builder widget options
 */
function alzira_custom_widget_style_attributes( $attributes, $args ) {

	if ( !empty($args['title_color']) ) {
    	$attributes['data-title-color'] = esc_attr($args['title_color']);		
	}
	if ( !empty($args['headings_color']) ) {
    	$attributes['data-headings-color'] = esc_attr($args['headings_color']);		
	}
	if ( !empty($args['content_alignment']) ) {
		$attributes['style'] .= 'text-align: ' . esc_attr($args['content_alignment']) . ';';
	}	
    return $attributes;
}
add_filter('siteorigin_panels_widget_style_attributes', 'alzira_custom_widget_style_attributes', 10, 2);

/**
 * Remove defaults
 */
function alzira_remove_default_so_row_styles( $fields ) {
	unset( $fields['background_image_attachment'] );
	unset( $fields['background_display'] );
	unset( $fields['border_color'] );	
	return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'alzira_remove_default_so_row_styles' );
add_filter('siteorigin_premium_upgrade_teaser', '__return_false');