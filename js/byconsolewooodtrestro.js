//synchornization of widget radior selection to caheout field radio selection	
jQuery(document).ready(function () {
		jQuery('input[name="_byconsolewooodtrestro_order_type"]').on('click',function(){
       
        // Get the element index , which one we click on
        var indx = jQuery(this).index('input[name="_byconsolewooodtrestro_order_type"]');
        
        // Trigger a click on the same index in the second radio set
        
        jQuery('input[name="byconsolewooodtrestro_widget_type_field"]')[indx].click();
		
		//save the widget form
		jQuery('input[name="byconsolewooodtrestro_widget_submit"]').click();
    });
	
	//to avoid wrong parameters for time drop-down when the delivery type radio selection has changed
	jQuery('input[name="byconsolewooodtrestro_widget_type_field"]').on('click',function(){
		//remove the value relected for previous option
		jQuery('input[name="byconsolewooodtrestro_widget_time_field"]').val('');
		//reload the widget to get new values for time drop-down from admin settings
		jQuery('input[name="byconsolewooodtrestro_widget_submit"]').click();
		});

	//synchornize check out date time field value with widget date time field value
		jQuery('input[name="byconsolewooodtrestro_widget_date_field"]').on('change',function(){
		jQuery('input[name="_byconsolewooodtrestro_delivery_date"]').val(jQuery(this).val());
		});
		jQuery('input[name="byconsolewooodtrestro_widget_time_field"]').on('change',function(){
		jQuery('input[name="_byconsolewooodtrestro_delivery_time"]').val(jQuery(this).val());
		});
		jQuery('input[name="byconsolewooodtrestro_delivery_date"]').on('change',function(){
		jQuery('input[name="_byconsolewooodtrestro_widget_date_field"]').val(jQuery(this).val());
		});
		jQuery('input[name="byconsolewooodtrestro_delivery_time"]').on('change',function(){
		jQuery('input[name="_byconsolewooodtrestro_widget_time_field"]').val(jQuery(this).val());
		});
		
		
	//Guest count and purpose need to be shown only when dine in option is chosen
		//jQuery('input[name="_byconsolewooodtrestro_order_type"]').on('change',function(){
			if(jQuery('#_byconsolewooodtrestro_order_type_dinein').is(':checked')){
				jQuery('.form-row.byconsolewooodtrestro_guest_count').css({'display':'block'});
				jQuery('.form-row.byconsolewooodtrestro_guest_purpose').css({'display':'block'});
				}else{
					jQuery('.form-row.byconsolewooodtrestro_guest_count').css({'display':'none'});
					jQuery('.form-row.byconsolewooodtrestro_guest_purpose').css({'display':'none'});
					}
					
			//for widget
			if(jQuery('input[name=byconsolewooodtrestro_widget_type_field]:checked').val()=='dinein'){
				jQuery('.byconsolewooodtrestro_widget_guest_count_field').css({'display':'block'});
				jQuery('.byconsolewooodtrestro_widget_guest_purpose_field').css({'display':'block'});
				}else{
					jQuery('.byconsolewooodtrestro_widget_guest_count_field').css({'display':'none'});
					jQuery('.byconsolewooodtrestro_widget_guest_purpose_field').css({'display':'none'});
					}
			//})
			
});