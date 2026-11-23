<?php
/**
 * Front page: hero and logo strip from the theme, then the page's own block content
 * (Services Grid, Stats Bar, Pricing Table and core blocks), then the closing CTA.
 * With no static front page set, or a front page without blocks, the theme's
 * hard-coded sections render instead so a fresh install still shows the full design.
 *
 * @package GutenbergBlocksDemo
 */

get_header();

$use_block_content = (is_page() && has_blocks(get_post())) ? true : false;
?>
<main id="main">
	<?php
	gutenberg_blocks_demo_section('hero');
	gutenberg_blocks_demo_section('logos');

	if ($use_block_content) {
		while (have_posts()) {
			the_post();
			echo '<div class="front-blocks">';
			the_content();
			echo '</div>';
		}
	} else {
		gutenberg_blocks_demo_section('services');
		gutenberg_blocks_demo_section('about');
		gutenberg_blocks_demo_section('pricing');
	}

	gutenberg_blocks_demo_section('cta');
	?>
</main>
<?php
get_footer();
