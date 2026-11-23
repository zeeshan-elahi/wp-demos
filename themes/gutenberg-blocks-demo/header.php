<?php
/**
 * Site header.
 *
 * @package GutenbergBlocksDemo
 */

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'gutenberg-blocks-demo'); ?></a>

<header class="site-header" id="home">
	<div class="container site-header__inner">
		<a class="site-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e('Primary', 'gutenberg-blocks-demo'); ?>">
			<?php
			wp_nav_menu([
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'gutenberg_blocks_demo_menu_fallback',
				'depth'          => 1,
			]);
			?>
		</nav>

		<div class="site-header__actions">
			<a href="<?php echo esc_url(wp_login_url()); ?>"><?php esc_html_e('Sign in', 'gutenberg-blocks-demo'); ?></a>
			<a class="btn btn--accent" href="#contact"><?php esc_html_e('Sign up', 'gutenberg-blocks-demo'); ?></a>
		</div>

		<button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false">
			<span></span><span></span><span></span>
			<span class="screen-reader-text"><?php esc_html_e('Menu', 'gutenberg-blocks-demo'); ?></span>
		</button>
	</div>
</header>
