<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_page_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

		<?php
		if (is_user_logged_in()) {
			$userId = get_current_user_id();

			$userData = get_userdata($userId);
			$userMetaData = get_user_meta($userId);
			$roleOptions = [
				"one" => "Associate",
				"two" => "Relationship Manager",
				"three" => "Senior Manager",
				"four" => "Customer",
			];

			if ( metadata_exists( 'user', $userId, "Role" ) ){
				switch($roleOptions[$userMetaData["Role"][0]]){
					case "Associate":
						echo "
						<ul>
							<li>Referral Link (Customer)</li>
						</ul>";
						break;
					case "Customer":
						echo "Some Options for Customers";
						break;
					default:
						echo "
						<ul>
							<li>Referral Link (Customer)</li>
							<li>Referral Link (Associate)</li>
						</ul>";
						break;
				}
			} else {
				echo "Hello Admin";
			}
		}
		?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
