/**
 * WordPress coding standards from @wordpress/scripts, plus one adjustment: @wordpress/* packages
 * are webpack externals supplied by WordPress at runtime (wp.blocks, wp.blockEditor, ...), so they
 * are intentionally not installed and must not be flagged as unresolved or undeclared.
 */
const defaultConfig = require( '@wordpress/scripts/config/eslint.config.cjs' );

module.exports = [
	...defaultConfig,
	{
		settings: {
			'import/core-modules': [
				'@wordpress/blocks',
				'@wordpress/block-editor',
				'@wordpress/components',
				'@wordpress/element',
				'@wordpress/i18n',
				'@wordpress/rich-text',
			],
		},
	},
];
