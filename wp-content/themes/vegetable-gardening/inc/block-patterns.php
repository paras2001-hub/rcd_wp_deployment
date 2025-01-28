<?php
/**
 * Block Patterns
 *
 * @package vegetable_gardening
 * @since 1.0
 */

function vegetable_gardening_register_block_patterns() {
	$block_pattern_categories = array(
		'vegetable-gardening' => array( 'label' => esc_html__( 'Vegetable Gardening', 'vegetable-gardening' ) ),
		'pages' => array( 'label' => esc_html__( 'Pages', 'vegetable-gardening' ) ),
	);

	$block_pattern_categories = apply_filters( 'vegetable_gardening_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', 'vegetable_gardening_register_block_patterns', 9 );