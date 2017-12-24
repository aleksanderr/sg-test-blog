<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/alexanderryzhiy/
 * @since      1.0.0
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/admin
 * @author     Alexander Ryzhiy <oleksandr.ryzhiy@gmail.com>
 */
class Currency_Graph_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	private $data;

	public function __construct( $plugin_name, $version, $data ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->page_sections = array();
		$this->data = $data;

		$this->display_plugin_settings_page();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Currency_Graph_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Currency_Graph_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/currency-graph-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Currency_Graph_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Currency_Graph_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/currency-graph-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     */

	    // add_menu_page( 'Currency graph - Options', 'Currency graph', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), 'dashicons-chart-area', 3 );


	   // error_log($this->plugin_name);

	    // add_submenu_page( $this->plugin_name, 'Currency graph - Options', 'Options', 'manage_options', $this->plugin_name );
	    // add_submenu_page( $this->plugin_name, 'Currency graph - Technical support', 'Technical support', 'manage_options', $this->plugin_name.'-test', array($this, 'display_plugin_setup_page') );
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge( $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_settings_page() {
	    include_once( 'partials/class-currency-graph-settings-page.php' );
	    $my_settings_page = new Currency_Graph_Settings_Page($this->data);
	}

}
