<?php
/**
 * Plugin Name:       Demo Blocks
 * Description:       Dynamic Gutenberg blocks (Services Grid, Pricing Table, Stats Bar) and a "scribble underline" text format, built for the Gutenberg Blocks Demo theme.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      8.1
 * Author:            Zeeshan Elahi
 * License:           GPL-2.0-or-later
 * Text Domain:       demo-blocks
 *
 * @package DemoBlocks
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Register every block found in build/blocks/. Each folder holds a block.json (metadata, attributes,
 * editor script) and a render.php (server-side output), so adding a block needs no PHP change here.
 */
function demo_blocks_register_blocks()
{
	$block_dirs = glob(__DIR__ . '/build/blocks/*', GLOB_ONLYDIR);

	foreach ($block_dirs ?: [] as $block_dir) {
		register_block_type($block_dir);
	}
}
add_action('init', 'demo_blocks_register_blocks');

/**
 * Put the blocks in their own inserter category, first in the list.
 *
 * @param array $categories Registered block categories.
 * @return array
 */
function demo_blocks_category($categories)
{
	array_unshift($categories, [
		'slug'  => 'demo-blocks',
		'title' => __('Demo Blocks', 'demo-blocks'),
		'icon'  => null,
	]);

	return $categories;
}
add_filter('block_categories_all', 'demo_blocks_category');

/**
 * Editor-only script for the scribble-underline rich-text format.
 */
function demo_blocks_editor_assets()
{
	$asset_path = __DIR__ . '/build/formats/scribble.asset.php';

	if (!file_exists($asset_path)) {
		return;
	}

	$asset = include $asset_path;

	wp_enqueue_script(
		'demo-blocks-scribble',
		plugins_url('build/formats/scribble.js', __FILE__),
		$asset['dependencies'],
		$asset['version'],
		true
	);
}
add_action('enqueue_block_editor_assets', 'demo_blocks_editor_assets');
