(function( $ ) {
	'use strict';

	 function get_all_locations(){
	 	var data = {
            action: 'untappd_all_locations'
        };
        var locations;
        var $dropdown = jQuery("#untappd-locations");
        jQuery.ajax({ 
		    type: 'POST', 
		    url: ajaxurl, 
		    data: data, 
		    dataType: 'json',
		    success: function(data) { 
		    	locations = data.locations;
		    	$dropdown.html('');
		    	jQuery.each(locations, function() {
				    $dropdown.append($("<option />").val(this.id).text(this.name));
				});
				$('.get-menus').show();
		    }   
		});
	 }

	 function get_location_menus(location_id){
	 	var data = {
            action: 'untappd_get_location_menus',
            location_id: location_id
        };
        var menus;
        var $dropdown = jQuery("#untappd-menus");
        jQuery.ajax({ 
		    type: 'POST', 
		    url: ajaxurl, 
		    data: data, 
		    dataType: 'json',
		    success: function(response) { 
		    	
		    	menus = response.menus;
		    	$dropdown.html('');
		    	jQuery.each(menus, function() {
				    $dropdown.append($("<option />").val(this.id).text(this.name));
				});
				$('.get-menus').hide();
				$('.get-sections').show();
				$('#untappd-locations').prop('disabled', 'disabled');
		    }   
		});
	 }

	 function get_menu_sections(menu_id){
	 	var data = {
            action: 'untappd_get_menu_sections',
            menu_id: menu_id
        };
        var sections;
        var $dropdown = jQuery("#untappd-sections");
        jQuery.ajax({ 
		    type: 'POST', 
		    url: ajaxurl, 
		    data: data, 
		    dataType: 'json',
		    success: function(response) { 
		    	
		    	sections = response.sections;
		    	$dropdown.html('');
		    	jQuery.each(sections, function() {
				    $dropdown.append($("<option />").val(this.id).text(this.name));
				});
				$('.get-sections').hide();
				$('.get-items').show();
				$('#untappd-menus').prop('disabled', 'disabled');
		    }   
		});
	 }

	 function get_section_items(section_id){
	 	var data = {
            action: 'untappd_get_section_items',
            section_id: section_id
        };
        var items;
        var $dropdown = jQuery("#untappd-items");
        jQuery.ajax({ 
		    type: 'POST', 
		    url: ajaxurl, 
		    data: data, 
		    dataType: 'json',
		    success: function(response) { 
		    	
		    	items = response.items;
		    	$dropdown.html('');
		    	jQuery.each(items, function() {
				    $dropdown.append($("<option />").val(this.id).text(this.name));
				});
				$('.get-items').hide();
				$('.select-item-id').show();
				$('#untappd-sections').prop('disabled', 'disabled');
		    }   
		});
	 }

	 function fill_untappd_input(untappd_id){
	 	$('#untappd_id').val(untappd_id);
	 	$([document.documentElement, document.body]).animate({
	        scrollTop: $("#untappd_id").offset().top
	    }, 2000);

	    alert('Untappd ID Selected!');
	 }


	 jQuery('.load-locations').click(function(e){
	 	e.preventDefault();
	 	//get selected location and check if it's null
	 	get_all_locations();
	 	$(this).hide();
	 });


	 jQuery('.get-menus').click(function(e){
	 	e.preventDefault();
	 	//get selected location and check if it's null
	 	var selectedLocation;
	 	selectedLocation = jQuery('#untappd-locations').val();
	 	if(selectedLocation.lenght == 0){
	 		alert('Select location first!');
	 	}else{
	 		get_location_menus(selectedLocation);
	 	}
	 });

	 jQuery('.get-sections').click(function(e){
	 	e.preventDefault();
	 	//get selected location and check if it's null
	 	var selectedMenu;
	 	selectedMenu = jQuery('#untappd-menus').val();
	 	if(selectedMenu.lenght == 0){
	 		alert('Select menu first!');
	 	}else{
	 		get_menu_sections(selectedMenu);
	 	}
	 });

	 jQuery('.get-items').click(function(e){
	 	e.preventDefault();
	 	//get selected location and check if it's null
	 	var selectedSection;
	 	selectedSection = jQuery('#untappd-sections').val();
	 	if(selectedSection.lenght == 0){
	 		alert('Select section first!');
	 	}else{
	 		get_section_items(selectedSection);
	 	}
	 });

	 jQuery('.select-item-id').click(function(e){
	 	e.preventDefault();
	 	//get selected location and check if it's null
	 	var selectedItem;
	 	selectedItem = jQuery('#untappd-items').val();
	 	if(selectedItem.lenght == 0){
	 		alert('Select item first!');
	 	}else{
	 		fill_untappd_input(selectedItem);
	 	}
	 });

	 
})( jQuery );
