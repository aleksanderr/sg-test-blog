<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/alexanderryzhiy/
 * @since      1.0.0
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/public/partials
 */

class Currency_Graph_Public_Display {
	static $data;
	public function __construct( $data ) {
		self::$data = $data;
	}

	public static function getData() {
		$options = get_option('currency_graph');
		echo '<div class="cg-panel">
		<select name="currency-list" id="currency-list" class="cg-select" data-cg-currency-list>';
		foreach (self::$data as $value) {
			$currency = $value['cc'];
			if ( isset($options['cur_'.$currency]) ) {
				echo '<option value="' . $currency . '">' . $currency . '</option>';
			}
		}
		echo '</select>
		<div class="cg-periods">
		<button class="cg-periods__item" data-cg-get-days="3">3 days</button>
		<button class="cg-periods__item" data-cg-get-days="7">1 week</button>
		<button class="cg-periods__item" data-cg-get-days="30">1 month</button>
		</div>
		</div>';
		echo '<br><div class="cg-chart"><div class="cg-preloader"><img src="' . plugins_url( 'pic/preloader.gif' , dirname(__FILE__) ) .'" /></div>';
		echo '<canvas id="myChart"></canvas>';
		echo '</div>';
		echo "<script> 
		$(document).ready(function(){
			graph.init();
		});		
		</script>";
		// var_dump(self::$data);
	}
}
?>