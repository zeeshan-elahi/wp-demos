/**
 * Sidebar panel that lists a block's items with Remove buttons and an Add button.
 */
import { __ } from '@wordpress/i18n';
import { PanelBody, Button, Flex, FlexItem } from '@wordpress/components';

export default function ItemsPanel( {
	title,
	items,
	labelFor,
	onAdd,
	onRemove,
	addLabel,
	min = 1,
	max = 0,
} ) {
	const isFull = max > 0 && items.length >= max ? true : false;
	const isAtMinimum = items.length <= min ? true : false;

	return (
		<PanelBody title={ title }>
			{ items.map( ( item, index ) => (
				<Flex
					key={ index }
					justify="space-between"
					style={ { marginBottom: '8px' } }
				>
					<FlexItem>{ labelFor( item, index ) }</FlexItem>
					<Button
						variant="link"
						isDestructive
						disabled={ isAtMinimum }
						onClick={ () => onRemove( index ) }
					>
						{ __( 'Remove', 'demo-blocks' ) }
					</Button>
				</Flex>
			) ) }
			<Button variant="secondary" disabled={ isFull } onClick={ onAdd }>
				{ addLabel }
			</Button>
		</PanelBody>
	);
}
