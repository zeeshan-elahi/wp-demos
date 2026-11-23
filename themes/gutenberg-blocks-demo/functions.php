<?php
/**
 * Gutenberg Blocks Demo theme setup.
 *
 * @package GutenbergBlocksDemo
 */

if (!defined('ABSPATH')) {
	exit;
}

define('GUTENBERG_BLOCKS_DEMO_VERSION', '1.0.0');

/**
 * Theme supports and menu locations.
 */
function gutenberg_blocks_demo_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets']);
	add_theme_support('responsive-embeds');
	add_theme_support('wp-block-styles');

	// Load the theme stylesheet in the block editor so custom blocks look the same as on the front end.
	add_theme_support('editor-styles');
	add_editor_style([
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		'style.css',
	]);

	register_nav_menus([
		'primary' => __('Primary menu', 'gutenberg-blocks-demo'),
		'footer'  => __('Footer menu', 'gutenberg-blocks-demo'),
	]);
}
add_action('after_setup_theme', 'gutenberg_blocks_demo_setup');

/**
 * Front-end assets. Version comes from the file mtime in debug mode so edits show without cache busting by hand.
 */
function gutenberg_blocks_demo_assets()
{
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	$css_version = (defined('WP_DEBUG') && WP_DEBUG) ? (string) filemtime($dir . '/style.css') : GUTENBERG_BLOCKS_DEMO_VERSION;
	$js_version  = (defined('WP_DEBUG') && WP_DEBUG) ? (string) filemtime($dir . '/assets/js/theme.js') : GUTENBERG_BLOCKS_DEMO_VERSION;

	wp_enqueue_style(
		'gutenberg-blocks-demo-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		[],
		null
	);
	wp_enqueue_style('gutenberg-blocks-demo', get_stylesheet_uri(), ['gutenberg-blocks-demo-fonts'], $css_version);
	wp_enqueue_script('gutenberg-blocks-demo', $uri . '/assets/js/theme.js', [], $js_version, ['strategy' => 'defer', 'in_footer' => true]);
}
add_action('wp_enqueue_scripts', 'gutenberg_blocks_demo_assets');

/**
 * Swap the no-js class as early as possible so reveal animations never hide content without JS.
 */
function gutenberg_blocks_demo_js_class()
{
	echo "<script>document.documentElement.classList.replace('no-js','js');</script>\n";
}
add_action('wp_head', 'gutenberg_blocks_demo_js_class', 1);

/**
 * Menu fallback: anchor links to the front-page sections, used until a menu is assigned.
 */
function gutenberg_blocks_demo_menu_fallback()
{
	$items = [
		'#home'     => __('Home', 'gutenberg-blocks-demo'),
		'#services' => __('Services', 'gutenberg-blocks-demo'),
		'#about'    => __('About', 'gutenberg-blocks-demo'),
		'#pricing'  => __('Pricing', 'gutenberg-blocks-demo'),
		'#contact'  => __('Contact', 'gutenberg-blocks-demo'),
	];

	echo '<ul>';
	foreach ($items as $href => $label) {
		printf('<li><a href="%s">%s</a></li>', esc_url(home_url('/' . $href)), esc_html($label));
	}
	echo '</ul>';
}

/**
 * Render a template part from template-parts/front/ with optional args.
 *
 * @param string $slug Part file name without extension.
 * @param array  $args Arguments passed to the part.
 */
function gutenberg_blocks_demo_section($slug, $args = [])
{
	get_template_part('template-parts/front/' . $slug, null, $args);
}
