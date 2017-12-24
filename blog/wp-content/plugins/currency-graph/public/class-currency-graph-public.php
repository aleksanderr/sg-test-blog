<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/alexanderryzhiy/
 * @since      1.0.0
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/public
 * @author     Alexander Ryzhiy <oleksandr.ryzhiy@gmail.com>
 */
class Currency_Graph_Public {

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

	private $data;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version,  $data ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->data = $data;
		$this->display_graphs($data);		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/currency-graph-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( 'chart-js', plugin_dir_url( __FILE__ ) . 'js/Chart.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/currency-graph-public.js', array( 'jquery' ), $this->version, false );

	}

	public function get_data_by_date() {
		$dates = json_decode(stripslashes($_GET['dates']));
		$currency = $_GET['currency'];

		$i = 0;
		foreach ($dates as $date) {
			do {
				$data = file_get_contents('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=' . $currency . '&date=' . $date . '&json');
			} while ( ! $data );

			// echo $data;
			$json[$i] = json_decode($data, true);
			$i++;
		};

		$result = json_encode($json);
		print_r($result);
		die ();
	}

	public function js_variables(){
		echo '<script type="text/javascript">window.cg_ajax_url = "' . admin_url('admin-ajax.php') . '";</script>';
	}

	public function display_graphs($data) {
		require_once ( 'partials/currency-graph-public-display.php' );
		$graphs = new Currency_Graph_Public_Display($data);
	}

}
