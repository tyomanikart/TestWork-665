<?php
/**
 * Template Name: Product Create
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */


if(!empty($_POST['product-title'])) {

	$post_information = array(
		'post_title' => esc_attr(strip_tags($_POST['product-title'])),
		'post_type' => 'product',
		'post_status' => 'publish',

	);

	$post_id = wp_insert_post($post_information);
	$product = wc_get_product( $post_id );
	$product->set_regular_price( $_POST['price'] );
	$product->save();

	foreach($_POST['extra'] as $key => $value) {
		if(!empty($value)) {
			update_post_meta( $post_id, $key, strip_tags( $value ) ) ;
		}
	}		

	if ( $_FILES ) {
		upload_user_file($_FILES['product-image'], $post_id);
	}

	if($post_id)
	{
		wp_redirect(home_url());
		exit;
	}
}



get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'product-create' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
