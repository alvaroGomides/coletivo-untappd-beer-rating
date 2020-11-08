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
 * @subpackage Coletivo_Untappd_Beer_Rating_Untappd/Api
 * @author     Álvaro Gomides <al.gomides@gmail.com>
 */
class Coletivo_Untappd_Beer_Rating_Untappd_Api {

	private $email;
	private $token;
	private $auth;
	private $base_url;
    private $textfield_id;

	public function __construct(){
		$options = get_option( 'untappd_access' );
		$this->email = $options['email'];
		$this->token = $options['token'];
		$this->auth = base64_encode($this->email .':'. $this->token);
		$this->base_url = 'https://business.untappd.com/api/v1';
        $this->textfield_id = UNTAPPD_FIELD_ID;
	}


	public function call_untappd_api($curl_url)
	{
		$curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $curl_url,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$this->auth
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return json_decode($response);
        }
	}

    public function get_locations()
    {
        $curl_url = $this->base_url."/locations";
    	$get_info = $this->call_untappd_api($curl_url);

        if(is_object($get_info)){
            return $get_info;
        }else{
            throw new Exception($get_info, 1);
        }
    }

    public function get_location_menus($location_id)
    {
        $curl_url = $this->base_url."/locations/{$location_id}/menus";
    	$get_info = $this->call_untappd_api($curl_url);

    	if(is_object($get_info)){
    		return $get_info;
    	}else{
    		throw new Exception($get_info, 1);
    	}
    }

    public function get_menu_sections($menu_id)
    {
        $curl_url = $this->base_url."/menus/{$menu_id}/sections";
    	$get_info = $this->call_untappd_api($curl_url);

    	if(is_object($get_info)){
    		return $get_info;
    	}else{
    		throw new Exception($get_info, 1);
    	}
    }

    public function get_section_items($section_id)
    {
        $curl_url = $this->base_url."/sections/{$section_id}/items";
    	$get_info = $this->call_untappd_api($curl_url);

    	if(is_object($get_info)){
    		return $get_info;
    	}else{
    		throw new Exception($get_info, 1);
    	}
    }

    public function get_item_info($item_id)
    {
        $curl_url = $this->base_url."/items/".$item_id;
    	$get_info = $this->call_untappd_api($curl_url);

    	if(is_object($get_info)){
    		return $get_info;
    	}else{
    		throw new Exception($get_info, 1);
    	}
    }

    public function get_product_info($product_id)
    {
        if($cache = $this->get_product_info_cache($product_id) ){
            //check if have cache
            return $cache;
        }else{
            //if cache is empty, get untappd item id
            if($product_untappd_id = $this->get_product_untappd_id($product_id)){
                //if product have untappd id, get info and return
                $product_data = $this->get_item_info($product_untappd_id);
                $this->set_product_info_cache($product_id, $product_data);
                return $product_data;
            }else{
                return null;
            }
        }
    }

    public function get_product_untappd_id($product_id)
    {
        $untappd_id = get_post_meta( $product_id, $this->textfield_id, true );
        if ( empty( $untappd_id ) ) {
          return;
        }else{
            return $untappd_id;
        }
    }

    public function get_product_info_cache($product_id)
    {
        if ( $value = get_transient( 'untappd_product_'.$product_id ) ) {
            return $value;
        }else{
            return false;
        }
    }

    public function set_product_info_cache($product_id, $product_data)
    {
        set_transient( 'untappd_product_'.$product_id, $product_data, 12 * HOUR_IN_SECONDS );
    }
}