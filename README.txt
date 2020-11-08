=== Untappd Beer Rating ===
Contributors: alvaroGomides
Donate link: https://github.com/alvaroGomides/coletivo-untappd-beer-rating
Tags: beer, rating, untappd, woocommerce
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The plugin create API connection with Untappd to display current beer rating on product page.

== Description ==

This plugin is developed to ColetivoRoda (thanks Gustavo!) and implements a very simple interface to display untappd rating of beers. Untappd is the most famous beer rating repository and help customers to drink better.

== Installation ==

1. First get your API credentials and fill the Settings > Untappd Credentials
2. Go to Woocommerce product list on back-office and edit the selected beer
3. Find the *Find Product Untappd Id* section and use the Wizard to select Item ID
4. Save product and check the widget on product page

== Frequently Asked Questions ==

= How to style the widget? =

The first version of the plugin doesn't have style options at backoffice. You have to do with CSS.

= The rating is updated at every page load? =

No, the plugin save the rating at WP Transient Cache to improve performance.

== Screenshots ==

1. Rating displayed on product page at frontend. It's have a link to untappd website.
2. Settings page to put API credentials.
3. Wizard to select beer on woocommerce product edit page.

== Changelog ==

= 1.0 =
* Initial version.

== Upgrade Notice ==

= 1.0 =
First version of module with MVP functions.

== Possible future features ==

You can contribute with the project developing new features:

* Wizard to generate Shortcodes
* Widget position setting
* Errors handling
* Widget Style setting
* Wizard css style
