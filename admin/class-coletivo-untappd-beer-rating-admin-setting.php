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
 * @subpackage Coletivo_Untappd_Beer_Rating_Admin/setting
 * @author     Álvaro Gomides <al.gomides@gmail.com>
 */
class Coletivo_Untappd_Beer_Rating_Admin_Setting {


	public function __construct(){
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );

	}

	/**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Untappd Credentials', 
            'Untappd Credentials', 
            'manage_options', 
            'untappd_credentials', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'untappd_access' );
        ?>

        <div class="wrap">
            <h1>Untappd Beer Rating</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'untappd_fields' );
                do_settings_sections( 'untappd_credentials' );
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
        register_setting(
            'untappd_fields', // Option group
            'untappd_access', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Untappd Business Credentials', // Title
            array( $this, 'print_section_info' ), // Callback
            'untappd_credentials' // Page
        );  

        add_settings_field(
            'untappd_email', // ID
            'E-mail', // Title 
            array( $this, 'email_callback' ), // Callback
            'untappd_credentials', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'untappd_token', // ID
            'Token', // Title 
            array( $this, 'token_callback' ), // Callback
            'untappd_credentials', // Page
            'setting_section_id' // Section           
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['email'] ) )
            $new_input['email'] = sanitize_text_field( $input['email'] );

        if( isset( $input['token'] ) )
            $new_input['token'] = sanitize_text_field( $input['token'] );
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your e-mail and token read only:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function email_callback()
    {
        printf(
            '<input type="text" id="untappd_email" name="untappd_access[email]" value="%s" />',
            isset( $this->options['email'] ) ? esc_attr( $this->options['email']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function token_callback()
    {
        printf(
            '<input type="text" id="untappd_token" name="untappd_access[token]" value="%s" />',
            isset( $this->options['token'] ) ? esc_attr( $this->options['token']) : ''
        );
    }
}