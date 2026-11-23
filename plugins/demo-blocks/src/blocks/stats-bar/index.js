import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import metadata from './block.json';

// Dynamic block: markup comes from render.php, so nothing is saved to post content.
registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
