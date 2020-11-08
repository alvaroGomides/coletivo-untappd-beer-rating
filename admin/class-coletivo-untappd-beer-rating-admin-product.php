<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://coletivoroda.com.br
 * @since      1.0.0
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating_Admin/product
 * @author     Álvaro Gomides <al.gomides@gmail.com>
 */
class Coletivo_Untappd_Beer_Rating_Admin_Product {

	private $textfield_id;

	public function __construct(){
		$this->textfield_id = UNTAPPD_FIELD_ID;
		$this->init();
	}

	public function init(){

		//create product field on general tab
		add_action(
                'woocommerce_product_options_general_product_data',
                array( $this, 'product_options_grouping' )
            );
		//save field
        add_action(
		    'woocommerce_process_product_meta',
		    array( $this, 'add_custom_linked_field_save' )
		);
        //create metabox to search untappd id
		add_action( 'add_meta_boxes', array($this, 'create_untappd_meta_box' ));

	}

	function create_untappd_meta_box()
    {
        add_meta_box(
            'untappd_product_meta_box',
            __( 'Find Product Untappd Id', 'woocommerce' ),
            array($this, 'add_untappd_product_content_meta_box'),
            'product',
            'normal',
            'default'
        );
    }

    function add_untappd_product_content_meta_box( $post ){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/coletivo-untappd-beer-rating-admin-display.php';
    }

	public function product_options_grouping(){
		$description = sanitize_text_field( '' );
        $placeholder = sanitize_text_field( 'Use the wizard to get Untappd ID' );

        $args = array(
            'id'            => $this->textfield_id,
            'label'         => sanitize_text_field( 'Untappd ID' ),
            'placeholder'   => 'Use the wizard to get Untappd ID',
            'desc_tip'      => true,
            'description'   => $description,
        );
        woocommerce_wp_text_input( $args );
	}

	public function add_custom_linked_field_save( $post_id ) {
 
        if ( ! ( isset( $_POST['woocommerce_meta_nonce'], $_POST[ $this->textfield_id ] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) {
	        return false;
	    }
	 
	    $product_teaser = sanitize_text_field(
	        wp_unslash( $_POST[ $this->textfield_id ] )
	    );
	 
	    update_post_meta(
	        $post_id,
	        $this->textfield_id,
	        esc_attr( $product_teaser )
	    );
	    delete_transient( 'untappd_product_'.$post_id );
	}

}