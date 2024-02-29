<?php

class Date_Picker
{
	private $_plugin_path;

	function __construct()
	{
		$this->_plugin_path = '/wp-content/mu-plugins/date-picker';
		$this->enqueueActions();
	}

	private function enqueueActions()
	{
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		add_action('admin_menu', array($this, 'create_forfaits_options_page'));
		add_action('admin_init', array($this, 'register_forfaits_settings'));
	}

	/**
	 * Inclusions des fichiers javascript
	 */
	public function enqueueScripts()
	{
		wp_enqueue_script('date-picker', sprintf('%s/assets/js/date-picker.js', $this->_plugin_path), array('jquery'));

		$php_vars = array(
			'restrictedDates' => $this->get_restricted_dates(),
			'firstAvailableDate' => $this->get_first_available_date(),
		);

		wp_localize_script('date-picker', 'forfaitsData', $php_vars);
	}

	public function create_forfaits_options_page()
	{
		add_menu_page(
			__('Options des forfaits'),
			__('Options des forfaits'),
			'edit_posts',
			'options-forfaits',
			array($this, 'render_forfaits_options_page')
		);
	}

	public function render_forfaits_options_page()
	{
		?>
		<div class="wrap">
        <h1><?php _e('Options des forfaits', 'textdomain'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('forfaits_options_group');
            do_settings_sections('options-forfaits');
            submit_button();
            ?>
        </form>
    </div>
		<script>
        (function ($) {
            $(document).ready(function () {
                var $tableBody = $('#restrictions_des_dates_tbody');

                $('#add-restriction-row').on('click', function () {
                    var index = $tableBody.find('tr').length;
                    var newRow = '<tr>' +
                        '<td><input type="date" name="forfaits_options[restrictions_des_dates][' + index + '][date_de_debut]" /></td>' +
                        '<td><input type="date" name="forfaits_options[restrictions_des_dates][' + index + '][date_de_fin]" /></td>' +
                        '<td><button type="button" class="button remove-row"><?php _e('Remove', 'textdomain'); ?></button></td>' +
                        '</tr>';

                    $tableBody.append(newRow);
                });

                $tableBody.on('click', '.remove-row', function () {
                    $(this).closest('tr').remove();
                });
            });
        })(jQuery);
    </script>
		<?php
	}

	public function register_forfaits_settings()
	{
		register_setting(
			'forfaits_options_group',
			'forfaits_options',
			'sanitize_forfaits_options'
		);

		add_settings_section(
			'forfaits_options_section',
			__('Forfaits Options', 'textdomain'),
			array($this, 'forfaits_options_section_callback'),
			'options-forfaits'
		);

		add_settings_field(
			'restrictions_des_dates',
			__('Restrictions des dates', 'textdomain'),
			array($this, 'render_restrictions_des_dates_field'),
			'options-forfaits',
			'forfaits_options_section'
		);
	}

	public function forfaits_options_section_callback()
	{
		_e('Configure your forfaits options here.', 'textdomain');
	}

	public function get_first_available_date()
	{
		$restricted_dates = $this->get_restricted_dates();
		$current_date = new DateTime();
		$first_available_date = null;
		if (empty($restricted_dates)) return $current_date;
		// Sort restricted dates by start date
		usort($restricted_dates, function ($a, $b) {
			return strtotime($a['date_de_debut']) - strtotime($b['date_de_debut']);
		});

		foreach ($restricted_dates as $date_range) {
			$start_date = new DateTime($date_range['date_de_debut']);
			$end_date = new DateTime($date_range['date_de_fin']);
			$end_date->modify('+1 day'); // Include the end date in the restricted range

			// If the current date is within the restricted range, move the current date to the end of the range
			if ($current_date >= $start_date && $current_date < $end_date) {
				$current_date = $end_date;
			}

			// If the next start date is greater than the current date, it means we found the first available date
			if (!$first_available_date && $current_date < $start_date) {
				$first_available_date = $current_date;
				break;
			}
		}

		// If no first available date is found, set it to the current date
		if (!$first_available_date) {
			$first_available_date = $current_date;
		}

		return $first_available_date->format('Y-m-d');
	}

	public function render_restrictions_des_dates_field()
	{
		$options = get_option('forfaits_options');
		$restrictions = isset($options['restrictions_des_dates']) ? $options['restrictions_des_dates'] : array();

		// Nonce field for security

		?>

		<table class="wp-list-table widefat fixed" cellspacing="0">
        <thead>
        <tr>
            <td><?php _e('Date de début', 'textdomain'); ?></td>
            <td><?php _e('Date de fin', 'textdomain'); ?></td>
            <td></td>
        </tr>
        </thead>
        <tbody id="restrictions_des_dates_tbody">
        <?php foreach ($restrictions as $index => $restriction): ?>
	        <tr>
                <td><input type="date"
                           name="forfaits_options[restrictions_des_dates][<?php echo $index; ?>][date_de_debut]"
                           value="<?php echo esc_attr($restriction['date_de_debut']); ?>"/></td>
                <td><input type="date"
                           name="forfaits_options[restrictions_des_dates][<?php echo $index; ?>][date_de_fin]"
                           value="<?php echo esc_attr($restriction['date_de_fin']); ?>"/></td>
                <td>
                    <button type="button" class="button remove-row"><?php _e('Remove', 'textdomain'); ?></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">
                <button type="button" class="button"
                        id="add-restriction-row"><?php _e('Add Row', 'textdomain'); ?></button>
            </td>
        </tr>
        </tfoot>
    </table>

		<?php
	}

	public function get_restricted_dates()
	{
		$forfaits_options = get_option('forfaits_options');
		$restricted_dates = array();

		if (isset($forfaits_options['restrictions_des_dates']) && !empty($forfaits_options['restrictions_des_dates'])) {
			$restricted_dates = $forfaits_options['restrictions_des_dates'];
		}

		return $restricted_dates;
	}
}

$date_picker = new Date_Picker();
