/**
 * Default @wordpress/scripts config (finds every block.json under src/) plus one extra
 * entry for the rich-text format, which is not a block and so is not auto-discovered.
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const defaultEntry =
	typeof defaultConfig.entry === 'function'
		? defaultConfig.entry()
		: defaultConfig.entry;

module.exports = {
	...defaultConfig,
	entry: {
		...defaultEntry,
		'formats/scribble': './src/formats/scribble.js',
	},
};
