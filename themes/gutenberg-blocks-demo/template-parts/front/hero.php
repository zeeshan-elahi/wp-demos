<?php
/**
 * Hero: headline, actions, 2×2 portrait grid. Portraits are inline SVG placeholders (no stock photos shipped).
 *
 * @package GutenbergBlocksDemo
 */

$tiles = [
	['shape' => 'tile', 'bg' => '#3B3A36', 'skin' => '#C89B7B', 'shirt' => '#5B6B7F'],
	['shape' => 'tile tile--round', 'bg' => '#F9D57A', 'skin' => '#E0B48F', 'shirt' => '#4A6FA5'],
	['shape' => 'tile tile--bl', 'bg' => '#55606B', 'skin' => '#B98563', 'shirt' => '#2F3A48'],
	['shape' => 'tile tile--br', 'bg' => '#8A8F96', 'skin' => '#D6A786', 'shirt' => '#6E5A48'],
];
?>
<section class="hero">
	<svg class="hero__stripes" viewBox="0 0 40 48" aria-hidden="true">
		<path d="M0 10 L40 0 M0 26 L40 16 M0 42 L40 32" stroke="#1E1E1E" stroke-width="6" />
	</svg>

	<div class="container hero__inner">
		<div class="reveal">
			<h1>
				<?php esc_html_e('Creative Idea Help to Grow', 'gutenberg-blocks-demo'); ?>
				<span class="scribble"><?php esc_html_e('Business', 'gutenberg-blocks-demo'); ?></span>
			</h1>
			<p class="hero__lead muted">
				<?php esc_html_e('We design and build fast, accessible websites that turn visitors into clients, from the first sketch to launch day.', 'gutenberg-blocks-demo'); ?>
			</p>
			<div class="hero__actions">
				<a class="btn btn--dark" href="#contact"><?php esc_html_e('Get Started', 'gutenberg-blocks-demo'); ?></a>
				<a class="btn btn--ghost" href="#about">
					<span class="btn__play" aria-hidden="true">▶</span>
					<?php esc_html_e('How it works', 'gutenberg-blocks-demo'); ?>
				</a>
			</div>
		</div>

		<div class="hero__grid reveal">
			<?php foreach ($tiles as $tile) : ?>
				<div class="<?php echo esc_attr($tile['shape']); ?>">
					<svg viewBox="0 0 200 200" role="img" aria-label="<?php esc_attr_e('Team member', 'gutenberg-blocks-demo'); ?>">
						<rect width="200" height="200" fill="<?php echo esc_attr($tile['bg']); ?>" />
						<path d="M30 200 C 40 140, 160 140, 170 200 Z" fill="<?php echo esc_attr($tile['shirt']); ?>" />
						<circle cx="100" cy="92" r="38" fill="<?php echo esc_attr($tile['skin']); ?>" />
						<path d="M62 86 C 64 50, 136 50, 138 86 C 126 70, 80 68, 62 86 Z" fill="#2A2522" />
					</svg>
				</div>
			<?php endforeach; ?>

			<div class="hero__badge">
				<span class="hero__badge-avatar" aria-hidden="true"></span>
				<span>
					<strong>Albert Smith</strong>
					<small><?php esc_html_e('Project manager', 'gutenberg-blocks-demo'); ?></small>
				</span>
			</div>
		</div>
	</div>
</section>
