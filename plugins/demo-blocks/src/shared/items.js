/**
 * Small immutable helpers for blocks that store a list of items in one array attribute.
 */

export const updateItem = ( items, index, key, value ) =>
	items.map( ( item, i ) =>
		i === index ? { ...item, [ key ]: value } : item
	);

export const removeItem = ( items, index ) =>
	items.filter( ( _item, i ) => i !== index );

// Keep the highlighted index pointing at the same item after a removal; -1 means none.
export const shiftFeatured = ( featured, removedIndex ) => {
	if ( featured === removedIndex ) {
		return -1;
	}

	return featured > removedIndex ? featured - 1 : featured;
};

export const plainText = ( html ) => ( html || '' ).replace( /<[^>]+>/g, '' );
