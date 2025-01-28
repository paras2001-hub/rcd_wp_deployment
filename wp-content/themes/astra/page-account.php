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
			$logoutUrl = wp_logout_url('http://localhost:8085/?page_id=148');

			$userData = get_userdata($userId);
			$userMetaData = get_user_meta($userId);
			$roleOptions = [
				"one" => "Associate",
				"two" => "Relationship Manager",
				"three" => "Senior Manager",
				"four" => "Customer",
			];

			echo "
			<ul>
				<li>User Id: " . $userId . "</li>
				<li>Username: " . $userData->user_email . "</li>
				<li>Backend Role: " . implode(', ', $userData->roles) . "</li>";

				if ( metadata_exists( 'user', $userId, "Role" ) ){
					echo "<li>Role: <b>" . $roleOptions[$userMetaData["Role"][0]] . "</b></li>";
					echo "<li>Address: " . $userMetaData["Address"][0] . "</li>";
				}

			echo "<li><a href='$logoutUrl'>Logout</a></li>
			</ul>";
		}
		?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
