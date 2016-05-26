<?php

/**
 * Wp in Progress
 *
 * @package Jax Lite
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/*-----------------------------------------------------------------------------------*/
/* THEME SETTINGS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_setting')) {

	function jaxlite_setting($id) {

		$jaxlite_setting = get_theme_mod($id);

		if(isset($jaxlite_setting))
			return $jaxlite_setting;

	}

}

/*-----------------------------------------------------------------------------------*/
/* Single Blog Post formating based on Category */
/*-----------------------------------------------------------------------------------*/

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
 '$the_template',
 'foreach( (array) get_the_category() as $cat ) {
	 if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
	 return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
 return $the_template;' )
);

/*-----------------------------------------------------------------------------------*/
/* POST META */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_postmeta')) {

	function jaxlite_postmeta($id) {

		global $post;

		$val = get_post_meta( $post->ID , $id, TRUE);

		if ( isset($val) ) :

			return $val;

		else :

			return null;

		endif;


	}

}

/*-----------------------------------------------------------------------------------*/
/* REQUIRE */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_require')) {

	function jaxlite_require($folder) {

		if (isset($folder)) :

			if ( ( !jaxlite_setting('jaxlite_loadsystem') ) || ( jaxlite_setting('jaxlite_loadsystem') == "mode_a" ) ) {

				$folder = dirname(dirname(__FILE__)) . $folder ;

				$files = scandir($folder);

				foreach ($files as $key => $name) {

					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) {

						require_once $folder . $name;

					}
				}

			} else if ( jaxlite_setting('jaxlite_loadsystem') == "mode_b" ) {


				$dh  = opendir(get_template_directory().$folder);

				while (false !== ($filename = readdir($dh))) {

					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {

						require_once get_template_directory()."/".$folder.$filename;

					}
				}
			}

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* SCRIPTS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_enqueue_script')) {

	function jaxlite_enqueue_script($folder) {

		if (isset($folder)) :

			if ( ( !jaxlite_setting('jaxlite_loadsystem') ) || ( jaxlite_setting('jaxlite_loadsystem') == "mode_a" ) ) {

				$dir = dirname(dirname(__FILE__)) . $folder ;

				$files = scandir($dir);

				foreach ($files as $key => $name) {

					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) {

						wp_enqueue_script( str_replace('.js','',$name), get_template_directory_uri() . $folder . "/" . $name , array('jquery'), FALSE, TRUE );

					}
				}

			} else if ( jaxlite_setting('jaxlite_loadsystem') == "mode_b" ) {

				$dh  = opendir(get_template_directory().$folder);

				while (false !== ($filename = readdir($dh))) {

					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {

						wp_enqueue_script( str_replace('.js','',$filename), get_template_directory_uri() . $folder . "/" . $filename , array('jquery'), FALSE, TRUE );

					}

				}

			}

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* STYLES */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_enqueue_style')) {

	function jaxlite_enqueue_style($folder) {

		if (isset($folder)) :

			if ( ( !jaxlite_setting('jaxlite_loadsystem') ) || ( jaxlite_setting('jaxlite_loadsystem') == "mode_a" ) ) {

				$dir = dirname(dirname(__FILE__)) . $folder ;

				$files = scandir($dir);

				foreach ($files as $key => $name) {

					if ( (!is_dir($name)) && ( $name <> ".DS_Store" ) ) {

						wp_enqueue_style( str_replace('.css','',$name), get_template_directory_uri() . $folder . "/" . $name );

					}
				}


			} else if ( jaxlite_setting('jaxlite_loadsystem') == "mode_b" ) {


				$dh  = opendir(get_template_directory().$folder);

				while (false !== ($filename = readdir($dh))) {

					if ( ( strlen($filename) > 2 ) && ( $filename <> ".DS_Store" ) ) {

						wp_enqueue_style( str_replace('.css','',$filename), get_template_directory_uri() . $folder . "/" . $filename );

					}

				}

			}

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* THUMBNAILS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_get_width')) {

	function jaxlite_get_width() {

		if ( jaxlite_setting('jaxlite_screen3') ):
			return jaxlite_setting('jaxlite_screen3');
		else:
			return "940";
		endif;

	}

}

if (!function_exists('jaxlite_get_height')) {

	function jaxlite_get_height() {

		if ( jaxlite_setting('jaxlite_thumbnails') ):
			return jaxlite_setting('jaxlite_thumbnails');
		else:
			return "600";
		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* HEADER IMAGE */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_header_image')) {

	function jaxlite_header_image() {

		return get_header_image();

	}

}

/*-----------------------------------------------------------------------------------*/
/* POST ICON */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_posticon')) {

	function jaxlite_posticon() {

		$icons = array (

			"video" => "genericon-video" ,
			"gallery" => "genericon-image" ,
			"audio" => "genericon-audio" ,
			"chat" => "genericon-chat",
			"status" => "genericon-status",
			"image" => "genericon-picture",
			"quote" => "genericon-quote" ,
			"link" => "genericon-external",
			"aside" => "genericon-aside"

		);

		if ( get_post_format() ) :

			$icon = '<span class="genericon '.$icons[get_post_format()].'"></span> '.ucfirst(get_post_format());

		else:

			$icon = '<span class="genericon genericon-standard"></span> Standard';

		endif;

		return $icon;

	}

}

/*-----------------------------------------------------------------------------------*/
/* HEADER LAYOUT */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_get_header_layout')) {

	function jaxlite_get_header_layout() {

		if ( is_home() )  {

			$layout = "header_one";

		} else {

			$layout = "header_two";

		}

		return $layout;

	}

}


/*-----------------------------------------------------------------------------------*/
/* LOGIN AREA */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_custom_login_logo')) {

	function jaxlite_custom_login_logo() {

		if ( jaxlite_setting('jaxlite_login_logo') ) : ?>

			<style type="text/css">

				body.login div#login h1 a {
					background-image: url('<?php echo jaxlite_setting('jaxlite_login_logo'); ?>');
					-webkit-background-size: inherit;
					background-size: inherit ;
					width:100%;
					height:<?php echo jaxlite_setting('jaxlite_login_logo_height'); ?>;
				}

			</style>

<?php

		endif;

	}

	add_action( 'login_enqueue_scripts', 'jaxlite_custom_login_logo' );

}

/*-----------------------------------------------------------------------------------*/
/* Content template */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_template')) {

	function jaxlite_template($id) {

		$template = array ("full" => "col-md-12" , "left-sidebar" => "col-md-8" , "right-sidebar" => "col-md-8" );

		$span = $template["right-sidebar"];
		$sidebar =  "right-sidebar";

		if  ( ( (is_category()) || (is_tag()) || (is_tax()) || (is_month() ) ) && (jaxlite_setting('jaxlite_category_layout')) ) {

			$span = $template[jaxlite_setting('jaxlite_category_layout')];
			$sidebar =  jaxlite_setting('jaxlite_category_layout');

		} else if ( (is_home()) && (jaxlite_setting('jaxlite_home')) ) {

			$span = $template[jaxlite_setting('jaxlite_home')];
			$sidebar =  jaxlite_setting('jaxlite_home');

		} else if ( (is_search()) && (jaxlite_setting('jaxlite_search_layout')) ) {

			$span = $template[jaxlite_setting('jaxlite_search_layout')];
			$sidebar =  jaxlite_setting('jaxlite_search_layout');

		} else if ( ( (is_single()) || (is_page()) ) && (jaxlite_postmeta('jaxlite_template')) ) {

			$span = $template[jaxlite_postmeta('jaxlite_template')];
			$sidebar =  jaxlite_postmeta('jaxlite_template');

		}

		return ${$id};

	}

}

/*-----------------------------------------------------------------------------------*/
/* PRETTYPHOTO */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_prettyPhoto')) {

	function jaxlite_prettyPhoto( $html, $id, $size, $permalink, $icon, $text ) {

		if ( ! $permalink )
			return str_replace( '<a', '<a rel="prettyPhoto" ', $html );
		else
			return $html;

	}

	add_filter( 'wp_get_attachment_link', 'jaxlite_prettyPhoto', 10, 6);

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE CATEGORY LIST REL */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_remove_category_list_rel')) {

	function jaxlite_remove_category_list_rel($output) {
		$output = str_replace('rel="category"', '', $output);
		return $output;
	}

	add_filter('wp_list_categories', 'jaxlite_remove_category_list_rel');
	add_filter('the_category', 'jaxlite_remove_category_list_rel');

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE THUMBNAIL DIMENSION */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_remove_thumbnail_dimensions')) {

	function jaxlite_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}

	add_filter( 'post_thumbnail_html', 'jaxlite_remove_thumbnail_dimensions', 10, 3 );

}

/*-----------------------------------------------------------------------------------*/
/* REMOVE CSS GALLERY */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_my_gallery_style')) {

	function jaxlite_my_gallery_style() {
		return "<div class='gallery'>";
	}

	add_filter( 'gallery_style', 'jaxlite_my_gallery_style', 99 );

}

/*-----------------------------------------------------------------------------------*/
/*RESPONSIVE EMBED */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_embed_html')) {

	function jaxlite_embed_html( $html ) {
		return '<div class="embed-container">' . $html . '</div>';
	}

	add_filter( 'embed_oembed_html', 'jaxlite_embed_html', 10, 3 );
	add_filter( 'video_embed_html', 'jaxlite_embed_html' );

}

/*-----------------------------------------------------------------------------------*/
/* DEFAULT STYLE, AFTER THEME ACTIVATION */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'jaxlite_after_switch_theme' ) ) {

	function jaxlite_after_switch_theme () {

		wp_redirect(admin_url("customize.php"));

	}

	add_action('after_switch_theme', 'jaxlite_after_switch_theme');

}

/*-----------------------------------------------------------------------------------*/
/* GET ARCHIVE TITLE */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_get_the_archive_title')) {

	function jaxlite_get_archive_title() {

		if ( get_the_archive_title()  && ( get_the_archive_title() <> 'Archives' ) ) :

			return get_the_archive_title();

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* IS SINGLE */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_is_single')) {

	function jaxlite_is_single() {

		if ( is_single() || is_page() ) :

			return true;

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* POST CLASS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_post_class')) {

	function jaxlite_post_class($classes) {

		$masonry  = 'post-container masonry-element col-md-4';
		$standard = 'post-container col-md-12';

		if ( ( !jaxlite_is_single()) && ( is_home() ) ) {

			if ( ( !jaxlite_setting('jaxlite_home')) || ( jaxlite_setting('jaxlite_home') == "masonry" ) ) {

				$classes[] = $masonry;

			} else {

				$classes[] = $standard;

			}

		} else if ( ( !jaxlite_is_single()) && ( jaxlite_get_archive_title() ) ) {

			if ( ( !jaxlite_setting('jaxlite_category_layout')) || ( jaxlite_setting('jaxlite_category_layout') == "masonry" ) ) {

				$classes[] = $masonry;

			} else {

				$classes[] = $standard;

			}

		} else if ( ( !jaxlite_is_single()) && ( is_search() ) ) {

			if ( ( !jaxlite_setting('jaxlite_search_layout')) || ( jaxlite_setting('jaxlite_search_layout') == "masonry" ) ) {

				$classes[] = $masonry;

			} else {

				$classes[] = $standard;

			}

		} else if ( jaxlite_is_single() ) {

			$classes[] = 'post-container col-md-12';

		}

		return $classes;

	}

	add_filter('post_class', 'jaxlite_post_class');

}


/*-----------------------------------------------------------------------------------*/
/* VERSION */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_remove_version')) {

	function jaxlite_remove_version( $src ) {

		if ( strpos( $src, 'ver=' ) )

			$src = remove_query_arg( 'ver', $src );

		return $src;

	}

	add_filter( 'style_loader_src', 'jaxlite_remove_version', 9999 );
	add_filter( 'script_loader_src', 'jaxlite_remove_version', 9999 );

}

/*-----------------------------------------------------------------------------------*/
/* TAG TITLE */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function jaxlite_title( $title, $sep ) {

		global $paged, $page;

		if ( is_feed() )
			return $title;

		$title .= get_bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'jaxlite' ), max( $paged, $page ) );

		return $title;

	}

	add_filter( 'wp_title', 'jaxlite_title', 10, 2 );

	function jaxlite_addtitle() {

?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php

	}

	add_action( 'wp_head', 'jaxlite_addtitle' );

}

/*-----------------------------------------------------------------------------------*/
/* THEME DATA */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_theme_data')) {

	function jaxlite_theme_data($id, $check = true ) {

		if ( ( wp_get_theme()->parent() == true ) && ( $check == true ) ) {

			$themedata = wp_get_theme()->parent();

		} else if ( ( wp_get_theme()->parent() == false ) && ( $check == true ) ) {

			$themedata = wp_get_theme();

		} else if ( $check == false ) {

			$themedata = wp_get_theme();

		}

		return $themedata->get($id);

	}

}

/*-----------------------------------------------------------------------------------*/
/* BODY CLASSES */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_body_classes_function')) {

	function jaxlite_body_classes_function( $classes ) {

		global $wp_customize;

		if ( jaxlite_setting('jaxlite_infinitescroll_system') == "on" ) :

			$classes[] = 'infinitescroll';

		endif;

		if ( !jaxlite_setting('jaxlite_animated_titles') || jaxlite_setting('jaxlite_animated_titles') == "on" ) :

			$classes[] = 'animatedtitles-active';

		endif;

		if ( !jaxlite_setting('jaxlite_preloading_system') || jaxlite_setting('jaxlite_preloading_system') == "on" ) :

			$classes[] = 'animsition-active';

		else:

			$classes[] = 'animsition-inactive';

		endif;

		if ( ( jaxlite_is_single() ) && ( ( jaxlite_get_header_layout() == "header_five") || ( jaxlite_get_header_layout() == "header_six") ) ) :

			$classes[] = 'hide_title';

		endif;

		if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) :

			$classes[] = 'ie_browser';

		endif;

		if ( isset( $wp_customize ) ) :

			$classes[] = 'customizer_active';

		endif;

		return $classes;

	}

	add_filter( 'body_class', 'jaxlite_body_classes_function' );

}

/*-----------------------------------------------------------------------------------*/
/* WRAP CLASS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_wrap_class')) {

	function jaxlite_wrap_class() {

		if ( !jaxlite_setting('jaxlite_preloading_system') || jaxlite_setting('jaxlite_preloading_system') == "on" ) :

			echo 'class="animsition"';

		endif;

	}

}

/*-----------------------------------------------------------------------------------*/
/* SIDEBAR NAME */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_sidebar_name')) {

	function jaxlite_sidebar_name( $type ) {

		$sidebars = array (

			"header" => array (
				"postmeta" => "jaxlite_header_sidebar",
				"default" => "header-sidebar-area"
			),

			"side" => array (
				"postmeta" => "jaxlite_sidebar",
				"default" => "side-sidebar-area"
			),

			"scroll" => array (
				"postmeta" => "jaxlite_scroll_sidebar",
				"default" => "scroll-sidebar-area"
			),

			"bottom" => array (
				"postmeta" => "jaxlite_bottom_sidebar",
				"default" => "bottom-sidebar-area"
			),

			"footer" => array (
				"postmeta" => "jaxlite_footer_sidebar",
				"default" => "footer-sidebar-area"
			),

		);

		if ( jaxlite_is_single() ) :

			$sidebar_name = jaxlite_postmeta($sidebars[$type]['postmeta']);

		else :

			$sidebar_name = $sidebars[$type]['default'];

		endif;

		return $sidebar_name;

	}

}

/*-----------------------------------------------------------------------------------*/
/* SIDEBAR LIST */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_sidebar_list')) {

	function jaxlite_sidebar_list($sidebar_type) {

		$default = array("none" => "None", $sidebar_type."-sidebar-area" => "Default");

		return $default;

	}

}

/*-----------------------------------------------------------------------------------*/
/* GET PAGED */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_paged')) {

	function jaxlite_paged() {

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		return $paged;

	}

}


/*-----------------------------------------------------------------------------------*/
/* EXCERPT MORE  */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_hide_excerpt_more')) {

	function jaxlite_hide_excerpt_more() {
		return '';
	}

	add_filter('the_content_more_link', 'jaxlite_hide_excerpt_more');
	add_filter('excerpt_more', 'jaxlite_hide_excerpt_more');

}

/*-----------------------------------------------------------------------------------*/
/* STYLES AND SCRIPTS */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_scripts_styles')) {

	function jaxlite_scripts_styles() {

		jaxlite_enqueue_style('/assets/css');

		if ( ( get_theme_mod('jaxlite_skin') ) && ( get_theme_mod('jaxlite_skin') <> "turquoise" ) ):

			wp_enqueue_style( 'jaxlite ' . get_theme_mod('jaxlite_skin') , get_template_directory_uri() . '/assets/skins/' . get_theme_mod('jaxlite_skin') . '.css' );

		endif;

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=PT+Sans|Montserrat:400,300,100,700' );

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		wp_enqueue_script( "jquery-ui-core", array('jquery'));
		wp_enqueue_script( "jquery-ui-tabs", array('jquery'));
		wp_enqueue_script( "masonry", array('jquery') );

		jaxlite_enqueue_script('/assets/js');

	}

	add_action( 'wp_enqueue_scripts', 'jaxlite_scripts_styles', 11 );

}

/*-----------------------------------------------------------------------------------*/
/* THEME SETUP */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('jaxlite_setup')) {

	function jaxlite_setup() {

		global $content_width;

		if ( ! isset( $content_width ) )
			$content_width = jaxlite_get_width();

			// EDIT added profile post format
		add_theme_support( 'post-formats', array( 'aside','gallery','quote','video','audio','link','status','chat','image' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'thumbnail', jaxlite_get_width(), jaxlite_get_height(), TRUE );

		add_theme_support( 'title-tag' );

		add_image_size( 'large', 449,304, TRUE );
		add_image_size( 'medium', 290,220, TRUE );
		add_image_size( 'small', 211,150, TRUE );

		register_nav_menu( 'main-menu', 'Main menu' );

		load_theme_textdomain("jaxlite", get_template_directory() . '/languages');

		add_theme_support( 'custom-background', array(
			'default-color' => 'f3f3f3',
		) );

		add_theme_support( 'custom-header', array(
			'default-image' => get_template_directory_uri() . '/assets/images/background/header.jpg',
			'default-text-color' => 'fafafa',
		) );

		register_default_headers( array(
			'wheel' => array(
				'url' => get_template_directory_uri() . '/assets/images/background/header.jpg',
				'thumbnail_url' => get_template_directory_uri() . '/assets/images/background/header.jpg',
				'description' => __( 'Default', "jaxlite" )
			)
		) );

		$require_array = array (
			"/core/classes/",
			"/core/admin/customize/",
			"/core/functions/",
			"/core/templates/",
			"/core/scripts/",
			"/core/metaboxes/",
		);

		foreach ( $require_array as $require_file ) {

			jaxlite_require($require_file);

		}

	}

	add_action( 'after_setup_theme', 'jaxlite_setup' );

}


?>
