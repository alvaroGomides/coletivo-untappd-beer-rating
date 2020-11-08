<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://coletivoroda.com.br
 * @since      1.0.0
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating_Public_Product/widget
 * @author     Álvaro Gomides <al.gomides@gmail.com>
 */
class Coletivo_Untappd_Beer_Rating_Public_Product_Widget {

	private $textfield_id;
  private $api;

	public function __construct(){
		$this->textfield_id = UNTAPPD_FIELD_ID;
    $this->init();

  }

  public function init() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'untappd/coletivo-untappd-beer-rating-untappd-api.php';
    $this->api = new Coletivo_Untappd_Beer_Rating_Untappd_Api();

    add_action(
      'woocommerce_single_product_summary',
      array( $this, 'untappd_widget' )
    );
  }

  public function untappd_widget() {

    $beer_info = $this->api->get_product_info(get_the_ID());

    if($beer_info){
      $page_template = plugin_dir_path( dirname( __FILE__ ) ) .  '/public/partials/coletivo-untappd-beer-rating-public-display.php'; 
        //render template page
      require_once $page_template;
    }
    
  }

  public function round_helper($number){
    $fraction = 4;
    $x = $number * $fraction;
    $x = floor($x);
    $x = $x / $fraction;
    return $x;
  }


}