<?php

	
wp_enqueue_style( 'create-product-css', get_template_directory_uri() . '/assets/css/form.css',false,'1.1','all');


add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'product', 'side', 'high'  );
}

function extra_fields_box_func( $post ){
    $date = !empty(get_post_meta($post->ID, 'created_at', 1)) ? get_post_meta($post->ID, 'created_at', 1) : date('Y-m-d');
	?>

	<p>Дата создания:
		<input type="date" name="extra[created_at]" class="input-date" style="width:100%;" value="<?php echo $date; ?>">
	</p>

	<p>
        <label>Тип:</label>
        <select name="extra[type]" class="select-type" style="width: 100%">
			<?php $sel_v = get_post_meta($post->ID, 'type', 1); ?>
			<option value="">----</option>
			<option value="rare" <?php selected( $sel_v, 'rare' )?> >Rare</option>
			<option value="frequent" <?php selected( $sel_v, 'frequent' )?> >Frequent</option>
			<option value="unusual" <?php selected( $sel_v, 'unusual' )?> >Unusual</option>
		</select></p>


    <p>
        <label for="extra[image]">Image Upload</label><br>
        <input type="text" name="extra[image]" id="extra[image]" class="meta-image regular-text" style="max-width: 100%; margin-bottom: 10px" value="<?php echo get_post_meta($post->ID, 'image', 1); ?>">
        <input type="button" class="button image-upload" value="Browse">
        <input type="button" class="button image-remove" value="Remove">
    </p>
    <div class="image-preview"><img src="<?php echo get_post_meta($post->ID, 'image', 1); ?>" style="max-width: 100%;"></div>

    
    <input type="button" class="button form-clear" value="Clear">
    <input type="button" class="button form-publish" value="Publish">

    <script>
    jQuery(document).ready(function ($) {
      var meta_image_frame;
      var meta_image_preview = $('.image-preview');

      $('.image-upload').click(function (e) {
        e.preventDefault();
        var meta_image = $(this).parent().children('.meta-image');
        if (meta_image_frame) {
          meta_image_frame.open();
          return;
        }
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
          title: meta_image.title,
          button: {
            text: meta_image.button
          }
        });
        meta_image_frame.on('select', function () {
          var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
          meta_image.val(media_attachment.url);
          meta_image_preview.children('img').attr('src', media_attachment.url);
        });
        meta_image_frame.open();
      });

      $('.image-remove').click(function (e) {
        meta_image_preview.children('img').attr('src', "");
        $('.meta-image').val("");
      });

      $('.form-clear').on('click',function(e){
          $('.input-date').val("");
          $('.select-type').val("");
          $('.meta-image').val("");
          meta_image_preview.children('img').attr('src', "");
      });

      $('.form-publish').on('click', function(e){
        e.preventDefault();
        $('#publish').click();
      })

      
    });
  </script>

	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}


add_action( 'save_post', 'my_extra_fields_update', 0 );

function my_extra_fields_update( $post_id ){
	if (
		   empty( $_POST['extra'] )
		|| ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
		|| wp_is_post_autosave( $post_id )
		|| wp_is_post_revision( $post_id )
	)
		return false;

	$_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] );
	foreach( $_POST['extra'] as $key => $value ){
		if( empty($value) ){
			delete_post_meta( $post_id, $key );
			continue;
		}

		update_post_meta( $post_id, $key, $value );
	}

	return $post_id;
}

if ( ! function_exists( 'upload_user_file' ) ) :
    function upload_user_file( $file = array(), $post_id, $title = false ) {


        require_once ABSPATH.'wp-admin/includes/admin.php';

        $file_return = wp_handle_upload($file, array('test_form' => false));

        if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){

            return false;

        }else{

            $filename = $file_return['file'];

            $attachment = array(
                'post_mime_type' => $file_return['type'],
                'post_content' => '',
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'guid' => $file_return['url']
            );

            if($title){
                $attachment['post_title'] = $title;
            }

            $attachment_id = wp_insert_attachment( $attachment, $filename );

            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );

            wp_update_attachment_metadata( $attachment_id, $attachment_data );

            if( 0 < intval( $attachment_id ) ) {
                update_post_meta( $post_id, 'image', $file_return['url'] ) ;
                set_post_thumbnail( $post_id, $attachment_id );
                return $attachment_id;
            }
        }

        return false;
    }
endif;

add_action( 'woocommerce_show_custom_fields', 'show_custom_fields', 15 );

function show_custom_fields() {
    global $post;
    $meta = get_post_meta($post->ID);
    echo('<p>Created at: ' . $meta['created_at'][0] . '</p>');
    echo('<p>Type: ' . $meta['type'][0] . '</p>');
    echo('<p><img src="' . $meta['image'][0] . '"></p>');
}



function dd($var) {
    echo "<pre>";
    print_r($var);
    exit;
}

