import { __, sprintf } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	TextControl,
} from '@wordpress/components';
import ItemsPanel from '../../shared/items-panel';
import {
	updateItem,
	removeItem,
	shiftFeatured,
	plainText,
} from '../../shared/items';

const MAX_ITEMS = 8;

const newService = () => ( {
	title: __( 'New service', 'demo-blocks' ),
	text: '',
	linkText: __( 'Learn more →', 'demo-blocks' ),
	linkUrl: '#contact',
} );

export default function Edit( { attributes, setAttributes } ) {
	const { columns, featured, items } = attributes;

	const blockProps = useBlockProps( {
		className: 'services-grid',
		style: { '--columns': columns },
	} );

	const setItem = ( index, key, value ) =>
		setAttributes( { items: updateItem( items, index, key, value ) } );

	const labelFor = ( item, index ) =>
		plainText( item.title ) ||
		sprintf(
			/* translators: %d: card number */
			__( 'Card %d', 'demo-blocks' ),
			index + 1
		);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Layout', 'demo-blocks' ) }>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Columns on desktop', 'demo-blocks' ) }
						value={ columns }
						min={ 1 }
						max={ 4 }
						onChange={ ( value ) =>
							setAttributes( { columns: value } )
						}
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Highlighted card', 'demo-blocks' ) }
						value={ String( featured ) }
						options={ [
							{ label: __( 'None', 'demo-blocks' ), value: '-1' },
							...items.map( ( item, index ) => ( {
								label: labelFor( item, index ),
								value: String( index ),
							} ) ),
						] }
						onChange={ ( value ) =>
							setAttributes( { featured: parseInt( value, 10 ) } )
						}
					/>
				</PanelBody>
				<ItemsPanel
					title={ __( 'Cards', 'demo-blocks' ) }
					items={ items }
					labelFor={ labelFor }
					max={ MAX_ITEMS }
					addLabel={ __( 'Add card', 'demo-blocks' ) }
					onAdd={ () =>
						setAttributes( { items: [ ...items, newService() ] } )
					}
					onRemove={ ( index ) =>
						setAttributes( {
							items: removeItem( items, index ),
							featured: shiftFeatured( featured, index ),
						} )
					}
				/>
				<PanelBody
					title={ __( 'Card links', 'demo-blocks' ) }
					initialOpen={ false }
				>
					{ items.map( ( item, index ) => (
						<TextControl
							key={ index }
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							label={ labelFor( item, index ) }
							value={ item.linkUrl }
							onChange={ ( value ) =>
								setItem( index, 'linkUrl', value )
							}
						/>
					) ) }
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ items.map( ( item, index ) => {
					const isFeatured = index === featured ? true : false;

					return (
						<article
							key={ index }
							className={
								'service-card' +
								( isFeatured ? ' service-card--featured' : '' )
							}
						>
							<span
								className="service-card__icon"
								aria-hidden="true"
							>
								✦
							</span>
							<RichText
								tagName="h3"
								value={ item.title }
								allowedFormats={ [] }
								placeholder={ __(
									'Service name',
									'demo-blocks'
								) }
								onChange={ ( value ) =>
									setItem( index, 'title', value )
								}
							/>
							<RichText
								tagName="p"
								value={ item.text }
								allowedFormats={ [
									'core/bold',
									'core/italic',
								] }
								placeholder={ __(
									'Describe the service…',
									'demo-blocks'
								) }
								onChange={ ( value ) =>
									setItem( index, 'text', value )
								}
							/>
							<RichText
								tagName="span"
								className="service-card__link"
								value={ item.linkText }
								allowedFormats={ [] }
								placeholder={ __( 'Link text', 'demo-blocks' ) }
								onChange={ ( value ) =>
									setItem( index, 'linkText', value )
								}
							/>
						</article>
					);
				} ) }
			</div>
		</>
	);
}
