<?php
/**
 * About: heading, illustration, copy with checklist, stats bar.
 *
 * @package GutenbergBlocksDemo
 */

$points = [
	__('Pixel-accurate builds from your Figma files', 'gutenberg-blocks-demo'),
	__('Responsive from 390px phones to 1440px desktops', 'gutenberg-blocks-demo'),
	__('Content you can edit yourself in the block editor', 'gutenberg-blocks-demo'),
];

$stats = [
	['value' => '280+', 'label' => __('Projects complete', 'gutenberg-blocks-demo')],
	['value' => '200+', 'label' => __('Happy clients', 'gutenberg-blocks-demo')],
	['value' => '15+', 'label' => __('Team members', 'gutenberg-blocks-demo')],
];
?>
<div class="container" id="about">
	<section class="about reveal">
		<h2><?php esc_html_e('We Are Here To Make Your Website Look More Elegant And', 'gutenberg-blocks-demo'); ?> <span class="scribble"><?php esc_html_e('Stylish!', 'gutenberg-blocks-demo'); ?></span></h2>

		<div class="about__inner">
			<div class="about__media">
				<svg viewBox="0 0 400 270" role="img" aria-label="<?php esc_attr_e('Team meeting around a table', 'gutenberg-blocks-demo'); ?>">
					<rect width="400" height="270" fill="#4B5563" />
					<rect x="220" y="40" width="140" height="90" rx="6" fill="#9CC3E6" />
					<rect x="40" y="190" width="320" height="80" fill="#D9C2A3" />
					<circle cx="90" cy="150" r="24" fill="#E0B48F" />
					<circle cx="170" cy="140" r="24" fill="#C89B7B" />
					<circle cx="300" cy="150" r="24" fill="#B98563" />
					<path d="M55 200 C 60 170, 120 170, 125 200 Z M135 195 C 140 160, 200 160, 205 195 Z M265 200 C 270 170, 330 170, 335 200 Z" fill="#F9D57A" />
				</svg>
			</div>

			<div class="about__body">
				<p class="muted">
					<?php esc_html_e('Every project starts with your design and ends with a site your team can run without calling us. We build classic and block themes by hand, keep the markup lean, and test on real devices before launch.', 'gutenberg-blocks-demo'); ?>
				</p>
				<ul class="checklist">
					<?php foreach ($points as $point) : ?>
						<li><?php echo esc_html($point); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<ul class="stats">
			<?php foreach ($stats as $stat) : ?>
				<li>
					<strong><?php echo esc_html($stat['value']); ?></strong>
					<span><?php echo esc_html($stat['label']); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
</div>
