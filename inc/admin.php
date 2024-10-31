<?php

// add mmenu


include('byconsolewooodtrestro_holiday_management.php');

include('byconsolewooodtrestro_modification_request_details.php');

include('byconsolewooodtrestro_tweak_features.php');

include('byconsolewooodtrestro_timeslot_setting.php');


add_action('admin_menu','byconsolewooodtrestro_add_plugin_menu');

function byconsolewooodtrestro_add_plugin_menu(){


global $byconsolewooodtrestro_admin_settings;
global $byconsolewooodtrestro_timeslot_settings;
global $byconsolewooodtrestro_admin_holiday_settings;

global $byconsolewooodtrestro_admin_modification_request;

global $byconsolewooodtrestro_tweak_features_settings;


$byconsolewooodtrestro_admin_settings = add_menu_page( 'Restaurant Pickup | Delivery | Dine in', 'Pickup | Delivery | Dine in', 'manage_options', 'byconsolewooodtrestro_general_settings', 'byconsolewooodtrestro_admin_general_settings_form' );

$byconsolewooodtrestro_timeslot_settings = add_submenu_page('byconsolewooodtrestro_general_settings', 'Timeslot Setting','Timeslot Setting', 'manage_options', 'byconsolewooodtrestro_admin_timeslot_settings', 'byconsolewooodtrestro_free_admin_timeslot_form');

$byconsolewooodtrestro_admin_holiday_settings = add_submenu_page('byconsolewooodtrestro_general_settings', 'Holiday Management','Holiday Management', 'manage_options', 'byconsolewooodtrestro_admin_holiday_settings', 'byconsolewooodtrestro_free_admin_holiday_form');



$byconsolewooodtrestro_admin_modification_request = add_submenu_page('byconsolewooodtrestro_general_settings', 'Custom Modification Request','Custom Modification Request', 'manage_options', 'byconsolewooodtrestro_admin_modification_request_settings', 'byconsolewooodtrestro_admin_modification_request_form');

$byconsolewooodtrestro_tweak_features_settings = add_submenu_page(
													'byconsolewooodtrestro_general_settings', 
													'Tweak Features',
													'Tweak Features', 
													'manage_options', 
													'byconsolewooodtrestro_admin_tweak_features_settings', 
													'byconsolewooodtrestro_tweak_features_admin_form');







}





function byconsolewooodtrestro_admin_general_settings_form(){

?>

			<div class="wrap">

			<h1>ByConsole Restaurant Pickup | Delivery | Dine in management settings panel</h1>



            <div class="" style="width:80%; float:left;">



			<form method="post" class="form_byconsolewooodtrestro_plugin_settings" action="options.php">



				<?php



					settings_fields("section");



					do_settings_sections("byconsolewooodtrestro_plugin_options");      



					submit_button(); 



				?>          



			</form>



			</div>



<?php 

}



function byconsolewooodtrestro_order_type(){

$byc_allowed_order_types=get_option('byconsolewooodtrestro_order_type');

?>

<label>

    <input type="checkbox" name="byconsolewooodtrestro_order_type[levering]" id="byconsolewooodtrestro_order_type" class="byconsolewooodtrestro_admin_element_field radio" value="yes" <?php if(is_array($byc_allowed_order_types) && array_key_exists('levering',$byc_allowed_order_types) && $byc_allowed_order_types['levering']=='yes'){?> checked="checked"<?php }?> />Delivery

</label>

  

<label>

  <input type="checkbox" name="byconsolewooodtrestro_order_type[take_away]" id="byconsolewooodtrestro_order_type" class="byconsolewooodtrestro_admin_element_field radio" value="yes" <?php if(is_array($byc_allowed_order_types) && array_key_exists('take_away',$byc_allowed_order_types) && $byc_allowed_order_types['take_away']=='yes'){?> checked="checked"<?php }?> />Pickup    

</label>



<label>

  <input type="checkbox" name="byconsolewooodtrestro_order_type[dinein]" id="byconsolewooodtrestro_order_type" class="byconsolewooodtrestro_admin_element_field radio" value="yes" <?php if(is_array($byc_allowed_order_types) && array_key_exists('dinein',$byc_allowed_order_types) &&  $byc_allowed_order_types['dinein']=='yes'){?> checked="checked"<?php }?> />Dine in    

</label>



<?php 

	} 



	function byconsolewooodtrestro_chekout_page_section_heading()

	{

?>



 <input type="text" name="byconsolewooodtrestro_chekout_page_section_heading" id="byconsolewooodtrestro_chekout_page_section_heading" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_chekout_page_section_heading')); ?>"/>



 <label><?php echo __('Texts to display on checkout page as section heading.','restaurant-pickup-delivery-dine-in');?></label><br />



 <span style="color:#a0a5aa">(Eg: Desired delivery date and time)</span>



<?php

	}



	function byconsolewooodtrestro_chekout_page_date_label()

	{

?>



 <input type="text" name="byconsolewooodtrestro_chekout_page_date_label" id="byconsolewooodtrestro_chekout_page_date_label" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_chekout_page_date_label')); ?>"/>



 <label><?php echo __('displayed as calendar label on checkout page.','restaurant-pickup-delivery-dine-in');?></label><br />



 <span style="color:#a0a5aa">(Eg: Select date)</span>

<?php

	}



	function byconsolewooodtrestro_chekout_page_time_label()

	{

?>



 <input type="text" name="byconsolewooodtrestro_chekout_page_time_label" id="byconsolewooodtrestro_chekout_page_time_label" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_chekout_page_time_label')); ?>"/>



 <label><?php echo __('displayed as time drop-down label on checkout page.','restaurant-pickup-delivery-dine-in');?></label><br />



<span style="color:#a0a5aa">(Eg: Select time)</span>

<?php

	}



	function byconsolewooodtrestro_chekout_page_order_type_label()

	{

?>



 <input type="text" name="byconsolewooodtrestro_chekout_page_order_type_label" id="byconsolewooodtrestro_chekout_page_order_type_label" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_chekout_page_order_type_label')); ?>"/>



 <label><?php echo __('displayed as time drop-down label on checkout page.','restaurant-pickup-delivery-dine-in');?></label><br />



 <span style="color:#a0a5aa">(Eg: Select order type)</span>



<?php

	}



	function byconsolewooodtrestro_hours_format()

	{                                        

?>



 <select id="byconsolewooodtrestro_hours_format" name="byconsolewooodtrestro_hours_format" style="width:35%;" >



 <option   value="H:i" <?php if( get_option('byconsolewooodtrestro_hours_format')=='H:i'){?> selected="selected"<?php }?> >24 hours</option>



 <option   value="h:i A"<?php if( get_option('byconsolewooodtrestro_hours_format')=='h:i A'){?> selected="selected"<?php }?> >12 hours</option>



 </select>



 <label><?php echo __('24 hours or 12 hours with AM / PM.','restaurant-pickup-delivery-dine-in');?> </label>



<?php

	}



	function byconsolewooodtrestro_preorder_days()

	{

?>

<input type="number" name="byconsolewooodtrestro_preorder_days" id="byconsolewooodtrestro_preorder_days" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_preorder_days')); ?>"/>



<label><?php echo __('Leave blank to not set and pre-order days, this is number of days customer can pre order in advance.','restaurant-pickup-delivery-dine-in');?></label><br />

<span style="color:#a0a5aa">(Eg: 10 Only number)</span>

<?php

	}



	function byconsolewooodtrestro_time_field_validation(){

		

		$byconsolewooodtrestro_time_field_validation = get_option('byconsolewooodtrestro_time_field_validation');

		if($byconsolewooodtrestro_time_field_validation == 'yes'){

			$checked = 'checked="checked"';

		}else{

			$checked = '';

		}

		?>

			<input type="checkbox" name="byconsolewooodtrestro_time_field_validation" id="byconsolewooodtrestro_time_field_validation" value="yes" <?php echo $checked;?>/>

            <label><?php echo __('Make time selection mendatory.','restaurant-pickup-delivery-dine-in');?></label>

		<?php

	}



	function byconsolewooodtrestro_pickup_hours()

	{

?>



<label><?php echo __('From','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_pickup_hours_from" id="byconsolewooodtrestro_pickup_hours_from" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_pickup_hours_from')); ?>" />



<label><?php echo __('To','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_pickup_hours_to" id="byconsolewooodtrestro_pickup_hours_to" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_pickup_hours_to')); ?>" />



<label><?php echo __('Allowable Pickup Time.','restaurant-pickup-delivery-dine-in');?></label>

<?php

	}



	function byconsolewooodtrestro_delivery_hours()

	{

?>

<label><?php echo __('From','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_delivery_hours_from" id="byconsolewooodtrestro_delivery_hours_from" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_delivery_hours_from')); ?>" />



<label><?php echo __('To','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_delivery_hours_to" id="byconsolewooodtrestro_delivery_hours_to" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_delivery_hours_to')); ?>" />



<label><?php echo __('Allowable Delivery Time.','restaurant-pickup-delivery-dine-in');?></label>



<?php

	}



	function byconsolewooodtrestro_dinein_hours()

	{

?>

<label><?php echo __('From','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_dinein_hours_from" id="byconsolewooodtrestro_dinein_hours_from" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_dinein_hours_from')); ?>" />



<label><?php echo __('To','restaurant-pickup-delivery-dine-in');?></label>



<input type="time" name="byconsolewooodtrestro_dinein_hours_to" id="byconsolewooodtrestro_dinein_hours_to" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_dinein_hours_to')); ?>" />



<label><?php echo __('Allowable Dine in Time.','restaurant-pickup-delivery-dine-in');?></label>



<?php

	}



	function byconsolewooodtrestro_delivery_times()

	{

?>



<input type="text" name="byconsolewooodtrestro_delivery_times" id="byconsolewooodtrestro_delivery_times" style="width:30%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_delivery_times')); ?>" />



<label> <?php echo __('This is visible on widget front end if customer has chosen delivery.','restaurant-pickup-delivery-dine-in');?></label><br />



<span style="color:#a0a5aa">(Eg: Minimum Delivery time 30 minutes)</span>



<?php

	}

	function byconsolewooodtrestro_takeaway_lable()

	{

?>



<input type="text" name="byconsolewooodtrestro_takeaway_lable" id="byconsolewooodtrestro_takeaway_lable" style="width:50%; padding:7px;" value="<?php echo get_option('byconsolewooodtrestro_takeaway_lable'); ?>" />



<label> <?php echo __('Take away label shown on checkout page and in widget.','restaurant-pickup-delivery-dine-in');?></label><br />

<?php		

	}



	function byconsolewooodtrestro_delivery_lable()

	{

?>



<input type="text" name="byconsolewooodtrestro_delivery_lable" id="byconsolewooodtrestro_delivery_lable" style="width:50%; padding:7px;" value="<?php echo get_option('byconsolewooodtrestro_delivery_lable'); ?>" />



<label> <?php echo __('Delivery label shown on checkout page and in widget.','restaurant-pickup-delivery-dine-in');?></label><br />

<?php		



	}



	function byconsolewooodtrestro_dinein_lable()

	{

?>



<input type="text" name="byconsolewooodtrestro_dinein_lable" id="byconsolewooodtrestro_dinein_lable" style="width:50%; padding:7px;" value="<?php echo get_option('byconsolewooodtrestro_dinein_lable'); ?>" />



<label> <?php echo __('Dinein label shown on checkout page and in widget.','restaurant-pickup-delivery-dine-in');?></label><br />

<?php		



	}



	function byconsolewooodtrestro_date_field_text()

	{

?>

<input type="text" name="byconsolewooodtrestro_date_field_text" id="byconsolewooodtrestro_date_field_text" style="width:50%; padding:7px;" value="<?php echo get_option('byconsolewooodtrestro_date_field_text'); ?>" />



<label> <?php echo __('Placeholder text for date-picker calendar input box.','restaurant-pickup-delivery-dine-in');?></label><br />

<?php		

	}



	function byconsolewooodtrestro_time_field_text()

	{

?>

<input type="text" name="byconsolewooodtrestro_time_field_text" id="byconsolewooodtrestro_time_field_text" style="width:50%; padding:7px;" value="<?php echo get_option('byconsolewooodtrestro_time_field_text'); ?>" />



<label> <?php echo __('Placeholder text for time drop-down input box.','restaurant-pickup-delivery-dine-in');?></label><br />

<?php		

	}



	function byconsolewooodtrestro_orders_delivered()

	{

?>

<input type="text" name="byconsolewooodtrestro_orders_delivered" id="byconsolewooodtrestro_orders_delivered" style="width:50%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_orders_delivered')); ?>" />



<label> <?php echo __('This is the text is shown on Order details page of customer side.','restaurant-pickup-delivery-dine-in');?></label><br />



<span style="color:#a0a5aa">(<?php echo __('Eg: The order will be delivered on','restaurant-pickup-delivery-dine-in');?>  [bycrestro_delivery_date] <?php echo __('at','restaurant-pickup-delivery-dine-in');?>   [bycrestro_delivery_time])</span>

<?php

	}



	function byconsolewooodtrestro_orders_pick_up()

	{

?>

<input type="text" name="byconsolewooodtrestro_orders_pick_up" id="byconsolewooodtrestro_orders_pick_up" style="width:50%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_orders_pick_up')); ?>" />



<label> <?php echo __('This is the text is shown on Order details page of customer side.','restaurant-pickup-delivery-dine-in');?></label><br />



<span style="color:#a0a5aa">(<?php echo __('Eg: The order can be Pick Up on','restaurant-pickup-delivery-dine-in');?>  [bycrestro_pickup_date] <?php echo __('at','restaurant-pickup-delivery-dine-in');?>  [bycrestro_pickup_time])</span>

<?php

	}



	function byconsolewooodtrestro_orders_dinein()

	{

?>

<input type="text" name="byconsolewooodtrestro_orders_dinein" id="byconsolewooodtrestro_orders_dinein" style="width:50%; padding:7px;" value="<?php printf( __('%s','restaurant-pickup-delivery-dine-in'),get_option('byconsolewooodtrestro_orders_dinein')); ?>" />



<label> <?php echo __('This is the text is shown on Order details page of customer side.','restaurant-pickup-delivery-dine-in');?></label><br />



<span style="color:#a0a5aa">(<?php echo __('Eg: Please be appear on','restaurant-pickup-delivery-dine-in');?>  [bycrestro_dine_in_date] <?php echo __('at','restaurant-pickup-delivery-dine-in');?>  [bycrestro_dine_in_time] <?php echo __('to have a wonderful dining experience','restaurant-pickup-delivery-dine-in');?>)</span>

<?php

	}



	function byconsolewooodtrestro_widget_field_position()

	{                                        

?>

<select id="byconsolewooodtrestro_widget_field_position" name="byconsolewooodtrestro_widget_field_position" style="width:35%;" >


<option   value="" ><?php echo __('Do not show on order complete page','restaurant-pickup-delivery-dine-in');?> </option>

<option   value="top" <?php if( get_option('byconsolewooodtrestro_widget_field_position')=='top'){?> selected="selected"<?php }?> ><?php echo __('Show on top','restaurant-pickup-delivery-dine-in');?></option>

<option   value="bottom"<?php if( get_option('byconsolewooodtrestro_widget_field_position')=='bottom'){?> selected="selected"<?php }?> ><?php echo __('Show at bottom','restaurant-pickup-delivery-dine-in');?></option>



</select>



<label><?php echo __('Choose if date time text have to be shown on top (before order product list) or bottom (after product list).','restaurant-pickup-delivery-dine-in');?> </label>

<?php } 



add_action('admin_init', 'byconsolewooodtrestro_plugin_settings_fields');



function byconsolewooodtrestro_plugin_settings_fields()

	{



	add_settings_section("section", "All Settings", null, "byconsolewooodtrestro_plugin_options");

	

	add_settings_field("byconsolewooodtrestro_order_type", __('Allow order for:','byconsolewooodtrestro'), "byconsolewooodtrestro_order_type", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_preorder_days", __('Preorder Days:','byconsolewooodtrestro'), "byconsolewooodtrestro_preorder_days", "byconsolewooodtrestro_plugin_options", "section");

	

	add_settings_field("byconsolewooodtrestro_time_field_validation", __('Time field is required:','byconsolewooodtrestro'), "byconsolewooodtrestro_time_field_validation", "byconsolewooodtrestro_plugin_options", "section");

	

	add_settings_field("byconsolewooodtrestro_pickup_hours", __('Pickup Hours:','byconsolewooodtrestro'), "byconsolewooodtrestro_pickup_hours", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_delivery_hours", __('Delivery Hours:','byconsolewooodtrestro'), "byconsolewooodtrestro_delivery_hours", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_dinein_hours", __('Dine in Hours:','byconsolewooodtrestro'), "byconsolewooodtrestro_dinein_hours", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodt_minimum_delivery_times", __('Minimum delivery Times:','byconsolewooodtrestro'), "byconsolewooodt_delivery_times", "byconsolewooodt_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_takeaway_lable", __('Pickup label text:','byconsolewooodtrestro'), "byconsolewooodtrestro_takeaway_lable", "byconsolewooodtrestro_plugin_options", "section");	



	add_settings_field("byconsolewooodtrestro_delivery_lable", __('Delivery label text:','byconsolewooodtrestro'), "byconsolewooodtrestro_delivery_lable", "byconsolewooodtrestro_plugin_options", "section");

	

	add_settings_field("byconsolewooodtrestro_dinein_lable", __('Dine in label text:','byconsolewooodtrestro'), "byconsolewooodtrestro_dinein_lable", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_date_field_text", __('Date field text:','byconsolewooodtrestro'), "byconsolewooodtrestro_date_field_text", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_time_field_text", __('Time field text:','byconsolewooodtrestro'), "byconsolewooodtrestro_time_field_text", "byconsolewooodtrestro_plugin_options", "section");	



	add_settings_field("byconsolewooodtrestro_orders_delivered", __('The order will be delivered:','byconsolewooodtrestro'), "byconsolewooodtrestro_orders_delivered", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_orders_pick_up", __('The order can be Pickup:','byconsolewooodtrestro'), "byconsolewooodtrestro_orders_pick_up", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_orders_dinein", __('Dine in schedule:','byconsolewooodtrestro'), "byconsolewooodtrestro_orders_dinein", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_widget_field_position", __('Position of the text in the orders page:','byconsolewooodtrestro'), "byconsolewooodtrestro_widget_field_position", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_chekout_page_section_heading", __('Checkout page section heading','byconsolewooodtrestro'), "byconsolewooodtrestro_chekout_page_section_heading", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_chekout_page_order_type_label", __('Order type label on checkout page:','byconsolewooodtrestro'), "byconsolewooodtrestro_chekout_page_order_type_label", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_chekout_page_date_label", __('Calendar label on checkout page:','byconsolewooodtrestro'), "byconsolewooodtrestro_chekout_page_date_label", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_chekout_page_time_label", __('Time field label on checkout page:','byconsolewooodtrestro'), "byconsolewooodtrestro_chekout_page_time_label", "byconsolewooodtrestro_plugin_options", "section");



	add_settings_field("byconsolewooodtrestro_hours_format", __('Time format:','byconsolewooodtrestro'), "byconsolewooodtrestro_hours_format", "byconsolewooodtrestro_plugin_options", "section");

	

	

	register_setting("section", "byconsolewooodtrestro_order_type");



	register_setting("section", "byconsolewooodtrestro_preorder_days");

		

	register_setting("section", "byconsolewooodtrestro_time_field_validation");



	register_setting("section", "byconsolewooodtrestro_pickup_hours_from");



	register_setting("section", "byconsolewooodtrestro_pickup_hours_to");



	register_setting("section", "byconsolewooodtrestro_delivery_hours_from");



	register_setting("section", "byconsolewooodtrestro_delivery_hours_to");



	register_setting("section", "byconsolewooodtrestro_dinein_hours_from");



	register_setting("section", "byconsolewooodtrestro_dinein_hours_to");



	register_setting("section", "byconsolewooodtrestro_delivery_times");



	register_setting("section", "byconsolewooodtrestro_takeaway_lable");



	register_setting("section", "byconsolewooodtrestro_delivery_lable");

	

	register_setting("section", "byconsolewooodtrestro_dinein_lable");



	register_setting("section", "byconsolewooodtrestro_date_field_text");



	register_setting("section", "byconsolewooodtrestro_time_field_text");	



	register_setting("section", "byconsolewooodtrestro_orders_delivered");



	register_setting("section", "byconsolewooodtrestro_orders_pick_up");

	

	register_setting("section", "byconsolewooodtrestro_orders_dinein");



	register_setting("section", "byconsolewooodtrestro_widget_field_position");



	register_setting("section", "byconsolewooodtrestro_chekout_page_section_heading");



	register_setting("section", "byconsolewooodtrestro_chekout_page_order_type_label");



	register_setting("section", "byconsolewooodtrestro_chekout_page_date_label");



	register_setting("section", "byconsolewooodtrestro_chekout_page_time_label");



	register_setting("section", "byconsolewooodtrestro_hours_format");



	}

?>