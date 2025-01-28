<?php
/**
 * Block Filters
 *
 * @package vegetable_gardening
 * @since 1.0
 */

function vegetable_gardening_block_wrapper( $block_content, $block ) {
    if ( 'core/button' === $block['blockName'] ) {
        if( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'has-arrow' ) !== false ) {
            $block_content = str_replace( '</a>', vegetable_gardening_get_svg( array( 'icon' => 'caret-circle-right' ) ) . '</a>', $block_content );
            return $block_content;
        }
    }

    if ( ! is_single() ) {
        if ( 'core/post-terms' === $block['blockName'] ) {
            if ( 'post_tag' === $block['attrs']['term'] ) {
                $block_content = str_replace( '<div class="taxonomy-post_tag wp-block-post-terms">', '<div class="taxonomy-post_tag wp-block-post-terms flex">' . vegetable_gardening_get_svg( array( 'icon' => 'tags' ) ), $block_content );
            } elseif ( 'category' === $block['attrs']['term'] ) {
                $block_content = str_replace( '<div class="taxonomy-category wp-block-post-terms">', '<div class="taxonomy-category wp-block-post-terms flex">' . vegetable_gardening_get_svg( array( 'icon' => 'category' ) ), $block_content );
            }
            return $block_content;
        }
        if ( 'core/post-date' === $block['blockName'] ) {
            $block_content = str_replace( '<div class="wp-block-post-date">', '<div class="wp-block-post-date flex">' . vegetable_gardening_get_svg( array( 'icon' => 'calendar' ) ), $block_content );
            return $block_content;
        }
        if ( 'core/post-author' === $block['blockName'] ) {
            $block_content = str_replace( '<div class="wp-block-post-author">', '<div class="wp-block-post-author flex">' . vegetable_gardening_get_svg( array( 'icon' => 'user' ) ), $block_content );
            return $block_content;
        }
    }

    if ( is_single() ) {
        if ( 'core/post-navigation-link' === $block['blockName'] ) {
            if ( isset( $block['attrs']['type'] ) && 'previous' === $block['attrs']['type'] ) {
                $block_content = str_replace( '<span class="post-navigation-link__label">', '<span class="post-navigation-link__label">' . vegetable_gardening_get_svg( array( 'icon' => 'prev' ) ) . ' ', $block_content );
            } else {
                $block_content = str_replace( '<span class="post-navigation-link__label">Next Post', '<span class="post-navigation-link__label">Next Post' . vegetable_gardening_get_svg( array( 'icon' => 'next' ) ), $block_content );
            }
            return $block_content;
        }
        if ( 'core/post-date' === $block['blockName'] ) {
            $block_content = str_replace( '<div class="wp-block-post-date">', '<div class="wp-block-post-date flex">' . vegetable_gardening_get_svg( array( 'icon' => 'calendar' ) ), $block_content );
            return $block_content;
        }
        if ( 'core/post-author' === $block['blockName'] ) {
            $block_content = str_replace( '<div class="wp-block-post-author">', '<div class="wp-block-post-author flex">' . vegetable_gardening_get_svg( array( 'icon' => 'user' ) ), $block_content );
            return $block_content;
        }
    }
    return $block_content;
}

add_filter( 'render_block', 'vegetable_gardening_block_wrapper', 10, 2 );

