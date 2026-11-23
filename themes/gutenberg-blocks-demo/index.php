<?php
/**
 * Fallback template: posts and pages in a single readable column.
 *
 * @package GutenbergBlocksDemo
 */

get_header();
?>
<main id="main" class="section">
	<div class="container" style="max-width:760px;">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article <?php post_class(); ?> style="margin-bottom:3rem;">
					<h1 class="section-title"><?php the_title(); ?></h1>
					<div class="entry-content" style="margin-top:1rem;">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e('Nothing here yet.', 'gutenberg-blocks-demo'); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
