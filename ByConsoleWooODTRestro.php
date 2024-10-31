<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly /** 

/*

* Plugin Name: Pickup | Delivery | Dine in

* Plugin URI: https://plugins.byconsole.com/product/pickup-delivery-dine-in-pro/

* Description: Let your buyers to choose if they are ordering for delivery or pickup or dine in on chosen date and time (Need to have Woocommerce installed first). 

* Version: 1.0.9

* Author: ByConsole 

* Author URI: https://www.plugins.byconsole.com/ 

* Text Domain: restaurant-pickup-delivery-dine-in

* Domain Path: /languages

* License: GPL2 

*/ 

/**

* Remove payment methods in woocommerce

*/

//add_filter( 'woocommerce_available_payment_gateways' , 'byconsolewooodtrestro_change_payment_gateway', 20, 1);

/*function byconsolewooodtrestro_change_payment_gateway( $gateways ){	

    $stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);

	$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);

    if( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein' ){

         // then unset the 'cod' key (cod is the unique id of COD Gateway)

         unset( $gateways['cod'] );

    }

    return $gateways;

}*/

add_action( 'wp_ajax_get_byconsolewooodtrestro_timeslot_by_selected_date', 'get_byconsolewooodtrestro_timeslot_by_selected_date' );

add_action( 'wp_ajax_nopriv_get_byconsolewooodtrestro_timeslot_by_selected_date', 'get_byconsolewooodtrestro_timeslot_by_selected_date' );

function get_byconsolewooodtrestro_timeslot_by_selected_date() {

	$selected_date = $_POST['selected_alternate_date_value'];

	$selected_order_type = $_POST['selected_order_type'];

	if($selected_order_type == 'take_away'){

		$timeslotArray = get_option('byconsolewooodtrestro_pickup_timeslot');

	}

	if($selected_order_type == 'levering'){

		$timeslotArray = get_option('byconsolewooodtrestro_delivery_timeslot');

	}

	if($selected_order_type == 'dinein'){

		$timeslotArray = get_option('byconsolewooodtrestro_dinein_timeslot');

	}

	

	$selectedDaynum = date("N", strtotime($selected_date));

	

	echo '<option value="">Select Time</option>';

	

	if(!empty($timeslotArray)){

		

		$wp_current_time_stamp = strtotime(current_time('H:i'));

		

		foreach($timeslotArray as $singleTimeSlotKey => $singleTimeSlotVal){

			

			$startTime = $singleTimeSlotVal['start_timeslot'];	

			

			$startTime_delayed_timestamp=strtotime($startTime." - 30 minutes");

			

			$endTime = $singleTimeSlotVal['end_timeslot'];



			$timeSlotVal = $startTime.' - '.$endTime;

			

			if(strtotime(current_time('m/d/y')) == strtotime($selected_date)){

				if($startTime_delayed_timestamp > $wp_current_time_stamp){	

				echo '<option value="'.$timeSlotVal.'">'.$timeSlotVal.'</option>';

					}

				}else{

					echo '<option value="'.$timeSlotVal.'">'.$timeSlotVal.'</option>';

					}

		}

	}

	//print_r($timeslotArray);

	wp_die(); // this is required to terminate immediately and return a proper response

}

// load plugin's text domaim
function byconsolewooodtrestro_free_plugin_activation() {

	global $wpdb;

	if(!get_option('byconsolewooodtrestro_free_plugin_activation_date')){		

		$currentActivatedDate = date("m/d/Y");

		update_option('byconsolewooodtrestro_free_plugin_activation_date',$currentActivatedDate);

	}

	if(!get_option('byconsolewooodtrestro_order_type') || get_option('byconsolewooodtrestro_order_type') == ''){

		$default_byconsolewooodtrestro_order_type = array(

			"take_away" => "yes",

			"dinein" => "yes",

			"levering" => "yes"

			);		

		update_option('byconsolewooodtrestro_order_type',$default_byconsolewooodtrestro_order_type);

	}

	if(!get_option('byconsolewooodtrestro_takeaway_lable') || get_option('byconsolewooodtrestro_takeaway_lable') == ''){		

		$default_byconsolewooodtrestro_takeaway_lable = 'Take away';

		update_option('byconsolewooodtrestro_takeaway_lable',$default_byconsolewooodtrestro_takeaway_lable);



	}

	if(!get_option('byconsolewooodtrestro_delivery_lable') || get_option('byconsolewooodtrestro_delivery_lable') == ''){		



		$default_byconsolewooodtrestro_delivery_lable = 'Delivery';



		update_option('byconsolewooodtrestro_delivery_lable',$default_byconsolewooodtrestro_delivery_lable);



	}

	if(!get_option('byconsolewooodtrestro_dinein_lable') || get_option('byconsolewooodtrestro_dinein_lable') == ''){		



		$default_byconsolewooodtrestro_dinein_lable = 'Dine in';



		update_option('byconsolewooodtrestro_dinein_lable',$default_byconsolewooodtrestro_dinein_lable);



	}

	if(!get_option('byconsolewooodtrestro_guest_no') || get_option('byconsolewooodtrestro_guest_no') == ''){		



		$default_byconsolewooodtrestro_guest_no = 'yes';



		update_option('byconsolewooodtrestro_guest_no',$default_byconsolewooodtrestro_guest_no);



	}

	if(!get_option('byconsolewooodtrestro_guest_purpose') || get_option('byconsolewooodtrestro_guest_purpose') == ''){		



		$default_byconsolewooodtrestro_guest_purpose = 'yes';



		update_option('byconsolewooodtrestro_guest_purpose',$default_byconsolewooodtrestro_guest_purpose);



	}

	if(!get_option('byconsolewooodtrestro_widget_field_position') || get_option('byconsolewooodtrestro_widget_field_position') == ''){		



		$default_byconsolewooodtrestro_widget_field_position = 'bottom';



		update_option('byconsolewooodtrestro_widget_field_position',$default_byconsolewooodtrestro_widget_field_position);



	}

	

	



}



register_activation_hook( __FILE__, 'byconsolewooodtrestro_free_plugin_activation' );

function byconsolewooodtrestro_free_plugin_activation_admin_notice_error() {

	$free_plugins_activated_date = get_option('byconsolewooodtrestro_free_plugin_activation_date');

	$free_plugins_activated_after_date = date('m/d/Y', strtotime($free_plugins_activated_date. ' + 16 days'));

	$currentDate = date("m/d/Y");

	if($free_plugins_activated_after_date <= $currentDate){	

		$message = 'It has been more than 15 days you are using <b>Restaurant Pickup | Delivery | Dine in</b> plugin. Will you mind put a 5 star review to grow up the plugin with more & more features! Please <a href="https://wordpress.org/support/plugin/restaurant-pickup-delivery-dine-in/reviews/?rate=5#new-post" target="_new">click here</a>';

    echo '<div class="notice notice-warning is-dismissible" style="padding: 10px;">'.$message.'</div>';	

	}

}

add_action( 'admin_notices', 'byconsolewooodtrestro_free_plugin_activation_admin_notice_error' );

function byconsolewooodtrestro_load_text_domain(){

$byc_lang_path=dirname( plugin_basename(__FILE__) ) . '/languages/';

if(load_plugin_textdomain( 'byconsolewooodtrestro', false, $byc_lang_path ));

}

add_action('plugins_loaded','byconsolewooodtrestro_load_text_domain');

include('inc/admin.php');

global $woocommerce;

// we need cookie so lets have a safe and confirm way

add_action('init', 'byconsolewooodtrestroSetCookie', 1);

function byconsolewooodtrestroSetCookie() {

// set default values if empty to avoid undefined index issue using cookies

if(empty($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie'])){

$byconsolewooodtrestro_delivery_widget=array(

'byconsolewooodtrestro_widget_date_field'=>'',

'byconsolewooodtrestro_widget_time_field'=>'',

'byconsolewooodtrestro_widget_type_field'=>'levering',

'byconsolewooodtrestro_widget_guest_count_field'=>'',

'byconsolewooodtrestro_widget_guest_purpose_field'=>''

); 

$json_byconsolewooodtrestro_delivery_widget=json_encode($byconsolewooodtrestro_delivery_widget);

setcookie('byconsolewooodtrestro_delivery_widget_cookie',$json_byconsolewooodtrestro_delivery_widget,time() + 60 * 60 * 24 *1,'/');

if(empty($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']))
{

	$_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']=json_encode($byconsolewooodtrestro_delivery_widget);

}

}

} 

// front-end widget 

class byconsolewooodtrestro_widget extends WP_Widget {

function __construct() {

parent::__construct(

// Base ID of our widget
'byconsolewooodtrestro_widget', 

// Widget name will appear in UI
__('Delivery|pickup|dinr in widget', 'ByConsoleWooODTrestro'), 

// Widget description
array( 'description' => __( 'Widget for users to choose date & time of delivery|pickup|dine in', 'restaurant-pickup-delivery-dine-in' ), ) 

);

}

// Creating widget front-end
// This is where the action happens

public function widget( $args, $instance ) {

echo $args['before_widget'];

if ( ! empty( $instance['byconsolewooodtrestro_widget_title'] ) ) {

echo $args['before_title'] . apply_filters( 'widget_title', esc_html($instance['byconsolewooodtrestro_widget_title']) ) . $args['after_title'];

}

echo $args['after_widget'];

$stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);

$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);

$byconsolewooodtrestro_delivery_date = !empty( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_date_field'] ) ? $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_date_field'] : false;

$byconsolewooodtrestro_delivery_time = !empty( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_time_field'] ) ? $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_time_field'] : false;

$byconsolewooodtrestro_order_type = !empty( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field'] ) ? $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field'] : false;

$byconsolewooodtrestro_guest_count = !empty( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field'] ) ? $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field'] : '';

$byconsolewooodtrestro_guest_purpose = !empty( $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field'] ) ? $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field'] : '';

//for translations
$byconsolewooodtrestro_takeaway_lable=get_option('byconsolewooodtrestro_takeaway_lable');

$byconsolewooodtrestro_delivery_lable=get_option('byconsolewooodtrestro_delivery_lable');

$byconsolewooodtrestro_date_field_text=get_option('byconsolewooodtrestro_date_field_text');

$byconsolewooodtrestro_time_field_text=get_option('byconsolewooodtrestro_time_field_text');

$byconsolewooodtrestro_guest_count_lable=get_option('byconsolewooodtrestro_guest_count_lable');

$byconsolewooodtrestro_guest_purpose_lable=get_option('byconsolewooodtrestro_guest_purpose_lable');

// get cookie as array
$stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);

$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);

if(!empty($byconsolewooodtrestro_takeaway_lable)) 

{ }

else 

{ 

$byconsolewooodtrestro_takeaway_lable = __('Take away','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_delivery_lable)) 

{ }

else 

{ 

$byconsolewooodtrestro_delivery_lable = __('Delivery','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_dinein_lable)) 

{ }

else 

{ 

$byconsolewooodtrestro_dinein_lable = __('Dine in','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_date_field_text)) 

{ } 

else 

{ 

$byconsolewooodtrestro_date_field_text = __('Choose your date','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_time_field_text)) 

{ } 

else 

{ 

$byconsolewooodtrestro_time_field_text = __('Choose your time','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_guest_count_field_text)) 

{ } 

else 

{ 

//$byconsolewooodtrestro_guest_count_field_text = __('How many guests are coming','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_guest_purpose_field_text)) 

{ } 

else 

{ 

$byconsolewooodtrestro_guest_purpose_field_text = __('What accommodation we need to provide you','restaurant-pickup-delivery-dine-in');

}

?>

<form action="" method="post" class="byconsolewooodtrestro_order_type_for_widget">

<div class="byconsolewooodtrestro_order_type_for_widget">

<?php 

$byconsolewooodtrestro_allowed_order_types=get_option('byconsolewooodtrestro_order_type');

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('take_away',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['take_away']=='yes'){

?>

<input type="radio" name="byconsolewooodtrestro_widget_type_field" value="take_away" <?php if($byconsolewooodtrestro_order_type=='take_away'){echo ' checked="checked"';}?>/>

<label for="byconsolewooodtrestro_order_type_take_away" class="radio "><?php echo esc_html($byconsolewooodtrestro_takeaway_lable);?></label>

<?php }

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('levering',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['levering']=='yes'){

?>

<input type="radio" name="byconsolewooodtrestro_widget_type_field" value="levering"<?php if($byconsolewooodtrestro_order_type=='levering'){echo ' checked="checked"';}?> />

<label for="byconsolewooodtrestro_order_type_levering" class="radio "><?php echo esc_html($byconsolewooodtrestro_delivery_lable);?></label>

<?php }

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('dinein',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['dinein']=='yes'){

?>

<input type="radio" name="byconsolewooodtrestro_widget_type_field" value="dinein"<?php if($byconsolewooodtrestro_order_type=='dinein'){echo ' checked="checked"';}?> />

<label for="byconsolewooodtrestro_order_type_dinein" class="radio "><?php echo esc_html($byconsolewooodtrestro_dinein_lable);?></label>

<?php }?>

</div>

<br />

<input type="text" name="byconsolewooodtrestro_widget_date_field" class="byconsolewooodtrestro_widget_date_field"  placeholder="<?php echo esc_html($byconsolewooodtrestro_date_field_text);?>" readonly="readonly" value="<?php echo esc_attr($byconsolewooodtrestro_delivery_date);?>" />

<input type="text" name="byconsolewooodtrestro_delivery_date_alternate" class="byconsolewooodtrestro_widget_date_field_alternate" id="byconsolewooodtrestro_delivery_date_alternate_widget" readonly="readonly" value="<?php echo esc_html(!empty($byconsolewooodtrestro_delivery_date_alternate)?$byconsolewooodtrestro_delivery_date_alternate:'');?>" style="display:none;" />

<input type="text" name="byconsolewooodtrestro_widget_time_field" class="byconsolewooodtrestro_widget_time_field" placeholder="<?php echo esc_html($byconsolewooodtrestro_time_field_text);?>" value="<?php echo esc_html($byconsolewooodtrestro_delivery_time);?>" />

<br />

<p class="byc_service_time_closed"></p>

<p class="byconsolewooodtrestro_widget_guest_count_field"><?php echo $byconsolewooodtrestro_guest_count_field_text;?>(optional)</p>

<select name="byconsolewooodtrestro_widget_guest_count_field" class="byconsolewooodtrestro_widget_guest_count_field">

<option value="">Number of guest</option>

<option value="single"<?php if($byconsolewooodtrestro_guest_count=='single'){echo' selected="selected"';} ?>>Single <?php //esc_html($byconsolewooodtrestro_guest_count_single_lable);?></option>

<option value="couple"<?php if($byconsolewooodtrestro_guest_count=='couple'){echo' selected="selected"';} ?>>Couple<?php //esc_html($byconsolewooodtrestro_guest_count_couple_lable);?></option>

<option value="three"<?php if($byconsolewooodtrestro_guest_count=='three'){echo' selected="selected"';} ?>>3<?php //esc_html($byconsolewooodtrestro_guest_count_three_lable);?></option>

<option value="four"<?php if($byconsolewooodtrestro_guest_count=='four'){echo' selected="selected"';} ?>>4<?php //esc_html($byconsolewooodtrestro_guest_count_four_lable);?></option>

<option value="five"<?php if($byconsolewooodtrestro_guest_count=='five'){echo' selected="selected"';} ?>>5<?php //esc_html($byconsolewooodtrestro_guest_count_five_lable);?></option>

<option value="six"<?php if($byconsolewooodtrestro_guest_count=='six'){echo' selected="selected"';} ?>>6<?php //esc_html($byconsolewooodtrestro_guest_count_six_lable);?></option>

<option value="seven"<?php if($byconsolewooodtrestro_guest_count=='seven'){echo' selected="selected"';} ?>>7<?php //esc_html($byconsolewooodtrestro_guest_count_seven_lable);?></option>

<option value="party_mode"<?php if($byconsolewooodtrestro_guest_count=='party_mode'){echo' selected="selected"';} ?>>7+<?php //esc_html($byconsolewooodtrestro_guest_count_part_mode_lable);?></option>

</select>

<p class="byconsolewooodtrestro_widget_guest_purpose_field"><?php echo $byconsolewooodtrestro_guest_purpose_field_text;?> (optional)</p>

<select name="byconsolewooodtrestro_widget_guest_purpose_field" class="byconsolewooodtrestro_widget_guest_purpose_field">

<option value="">Any accommodation</option>

<option value="casual_lunch_or_dinner" <?php if($byconsolewooodtrestro_guest_purpose=='casual_lunch_or_dinner'){echo 'selected="selected"';} ?>>Casual Lunch/dinner<?php //esc_html($byconsolewooodtrestro_guest_purpose_casual_lable);?></option>

<option value="romantic_dinner" <?php if($byconsolewooodtrestro_guest_purpose=='romantic_dinner'){echo 'selected="selected"';} ?>>Romantic dinner<?php //esc_html($byconsolewooodtrestro_guest_purpose_romantic_dinner_lable);?></option>

<option value="family_lunch_or_dinner" <?php if($byconsolewooodtrestro_guest_purpose=='family_lunch_or_dinner'){echo 'selected="selected"';} ?>>Lunch/dinner with family<?php //esc_html($byconsolewooodtrestro_guest_purpose_family_lunch_dinner_lable);?></option>

<option value="client_meet_over_lunch" <?php if($byconsolewooodtrestro_guest_purpose=='client_meet_over_lunch'){echo 'selected="selected"';} ?>>Client meet over lunch<?php //esc_html($byconsolewooodtrestro_guest_purpose_client_meeting_lable);?></option>

<option value="party_celebration" <?php if($byconsolewooodtrestro_guest_purpose=='party_celebration'){echo 'selected="selected"';} ?>>Party celebration<?php //esc_html($byconsolewooodtrestro_guest_purpose_party_lable);?></option>

</select>

<?php 

if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){?>

<p class="min-shipping-time"><img src="<?php echo plugins_url('images/min-shipping-time.png', __FILE__)?>" alt="Minimum delivery time" /> &nbsp; <?php echo esc_html(get_option('byconsolewooodtrestro_delivery_times'));?></p>

<?php }?>

<input type="submit" name="byconsolewooodtrestro_widget_submit" value="Save" />

</form>

<?php

echo $args['after_widget'];

//pre-order settings

?>

<script>

jQuery(document).ready(function(){

delivery_opening_time="<?php echo esc_html(get_option('byconsolewooodtrestro_delivery_hours_from')); ?>";

pickup_opening_time="<?php echo esc_html(get_option('byconsolewooodtrestro_pickup_hours_from')); ?>";

dinein_opening_time="<?php echo esc_html(get_option('byconsolewooodtrestro_dinein_hours_from')); ?>";

delivery_ending_time="<?php echo esc_html(get_option('byconsolewooodtrestro_delivery_hours_to')); ?>";

pickup_ending_time="<?php echo esc_html(get_option('byconsolewooodtrestro_pickup_hours_to')); ?>";

dinein_ending_time="<?php echo esc_html(get_option('byconsolewooodtrestro_dinein_hours_to')); ?>";

<?php

if(get_option('byconsolewooodtrestro_preorder_days')==''){// if no pre-order date is not set in settings page

?>

jQuery(".byconsolewooodtrestro_widget_date_field").datepicker({

minDate: 0,

showAnim: "slideDown", 

beforeShowDay: function(date){ return checkHolidaysBycRestro( date ); },

altField: ".byconsolewooodtrestro_widget_date_field_alternate",

altFormat: "dd/m/yy",

onSelect: function(){jQuery(".byconsolewooodtrestro_widget_time_field").timepicker("remove"); jQuery(".byconsolewooodtrestro_widget_time_field").val(''); byconsolewooodtrestroDeliveryWidgetTimePopulate(".byconsolewooodtrestro_widget_date_field",".byconsolewooodtrestro_widget_time_field");} // reset timepicker on date selection to get new time value depending date selected here AND THEN call call time population function

});

<?php

}else{//if no pre-order date is set in settings page do the date selection restriction

?>

jQuery( ".byconsolewooodtrestro_widget_date_field" ).datepicker({ 

minDate: 0, 

maxDate: "<?php echo esc_html(get_option('byconsolewooodtrestro_preorder_days'));?>+D", 

showOtherMonths: true,

selectOtherMonths: true,

showAnim: "slideDown",

beforeShowDay: function(date){ return checkHolidaysBycRestro( date ); },

altField: ".byconsolewooodtrestro_widget_date_field_alternate",

altFormat: "dd/m/yy",

onSelect: function(){jQuery(".byconsolewooodtrestro_widget_time_field").timepicker("remove"); jQuery(".byconsolewooodtrestro_widget_time_field").val(''); byconsolewooodtrestroDeliveryWidgetTimePopulate(".byconsolewooodtrestro_widget_date_field",".byconsolewooodtrestro_widget_time_field");} // reset timepicker on date selection to get new time value depending date selected here AND THEN call call time population function

});

<?php }	

//synchornize all the order type radio button in widget and in checkout field in a simple way

if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){

?>

jQuery("#_byconsolewooodtrestro_order_type_levering").prop("checked", true);

<?php	}

if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away'){

?>

jQuery("#_byconsolewooodtrestro_order_type_take_away").prop("checked", true);

<?php	}

if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein'){

?>

jQuery("#_byconsolewooodtrestro_order_type_dinein").prop("checked", true);

<?php } ?>

jQuery("input#_byconsolewooodtrestro_delivery_date").val("<?php echo esc_html($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_date_field']);?>");

jQuery("input#_byconsolewooodtrestro_delivery_time").val("<?php echo esc_html(isset($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_time_field'])?$byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_time_field']:'');?>");

jQuery("input#_byconsolewooodtrestro_guest_count").val("<?php echo esc_html(isset($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field'])?$byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field']:'');?>");

jQuery("input#_byconsolewooodtrestro_guest_purpose").val("<?php echo esc_html(isset($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field'])?$byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field']:'');?>");

})

</script>

<?php

}

// Widget Backend 

public function form( $instance ) {

if ( isset( $instance[ 'byconsolewooodtrestro_widget_title' ] ) ) {

$title = $instance[ 'byconsolewooodtrestro_widget_title' ];

}

else 

{

$title = __( 'New title', 'restaurant-pickup-delivery-dine-in' );

}

// Widget admin form

?>

<p>

<label for="<?php echo esc_html($this->get_field_id( 'byconsolewooodtrestro_widget_title' )); ?>"><?php __( 'Title:','restaurant-pickup-delivery-dine-in' ); ?></label> 

<input class="widefat" id="<?php echo esc_html($this->get_field_id( 'byconsolewooodtrestro_widget_title' )); ?>" name="<?php echo $this->get_field_name( 'byconsolewooodtrestro_widget_title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

</p>

<?php 

}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

$instance = array();

$instance['byconsolewooodtrestro_widget_title'] = ( ! empty( $new_instance['byconsolewooodtrestro_widget_title'] ) ) ? strip_tags( $new_instance['byconsolewooodtrestro_widget_title'] ) : '';

return $instance;

}

/*****************************************************/
} // Class byconsolewooodtrestro_widget ends here
// Register and load the widget

function byconsolewooodtrestro_load_widget() {

register_widget( 'byconsolewooodtrestro_widget' );

}

add_action( 'widgets_init', 'byconsolewooodtrestro_load_widget' );//save frontend widget data in cookie, so we need to do it before any output, hence hook it on init

function byconsolewooodtrestro_savefrontend_widget_data(){

// save thwe widget data in in cookie	

if(isset($_POST['byconsolewooodtrestro_widget_submit'])){

$byconsolewooodtrestro_delivery_widget_post_array = array(

'byconsolewooodtrestro_widget_date_field'   => sanitize_text_field(isset($_POST['byconsolewooodtrestro_widget_date_field'])?$_POST['byconsolewooodtrestro_widget_date_field']:''),

'byconsolewooodtrestro_widget_time_field'   => sanitize_text_field(isset($_POST['byconsolewooodtrestro_widget_time_field'])?$_POST['byconsolewooodtrestro_widget_time_field']:''),

'byconsolewooodtrestro_widget_type_field'   => sanitize_text_field(isset($_POST['byconsolewooodtrestro_widget_type_field'])?$_POST['byconsolewooodtrestro_widget_type_field']:''),

'byconsolewooodtrestro_widget_guest_count_field'   => sanitize_text_field(isset($_POST['byconsolewooodtrestro_widget_guest_count_field'])?$_POST['byconsolewooodtrestro_widget_guest_count_field']:''),

'byconsolewooodtrestro_widget_guest_purpose_field'   => sanitize_text_field(isset($_POST['byconsolewooodtrestro_widget_guest_purpose_field'])?$_POST['byconsolewooodtrestro_widget_guest_purpose_field']:'')

);

//set cookie

$json_byconsolewooodtrestro_delivery_widget_post_array=json_encode($byconsolewooodtrestro_delivery_widget_post_array);

setcookie('byconsolewooodtrestro_delivery_widget_cookie',$json_byconsolewooodtrestro_delivery_widget_post_array , time() + 60 * 60 * 24 * 1, '/');

$_COOKIE['byconsolewooodtrestro_delivery_widget_cookie'] = $json_byconsolewooodtrestro_delivery_widget_post_array;// for immediate access in widget

}

}// end of byconsolewooodtrestro_savefrontend_widget_data

add_action('init','byconsolewooodtrestro_savefrontend_widget_data');// Add the field to the checkout

//add_action( 'woocommerce_after_order_notes', 'byconsolewooodtrestro_checkout_field' );

add_action( 'woocommerce_checkout_before_customer_details', 'byconsolewooodtrestro_checkout_field' );

function byconsolewooodtrestro_checkout_field( $checkout ) {

global $woocommerce;// get cookie as array

$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

	if($byconsolewooodtrestro_enable_timeslot == 'yes'){

		echo '<div class="loading_image_contanier" style="display:none;"><img src="'.plugins_url().'/restaurant-pickup-delivery-dine-in/images/loading_image.gif" alt="" /></div>';

	}

$byconsolewooodtrestro_time_field_validation = get_option('byconsolewooodtrestro_time_field_validation');

$byconsolewooodtrestro_has_virtual_products = false;

$byconsolewooodtrestro_virtual_products = 0;

// Get all products in cart

$byconsolewooodtrestro_products = $woocommerce->cart->get_cart();

  // Loop through cart products

  foreach( $byconsolewooodtrestro_products as $byconsolewooodtrestro_product ) {

	  // Get product ID and '_virtual' post meta
	  $byconsolewooodtrestro_product_id = $byconsolewooodtrestro_product['product_id'];

	  $byconsolewooodtrestro_is_virtual = get_post_meta( $byconsolewooodtrestro_product_id, '_virtual', true );

	  // Update $has_virtual_product if product is virtual

	  if( $byconsolewooodtrestro_is_virtual == 'yes' )

  		$byconsolewooodtrestro_virtual_products += 1;

  }

  if( count($byconsolewooodtrestro_products) == $byconsolewooodtrestro_virtual_products )

  {

	  $byconsolewooodtrestro_both_product_count_val = 'same';

  }
  else
  {

	  $byconsolewooodtrestro_both_product_count_val = 'not_same';

  }

  //echo $bycwooodt_both_product_count_val;
  //$has_virtual_products = true;
if($byconsolewooodtrestro_both_product_count_val == 'not_same')
{

$byconsolewooodtrestro_takeaway_lable=get_option('byconsolewooodtrestro_takeaway_lable');

$byconsolewooodtrestro_delivery_lable=get_option('byconsolewooodtrestro_delivery_lable');

$byconsolewooodtrestro_dinein_lable=get_option('byconsolewooodtrestro_dinein_lable');

$byconsolewooodtrestro_date_field_text=get_option('byconsolewooodtrestro_date_field_text');

$byconsolewooodtrestro_time_field_text=get_option('byconsolewooodtrestro_time_field_text');

$byconsolewooodtrestro_guest_count_field_text=get_option('byconsolewooodtrestro_guest_count_field_text');

$byconsolewooodtrestro_guest_purpose_field_text=get_option('byconsolewooodtrestro_guest_purpose_field_text');

$byconsolewooodtrestro_allowed_order_types=get_option('byconsolewooodtrestro_order_type');

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('take_away',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['take_away']=='yes'){

	$byconsolewooodtrestro_allowed_order_types_array['take_away']=esc_html($byconsolewooodtrestro_takeaway_lable);

	}

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('levering',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['levering']=='yes'){

	$byconsolewooodtrestro_allowed_order_types_array['levering']=esc_html($byconsolewooodtrestro_delivery_lable);

	}

if(is_array($byconsolewooodtrestro_allowed_order_types) && array_key_exists('dinein',$byconsolewooodtrestro_allowed_order_types) && $byconsolewooodtrestro_allowed_order_types['dinein']=='yes'){

	$byconsolewooodtrestro_allowed_order_types_array['dinein']=esc_html($byconsolewooodtrestro_dinein_lable); 

	}

// get cookie as array

$stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);

$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);

if(!empty($byconsolewooodtrestro_takeaway_lable)) 
{ 

//$byconsolewooodtrestro_takeaway_lable =  get_option('byconsolewooodtrestro_takeaway_lable'); 

} 

else 

{ 

$byconsolewooodtrestro_takeaway_lable = __('Take away','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_delivery_lable)) 

{ 

//$byconsolewooodtrestro_delivery_lable =  get_option('byconsolewooodtrestro_delivery_lable'); 

} 

else 

{ 

$byconsolewooodtrestro_delivery_lable = __('Delivery','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_dinein_lable)) 

{ 

//$byconsolewooodtrestro_delivery_lable =  get_option('byconsolewooodtrestro_delivery_lable'); 

} 

else 

{ 

$byconsolewooodtrestro_dinein_lable = __('Dine in','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_date_field_text)) 

{ 

//$byconsolewooodtrestro_date_field_text =  get_option('byconsolewooodtrestro_date_field_text'); 

} 

else 

{ 

$byconsolewooodtrestro_date_field_text = __('Choose your date','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_time_field_text)) 

{ 

//$byconsolewooodtrestro_time_field_text =  get_option('byconsolewooodtrestro_time_field_text'); 

} 
else 
{ 

$byconsolewooodtrestro_time_field_text = __('Select time','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_guest_count_field_text)) 

{ 

//$byconsolewooodtrestro_time_field_text =  get_option('byconsolewooodtrestro_time_field_text'); 

} 

else 

{ 

$byconsolewooodtrestro_guest_count_field_text = __('Number of guest','restaurant-pickup-delivery-dine-in');

}

if(!empty($byconsolewooodtrestro_guest_purpose_field_text)) 

{ 

//$byconsolewooodtrestro_time_field_text =  get_option('byconsolewooodtrestro_time_field_text'); 

} 

else 

{ 

$byconsolewooodtrestro_guest_purpose_field_text = __('What accommodation you need','restaurant-pickup-delivery-dine-in');

}

$get_option_byconsolewooodtrestro_chekout_page_order_type_label=get_option('byconsolewooodtrestro_chekout_page_order_type_label');

if(!empty($get_option_byconsolewooodtrestro_chekout_page_order_type_label)){

}else{

$get_option_byconsolewooodtrestro_chekout_page_order_type_label = __('Select order type','restaurant-pickup-delivery-dine-in');	

}

$get_option_byconsolewooodtrestro_chekout_page_date_label=get_option('byconsolewooodtrestro_chekout_page_date_label');

if(!empty($get_option_byconsolewooodtrestro_chekout_page_date_label)){

//$get_option_byconsolewooodtrestro_chekout_page_date_lebel=get_option('byconsolewooodtrestro_chekout_page_date_label');	

}else{

$get_option_byconsolewooodtrestro_chekout_page_date_label = __('Choose a date','restaurant-pickup-delivery-dine-in');		

}

$get_option_byconsolewooodtrestro_chekout_page_time_label=get_option('byconsolewooodtrestro_chekout_page_time_label');

if(!empty($get_option_byconsolewooodtrestro_chekout_page_time_label)){

}else{

$get_option_byconsolewooodtrestro_chekout_page_time_label=__('Choose a time','restaurant-pickup-delivery-dine-in');	

}

echo '<div id="byconsolewooodtrestro_checkout_field"><h3>'.esc_html(get_option('byconsolewooodtrestro_chekout_page_section_heading')) . '</h3>';

woocommerce_form_field( '_byconsolewooodtrestro_order_type', array(

'type'          => 'radio',

'required'		=>	true,

'class'         => array('byconsolewooodtrestro_order_type', 'ABC'),

'label'         => $get_option_byconsolewooodtrestro_chekout_page_order_type_label,

'label_class'	=> 'byconsolewooodtrestro_ordertype_label',

'placeholder'   => __('Select order type','restaurant-pickup-delivery-dine-in'),

'default'		=> esc_html($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']),

'checked'		=> 'checked',

'options'		=> $byconsolewooodtrestro_allowed_order_types_array,

/*
'options'		=> array(

'take_away' => esc_html($byconsolewooodtrestro_takeaway_lable), 

'levering' => esc_html($byconsolewooodtrestro_delivery_lable), 

'dinein' => esc_html($byconsolewooodtrestro_dinein_lable), 
)
*/

));

//$get_option_byconsolewooodtrestro_chekout_page_date_lebel='CVBN';
woocommerce_form_field( '_byconsolewooodtrestro_delivery_date', array(

'type'          => 'text',

'required'		=>	true,

'class'         => array('byconsolewooodtrestro_delivery_date'),

'label'         => $get_option_byconsolewooodtrestro_chekout_page_date_label,

'placeholder'   => __(esc_html($byconsolewooodtrestro_date_field_text),'restaurant-pickup-delivery-dine-in'),

'default'		=> esc_html($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_date_field'])

));

woocommerce_form_field( '_byconsolewooodtrestro_delivery_date_alternate', array(

'type'          => 'text',

'class'         => array('byconsolewooodtrestro_delivery_date_alternate'),

'label'         => '',

'placeholder'   => '',

'default'		=> '',

));		

if($byconsolewooodtrestro_time_field_validation == 'yes'){
	$required = true;
}else{
	$required = false;
}

$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

if($byconsolewooodtrestro_enable_timeslot == 'yes'){

	$byconsolewooodtrestro_widget_time_val = array('0' => __('Select time','restaurant-pickup-delivery-dine-in'));

	woocommerce_form_field( '_byconsolewooodtrestro_delivery_time', array(

	'type'          => 'select',

	'class'         => array('byconsolewooodtrestro_delivery_time'),

	'label'         => $get_option_byconsolewooodtrestro_chekout_page_time_label,

	'placeholder'   => __(esc_html($byconsolewooodtrestro_time_field_text),'restaurant-pickup-delivery-dine-in'),

	'default'		=> '',	

	'options'		=> $byconsolewooodtrestro_widget_time_val,

	'required'		=>	$required,

	));

}else{

	woocommerce_form_field( '_byconsolewooodtrestro_delivery_time', array(

	'type'          => 'text',

	'required'		=>	$required,

	'class'         => array('byconsolewooodtrestro_delivery_time'),

	'label'         => $get_option_byconsolewooodtrestro_chekout_page_time_label,

	'placeholder'   => __(esc_html($byconsolewooodtrestro_time_field_text),'restaurant-pickup-delivery-dine-in'),

	'default'		=> esc_html($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_time_field'])

	));
 } 

echo '<p class="byc_service_time_closed"></p></div>';

/*****************************************************************/

$byconsolewooodtrestro_guest_no =  get_option('byconsolewooodtrestro_guest_no');

if($byconsolewooodtrestro_guest_no == "yes"){

	woocommerce_form_field( '_byconsolewooodtrestro_guest_count', array(

		'type'          => 'radio',

		'required'		=>	false,

		'class'         => array('byconsolewooodtrestro_guest_count', 'ABC'),

		'label'         => 'Tell us about number of guest(s)',//$get_option_byconsolewooodtrestro_chekout_page_order_type_label,

		'label_class'	=> 'byconsolewooodtrestro_guest_count_label',

		'placeholder'   => __('Tell us about number of guest(s)','restaurant-pickup-delivery-dine-in'),

		'default'		=> esc_html(isset($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field'])?$byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_count_field']:''),

		'checked'		=> 'checked',

		'options'		=> array(

		'single' => 1,//esc_html($byconsolewooodtrestro_guest_count_single_lable),

		'couple' => 2,//esc_html($byconsolewooodtrestro_guest_count_couple_lable),

		'three' => 3,//esc_html($byconsolewooodtrestro_guest_count_three_lable),

		'four' => 4,//esc_html($byconsolewooodtrestro_guest_count_four_lable),

		'five' => 5,//esc_html($byconsolewooodtrestro_guest_count_five_lable),

		'six' => 6,//esc_html($byconsolewooodtrestro_guest_count_six_lable),

		'seven' => 7,//esc_html($byconsolewooodtrestro_guest_count_seven_lable),

		'party_mode' => '7+'//esc_html($byconsolewooodtrestro_guest_count_part_mode_lable)

		)
	));

}

$byconsolewooodtrestro_guest_purpose =  get_option('byconsolewooodtrestro_guest_purpose');

if($byconsolewooodtrestro_guest_purpose == "yes"){

	woocommerce_form_field( '_byconsolewooodtrestro_guest_purpose', array(

		'type'          => 'radio',

		'required'		=>	false,

		'class'         => array('byconsolewooodtrestro_guest_purpose', 'ABC'),

		'label'         => 'Tell us what accommodation we need to provide you',//$get_option_byconsolewooodtrestro_chekout_page_order_type_label,

		'label_class'	=> 'byconsolewooodtrestro_guest_purpose_label',

		'placeholder'   => __('Tell us if you need any of these below accommodations','restaurant-pickup-delivery-dine-in'),

		'default'		=> esc_html(isset($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field'])?$byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_guest_purpose_field']:''),

		'checked'		=> 'checked',

		'options'		=> array(

		'casual_lunch_or_dinner' => 'Casual Lunch/dinner',//esc_html($byconsolewooodtrestro_guest_purpose_casual_lable),

		'romantic_dinner' => 'Romantic dinner',//esc_html($byconsolewooodtrestro_guest_purpose_romantic_dinner_lable),

		'family_lunch_or_dinner' => 'Lunch/dinner with family',//esc_html($byconsolewooodtrestro_guest_purpose_family_lunch_dinner_lable),

		'client_meet_over_lunch' => 'Client meet over lunch',//esc_html($byconsolewooodtrestro_guest_purpose_client_meeting_lable),

		'party_celebration' => 'Party celebration',//esc_html($byconsolewooodtrestro_guest_purpose_party_lable)

		)

	));

}

/*****************************************************************/
	}

}







// Validate the custom field.



add_action('woocommerce_checkout_process', 'byconsolewooodtrestro_checkout_field_process');







function byconsolewooodtrestro_checkout_field_process() {







// Check if set, if its not set add an error.



global $woocommerce;// get cookie as array







 $byconsolewooodtrestro_has_virtual_products = false;







  // Default virtual products number



  $byconsolewooodtrestro_virtual_products = 0;







  // Get all products in cart



  $byconsolewooodtrestro_products = $woocommerce->cart->get_cart();







  // Loop through cart products



  foreach( $byconsolewooodtrestro_products as $byconsolewooodtrestro_product ) {



	  // Get product ID and '_virtual' post meta



	  $byconsolewooodtrestro_product_id = $byconsolewooodtrestro_product['product_id'];



	  $byconsolewooodtrestro_is_virtual = get_post_meta( $byconsolewooodtrestro_product_id, '_virtual', true );



	  // Update $has_virtual_product if product is virtual







	  if( $byconsolewooodtrestro_is_virtual == 'yes' )



  		$byconsolewooodtrestro_virtual_products += 1;



  }







  if( count($byconsolewooodtrestro_products) == $byconsolewooodtrestro_virtual_products )



  {



	  $byconsolewooodtrestro_both_product_count_val = 'same';



  }



  else



  {



	  $byconsolewooodtrestro_both_product_count_val = 'not_same';



  }







if($byconsolewooodtrestro_both_product_count_val == 'not_same')



{







if ( ! $_POST['_byconsolewooodtrestro_delivery_date'] )



wc_add_notice( '<b>'.__( 'Pickup / Delivery / Dine in date is a required field.','restaurant-pickup-delivery-dine-in' ).'</b>', 'error' );



$byconsolewooodtrestro_time_field_validation = get_option('byconsolewooodtrestro_time_field_validation');







if($byconsolewooodtrestro_time_field_validation == 'yes'){



if ( ! $_POST['_byconsolewooodtrestro_delivery_time'] )



wc_add_notice( '<b>'.__( 'Time is a required field.','restaurant-pickup-delivery-dine-in' ).'</b>', 'error' );



}







 }







}







//Save the order meta with field value



add_action( 'woocommerce_checkout_update_order_meta', 'byconsolewooodtrestro_checkout_field_update_order_meta' );







function byconsolewooodtrestro_checkout_field_update_order_meta( $order_id ) {







global $woocommerce;// get cookie as array







 $byconsolewooodtrestro_has_virtual_products = false;







  // Default virtual products number



  $byconsolewooodtrestro_virtual_products = 0;







  // Get all products in cart



  $byconsolewooodtrestro_products = $woocommerce->cart->get_cart();







  // Loop through cart products



  foreach( $byconsolewooodtrestro_products as $byconsolewooodtrestro_product ) {







	  // Get product ID and '_virtual' post meta



	  $byconsolewooodtrestro_product_id = $byconsolewooodtrestro_product['product_id'];







	  $byconsolewooodtrestro_is_virtual = get_post_meta( $byconsolewooodtrestro_product_id, '_virtual', true );







	  // Update $has_virtual_product if product is virtual



	  if( $byconsolewooodtrestro_is_virtual == 'yes' )



  		$byconsolewooodtrestro_virtual_products += 1;



  }







  if( count($byconsolewooodtrestro_products) == $byconsolewooodtrestro_virtual_products )



  {



	  $byconsolewooodtrestro_both_product_count_val = 'same';



  }



  else



  {



	  $byconsolewooodtrestro_both_product_count_val = 'not_same';



  }











if($byconsolewooodtrestro_both_product_count_val == 'not_same')



{



	



if ( ! empty( $_POST['_byconsolewooodtrestro_delivery_date'] ) ) {







update_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', sanitize_text_field( $_POST['_byconsolewooodtrestro_delivery_date'] ) );



}







if ( ! empty( $_POST['_byconsolewooodtrestro_delivery_time'] ) ) {



update_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', sanitize_text_field( $_POST['_byconsolewooodtrestro_delivery_time'] ) );



}







if ( ! empty( $_POST['_byconsolewooodtrestro_order_type'] ) ) {



update_post_meta( $order_id, '_byconsolewooodtrestro_order_type', sanitize_text_field($_POST['_byconsolewooodtrestro_order_type'] ));







if($_POST['_byconsolewooodtrestro_order_type']=='dinein'){



	if ( ! empty( $_POST['_byconsolewooodtrestro_guest_count'] ) ) {



		update_post_meta( $order_id, '_byconsolewooodtrestro_guest_count', sanitize_text_field($_POST['_byconsolewooodtrestro_guest_count'] ));



	}



	if ( ! empty( $_POST['_byconsolewooodtrestro_guest_purpose'] ) ) {



		update_post_meta( $order_id, '_byconsolewooodtrestro_guest_purpose', sanitize_text_field($_POST['_byconsolewooodtrestro_guest_purpose'] ));



	}







	



	}



}







}







}







//Display field value on the order edit page



add_action( 'woocommerce_admin_order_data_after_shipping_address', 'byconsolewooodtrestro_checkout_field_display_admin_order_meta', 10, 1 );







function byconsolewooodtrestro_checkout_field_display_admin_order_meta($order){







$order_id = version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->id : $order->get_id();







$byconsolewooodtrestro_takeaway_lable=get_option('byconsolewooodtrestro_takeaway_lable');







$byconsolewooodtrestro_delivery_lable=get_option('byconsolewooodtrestro_delivery_lable');







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='take_away'){



if(!empty($byconsolewooodtrestro_takeaway_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_takeaway_lable; 



} 



else 



{ 



$order_order_type = __('Take away','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='levering'){



if(!empty($byconsolewooodtrestro_delivery_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_delivery_lable; 



} 



else 



{ 



$order_order_type = __('Delivery','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='dinein'){



if(!empty($byconsolewooodtrestro_dinein_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_dinein_lable; 



} 



else 



{ 



$order_order_type = __('Dine in','restaurant-pickup-delivery-dine-in');



}



$order_dinein_guest_count=ucfirst(get_post_meta( $order_id, '_byconsolewooodtrestro_guest_count', true ));



$order_dinein_guest_purpose=ucfirst(get_post_meta( $order_id, '_byconsolewooodtrestro_guest_purpose', true ));



}







//type



if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )) )



{



echo '<p><strong>'.__('Order type','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html($order_order_type) . '</p>';



}







//date



if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) )



{



echo '<p><strong>'.__('Delivery|Pickup|dine in date','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) . '</p>';



}







//time



if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) )



{



echo '<p><strong>'.__('Delivery|Pickup|dine in time','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) . '</p>';



}







//dine in



if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true ) == 'dinein' )



{



echo '<p><strong>'.__('Number of guest','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html($order_dinein_guest_count). '</p>';



echo '<p><strong>'.__('Accomodation requested ','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html(str_replace('_',' ',$order_dinein_guest_purpose)) . '</p>';



}







}







// Display order meta in order details section



if(get_option('byconsolewooodtrestro_widget_field_position')=='top'){ //hook here if it is set to show on top in admin settings page







//add_action( 'woocommerce_view_order', 'byconsolewooodtrestro_checkout_field_display_user_order_meta', 10, 1 );



add_action( 'woocommerce_order_details_after_order_table_items', 'byconsolewooodtrestro_checkout_field_display_user_order_meta', 10, 1 );



}







if(get_option('byconsolewooodtrestro_widget_field_position')=='bottom'){  //hook here if it is set to show on bottom in admin settings page







add_action( 'woocommerce_order_details_after_order_table', 'byconsolewooodtrestro_checkout_field_display_user_order_meta', 10, 1 );







}







function byconsolewooodtrestro_checkout_field_display_user_order_meta($order){







$order_id = version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->id : $order->get_id();







$byconsolewooodtrestro_takeaway_lable=get_option('byconsolewooodtrestro_takeaway_lable');







$byconsolewooodtrestro_delivery_lable=get_option('byconsolewooodtrestro_delivery_lable');







$byconsolewooodtrestro_dinein_lable=get_option('byconsolewooodtrestro_dinein_lable');







$byconsolewooodtrestro_dinein_guest_number_lable=get_option('byconsolewooodtrestro_dinein_guest_number_lable');







$byconsolewooodtrestro_dinein_guest_accommodation_lable=get_option('byconsolewooodtrestro_dinein_guest_purpose_lable');







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='dinein'){



if(!empty($byconsolewooodtrestro_dinein_lable)) 



{ 



$order_order_type_text =  $byconsolewooodtrestro_dinein_lable; 



} 



else 



{ 



$order_order_type_text = __('This order is for','restaurant-pickup-delivery-dine-in');



}



$order_dinein_guest_count=get_post_meta( $order_id, '_byconsolewooodtrestro_guest_count', true );



$order_dinein_guest_purpose=get_post_meta( $order_id, '_byconsolewooodtrestro_guest_purpose', true );



}











if(get_post_meta( $order_id , '_byconsolewooodtrestro_order_type', true )=='take_away'){







if(!empty($byconsolewooodtrestro_takeaway_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_takeaway_lable; 



} 



else 



{ 



$order_order_type = __('Pickup','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='levering'){



if(!empty($byconsolewooodtrestro_delivery_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_delivery_lable; 



} 



else 



{ 



$order_order_type = __('Delivery','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='dinein'){



if(!empty($byconsolewooodtrestro_dinein_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_dinein_lable; 



} 



else 



{ 



$order_order_type = __('Dine in','restaurant-pickup-delivery-dine-in');



}



if(!empty($byconsolewooodtrestro_dinein_guest_number_lable)){



$order_dinein_guest_number_text=$byconsolewooodtrestro_dinein_guest_number_lable;	



}else{



$order_dinein_guest_number_text=__('Number of guest(s)','restaurant-pickup-delivery-dine-in');	



}



if(!empty($byconsolewooodtrestro_dinein_guest_accommodation_lable)){



$order_dinein_guest_accommodation_text = $byconsolewooodtrestro_dinein_guest_accommodation_lable;	



}else{



$order_dinein_guest_accommodation_text = __('Accommodation requested','restaurant-pickup-delivery-dine-in');	



}



$order_dinein_guest_count=get_post_meta( $order_id, '_byconsolewooodtrestro_guest_count', true );



$order_dinein_guest_purpose=ucfirst(get_post_meta( $order_id, '_byconsolewooodtrestro_guest_purpose', true ));



}







//type



if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )) )



{



echo '<p><strong>'.__('This order is for','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html($order_order_type) . '</p>';



}







//date



if( !empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) )



{



echo '<p><strong>'.__($order_order_type.' date','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) . '</p>';



}







//time



if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) )



{



echo '<p><strong>'.__($order_order_type.' time','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) . '</p>';



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='levering'){



$prepare_shipping_text= str_replace('[bycrestro_delivery_date]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )).'</b>',esc_html(get_option('byconsolewooodtrestro_orders_delivered')));







echo '<p>'.str_replace('[bycrestro_delivery_time]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )).'</b>',$prepare_shipping_text).'</p>';



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='take_away'){



$prepare_shipping_text= str_replace('[bycrestro_pickup_date]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )).'</b>',esc_html(get_option('byconsolewooodtrestro_orders_pick_up')));







echo '<p>'.str_replace('[bycrestro_pickup_time]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )).'</b>',$prepare_shipping_text).'</p>';	



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='dinein'){



$prepare_shipping_text= str_replace('[bycrestro_dine_in_date]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )).'</b>',esc_html(get_option('byconsolewooodtrestro_orders_dinein')));



$byconsolewooodtrestro_guest_no =  get_option('byconsolewooodtrestro_guest_no'); 

	

if( $byconsolewooodtrestro_guest_no == 'yes'){

		

	echo '<p><strong>'.$order_dinein_guest_number_text.':</strong> ' . esc_html(ucfirst($order_dinein_guest_count)) . '</p>';

	

}



$byconsolewooodtrestro_guest_purpose = get_option('byconsolewooodtrestro_guest_purpose');



if( $byconsolewooodtrestro_guest_purpose == 'yes'){



	echo '<p><strong>'.$order_dinein_guest_accommodation_text.':</strong> ' . esc_html(str_replace('_',' ',$order_dinein_guest_purpose)) . '</p>';



}





echo '<p>'.str_replace('[bycrestro_dine_in_time]','<b>'.esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )).'</b>',$prepare_shipping_text).'</p>';	



}



}







//include the custom order meta to woocommerce mail



//add_action( "woocommerce_email_after_order_table", "byconsolewooodtrestro_woocommerce_email_after_order_table", 10, 1);



add_action( "woocommerce_email_after_order_table", "byconsolewooodtrestro_checkout_field_display_user_order_meta", 10, 1);







function byconsolewooodtrestro_woocommerce_email_after_order_table( $order ) {







$byconsolewooodtrestro_takeaway_lable=get_option('byconsolewooodtrestro_takeaway_lable');







$byconsolewooodtrestro_delivery_lable=get_option('byconsolewooodtrestro_delivery_lable');







$order_id = version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->id : $order->get_id();







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='take_away'){



if(!empty($byconsolewooodtrestro_takeaway_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_takeaway_lable; 



} 



else 



{ 



$order_order_type = __('Take away','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='levering'){



if(!empty($byconsolewooodtrestro_delivery_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_delivery_lable; 



} 



else 



{ 



$order_order_type = __('Delivery','restaurant-pickup-delivery-dine-in');



}



}







if(get_post_meta( $order_id, '_byconsolewooodtrestro_order_type', true )=='dinein'){



if(!empty($byconsolewooodtrestro_delivery_lable)) 



{ 



$order_order_type =  $byconsolewooodtrestro_delivery_lable; 



} 



else 



{ 



$order_order_type = __('Dine in','restaurant-pickup-delivery-dine-in');



}



}







if(!empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) && !empty(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) )



{







echo '<p></p><p><strong>'.__('Delivery|Pickup|dine in date','byconsolewooodtrestro').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_date', true )) . '</p>';







echo '<p><strong>'.__('Delivery|Pickup|Dine in time','byconsolewooodtrestro').':</strong> ' . esc_html(get_post_meta( $order_id, '_byconsolewooodtrestro_delivery_time', true )) . '</p>';







echo '<p><strong>'.__('Order type','restaurant-pickup-delivery-dine-in').':</strong> ' . esc_html($order_order_type) . '</p>';



}



}







// add our styles and js



function byconsolewooodtrestro_add_scripts() {







wp_enqueue_script('jquery-ui-datepicker');







wp_register_script('byconsolewooodtrestro_timepicker', plugins_url('js/jquery.timepicker.min.js', __FILE__), array('jquery'),'1.12', true);







wp_register_script('byconsolewooodtrestro_main', plugins_url('js/byconsolewooodtrestro.js', __FILE__), array('jquery'),'1.12', true);







wp_enqueue_script('byconsolewooodtrestro_timepicker');







wp_enqueue_script('byconsolewooodtrestro_main');







}







add_action( 'wp_enqueue_scripts', 'byconsolewooodtrestro_add_scripts' ); 



//add styles



function byconsolewooodtrestro_add_styles() {



wp_enqueue_style('byconsolewooodtrestro_stylesheet', plugins_url('css/style.css', __FILE__));







wp_enqueue_style('byconsolewooodtrestro_stylesheet_ui', plugins_url('css/jquery-ui.min.css', __FILE__));







wp_enqueue_style('byconsolewooodtrestro_stylesheet_ui_theme', plugins_url('css/jquery-ui.theme.min.css', __FILE__));







wp_enqueue_style('byconsolewooodtrestro_stylesheet_ui_structure', plugins_url('css/jquery-ui.structure.min.css', __FILE__));







wp_enqueue_style('byconsolewooodtrestro_stylesheet_time_picker', plugins_url('css/jquery.timepicker.css', __FILE__));



}







add_action( 'wp_enqueue_scripts', 'byconsolewooodtrestro_add_styles' ); 









function byconsolewooodtrestro_admin_script($hook) {





	global $byconsolewooodtrestro_timeslot_settings;





	if($hook == $byconsolewooodtrestro_timeslot_settings){	



		$plugins_url_path = plugins_url();

		

		wp_register_script( 'byconsolewooodtrestro-admin-script', plugins_url( 'js/byconsolewooodtrestro-admin-script.js' , __FILE__ ),array('jquery'),'1.12', true );

		

		wp_enqueue_script( 'byconsolewooodtrestro-admin-script');



		wp_enqueue_style('byconsolewooodtrestro_admin_stylesheet', plugins_url('css/byconsolewooodtrestro-admin-style.css', __FILE__));





	}

	else

	{

		return;

	}





}





add_action('admin_enqueue_scripts', 'byconsolewooodtrestro_admin_script');







// refreshing the cart on page load



/** Break html5 cart caching */



add_action('wp_enqueue_scripts', 'byconsolewooodtrestro_cartcache_enqueue_scripts', 100);







function byconsolewooodtrestro_cartcache_enqueue_scripts()



{



wp_deregister_script('wc-cart-fragments');







wp_enqueue_script( 'wc-cart-fragments', plugins_url( 'js/cart-fragments.js', __FILE__ ), array( 'jquery', 'jquery-cookie' ), '1.12', true );







}







// show only store pickup when take_away is selected	



add_filter('woocommerce_package_rates', 'byconsolewooodtrestro_shipping_according_widget_input', 10, 2);



//add_filter('woocommerce_package_rates', 'byconsolewooodtrestro_shipping_according_widget_input', 100);







function byconsolewooodtrestro_shipping_according_widget_input($rates, $package)



{



// get cookie as array



$stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);







$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);







global $woocommerce;







$version = "2.6";







if (version_compare($woocommerce->version, $version, ">=")) {







$new_rates = array();







/*echo '<hr />';







print_r($rates);*/







if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away'){



foreach($rates as $key => $rate) {



if ('local_pickup' === $rate->method_id || 'legacy_local_pickup' === $rate->method_id) {



$new_rates[$key] = $rates[$key];



}



}







/*print_r($new_rates);



print_r($rates);*/



}elseif($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){



foreach($rates as $key => $rate) {



/*print_r($rate);



echo '<hr />';*/



if ('local_pickup' != $rate->method_id && 'legacy_local_pickup' != $rate->method_id ) {



$new_rates[$key] = $rates[$key];



//unset($rates['local_pickup']);



}



}



}elseif($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein'){



foreach($rates as $key => $rate) {



if ('local_pickup' === $rate->method_id || 'legacy_local_pickup' === $rate->method_id) {



$new_rates[$key] = $rates[$key];



}



}



/*print_r($new_rates);



print_r($rates);*/



}else{



//



}







return empty($new_rates) ? $rates : $new_rates;



/*echo '<hr />';



print_r($new_rates);*/



}



else {



if ($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away') {



$predefined_shipping          = $rates['local_pickup'];



$rates                  = array();



$rates['local_pickup'] = $predefined_shipping;



}







if ($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering') {



$predefined_shipping          = $rates['flat_rate'];



$rates                  = array();



$rates['flat_rate'] = $predefined_shipping;



}







if ($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein') {



$predefined_shipping          = $rates['local_pickup'];



$rates                  = array();



$rates['local_pickup'] = $predefined_shipping;



}



return $rates;



}



}







// check if checkout page



// do the JS to populate date and time field paqrameter



function byconsolewooodtrestro_wp_head() {



?>







	<style>



		#_byconsolewooodtrestro_delivery_date_alternate_field{display:none;}

		.loading_image_contanier{background-color: #ececec47;width: 80%;position: absolute;}

		.loading_image_contanier img{margin: 0 auto;display: block;margin-top: 15%;}



	</style>







<?php



}



add_action('wp_head', 'byconsolewooodtrestro_wp_head', 1);







function byconsolewooodtrestro_footer_script(){







// get cookie as array



if(!empty($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie'])){







$stripped_out_byconsolewooodtrestro_delivery_widget_cookie=stripslashes($_COOKIE['byconsolewooodtrestro_delivery_widget_cookie']);







$byconsolewooodtrestro_delivery_widget_cookie_array=json_decode($stripped_out_byconsolewooodtrestro_delivery_widget_cookie,true);



}



?>



<script>



function byconsolewooodtrestroStartTimeByInterval(cur_hour,cur_minute){



if(cur_minute > 0 && cur_minute < 15){







var start_minute=15;







}else if(cur_minute >= 15 && cur_minute < 30){







var start_minute=30;







}else if(cur_minute >= 30 && cur_minute < 45){







var start_minute=45;







}else if(cur_minute >= 45 && cur_minute < 59){







var start_minute=59;







}else{}







if(start_minute==59){







var next_hour=parseInt(cur_hour)+1;







var start_time_updated=next_hour+":"+"00";







}else{







var start_time_updated=cur_hour+":"+start_minute;







}







return start_time_updated;







} // end of ByConsoleWooODTtimeInterval







function byconsolewooodtrestroDeliveryWidgetTimePopulate(date_field_identifier,time_field_identifier){ 



// lock the time selection based on admin settings for delivery time



//echo 'var curtime_to_compare=new Date().toLocaleTimeString();';



service_status="open";







var current_date= new Date();







var curtime= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric", minute: "numeric"});



// get local minute



//var cur_minute= new Date().toLocaleTimeString("en-US", { hour12: false, minute: "numeric"});







var cur_minute=current_date.getMinutes();







// get local hour



//var cur_hour= new Date().toLocaleTimeString("en-US", { hour12: false, hour: "numeric"});											







var cur_hour=current_date.getHours();







var curtime=cur_hour+':'+cur_minute;







byconsolewooodtrestroStartTimeByInterval(cur_hour,cur_minute); // check this function in wp-footer



//populate time field based on date selection (call this function onSelect event of datepicker)



/*var selected_date=jQuery(".byconsolewooodtrestro_widget_date_field").datepicker( "getDate" );*/



selected_date=jQuery(date_field_identifier).datepicker('option', 'dateFormat', 'dd M yy').val();







//var byc_delivery_date_alternate = jQuery("#byconsolewooodtrestro_delivery_date_alternate").val().split("/");



var byc_delivery_date_alternate = jQuery(date_field_identifier+"_alternate").val().split("/");



if(byc_delivery_date_alternate[1]==1){



byc_delivery_date_alternate_month='Jan';



}else if(byc_delivery_date_alternate[1]==2){



byc_delivery_date_alternate_month='Feb';



}else if(byc_delivery_date_alternate[1]==3){



byc_delivery_date_alternate_month='Mar';



}else if(byc_delivery_date_alternate[1]==4){



byc_delivery_date_alternate_month='Apr';



}else if(byc_delivery_date_alternate[1]==5){



byc_delivery_date_alternate_month='May';



}else if(byc_delivery_date_alternate[1]==6){



byc_delivery_date_alternate_month='Jun';



}else if(byc_delivery_date_alternate[1]==7){



byc_delivery_date_alternate_month='Jul';



}else if(byc_delivery_date_alternate[1]==8){



byc_delivery_date_alternate_month='Aug';



}else if(byc_delivery_date_alternate[1]==9){



byc_delivery_date_alternate_month='Sep';



}else if(byc_delivery_date_alternate[1]==10){



byc_delivery_date_alternate_month='Oct';



}else if(byc_delivery_date_alternate[1]==11){



byc_delivery_date_alternate_month='Nov';



}else if(byc_delivery_date_alternate[1]==12){



byc_delivery_date_alternate_month='Dec';



}else{



byc_delivery_date_alternate_month='';



}







selected_date = byc_delivery_date_alternate[0] + " " + byc_delivery_date_alternate_month + " " + byc_delivery_date_alternate[2];







todays_date=new Date();



todays_date_month=(todays_date.getMonth()+1);



todays_date_date=todays_date.getDate();



todays_date_year=todays_date.getFullYear();







if( todays_date_month < 10){



todays_date_month='0' + todays_date_month;



}







if(todays_date_date < 10){



todays_date_date='0' + todays_date_date;



}







if(todays_date_month==1){



todays_date_month='Jan';



}else if(todays_date_month==2){



todays_date_month='Feb';



}else if(todays_date_month==3){



todays_date_month='Mar';



}else if(todays_date_month==4){



todays_date_month='Apr';



}else if(todays_date_month==5){



todays_date_month='May';



}else if(todays_date_month==6){



todays_date_month='Jun';



}else if(todays_date_month==7){



todays_date_month='Jul';



}else if(todays_date_month==8){



todays_date_month='Aug';



}else if(todays_date_month==9){



todays_date_month='Sep';



}else if(todays_date_month==10){



todays_date_month='Oct';



}else if(todays_date_month==11){



todays_date_month='Nov';



}else if(todays_date_month==12){



todays_date_month='Dec';



}else{



todays_date_month='';



}



todays_formated_date = todays_date_date + " " + todays_date_month + " " + todays_date_year;







if( Date.parse(selected_date) != Date.parse(todays_formated_date) ){



<?php if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away'){?>



start_time_updated_as_per_selected_date = pickup_opening_time;



<?php }



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){?>



start_time_updated_as_per_selected_date = delivery_opening_time;



<?php }



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein'){?>



start_time_updated_as_per_selected_date = dinein_opening_time;



<?php }?>







//alert('Different date, so starting time is store openning time '+delivery_opening_time + pickup_opening_time);



}else if( Date.parse(selected_date) == Date.parse(todays_formated_date) ){



//if current time is grater than openning time then show current time



<?php if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away'){?>



//alert(curtime +"||"+ pickup_opening_time);



if(Date.parse('22 Sep 2017 '+curtime) <= Date.parse('22 Sep 2017 '+pickup_opening_time)){



start_time_updated_as_per_selected_date = pickup_opening_time;



}







if(Date.parse('22 Sep 2017 '+curtime) > Date.parse('22 Sep 2017 '+pickup_opening_time)){



start_time_updated_as_per_selected_date = byconsolewooodtrestroStartTimeByInterval(cur_hour,cur_minute); // check this function in wp_footer







if(Date.parse('11 Jan 2018 '+start_time_updated_as_per_selected_date) >= Date.parse('11 Jan 2018 <?php echo esc_html(get_option('byconsolewooodtrestro_pickup_hours_to'));?>')){



	service_status="closed";



	}



}







<?php }







if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein'){?>



//alert(curtime +"||"+ pickup_opening_time);



if(Date.parse('11 Sep 2019 '+curtime) <= Date.parse('11 Sep 2019 '+dinein_opening_time)){



start_time_updated_as_per_selected_date = dinein_opening_time;



}







if(Date.parse('11 Sep 2019 '+curtime) > Date.parse('11 Sep 2019 '+dinein_opening_time)){



start_time_updated_as_per_selected_date = byconsolewooodtrestroStartTimeByInterval(cur_hour,cur_minute); // check this function in wp_footer







if(Date.parse('11 Sep 2019 '+start_time_updated_as_per_selected_date) >= Date.parse('11 Sep 2018 <?php echo esc_html(get_option('byconsolewooodtrestro_dinein_hours_to'));?>')){



	service_status="closed";



	}



}







<?php }







if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){?>







if(Date.parse('22 Sep 2017 '+curtime) <= Date.parse('22 Sep 2017 '+delivery_opening_time)){



start_time_updated_as_per_selected_date = delivery_opening_time;



}







if(Date.parse('22 Sep 2017 '+curtime) > Date.parse('22 Sep 2017 '+delivery_opening_time)){



start_time_updated_as_per_selected_date = byconsolewooodtrestroStartTimeByInterval(cur_hour,cur_minute); // check this function in wp_footer



//alert('start_time_updated_as_per_selected_date : '+start_time_updated_as_per_selected_date);







if(Date.parse('11 Jan 2018 '+start_time_updated_as_per_selected_date) >= Date.parse('11 Jan 2018 <?php echo esc_html(get_option('byconsolewooodtrestro_delivery_hours_to'));?>')){



	service_status="closed";



	}



}



<?php }?>



//alert('equal date, so starting time is current time '+start_time_updated_as_per_selected_date)



}else{



alert('You have bug in this version of plugin, please update the plugin');



}







<?php



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering'){



?>







if(service_status=='closed'){







	jQuery('p.byc_service_time_closed').html('<?php echo __("We are closed now, please select another day","restaurant-pickup-delivery-dine-in");?>');







	//alert('time_field_identifier : '+time_field_identifier);







	jQuery(time_field_identifier).css("dispaly:none");







	jQuery(time_field_identifier).addClass("byc_closed_now");







	}else{







jQuery(time_field_identifier).css("dispaly:block");







jQuery(time_field_identifier).removeClass("byc_closed_now");







jQuery('p.byc_service_time_closed').html('');







jQuery(time_field_identifier).timepicker({







//if it is not today's date selected in dateicker then do not do the past time resriction 



//if(jQuery(".byconsolewooodtrestro_widget_date_field").datepicker( "getDate" )!= new Date();



"minTime": start_time_updated_as_per_selected_date,







"maxTime": "<?php echo get_option('byconsolewooodtrestro_delivery_hours_to');?>",







"disableTextInput": "true",







"disableTouchKeyboard": "true",







"scrollDefault": "now",







"step": "15",







"selectOnBlur": "true",







"timeFormat": "<?php echo get_option('byconsolewooodtrestro_hours_format');?>"



});		



		}



<?php



}







// lock the time selection based on admin settings for pickup time



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away'){



?>



//alert("service_status : "+service_status);



if(service_status=='closed'){



	jQuery('p.byc_service_time_closed').html('<?php echo __("We are closed now, please select another day","restaurant-pickup-delivery-dine-in");?>');







	jQuery(time_field_identifier).css("dispaly:none");



	//alert('time_field_identifier : '+time_field_identifier);



	jQuery(time_field_identifier).css("dispaly:none");







	jQuery(time_field_identifier).addClass("byc_closed_now");







	}else{







jQuery(time_field_identifier).css("dispaly:block");







jQuery(time_field_identifier).removeClass("byc_closed_now");







jQuery('p.byc_service_time_closed').html('');







jQuery(time_field_identifier).timepicker({







"minTime": start_time_updated_as_per_selected_date,







"maxTime": "<?php echo get_option('byconsolewooodtrestro_pickup_hours_to');?>",







"disableTextInput": "true",







"disableTouchKeyboard": "true",







"scrollDefault": "now",







"step": "15",







"selectOnBlur": "true",







"timeFormat": "<?php echo get_option('byconsolewooodtrestro_hours_format');?>"



});



	}



<?php



}







// lock the time selection based on admin settings for dine in time



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein'){



?>



//alert("service_status : "+service_status);



if(service_status=='closed'){



	jQuery('p.byc_service_time_closed').html('<?php echo __("We are closed now, please select another day","restaurant-pickup-delivery-dine-in");?>');







	jQuery(time_field_identifier).css("dispaly:none");



	//alert('time_field_identifier : '+time_field_identifier);



	jQuery(time_field_identifier).css("dispaly:none");







	jQuery(time_field_identifier).addClass("byc_closed_now");







	}else{







jQuery(time_field_identifier).css("dispaly:block");







jQuery(time_field_identifier).removeClass("byc_closed_now");







jQuery('p.byc_service_time_closed').html('');







jQuery(time_field_identifier).timepicker({







"minTime": start_time_updated_as_per_selected_date,







"maxTime": "<?php echo get_option('byconsolewooodtrestro_dinein_hours_to');?>",







"disableTextInput": "true",







"disableTouchKeyboard": "true",







"scrollDefault": "now",







"step": "15",







"selectOnBlur": "true",







"timeFormat": "<?php echo get_option('byconsolewooodtrestro_hours_format');?>"



});



	}



<?php



}











// if no delivery type is not selected then show all times



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']==''){



?>



jQuery(time_field_identifier).timepicker({







"disableTextInput": "true",







"disableTouchKeyboard": "true",







"scrollDefault": "now",







"step": "15",







"selectOnBlur": "true",







"timeFormat": "<?php echo get_option('byconsolewooodtrestro_hours_format');?>"



});



<?php



}	



?>



} // End of function byconsolewooodtrestroDeliveryWidgetTimePopulate







<?php



$byconsolewooodtrestro_pickup_closingdays=get_option('byconsolewooodtrestro_pickup_holidays');



$byconsolewooodtrestro_delivery_closingdays=get_option('byconsolewooodtrestro_delivery_holidays');



$byconsolewooodtrestro_dinein_closingdays=get_option('byconsolewooodtrestro_dinein_holidays');



?>



$byconsolewooodtrestro_delivery_closingdays = [



<?php



$stat_i=1;



if(!empty($byconsolewooodtrestro_delivery_closingdays)){



$day_i=count($byconsolewooodtrestro_delivery_closingdays);



foreach($byconsolewooodtrestro_delivery_closingdays as $byconsolewooodtrestro_delivery_closingdays_single)



{



echo trim($byconsolewooodtrestro_delivery_closingdays_single);



//handle the last comma(,)



if($stat_i<$day_i){



echo ',';



}



$stat_i++;



}



}



?>



];







$byconsolewooodtrestro_pickup_closingdays = [



<?php



$stat_i=1;



if(!empty($byconsolewooodtrestro_pickup_closingdays)){



$day_i=count($byconsolewooodtrestro_pickup_closingdays);



foreach($byconsolewooodtrestro_pickup_closingdays as $byconsolewooodtrestro_pickup_closingdays_single)



{



echo trim($byconsolewooodtrestro_pickup_closingdays_single);



//handle the last comma(,)



if($stat_i<$day_i){



echo ',';



}



$stat_i++;



}



}



?>



];







$byconsolewooodtrestro_dinein_closingdays = [



<?php



$stat_i=1;



if(!empty($byconsolewooodtrestro_dinein_closingdays)){



$day_i=count($byconsolewooodtrestro_dinein_closingdays);



foreach($byconsolewooodtrestro_dinein_closingdays as $byconsolewooodtrestro_dinein_closingdays_single)



{



echo trim($byconsolewooodtrestro_dinein_closingdays_single);



//handle the last comma(,)



if($stat_i<$day_i){



echo ',';



}



$stat_i++;



}



}



?>



];







</script>



<?php







if(is_checkout()){// execute on woocommerce check out page only



//date and time fields population by plugin settings page



?>







<script>



jQuery(document).ready(function(){



<?php



if(get_option('byconsolewooodtrestro_preorder_days')==''){// if no pre-order date is not set in settings page



?>



jQuery("#_byconsolewooodtrestro_delivery_date").datepicker({







minDate: 0,







showAnim: "slideDown",







beforeShowDay: function(date){ return checkHolidaysBycRestro( date ); },







altField: "#_byconsolewooodtrestro_delivery_date_alternate",







//altFormat: "dd/m/yy",

altFormat: "mm/dd/yy",





onSelect: function(){jQuery("#_byconsolewooodtrestro_delivery_time").timepicker("remove"); jQuery("#_byconsolewooodtrestro_delivery_time").val(''); byconsolewooodtrestroDeliveryWidgetTimePopulate("#_byconsolewooodtrestro_delivery_date","#_byconsolewooodtrestro_delivery_time");

	

	<?php 

		$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

		if($byconsolewooodtrestro_enable_timeslot == 'yes'){

	?>

	

	var alternate_selecteddate = jQuery("#_byconsolewooodtrestro_delivery_date_alternate").val();

	<?php

	$byconsolewooodt_hours_format = get_option('byconsolewooodt_hours_format');



	if($byconsolewooodt_hours_format == 'H:i'){

		$hourformate = '12';

	}

	if($byconsolewooodt_hours_format == 'h:i A'){

		$hourformate = '24';

	}

	?>



	var curtime= new Date().toLocaleTimeString("en-US", { hour<?php echo $hourformate;?>: false, hour: "numeric", minute: "numeric"});

	var current_system_time= curtime.split(' ');

	var current_system_time_without_comma = curtime.replace(","," "); 



	jQuery(".loading_image_contanier").css("display","block");

	var selected_data = {	

	'action': 'get_byconsolewooodtrestro_timeslot_by_selected_date',

	'selected_alternate_date_value' : alternate_selecteddate,

	'current_system_time' : current_system_time_without_comma,

	'selected_order_type' : '<?php echo $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field'];?>',

	};

	

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php



	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	jQuery.post( ajaxurl, selected_data, function( response)  {

		//alert( 'Got this from the server: ' + response );

		//console.log('response: ' + response);

		jQuery("#_byconsolewooodtrestro_delivery_time").timepicker("remove");

		jQuery("#_byconsolewooodtrestro_delivery_time").empty();	

		jQuery("#_byconsolewooodtrestro_delivery_time").append(response);

		var byconsolewooodtrestro_delivery_time_count = jQuery('#_byconsolewooodtrestro_delivery_time option').length;

		jQuery(".loading_image_contanier").css("display","none");

		//console.log(byconsolewooodtrestro_delivery_time_count);

		if(byconsolewooodtrestro_delivery_time_count>1){

			//jQuery("#byconsolewooodt_delivery_time_field").css("display","block");

			//jQuery("#byc_time_field_service_closed_notice").css("display","none");

			jQuery("#_byconsolewooodtrestro_delivery_time").css({background:"",color:""});

			jQuery("#_byconsolewooodtrestro_delivery_date").css({border:""});

			jQuery(".loading_image_contanier").css("display","none");

		}else{

			jQuery("#_byconsolewooodtrestro_delivery_time").html('<option value="">We are closed for today! Please select another date</option>');

			var closed_today_style={background: "#c92b00", color: "#ff0"};

			jQuery("#_byconsolewooodtrestro_delivery_time").css({background:"#c92b00",color:"#ff0"});

			jQuery("#_byconsolewooodtrestro_delivery_date").css({border:"1px solid #ff0"}).animate({borderWidth: 4}, 500);

			//jQuery("#byc_time_field_service_closed_notice").css("display","block");	

			jQuery(".loading_image_contanier").css("display","none");

		}



	});

	

	<?php } ?>



} // reset timepicker on date selection to get new time value depending date selected here AND THEN call call time population function







});







<?php



}else{//if no pre-order date is set in settings page do the date selection restriction



?>







jQuery( "#_byconsolewooodtrestro_delivery_date" ).datepicker({ 







minDate: 0,







maxDate: "<?php echo get_option('byconsolewooodtrestro_preorder_days');?>D",







showOtherMonths: true,







selectOtherMonths: true,







showAnim: "slideDown",







beforeShowDay: function(date){ return checkHolidaysBycRestro( date ); },







altField: "#_byconsolewooodtrestro_delivery_date_alternate",







//altFormat: "dd/m/yy",



altFormat: "mm/dd/yy",



onSelect: function(){jQuery("#_byconsolewooodtrestro_delivery_time").timepicker("remove"); jQuery("#_byconsolewooodtrestro_delivery_time").val(''); byconsolewooodtrestroDeliveryWidgetTimePopulate("#_byconsolewooodtrestro_delivery_date","#_byconsolewooodtrestro_delivery_time");

	

	<?php 

		$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

		if($byconsolewooodtrestro_enable_timeslot == 'yes'){

	?>

	var alternate_selecteddate = jQuery("#_byconsolewooodtrestro_delivery_date_alternate").val();

	<?php

	$byconsolewooodt_hours_format = get_option('byconsolewooodt_hours_format');



	if($byconsolewooodt_hours_format == 'H:i'){

		$hourformate = '12';

	}

	if($byconsolewooodt_hours_format == 'h:i A'){

		$hourformate = '24';

	}

	?>



	var curtime= new Date().toLocaleTimeString("en-US", { hour<?php echo $hourformate;?>: false, hour: "numeric", minute: "numeric"});

	var current_system_time= curtime.split(' ');

	var current_system_time_without_comma = curtime.replace(","," "); 



	jQuery(".loading_image_contanier").css("display","block");

	var selected_data = {	

	'action': 'get_byconsolewooodtrestro_timeslot_by_selected_date',

	'selected_alternate_date_value' : alternate_selecteddate,

	'current_system_time' : current_system_time_without_comma,

	'selected_order_type' : '<?php echo $byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field'];?>',

	};

	

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php



	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

	jQuery.post( ajaxurl, selected_data, function( response)  {

		//alert( 'Got this from the server: ' + response );

		//console.log('response: ' + response);

		jQuery("#_byconsolewooodtrestro_delivery_time").timepicker("remove");

		jQuery("#_byconsolewooodtrestro_delivery_time").empty();	

		jQuery("#_byconsolewooodtrestro_delivery_time").append(response);

		var byconsolewooodtrestro_delivery_time_count = jQuery('#_byconsolewooodtrestro_delivery_time option').length;

		jQuery(".loading_image_contanier").css("display","none");

		//console.log(byconsolewooodtrestro_delivery_time_count);

		if(byconsolewooodtrestro_delivery_time_count>1){

			//jQuery("#byconsolewooodt_delivery_time_field").css("display","block");

			//jQuery("#byc_time_field_service_closed_notice").css("display","none");

			jQuery("#_byconsolewooodtrestro_delivery_time").css({background:"",color:""});

			jQuery("#_byconsolewooodtrestro_delivery_date").css({border:""});

			jQuery(".loading_image_contanier").css("display","none");

		}else{

			jQuery("#_byconsolewooodtrestro_delivery_time").html('<option value="">We are closed for today! Please select another date. </option>');

			var closed_today_style={background: "#c92b00", color: "#ff0"};

			jQuery("#_byconsolewooodtrestro_delivery_time").css({background:"#c92b00",color:"#ff0"});

			jQuery("#_byconsolewooodtrestro_delivery_date").css({border:"1px solid #ff0"}).animate({borderWidth: 4}, 500);

			//jQuery("#byc_time_field_service_closed_notice").css("display","block");	

			jQuery(".loading_image_contanier").css("display","none");

		}



	});

	<?php } ?>





} // reset timepicker on date selection to get new time value depending date selected here AND THEN call call time population function







});







<?php	}	?>







})







jQuery(document).ready(function(){



//jQuery("#byconsolewooodtrestro_delivery_date_alternate").css("display","none");







jQuery(".byconsolewooodtrestro_widget_date_field").val("");







jQuery(".byconsolewooodtrestro_widget_time_field").val("");







});







</script>







<?php



// refresh the page once delivery type is changed and if the checkout page dont have the widget present (if it has widget present it will be refresh by widget itself)



//check if it is checkout page



//check if widget is present on checkout page



//if widget is not present create it and make it hide



echo '<div style="display:none;">';



the_widget( 'byconsolewooodtrestro_widget' );



echo '</div>';



?>







<script>



//alertboxes to translate



jQuery(document).ready(function() {

	<?php

	$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

	if($byconsolewooodtrestro_enable_timeslot == ''){

	?>

	jQuery('#_byconsolewooodtrestro_delivery_time').on('click',function(){



		if(! jQuery('#_byconsolewooodtrestro_delivery_time').hasClass('ui-timepicker-input')){



			//alert("checkout");



			alert("<?php echo __("Please select date again","restaurant-pickup-delivery-dine-in");?>");



			}



	});

	<?php } ?>





jQuery('#_byconsolewooodtrestro_delivery_time').attr("readonly");







jQuery("#_byconsolewooodtrestro_delivery_date").prop("readonly",true);



});



</script>







<?php



}// is_checkout



else



{



?>



<script>



//alertboxes to translate



jQuery(document).ready(function() {

	

	<?php

	$byconsolewooodtrestro_enable_timeslot = get_option('byconsolewooodtrestro_enable_timeslot');

	if($byconsolewooodtrestro_enable_timeslot == ''){

	?>

	jQuery('.byconsolewooodtrestro_widget_time_field').on('click',function(){

		if(! jQuery('.byconsolewooodtrestro_widget_time_field').hasClass('ui-timepicker-input')){



		//alert("widget");



		alert("<?php echo __("Please select date again","restaurant-pickup-delivery-dine-in");?>");



		}



	});

	<?php } ?>





});







</script>



<?php



	} // !is_checkout



	



?>







<script>



function checkHolidaysBycRestro( date ){



var $return=true;



var $returnclass ="available";



//alert(date);







$checkdate = jQuery.datepicker.formatDate("mm/dd/yy", date);



$checkday	= jQuery.datepicker.formatDate("D", date);



//alert($checkday+' | '+date.getDay());



//alert(date.getDay());



$checkdaynum=date.getDay();



//alert($checkdaynum);



//var day = date.getDay();







//console.log($checkdaynum);







<?php



// do selection disable on closing days as per allowable pickup days settings



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='take_away' && !empty($byconsolewooodtrestro_pickup_closingdays)){



?>



if(jQuery.inArray($checkdaynum,$byconsolewooodtrestro_pickup_closingdays)!=-1){



$return = false;



$returnclass= "unavailable byconsolewooodtrestro_pickup_weekly_closing_day";



//alert($checkday+'||<?php //echo $allowable_pickup_days_js_array;?>');



//alert('in condition 1');



}



/***************************to_include************************/



/***************************to_include************************/



<?php



}



// do selection disable on closing days as per allowable delivery days settings



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='levering' && !empty($byconsolewooodtrestro_delivery_closingdays))



{



?>



if(jQuery.inArray($checkdaynum,$byconsolewooodtrestro_delivery_closingdays)!=-1){



$return = false;



$returnclass= "unavailable byconsolewooodtrestro_delivery_weekly_closing_day";



//alert('in condition 2');



}



/***************************to_include************************/



/***************************to_include************************/



<?php 



}







// do selection disable on closing days as per allowable dinein days settings



if($byconsolewooodtrestro_delivery_widget_cookie_array['byconsolewooodtrestro_widget_type_field']=='dinein' && !empty($byconsolewooodtrestro_dinein_closingdays))



{



?>



if(jQuery.inArray($checkdaynum,$byconsolewooodtrestro_dinein_closingdays)!=-1){



$return = false;



$returnclass= "unavailable byconsolewooodtrestro_dinein_weekly_closing_day";



//alert('in condition 2');



}



/***************************to_include************************/



/***************************to_include************************/



<?php 



}



?>











//function return value







return [$return,$returnclass];



}// Selectd  Holiday Diasable End



</script>



<?php



	



} //byconsolewooodtrestro_footer_script







add_action('wp_footer','byconsolewooodtrestro_footer_script');



//add_action('wp_footer','woocommerce_package_rates',999);



add_action('wp_footer','byconsolewooodtrestro_recalculate_shipping');







function byconsolewooodtrestro_recalculate_shipping(){



foreach (WC()->cart->get_cart() as $key => $value) {







    WC()->cart->set_quantity($key, $value['quantity']+1);







    WC()->cart->set_quantity($key, $value['quantity']);







    break;



}



}







?>