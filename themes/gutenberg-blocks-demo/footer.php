<?php
/**
 * Site footer.
 *
 * @package GutenbergBlocksDemo
 */

$columns = [
	__('Company', 'gutenberg-blocks-demo')   => [__('About', 'gutenberg-blocks-demo'), __('Careers', 'gutenberg-blocks-demo'), __('Blog', 'gutenberg-blocks-demo')],
	__('Services', 'gutenberg-blocks-demo')  => [__('UI/UX design', 'gutenberg-blocks-demo'), __('Web development', 'gutenberg-blocks-demo'), __('Branding', 'gutenberg-blocks-demo')],
	__('Support', 'gutenberg-blocks-demo')   => [__('Help centre', 'gutenberg-blocks-demo'), __('Contact', 'gutenberg-blocks-demo'), __('Privacy', 'gutenberg-blocks-demo')],
];
?>
<footer class="site-footer">
	<div class="container">
		<div class="site-footer__inner">
			<div>
				<a class="site-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<p class="muted" style="margin-top:0.75rem;max-width:18rem;"><?php bloginfo('description'); ?></p>
			</div>
			<?php foreach ($columns as $heading => $links) : ?>
				<div>
					<h3><?php echo esc_html($heading); ?></h3>
					<ul>
						<?php foreach ($links as $label) : ?>
							<li><a href="#"><?php echo esc_html($label); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="site-footer__bottom muted">
			<?php
			printf(
				/* translators: 1: year, 2: site name */
				esc_html__('© %1$s %2$s. Design: "Agency Website" by Publish Ninja (Figma Community, CC BY 4.0).', 'gutenberg-blocks-demo'),
				esc_html(gmdate('Y')),
				esc_html(get_bloginfo('name'))
			);
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
