<?php function byconsolewooodtrestro_free_admin_timeslot_form(){?>
	<div class="wrap">
        <h1>Time slot setting</h1>
        <form method="post" class="form_byconsolewooodtrestro_free_plugin_settings" action="options.php">
				<?php
                settings_fields("timeslot");
                do_settings_sections("byconsolewooodtrestro_timeslot_options");  
                submit_button();
                ?> 
		</form>
    </div>

	<?php
}

function byconsolewooodtrestro_enable_timeslot(){
	
	$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');
	if($byconsolewooodtrestro_enable_timeslot == 'yes'){
		$checkedVal = 'checked';
	}else{
		$checkedVal = '';
	}
	echo '<input type="checkbox" name="byconsolewooodtrestro_enable_timeslot" id="byconsolewooodtrestro_enable_timeslot" value="yes" '.$checkedVal.'/>';
	
}

include('byconsolewooodtrestro_pickup_timeslot.php');

include('byconsolewooodtrestro_delivery_timeslot.php');

include('byconsolewooodtrestro_dinein_timeslot.php');





add_action('admin_init', 'byconsolewooodtrestro_timeslot_settings_fields');

function byconsolewooodtrestro_timeslot_settings_fields(){	

add_settings_section("timeslot", "", null, "byconsolewooodtrestro_timeslot_options");

add_settings_field("byconsolewooodtrestro_enable_timeslot", "Enable Timeslot", "byconsolewooodtrestro_enable_timeslot", "byconsolewooodtrestro_timeslot_options", "timeslot");

add_settings_field("byconsolewooodtrestro_pickup_timeslot", "Pickup Timeslot", "byconsolewooodtrestro_pickup_timeslot", "byconsolewooodtrestro_timeslot_options", "timeslot");

add_settings_field("byconsolewooodtrestro_delivery_timeslot", "Delivery Timeslot", "byconsolewooodtrestro_delivery_timeslot", "byconsolewooodtrestro_timeslot_options", "timeslot");

add_settings_field("byconsolewooodtrestro_dinein_timeslot", "Dinein Timeslot", "byconsolewooodtrestro_dinein_timeslot", "byconsolewooodtrestro_timeslot_options", "timeslot");


register_setting("timeslot", "byconsolewooodtrestro_enable_timeslot");

register_setting("timeslot", "byconsolewooodtrestro_pickup_timeslot");

register_setting("timeslot", "byconsolewooodtrestro_delivery_timeslot");

register_setting("timeslot", "byconsolewooodtrestro_dinein_timeslot");



}
?>