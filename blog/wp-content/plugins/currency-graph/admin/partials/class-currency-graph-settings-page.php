<?php

/**
 * Display settings page
 *
 * @link       https://www.linkedin.com/in/alexanderryzhiy/
 * @since      1.0.0
 *
 * @package    Currency_Graph
 * @subpackage Currency_Graph/admin/partials
 */

class Currency_Graph_Settings_Page {

	private $options;
	private $slug = 'currency-graph.php';
	private $data;

    /**
     * Start up
     */
    public function __construct($data)
    {
    	add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    	add_action( 'admin_init', array( $this, 'page_init' ) );
    	$this->data = $data;
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
    	add_menu_page( 
    		'Currency graph - Settings', 
    		'Currency graph', 
    		'manage_options', 
    		$this->slug, 
    		array( $this, 'create_admin_page' ),
    		'dashicons-chart-area', 
    		3 
    	);
    	error_log('add_plugin_page()');
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
    	?>
    	<div class="wrap">
    		<?php 
    		$data = json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5'), true);
    		foreach ($this->data as $value) {
    			echo $value['ccy'];
    		}
    		?>
    		<h1>My Settings</h1>
    		<form method="post" action="options.php">
    			<?php
    			settings_fields( 'currency_graph' );
    			do_settings_sections( $this->slug );
    			submit_button();
    			?>
    		</form>
    	</div>
    	<?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        

    	register_setting( 'currency_graph', 'currency_graph', array( $this, 'validate_settings' ) ); // true_options

	// Добавляем секцию
    	add_settings_section( 'true_section_1', 'Отображаемые валюты', '', $this->slug );
    	$data = json_decode(file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5'), true);
    		foreach ($data as $value) {
    			$currency = $value['ccy'];
    		}

	// Создадим текстовое поле в первой секции
    	$true_field_params = array(
		'type'      => 'text', // тип
		'id'        => 'my_text',
		'desc'      => 'Пример обычного текстового поля.', // описание
		'label_for' => 'my_text' // позволяет сделать название настройки лейблом (если не понимаете, что это, можете не использовать), по идее должно быть одинаковым с параметром id
	);
    	add_settings_field( 'my_text_field', 'Текстовое поле', array( $this, 'build_field' ), $this->slug, 'true_section_1', $true_field_params );

	// Создадим textarea в первой секции
    	$true_field_params = array(
    		'type'      => 'textarea',
    		'id'        => 'my_textarea',
    		'desc'      => 'Пример большого текстового поля.'
    	);
    	add_settings_field( 'my_textarea_field', 'Большое текстовое поле', array( $this, 'build_field' ), $this->slug, 'true_section_1', $true_field_params );

	// Добавляем вторую секцию настроек

    	add_settings_section( 'true_section_2', 'Другие поля ввода', '', $this->slug );

	// Создадим чекбокс
    	$true_field_params = array(
    		'type'      => 'checkbox',
    		'id'        => 'my_checkbox',
    		'desc'      => 'Пример чекбокса.'
    	);
    	add_settings_field( 'my_checkbox_field', 'Чекбокс', array( $this, 'build_field' ), $this->slug, 'true_section_2', $true_field_params );

    		$true_field_params = array(
    		'type'      => 'checkbox',
    		'id'        => 'my_checkbox2',
    		'desc'      => 'Пример чекбокса.'
    	);
    	add_settings_field( 'my_checkbox_field2', 'Чекбокс', array( $this, 'build_field' ), $this->slug, 'true_section_2', $true_field_params );

	// Создадим выпадающий список
    	$true_field_params = array(
    		'type'      => 'select',
    		'id'        => 'my_select',
    		'desc'      => 'Пример выпадающего списка.',
    		'vals'		=> array( 'val1' => 'Значение 1', 'val2' => 'Значение 2', 'val3' => 'Значение 3')
    	);
    	add_settings_field( 'my_select_field', 'Выпадающий список', array( $this, 'build_field' ), $this->slug, 'true_section_2', $true_field_params );

	// Создадим радио-кнопку
    	$true_field_params = array(
    		'type'      => 'radio',
    		'id'      => 'my_radio',
    		'vals'		=> array( 'val1' => 'Значение 1', 'val2' => 'Значение 2', 'val3' => 'Значение 3')
    	);
    	add_settings_field( 'my_radio', 'Радио кнопки', array( $this, 'build_field' ), $this->slug, 'true_section_2', $true_field_params );

    }

    public function build_field($args) {
    	extract( $args );

    	$option_name = 'currency_graph';

    	$o = get_option( $option_name );

    	switch ( $type ) {  
    		case 'text':  
    		$o[$id] = esc_attr( stripslashes($o[$id]) );
    		echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";  
    		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
    		break;
    		case 'textarea':  
    		$o[$id] = esc_attr( stripslashes($o[$id]) );
    		echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";  
    		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
    		break;
    		case 'checkbox':
    		$checked = ($o[$id] == 'on') ? " checked='checked'" :  '';  
    		echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";  
    		echo ($desc != '') ? $desc : "";
    		echo "</label>";  
    		break;
    		case 'select':
    		echo "<select id='$id' name='" . $option_name . "[$id]'>";
    		foreach($vals as $v=>$l){
    			$selected = ($o[$id] == $v) ? "selected='selected'" : '';  
    			echo "<option value='$v' $selected>$l</option>";
    		}
    		echo ($desc != '') ? $desc : "";
    		echo "</select>";  
    		break;
    		case 'radio':
    		echo "<fieldset>";
    		foreach($vals as $v=>$l){
    			$checked = ($o[$id] == $v) ? "checked='checked'" : '';  
    			echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
    		}
    		echo "</fieldset>";  
    		break; 
    	}
    }

    public function validate_settings($input) {
    	foreach($input as $k => $v) {
    		$valid_input[$k] = trim($v);

		/* Вы можете включить в эту функцию различные проверки значений, например
		if(! задаем условие ) { // если не выполняется
			$valid_input[$k] = ''; // тогда присваиваем значению пустую строку
		}
		*/
	}
	return $valid_input;
}
}

?>
