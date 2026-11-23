<?php
/**
 * Services section. The grid is static markup for now; step 4 replaces it with the
 * gutenberg-blocks-demo/services-grid block, editable in the block editor.
 *
 * @package GutenbergBlocksDemo
 */

$services = [
	['title' => __('UI/UX Design', 'gutenberg-blocks-demo'), 'text' => __('Wireframes, prototypes and design systems your developers can actually build.', 'gutenberg-blocks-demo'), 'featured' => false],
	['title' => __('Web Development', 'gutenberg-blocks-demo'), 'text' => __('Custom WordPress themes and plugins. No page builders, no bloat.', 'gutenberg-blocks-demo'), 'featured' => true],
	['title' => __('Branding', 'gutenberg-blocks-demo'), 'text' => __('Logos, type and colour that hold up from a favicon to a billboard.', 'gutenberg-blocks-demo'), 'featured' => false],
	['title' => __('Growth & SEO', 'gutenberg-blocks-demo'), 'text' => __('Fast pages, clean markup and content that ranks and converts.', 'gutenberg-blocks-demo'), 'featured' => false],
];
?>
<section class="section" id="services">
	<div class="container">
		<div class="section__head reveal">
			<h2><?php esc_html_e('Our Included', 'gutenberg-blocks-demo'); ?> <span class="scribble"><?php esc_html_e('Services', 'gutenberg-blocks-demo'); ?></span></h2>
			<p class="muted"><?php esc_html_e('Everything a growing business needs to look sharp online, under one roof and one invoice.', 'gutenberg-blocks-demo'); ?></p>
		</div>

		<div class="services-grid">
			<?php foreach ($services as $service) : ?>
				<article class="service-card reveal<?php echo $service['featured'] ? ' service-card--featured' : ''; ?>">
					<span class="service-card__icon" aria-hidden="true">✦</span>
					<h3><?php echo esc_html($service['title']); ?></h3>
					<p><?php echo esc_html($service['text']); ?></p>
					<a class="service-card__link" href="#contact"><?php esc_html_e('Learn more →', 'gutenberg-blocks-demo'); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
