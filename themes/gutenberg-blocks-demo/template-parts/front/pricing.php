<?php
/**
 * Pricing: three plans with a monthly / yearly toggle (theme.js).
 *
 * @package GutenbergBlocksDemo
 */

$plans = [
	[
		'name'     => __('Starter', 'gutenberg-blocks-demo'),
		'monthly'  => '$49',
		'yearly'   => '$490',
		'features' => [__('One-page site', 'gutenberg-blocks-demo'), __('Mobile-ready layout', 'gutenberg-blocks-demo'), __('Email support', 'gutenberg-blocks-demo')],
		'featured' => false,
	],
	[
		'name'     => __('Business', 'gutenberg-blocks-demo'),
		'monthly'  => '$99',
		'yearly'   => '$990',
		'features' => [__('Up to 10 pages', 'gutenberg-blocks-demo'), __('Custom blocks', 'gutenberg-blocks-demo'), __('SEO setup', 'gutenberg-blocks-demo'), __('Priority support', 'gutenberg-blocks-demo')],
		'featured' => true,
	],
	[
		'name'     => __('Enterprise', 'gutenberg-blocks-demo'),
		'monthly'  => '$199',
		'yearly'   => '$1,990',
		'features' => [__('Unlimited pages', 'gutenberg-blocks-demo'), __('Integrations & APIs', 'gutenberg-blocks-demo'), __('Dedicated developer', 'gutenberg-blocks-demo')],
		'featured' => false,
	],
];
?>
<section class="section" id="pricing" data-pricing>
	<div class="container">
		<h2 class="section-title section-title--center reveal">
			<?php esc_html_e('Choose The Right Plan For', 'gutenberg-blocks-demo'); ?> <span class="scribble"><?php esc_html_e('You', 'gutenberg-blocks-demo'); ?></span>
		</h2>

		<div class="pricing-toggle" role="group" aria-label="<?php esc_attr_e('Billing period', 'gutenberg-blocks-demo'); ?>">
			<button type="button" data-period="monthly" aria-pressed="true"><?php esc_html_e('Monthly', 'gutenberg-blocks-demo'); ?></button>
			<button type="button" data-period="yearly" aria-pressed="false"><?php esc_html_e('Yearly', 'gutenberg-blocks-demo'); ?></button>
		</div>

		<div class="pricing-grid">
			<?php foreach ($plans as $plan) : ?>
				<article class="plan reveal<?php echo $plan['featured'] ? ' plan--featured' : ''; ?>">
					<h3><?php echo esc_html($plan['name']); ?></h3>
					<p class="plan__price" data-price-monthly="<?php echo esc_attr($plan['monthly']); ?>" data-price-yearly="<?php echo esc_attr($plan['yearly']); ?>">
						<span class="plan__amount"><?php echo esc_html($plan['monthly']); ?></span><small>/mo</small>
					</p>
					<ul>
						<?php foreach ($plan['features'] as $feature) : ?>
							<li><?php echo esc_html($feature); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="btn <?php echo $plan['featured'] ? 'btn--accent' : 'btn--dark'; ?>" href="#contact"><?php esc_html_e('Choose plan', 'gutenberg-blocks-demo'); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
