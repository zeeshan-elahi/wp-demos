<?php
/**
 * Services Grid: server-side render.
 *
 * @package DemoBlocks
 *
 * @var array $attributes Block attributes.
 */

$items = (isset($attributes['items']) && is_array($attributes['items'])) ? $attributes['items'] : [];

if (!$items) {
	return;
}

$columns  = max(1, min(4, (int) ($attributes['columns'] ?? 4)));
$featured = (int) ($attributes['featured'] ?? -1);
$wrapper  = get_block_wrapper_attributes([
	'class' => 'services-grid',
	'style' => '--columns:' . $columns . ';',
]);
?>
<div <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by core. ?>>
	<?php foreach ($items as $index => $item) : ?>
		<?php $is_featured = ($index === $featured) ? true : false; ?>
		<article class="service-card reveal<?php echo $is_featured ? ' service-card--featured' : ''; ?>">
			<span class="service-card__icon" aria-hidden="true">✦</span>
			<h3><?php echo wp_kses_post($item['title'] ?? ''); ?></h3>
			<p><?php echo wp_kses_post($item['text'] ?? ''); ?></p>
			<?php if (!empty($item['linkText'])) : ?>
				<a class="service-card__link" href="<?php echo esc_url($item['linkUrl'] ?? '#'); ?>"><?php echo wp_kses_post($item['linkText']); ?></a>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
</div>
