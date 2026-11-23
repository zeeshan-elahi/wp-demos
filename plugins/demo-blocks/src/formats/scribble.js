/**
 * "Scribble underline" rich-text format: wraps selected text in <span class="scribble">,
 * the hand-drawn underline from the design. Shows in the toolbar of any rich-text field.
 */
import { __ } from '@wordpress/i18n';
import { registerFormatType, toggleFormat } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';

const FORMAT_NAME = 'demo-blocks/scribble';

registerFormatType( FORMAT_NAME, {
	title: __( 'Scribble underline', 'demo-blocks' ),
	tagName: 'span',
	className: 'scribble',
	edit( { isActive, value, onChange } ) {
		return (
			<RichTextToolbarButton
				icon="edit"
				title={ __( 'Scribble underline', 'demo-blocks' ) }
				isActive={ isActive }
				onClick={ () =>
					onChange( toggleFormat( value, { type: FORMAT_NAME } ) )
				}
			/>
		);
	},
} );
