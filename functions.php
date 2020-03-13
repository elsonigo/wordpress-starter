<?php

// Add stylesheets and scripts
function enqueue_styles_and_scripts() {

	wp_enqueue_style('stylecss', get_template_directory_uri() . '/dist/app.css', array(), '1.0.0');
	wp_enqueue_script('appjs', get_template_directory_uri() . '/dist/app.js', array(), '1.0.0', true);
	
	/* load assets based on post type/template
	if(get_post_type() == 'projekt' || basename(get_page_template()) == 'page-projekte.php') {
		wp_enqueue_style('projektcss', get_template_directory_uri() . '/projekt.css', array(), '1.0.0');
		wp_enqueue_script('projektjs', get_template_directory_uri() . '/projekt.js', array(), '1.0.0');
	}
	*/
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

//remove gutenberg css library
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

// WordPress Titles
add_theme_support('title-tag');

//Disable Emoji Mess
add_action('init', 'disable_wp_emojicons');
function disable_wp_emojicons() {
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
	add_filter('emoji_svg_url', '__return_false');
}

function disable_emojicons_tinymce($plugins) {
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

//Disable xmlrpc.php
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

//Hide WordPress Update Nag to All But Admins
add_action('admin_head', 'hide_update_notice_to_all_but_admin', 1);
function hide_update_notice_to_all_but_admin() {
	if (!current_user_can('update_core')) {
		remove_action('admin_notices', 'update_nag', 3);
	}
}


//Remove All Dashboard Widgets
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}


// Remove JSON API stuff
add_action('after_setup_theme', 'remove_json_api');
function remove_json_api() {
	// Remove the REST API lines from the HTML Header
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

	// Remove the REST API endpoint.
	remove_action('rest_api_init', 'wp_oembed_register_route');

	// Turn off oEmbed auto discovery.
	add_filter('embed_oembed_discover', '__return_false');

	// Don't filter oEmbed results.
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

	// Remove oEmbed discovery links.
	remove_action('wp_head', 'wp_oembed_add_discovery_links');

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action('wp_head', 'wp_oembed_add_host_js');
}


add_action('after_setup_theme', 'disable_json_api');
function disable_json_api() {
	// Filters for WP-API version 1.x
	add_filter('json_enabled', '__return_false');
	add_filter('json_jsonp_enabled', '__return_false');

	// Filters for WP-API version 2.x
	add_filter('rest_enabled', '__return_false');
	add_filter('rest_jsonp_enabled', '__return_false');
}


// remove generator tag (and version number)
remove_action('wp_head', 'wp_generator');


add_filter('the_generator', 'wpbeginner_remove_version');
function wpbeginner_remove_version() {
	return '';
}



// compress original image on upload
add_filter('wp_handle_upload', 'wt_handle_upload_callback');
function wt_handle_upload_callback($data) {
	$image_quality = 85; // 85% commpresion of original image
	$file_path = $data['file'];
	$image = false;

	switch ($data['type']) {
		case 'image/jpeg': {
			$image = imagecreatefromjpeg($file_path);
			imagejpeg($image, $file_path, $image_quality);
			break;
		}
	}

	return $data;
}


// overrride medium_large image size
add_action( 'after_setup_theme', 'update_medium_large_size');
function update_medium_large_size() {
	update_option( 'medium_large_size_w', 1100 );
}

// define additional image sizes (when image is created on upload)
add_action( 'after_setup_theme', 'setup_custom_image_sizes' );
function setup_custom_image_sizes() {
	add_image_size( 'extra_large', 2100, 0, true );
}


//Page Slug Body Class
add_filter('body_class', 'add_slug_body_class');
function add_slug_body_class($classes) {
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_name;
	}
	return $classes;
}


// load editor-style.css for wysiwyg editor display
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}

// load admin-style.css for styling the backend
add_action('admin_enqueue_scripts', 'kb_admin_style');
function kb_admin_style() {
   wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin-style.css');
}


// add custom toolbar
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars ) {
	$toolbars['Minimal' ] = array();
	$toolbars['Minimal' ][1] = array('formatselect', 'bold', 'link', 'bullist','paste_as_text');
	return $toolbars;
}

// custom formats
add_filter( 'tiny_mce_before_init', 'cdils_change_mce_block_formats' );
function cdils_change_mce_block_formats( $init ) {
	$block_formats = array(
		'Absatz=p',
		'Titel 2=h2',
		'Titel 3=h3'
	);
	$init['block_formats'] = implode( ';', $block_formats );

	return $init;
}

/* @link https://anythinggraphic.net/paste-as-text-by-default-in-wordpress
/* Use Paste As Text by default in the editor
----------------------------------------------------------------------------------------*/
add_filter('tiny_mce_before_init', 'ag_tinymce_paste_as_text');
function ag_tinymce_paste_as_text( $init ) {
	$init['paste_as_text'] = true;
	return $init;
}
