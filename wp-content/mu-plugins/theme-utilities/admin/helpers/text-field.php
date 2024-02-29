<?php

function render_text_field($args, $label, $name, $type = 'normal')
{
	switch ($type):
		case 'table': ?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="<?= $args['field_id'] ?>"><?= $label ?></label>
				</th>
				<td>
					   <input type="text" id="<?= $args['field_id'] ?>" name="<?= $name ?>" class="custom_text_url"
					          value="<?= $args['field_value'] ?>">
					</p>
				</td>
			</tr>
			<?php break;
		case 'normal': ?>
			<div class="form-field field-text">
	        <label for="<?= $args['field_id'] ?>"><?= $label ?></label>
	        <input type="text" id="<?= $args['field_id'] ?>" name="<?= $name ?>" class="custom_text_url"
	               value="<?= $args['field_value'] ?>">
        </div>
		<?php
	endswitch;

}