import { __, sprintf } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	TextControl,
	TextareaControl,
	ToggleControl,
} from '@wordpress/components';
import ItemsPanel from '../../shared/items-panel';
import {
	updateItem,
	removeItem,
	shiftFeatured,
	plainText,
} from '../../shared/items';

const MAX_PLANS = 4;

const newPlan = () => ( {
	name: __( 'New plan', 'demo-blocks' ),
	monthly: '$0',
	yearly: '$0',
	features: __( 'First feature', 'demo-blocks' ),
	ctaText: __( 'Choose plan', 'demo-blocks' ),
	ctaUrl: '#contact',
} );

// Features are stored as one string, one feature per line, so the sidebar textarea and the
// inline fields edit the same value.
const splitFeatures = ( features ) =>
	( features || '' )
		.split( '\n' )
		.map( ( line ) => line.trim() )
		.filter( Boolean );

const replaceFeature = ( features, index, value ) => {
	const lines = splitFeatures( features );
	lines[ index ] = plainText( value ).replace( /\n/g, ' ' );

	return lines.join( '\n' );
};

export default function Edit( { attributes, setAttributes } ) {
	const { showToggle, featured, plans } = attributes;

	// Which price the canvas shows and edits. Editor-only state; the front end starts on monthly.
	const [ period, setPeriod ] = useState( 'monthly' );
	const isYearly = period === 'yearly' ? true : false;

	const blockProps = useBlockProps( { className: 'pricing-block' } );

	const setPlan = ( index, key, value ) =>
		setAttributes( { plans: updateItem( plans, index, key, value ) } );

	const labelFor = ( plan, index ) =>
		plainText( plan.name ) ||
		sprintf(
			/* translators: %d: plan number */
			__( 'Plan %d', 'demo-blocks' ),
			index + 1
		);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'demo-blocks' ) }>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'Show monthly / yearly switch',
							'demo-blocks'
						) }
						checked={ showToggle }
						onChange={ ( value ) =>
							setAttributes( { showToggle: value } )
						}
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Highlighted plan', 'demo-blocks' ) }
						value={ String( featured ) }
						options={ [
							{ label: __( 'None', 'demo-blocks' ), value: '-1' },
							...plans.map( ( plan, index ) => ( {
								label: labelFor( plan, index ),
								value: String( index ),
							} ) ),
						] }
						onChange={ ( value ) =>
							setAttributes( { featured: parseInt( value, 10 ) } )
						}
					/>
				</PanelBody>
				<ItemsPanel
					title={ __( 'Plans', 'demo-blocks' ) }
					items={ plans }
					labelFor={ labelFor }
					max={ MAX_PLANS }
					addLabel={ __( 'Add plan', 'demo-blocks' ) }
					onAdd={ () =>
						setAttributes( { plans: [ ...plans, newPlan() ] } )
					}
					onRemove={ ( index ) =>
						setAttributes( {
							plans: removeItem( plans, index ),
							featured: shiftFeatured( featured, index ),
						} )
					}
				/>
				{ plans.map( ( plan, index ) => (
					<PanelBody
						key={ index }
						title={ labelFor( plan, index ) }
						initialOpen={ false }
					>
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							label={ __( 'Monthly price', 'demo-blocks' ) }
							value={ plan.monthly }
							onChange={ ( value ) =>
								setPlan( index, 'monthly', value )
							}
						/>
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							label={ __( 'Yearly price', 'demo-blocks' ) }
							value={ plan.yearly }
							onChange={ ( value ) =>
								setPlan( index, 'yearly', value )
							}
						/>
						<TextareaControl
							__nextHasNoMarginBottom
							label={ __(
								'Features (one per line)',
								'demo-blocks'
							) }
							help={ __(
								'Add or remove lines here; edit existing ones on the canvas too.',
								'demo-blocks'
							) }
							value={ plan.features }
							onChange={ ( value ) =>
								setPlan( index, 'features', value )
							}
						/>
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							label={ __( 'Button link', 'demo-blocks' ) }
							value={ plan.ctaUrl }
							onChange={ ( value ) =>
								setPlan( index, 'ctaUrl', value )
							}
						/>
					</PanelBody>
				) ) }
			</InspectorControls>

			<div { ...blockProps }>
				{ showToggle && (
					<div
						className="pricing-toggle"
						role="group"
						aria-label={ __(
							'Price shown while editing',
							'demo-blocks'
						) }
					>
						<button
							type="button"
							aria-pressed={ isYearly ? 'false' : 'true' }
							onClick={ () => setPeriod( 'monthly' ) }
						>
							{ __( 'Monthly', 'demo-blocks' ) }
						</button>
						<button
							type="button"
							aria-pressed={ isYearly ? 'true' : 'false' }
							onClick={ () => setPeriod( 'yearly' ) }
						>
							{ __( 'Yearly', 'demo-blocks' ) }
						</button>
					</div>
				) }
				<div className="pricing-grid">
					{ plans.map( ( plan, index ) => {
						const isFeatured = index === featured ? true : false;

						return (
							<article
								key={ index }
								className={
									'plan' +
									( isFeatured ? ' plan--featured' : '' )
								}
							>
								<RichText
									tagName="h3"
									value={ plan.name }
									allowedFormats={ [] }
									placeholder={ __(
										'Plan name',
										'demo-blocks'
									) }
									onChange={ ( value ) =>
										setPlan( index, 'name', value )
									}
								/>
								<p className="plan__price">
									<RichText
										tagName="span"
										className="plan__amount"
										value={ plan[ period ] }
										allowedFormats={ [] }
										placeholder="$0"
										onChange={ ( value ) =>
											setPlan(
												index,
												period,
												plainText( value )
											)
										}
									/>
									<small>{ isYearly ? '/yr' : '/mo' }</small>
								</p>
								<ul>
									{ splitFeatures( plan.features ).map(
										( feature, featureIndex ) => (
											<RichText
												key={ featureIndex }
												tagName="li"
												value={ feature }
												allowedFormats={ [] }
												onChange={ ( value ) =>
													setPlan(
														index,
														'features',
														replaceFeature(
															plan.features,
															featureIndex,
															value
														)
													)
												}
											/>
										)
									) }
								</ul>
								<RichText
									tagName="span"
									className={
										'btn ' +
										( isFeatured
											? 'btn--accent'
											: 'btn--dark' )
									}
									value={ plan.ctaText }
									allowedFormats={ [] }
									placeholder={ __(
										'Button text',
										'demo-blocks'
									) }
									onChange={ ( value ) =>
										setPlan( index, 'ctaText', value )
									}
								/>
							</article>
						);
					} ) }
				</div>
			</div>
		</>
	);
}
