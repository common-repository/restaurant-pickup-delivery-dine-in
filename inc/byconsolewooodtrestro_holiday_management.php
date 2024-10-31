<?php function byconsolewooodtrestro_free_admin_holiday_form(){?>


	<style>


		.byconsolewooodtrestro_pickup_holidays span{padding-right: 15px;}


		.byconsolewooodtrestro_delivery_holidays span{padding-right: 15px;}
		
		.byconsolewooodtrestro_dinein_holidays span{padding-right: 15px;}


	</style>


	


	<div class="wrap">


        <h1>Holiday management</h1>


        <form method="post" class="form_byconsolewooodtrestro_free_plugin_settings" action="options.php">


				<?php


                settings_fields("holidaymanagement");


                do_settings_sections("byconsolewooodtrestro_free_holidaymanagement_options");  


                submit_button();


                ?> 


		</form>


    </div>


	<?php


}








function byconsolewooodtrestro_free_pickup_holiday_management(){


	$byconsolewooodtrestro_pickup_holidays = get_option('byconsolewooodtrestro_pickup_holidays');


	if(empty($byconsolewooodtrestro_pickup_holidays)){


		$byconsolewooodtrestro_pickup_holidays=array();


		}		


	


	


	echo '<div class="byconsolewooodtrestro_pickup_holidays">';


	if(in_array('0',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="0" checked><span>Sunday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="0"><span>Sunday</span>';


		}


		


	if(in_array('1',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="1" checked><span>Monday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="1"><span>Monday</span>';


		}


		


	if(in_array('2',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="2" checked><span>Tuesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="2"><span>Tuesday</span>';


		}


		


	if(in_array('3',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="3" checked><span>Wednesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="3"><span>Wednesday</span>';


		}


		


	if(in_array('4',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="4" checked><span>Thursday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="4"><span>Thuurday</span>';


		}


		


	if(in_array('5',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="5" checked><span>Friday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="5"><span>Friday</span>';


		}


		


	if(in_array('6',$byconsolewooodtrestro_pickup_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="6" checked><span>Saturday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_pickup_holidays[]" id="byconsolewooodtrestro_pickup_holidays" value="6"><span>Saturday</span>';


		}


	     


   echo '</div>';


	


}








function byconsolewooodtrestro_free_delivery_holiday_management(){


	


	$byconsolewooodtrestro_delivery_holidays = get_option('byconsolewooodtrestro_delivery_holidays');


	if(empty($byconsolewooodtrestro_delivery_holidays)){


		$byconsolewooodtrestro_delivery_holidays=array();


		}


	


	echo '<div class="byconsolewooodtrestro_delivery_holidays">';


	if(in_array('0',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="0" checked><span>Sunday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="0"><span>Sunday</span>';


		}


		


	if(in_array('1',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="1" checked><span>Monday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="1"><span>Monday</span>';


		}


		


	if(in_array('2',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="2" checked><span>Tuesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="2"><span>Tuesday</span>';


		}


		


	if(in_array('3',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="3" checked><span>Wednesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="3"><span>Wednesday</span>';


		}


		


	if(in_array('4',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="4" checked><span>Thursday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="4"><span>Thuurday</span>';


		}


		


	if(in_array('5',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="5" checked><span>Friday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="5"><span>Friday</span>';


		}


		


	if(in_array('6',$byconsolewooodtrestro_delivery_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="6" checked><span>Saturday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_delivery_holidays[]" id="byconsolewooodtrestro_delivery_holidays" value="6"><span>Saturday</span>';


		}


	     


   echo '</div>';


}



function byconsolewooodtrestro_free_dinein_holiday_management(){


	$byconsolewooodtrestro_dinein_holidays = get_option('byconsolewooodtrestro_dinein_holidays');
	


	if(empty($byconsolewooodtrestro_dinein_holidays)){


		$byconsolewooodtrestro_dinein_holidays=array();


		}		


	


	


	echo '<div class="byconsolewooodtrestro_dinein_holidays">';


	if(in_array('0',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="0" checked><span>Sunday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="0"><span>Sunday</span>';


		}


		


	if(in_array('1',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="1" checked><span>Monday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="1"><span>Monday</span>';


		}


		


	if(in_array('2',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="2" checked><span>Tuesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="2"><span>Tuesday</span>';


		}


		


	if(in_array('3',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="3" checked><span>Wednesday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="3"><span>Wednesday</span>';


		}


		


	if(in_array('4',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="4" checked><span>Thursday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="4"><span>Thuurday</span>';


		}


		


	if(in_array('5',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="5" checked><span>Friday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="5"><span>Friday</span>';


		}


		


	if(in_array('6',$byconsolewooodtrestro_dinein_holidays)){


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="6" checked><span>Saturday</span>';	}else{


		echo '<input type="checkbox" name="byconsolewooodtrestro_dinein_holidays[]" id="byconsolewooodtrestro_dinein_holidays" value="6"><span>Saturday</span>';


		}


	     


   echo '</div>';


	


}













add_action('admin_init', 'byconsolewooodtrestro_free_plugin_holiday_manage_settings_fields');





function byconsolewooodtrestro_free_plugin_holiday_manage_settings_fields(){





	add_settings_section("holidaymanagement", "", null, "byconsolewooodtrestro_free_holidaymanagement_options");





	add_settings_field("byconsolewooodtrestro_pickup_holidays", __('Pickup Holidays:','byconsole-woo-order-delivery-time'), "byconsolewooodtrestro_free_pickup_holiday_management", "byconsolewooodtrestro_free_holidaymanagement_options", "holidaymanagement");





	add_settings_field("byconsolewooodtrestro_delivery_holidays", __('Delivery Holidays:','byconsole-woo-order-delivery-time'), "byconsolewooodtrestro_free_delivery_holiday_management", "byconsolewooodtrestro_free_holidaymanagement_options", "holidaymanagement");
	
	
	
	add_settings_field("byconsolewooodtrestro_dinein_holidays", __('Dine in Holidays:','byconsole-woo-order-delivery-time'), "byconsolewooodtrestro_free_dinein_holiday_management", "byconsolewooodtrestro_free_holidaymanagement_options", "holidaymanagement");





	register_setting("holidaymanagement", "byconsolewooodtrestro_pickup_holidays");


	register_setting("holidaymanagement", "byconsolewooodtrestro_delivery_holidays");
	
	
	register_setting("holidaymanagement", "byconsolewooodtrestro_dinein_holidays");





	}


?>