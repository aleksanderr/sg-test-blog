<?php

/**
 *
 * @link              https://www.linkedin.com/in/alexanderryzhiy/
 * @since             1.0.0
 * @package           Currency_Graph
 *
 * @wordpress-plugin
 * Plugin Name:       Currency graph
 * Plugin URI:        -
 * Description:       Plugin for displaying exchange rate changes in the form of graphs
 * Version:           1.0.0
 * Author:            Alexander Ryzhiy
 * Author URI:        https://www.linkedin.com/in/alexanderryzhiy/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       currency-graph
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-currency-graph-activator.php
 */
function activate_currency_graph() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-currency-graph-activator.php';
	Currency_Graph_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-currency-graph-deactivator.php
 */
function deactivate_currency_graph() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-currency-graph-deactivator.php';
	Currency_Graph_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_currency_graph' );
register_deactivation_hook( __FILE__, 'deactivate_currency_graph' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-currency-graph.php';

/**
 * Begins execution of the plugin.
 */
function run_currency_graph() {

	$plugin = new Currency_Graph();
	$plugin->run();

}

run_currency_graph();


function plugintest() {

	$data = json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5'), true);
	echo "<pre>";
	var_dump($data);
	echo "</pre>";

	$obj = new Currency_Graph_Public('', '', '');
}
