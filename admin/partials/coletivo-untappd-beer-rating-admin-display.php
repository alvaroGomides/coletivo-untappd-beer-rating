<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://coletivoroda.com.br
 * @since      1.0.0
 *
 * @package    Coletivo_Untappd_Beer_Rating
 * @subpackage Coletivo_Untappd_Beer_Rating/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="untappd-form">

	<button class="load-locations">Load Locations</button>

	<p class="form-field select-row">
		<label for="untappd-locations">Locations:</label>
		<select id="untappd-locations" class="select short">
			<option value="">Click on Load Locations button</option>
		</select>
		<button class="get-menus hidden">Get Menus</button>
	</p>

	<div class="select-row">
		<label for="untappd-menus">Menu:</label>
		<select id="untappd-menus" class="select short">
			<option value="">Select an Location</option>
		</select>
		<button class="get-sections hidden">Get Sections</button>
	</div>

	<div class="select-row">
		<label for="untappd-sections">Section:</label>
		<select id="untappd-sections" class="select short">
			<option value="">Select an Menu</option>
		</select>
		<button class="get-items hidden">Get Items</button>
	</div>

	<div class="select-row">
		<label for="untappd-items">Item:</label>
		<select id="untappd-items" class="select short">
			<option value="">Select an Section</option>
		</select>
		<button class="select-item-id hidden">Select ID</button>
	</div>
</div>