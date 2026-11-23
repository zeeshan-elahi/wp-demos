<?php
/**
 * Client logo strip. Text marks stand in for logo files.
 *
 * @package GutenbergBlocksDemo
 */

$logos = ['Omega Mellon', 'Harvest', 'EdgeKart', 'Infinity Parker', 'WheelApp'];
?>
<div class="container">
	<section class="logos reveal" aria-labelledby="logos-title">
		<h2 id="logos-title"><?php esc_html_e('Over 32k+ software businesses growing with us', 'gutenberg-blocks-demo'); ?></h2>
		<ul>
			<?php foreach ($logos as $logo) : ?>
				<li>
					<svg width="18" height="18" viewBox="0 0 18 18" aria-hidden="true"><circle cx="9" cy="9" r="7" fill="none" stroke="currentColor" stroke-width="2" /></svg>
					<?php echo esc_html($logo); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
</div>
