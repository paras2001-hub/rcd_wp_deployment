<?php
/**
 * Vegetable Gardening functions and definitions
 *
 * @package vegetable_gardening
 * @since 1.0
 */

if ( ! function_exists( 'vegetable_gardening_support' ) ) :
	function vegetable_gardening_support() {

		load_theme_textdomain( 'vegetable-gardening', get_template_directory() . '/languages' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style(get_stylesheet_directory_uri() . '/assets/css/editor-style.css');

	}
endif;

add_action( 'after_setup_theme', 'vegetable_gardening_support' );

if ( ! function_exists( 'vegetable_gardening_styles' ) ) :
	function vegetable_gardening_styles() {
		// Register theme stylesheet.
		$vegetable_gardening_theme_version = wp_get_theme()->get( 'Version' );

		$vegetable_gardening_version_string = is_string( $vegetable_gardening_theme_version ) ? $vegetable_gardening_theme_version : false;
		wp_enqueue_style(
			'vegetable-gardening-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$vegetable_gardening_version_string
		);
	}
endif;

add_action( 'wp_enqueue_scripts', 'vegetable_gardening_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

// Add block styles
require get_template_directory() . '/inc/block-styles.php';

// Block Filters
require get_template_directory() . '/inc/block-filters.php';

// Svg icons
require get_template_directory() . '/inc/icon-function.php';