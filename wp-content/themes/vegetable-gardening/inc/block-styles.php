<?php
/**
 * Block Styles
 *
 * @package vegetable_gardening
 * @since 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	function vegetable_gardening_register_block_styles() {

		//Wp Block Padding Zero
		register_block_style(
			'core/group',
			array(
				'name'  => 'vegetable-gardening-padding-0',
				'label' => esc_html__( 'No Padding', 'vegetable-gardening' ),
			)
		);

		//Wp Block Post Author Style
		register_block_style(
			'core/post-author',
			array(
				'name'  => 'vegetable-gardening-post-author-card',
				'label' => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);

		//Wp Block Button Style
		register_block_style(
			'core/button',
			array(
				'name'         => 'vegetable-gardening-button',
				'label'        => esc_html__( 'Plain', 'vegetable-gardening' ),
			)
		);

		//Post Comments Style
		register_block_style(
			'core/post-comments',
			array(
				'name'         => 'vegetable-gardening-post-comments',
				'label'        => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);

		//Latest Comments Style
		register_block_style(
			'core/latest-comments',
			array(
				'name'         => 'vegetable-gardening-latest-comments',
				'label'        => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);


		//Wp Block Table Style
		register_block_style(
			'core/table',
			array(
				'name'         => 'vegetable-gardening-wp-table',
				'label'        => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);


		//Wp Block Pre Style
		register_block_style(
			'core/preformatted',
			array(
				'name'         => 'vegetable-gardening-wp-preformatted',
				'label'        => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);

		//Wp Block Verse Style
		register_block_style(
			'core/verse',
			array(
				'name'         => 'vegetable-gardening-wp-verse',
				'label'        => esc_html__( 'Theme Style', 'vegetable-gardening' ),
			)
		);
	}
	add_action( 'init', 'vegetable_gardening_register_block_styles' );
}
