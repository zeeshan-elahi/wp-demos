<?php
/**
 * Stats Bar: server-side render.
 *
 * @package DemoBlocks
 *
 * @var array $attributes Block attributes.
 */

$items = (isset($attributes['items']) && is_array($attributes['items'])) ? $attributes['items'] : [];

if (!$items) {
	return;
}

$wrapper = get_block_wrapper_attributes(['class' => 'stats']);
?>
<ul <?php echo $wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by core. ?>>
	<?php foreach ($items as $item) : ?>
		<li>
			<strong><?php echo esc_html(wp_strip_all_tags($item['value'] ?? '')); ?></strong>
			<span><?php echo esc_html(wp_strip_all_tags($item['label'] ?? '')); ?></span>
		</li>
	<?php endforeach; ?>
</ul>
