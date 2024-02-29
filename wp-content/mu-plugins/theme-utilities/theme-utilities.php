<?php
/**
 * Plugin Name: Theme Utilities
 * Description: Adds custom functionalities to the theme.
 * Version: 1.0
 */

class ThemeUtilities {
	const SETTINGS_MENU_SLUG = 'custom-settings';
	const SETTINGS_NAMESPACE = 'custom-settings';

	/**
	 * Initialize the plugin by registering the necessary hooks and actions.
	 */
	public function __construct() {
		$this->register_actions();
	}

	public function register_actions() {
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'admin_menu', array( $this, 'theme_utilities_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'theme_utilities_admin_init' ) );
		add_action( 'init', array( $this, 'include_settings' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'theme-utilities', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Include the utility files.
	 */
	public function include_files( $directory ) {
		$inc_path = plugin_dir_path( __FILE__ ) . $directory;

		// Include each utility file
		$files = glob( $inc_path . '/*.php' );

		if ( ! empty( $files ) ) {
			foreach ( $files as $file ) {
				require_once $file;
			}
		}
	}

	/**
	 * Include the admin settings files.
	 */
	public function include_admin_settings() {
		$this->include_files( 'admin/helpers' );
		$this->include_files( 'admin/src' );
	}

	/**
	 * Include the settings files.
	 */
	public function include_settings() {
		$this->include_files( 'src' );
	}

	public function theme_utilities_admin_menu() {
		add_menu_page(
			__( 'Custom Settings', self::SETTINGS_NAMESPACE ),
			__( 'Custom Settings', self::SETTINGS_NAMESPACE ),
			'manage_options',
			self::SETTINGS_MENU_SLUG,
			array( $this, 'theme_utilities_page_contents' ),
			'dashicons-schedule',
			999
		);
	}

	public function theme_utilities_page_contents() {
		?>
		<h1><?php esc_html_e( 'Custom Settings', self::SETTINGS_NAMESPACE ); ?></h1>
		<form method="POST" action="options.php">
			<?php
			settings_fields( self::SETTINGS_MENU_SLUG );
			do_settings_sections( self::SETTINGS_MENU_SLUG );
			submit_button();
			?>
		</form>
		<?php
	}

	public function theme_utilities_admin_init() {
		add_settings_section(
			'theme_utilities_section',
			__( 'Settings', self::SETTINGS_NAMESPACE ),
			false,
			self::SETTINGS_MENU_SLUG
		);

		$this->include_admin_settings();
	}
}

new ThemeUtilities();
