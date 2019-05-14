var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    blockStyle = { backgroundColor: '#900', color: '#fff', padding: '20px' };

registerBlockType( 'ipa/test-block-01', {
    title: 'Hello World (Step 1)',

    icon: 'universal-access-alt',

    category: 'common',

    edit: function() {
        return el( 'p', { style: blockStyle }, 'Hello editor.' );
    },

    save: function() {
        return el( 'p', { style: blockStyle }, 'Hello saved content.' );
    },
} );

