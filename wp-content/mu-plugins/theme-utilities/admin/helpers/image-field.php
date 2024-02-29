<?php

function render_image_field($args, $label, $name, $type = 'normal')
{
	add_action('admin_footer', 'add_image_field_script');

	switch ($type):
		case 'table': ?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="<?= $args['field_id'] ?>"><?= $label ?></label>
				</th>
				<td>
					 <input type="hidden" id="<?= $args['field_id'] ?>" name="<?= $name ?>" class="custom_media_url"
					        value="<?= $args['field_value'] ?>">
					<div id="category-image-wrapper" style="margin-bottom: 10px;">
		                <?php echo wp_get_attachment_image($args['field_value']); ?>
		            </div>
					<p class="description">
						<input data-field="<?= $args['field_id'] ?>" type="button" class="button button-secondary media_button" id="media_button"
						       name="media_button" value="<?php _e('Add Image', 'custom_settings_section'); ?>"/>
		                <input data-field="<?= $args['field_id'] ?>" type="button" class="button button-secondary media_remove" id="media_remove"
		                       name="media_remove" value="<?php _e('Remove Image', 'custom_settings_section'); ?>"/>
					</p>
				</td>
			</tr>
			<?php break;
		case 'normal': ?>
			<div class="form-field field-image">
		        <label for="<?= $args['field_id'] ?>"><?= $label ?></label>
		        <input type="hidden" id="<?= $args['field_id'] ?>" name="<?= $name ?>" class="custom_media_url"
		               value="<?= $args['field_value'] ?>">
		        <div id="category-image-wrapper" style="margin-bottom: 10px;">
		            <?php echo wp_get_attachment_image($args['field_value']); ?>
		        </div>
		        <p>
		            <input data-field="<?= $args['field_id'] ?>" type="button" class="button button-secondary media_button" id="media_button"
		                   name="media_button" value="<?php _e('Add Image', 'custom_settings_section'); ?>"/>
		            <input data-field="<?= $args['field_id'] ?>" type="button" class="button button-secondary media_remove" id="media_remove"
		                   name="media_remove" value="<?php _e('Remove Image', 'custom_settings_section'); ?>"/>
		        </p>
            </div>
		<?php
	endswitch;
}


function add_image_field_script()
{
	wp_enqueue_media();
	?>
	<script>
        jQuery(document).ready(function ($) {
            function media_upload(button_class) {
                let custom_media = true,
                    orig_send_attachment = wp.media.editor.send.attachment;

                $('body').on('click', button_class, function (e) {
                    let button = $(this),
                        fieldImage = $('#' + button.data('field')).closest('.field-image');

                    custom_media = true;

                    wp.media.editor.send.attachment = function (props, attachment) {
                        if (custom_media) {
                            fieldImage.find('input[type="hidden"]').val(attachment.id);
                            fieldImage.find('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                            fieldImage.find('#category-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                        } else {
                            return orig_send_attachment.apply(button_id, [props, attachment]);
                        }
                    }

                    wp.media.editor.open(button);

                    return false;
                });
            }

            media_upload('.media_button.button-secondary');

            $('body').on('click', '.media_remove', function () {
                let fieldImage = $('#' + $(this).data('field')).closest('.field-image');

                fieldImage.find('.custom_media_url').val('');
                fieldImage.find('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
            });

            $(document).ajaxComplete(function (event, xhr, settings) {
                var queryStringArr = settings.data.split('&');

                if ($.inArray('action=add-tag', queryStringArr) !== -1) {
                    var xml = xhr.responseXML;
                    $response = $(xml).find('term_id').text();
                    if ($response != "") {
                        // Clear the thumb image
                        $('#category-image-wrapper').html('');
                    }
                }
            });
        });

    </script>
	<?php
}
