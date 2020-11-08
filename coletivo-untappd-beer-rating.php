<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/alvaroGomides/coletivo-untappd-beer-rating
 * @since             1.0.0
 * @package           Coletivo_Untappd_Beer_Rating
 *
 * @wordpress-plugin
 * Plugin Name:       ColetivoRoda Untappd Beer Rating
 * Plugin URI:        https://github.com/alvaroGomides/coletivo-untappd-beer-rating
 * Description:       The plugin create API connection with Untappd to display current beer rating on product page.
 * Version:           1.0.0
 * Author:            Álvaro Gomides
 * Author URI:        https://coletivoroda.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coletivo-untappd-beer-rating
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COLETIVO_UNTAPPD_BEER_RATING_VERSION', '1.0.0' );
define( 'UNTAPPD_FIELD_ID', 'untappd_id' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-coletivo-untappd-beer-rating-activator.php
 */
function activate_coletivo_untappd_beer_rating() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coletivo-untappd-beer-rating-activator.php';
	Coletivo_Untappd_Beer_Rating_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-coletivo-untappd-beer-rating-deactivator.php
 */
function deactivate_coletivo_untappd_beer_rating() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coletivo-untappd-beer-rating-deactivator.php';
	Coletivo_Untappd_Beer_Rating_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_coletivo_untappd_beer_rating' );
register_deactivation_hook( __FILE__, 'deactivate_coletivo_untappd_beer_rating' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-coletivo-untappd-beer-rating.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_coletivo_untappd_beer_rating() {

	$plugin = new Coletivo_Untappd_Beer_Rating();
	$plugin->run();

}
run_coletivo_untappd_beer_rating();
