<?php

/**
 * Create save rating class
 *
 * @link       https://coletivoroda.com.br
 * @since      1.0.0
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/includes
 */

/**
 * Create save rating class
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/includes
 * @author     Álvaro Gomides <al.gomides@gmail.com>
 */
class Coletivo_Untappd_Beer_Rating_Ajax {

	private $api;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'untappd/coletivo-untappd-beer-rating-untappd-api.php';
    	$this->api = new Coletivo_Untappd_Beer_Rating_Untappd_Api();

		//all locations
		add_action('wp_ajax_untappd_all_locations', array($this,'all_locations') ); 

		//get location menus
		add_action('wp_ajax_untappd_get_location_menus', array($this,'get_location_menus') ); 

		//get menu sections
		add_action('wp_ajax_untappd_get_menu_sections', array($this,'get_menu_sections') ); 

		//get section items
		add_action('wp_ajax_untappd_get_section_items', array($this,'get_section_items') ); 
	}

	function all_locations() {
		echo json_encode($this->api->get_locations());
    	wp_die(); 
	}

	function get_location_menus() {
		echo json_encode($this->api->get_location_menus($_POST['location_id']));
    	wp_die(); 
	}

	function get_menu_sections() {
		echo json_encode($this->api->get_menu_sections($_POST['menu_id']));
    	wp_die(); 
	}

	function get_section_items() {
		echo json_encode($this->api->get_section_items($_POST['section_id']));
    	wp_die(); 
	}
}