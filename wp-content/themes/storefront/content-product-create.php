<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<form id="product-create-form" method="POST" enctype="multipart/form-data">
		<label>Title
			<input type="text" name="product-title">
		</label>
		<label>Price
			<input type="number" name="price">
		</label>
		<label>Created at
			<input type="date" name="extra[created_at]" class="input-text">
		</label>
		<p>
        <label>Type</label>
        <select name="extra[type]" class="select-type input-text" style="width: 100%">
			<?php $sel_v = get_post_meta($post->ID, 'type', 1); ?>
			<option value="">----</option>
			<option value="rare" <?php selected( $sel_v, 'rare' )?> >Rare</option>
			<option value="frequent" <?php selected( $sel_v, 'frequent' )?> >Frequent</option>
			<option value="unusual" <?php selected( $sel_v, 'unusual' )?> >Unusual</option>
		</select></p>
		<label>Image
			<input type="file" name="product-image" class="input-text">
		</label>
		<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
		<input type="submit" value="submit">
	</form>
</article><!-- #post-## -->


