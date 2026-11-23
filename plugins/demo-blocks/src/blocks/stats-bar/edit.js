import { __, sprintf } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import ItemsPanel from '../../shared/items-panel';
import { updateItem, removeItem, plainText } from '../../shared/items';

const MAX_ITEMS = 4;

export default function Edit( { attributes, setAttributes } ) {
	const { items } = attributes;

	const blockProps = useBlockProps( { className: 'stats' } );

	const setItem = ( index, key, value ) =>
		setAttributes( { items: updateItem( items, index, key, value ) } );

	const labelFor = ( item, index ) =>
		plainText( item.label ) ||
		sprintf(
			/* translators: %d: stat number */
			__( 'Stat %d', 'demo-blocks' ),
			index + 1
		);

	return (
		<>
			<InspectorControls>
				<ItemsPanel
					title={ __( 'Numbers', 'demo-blocks' ) }
					items={ items }
					labelFor={ labelFor }
					max={ MAX_ITEMS }
					addLabel={ __( 'Add number', 'demo-blocks' ) }
					onAdd={ () =>
						setAttributes( {
							items: [
								...items,
								{
									value: '0',
									label: __( 'New stat', 'demo-blocks' ),
								},
							],
						} )
					}
					onRemove={ ( index ) =>
						setAttributes( { items: removeItem( items, index ) } )
					}
				/>
			</InspectorControls>

			<ul { ...blockProps }>
				{ items.map( ( item, index ) => (
					<li key={ index }>
						<RichText
							tagName="strong"
							value={ item.value }
							allowedFormats={ [] }
							placeholder="0"
							onChange={ ( value ) =>
								setItem( index, 'value', value )
							}
						/>
						<RichText
							tagName="span"
							value={ item.label }
							allowedFormats={ [] }
							placeholder={ __( 'Label', 'demo-blocks' ) }
							onChange={ ( value ) =>
								setItem( index, 'label', value )
							}
						/>
					</li>
				) ) }
			</ul>
		</>
	);
}
