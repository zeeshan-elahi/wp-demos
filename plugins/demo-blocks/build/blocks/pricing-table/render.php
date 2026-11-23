<?php
/**
 * Pricing Table: server-side render. The monthly / yearly switch is wired up by the theme's
 * script through the data-pricing / data-period / data-price-* attributes.
 *
 * @package DemoBlocks
 *
 * @var array $attributes Block attributes.
 */

$plans = (isset($attributes['plans']) && is_array($attributes['plans'])) ? $attributes['plans'] : [];

if (!$plans) {
	return;
}

$featured    = (int) ($attributes['featured'] ?? -1);
$show_toggle = (!empty($attributes['showToggle'])) ? true : false;
$wrapper     = get_block_wrapper_attributes([
	'class'        => 'pricing-block',
	'data-pricing' => '',
]);
?>
<div <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by core. ?>>
	<?php if ($show_toggle) : ?>
		<div class="pricing-toggle" role="group" aria-label="<?php esc_attr_e('Billing period', 'demo-blocks'); ?>">
			<button type="button" data-period="monthly" aria-pressed="true"><?php esc_html_e('Monthly', 'demo-blocks'); ?></button>
			<button type="button" data-period="yearly" aria-pressed="false"><?php esc_html_e('Yearly', 'demo-blocks'); ?></button>
		</div>
	<?php endif; ?>

	<div class="pricing-grid">
		<?php foreach ($plans as $index => $plan) : ?>
			<?php
			$is_featured = ($index === $featured) ? true : false;
			$features    = array_filter(array_map('trim', preg_split('/\R/', (string) ($plan['features'] ?? ''))));
			?>
			<article class="plan reveal<?php echo $is_featured ? ' plan--featured' : ''; ?>">
				<h3><?php echo wp_kses_post($plan['name'] ?? ''); ?></h3>
				<p class="plan__price" data-price-monthly="<?php echo esc_attr($plan['monthly'] ?? ''); ?>" data-price-yearly="<?php echo esc_attr($plan['yearly'] ?? ''); ?>">
					<span class="plan__amount"><?php echo esc_html($plan['monthly'] ?? ''); ?></span><small>/mo</small>
				</p>
				<?php if ($features) : ?>
					<ul>
						<?php foreach ($features as $feature) : ?>
							<li><?php echo esc_html($feature); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if (!empty($plan['ctaText'])) : ?>
					<a class="btn <?php echo $is_featured ? 'btn--accent' : 'btn--dark'; ?>" href="<?php echo esc_url($plan['ctaUrl'] ?? '#'); ?>"><?php echo wp_kses_post($plan['ctaText']); ?></a>
				<?php endif; ?>
			</article>
		<?php endforeach; ?>
	</div>
</div>
