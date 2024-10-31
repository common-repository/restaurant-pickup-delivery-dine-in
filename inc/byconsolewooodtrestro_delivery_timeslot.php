<?php
function byconsolewooodtrestro_delivery_timeslot(){
	
	$byconsolewooodtrestro_delivery_timeslot_array = get_option('byconsolewooodtrestro_delivery_timeslot');
	
?>
	<div class="timeslot_container">
		<div class="ordertype_lable">
			<b>Delivery</b>
		</div> 
		
		<div class="timeslot_header">
			<div class="starttime_header"><b>Start Time</b></div>
			<div class="endtime_header"><b>End Time</b></div>
			<div class="days_header"><b>Days</b></div>
		</div>
		
		<ul class="byconsolewooodtrestro_delivery_timeslot">
		<?php
		if(!empty($byconsolewooodtrestro_delivery_timeslot_array)){
			
			end($byconsolewooodtrestro_delivery_timeslot_array);         // move the internal pointer to the end of the array
			$deliveryTimeslotLastKey = key($byconsolewooodtrestro_delivery_timeslot_array);

			foreach( $byconsolewooodtrestro_delivery_timeslot_array as $byconsolewooodtrestro_delivery_timeslot_key => $byconsolewooodtrestro_delivery_timeslot_array_val)
			{	
				$timeslotDaysArray = $byconsolewooodtrestro_delivery_timeslot_array_val['time_slot_for_day'];
				
				/*
				if(in_array('1',$timeslotDaysArray)){
					$mondayChecked = 'checked';
				}else{
					$mondayChecked = '';
				}
				if(in_array('2',$timeslotDaysArray)){
					$tuedayChecked = 'checked';
				}else{
					$tuedayChecked = '';
				}
				if(in_array('3',$timeslotDaysArray)){
					$weddayChecked = 'checked';
				}else{
					$weddayChecked = '';
				}
				if(in_array('4',$timeslotDaysArray)){
					$thudayChecked = 'checked';
				}else{
					$thudayChecked = '';
				}
				if(in_array('5',$timeslotDaysArray)){
					$fridayChecked = 'checked';
				}else{
					$fridayChecked = '';
				}
				if(in_array('6',$timeslotDaysArray)){
					$satdayChecked = 'checked';
				}else{
					$satdayChecked = '';
				}
				if(in_array('7',$timeslotDaysArray)){
					$sundayChecked = 'checked';
				}else{
					$sundayChecked = '';
				}
				*/
				?>
				<li class="delivery_timeslot_container_<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>" style="margin-bottom: 20px;">
				
					<div class="delivery_timeslot_container_<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>" style="width: 100%;">
					
						<div class="starttime_body">
							<input type="time" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][start_timeslot]" id="byconsolewooodtrestro_delivery_timeslot"  value="<?php echo $byconsolewooodtrestro_delivery_timeslot_array_val['start_timeslot'];?>" />
						</div>
						<div  class="endtime_body">
							<input type="time" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][end_timeslot]" id="byconsolewooodtrestro_delivery_timeslot" value="<?php echo $byconsolewooodtrestro_delivery_timeslot_array_val['end_timeslot'];?>" />
						</div>    
						<div class="days_body"> 
						
							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Mon</span>
					   
							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Tue</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Wed</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Thu</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Fri</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Sat</span>
							
							<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[<?php echo $byconsolewooodtrestro_delivery_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Sun</span>
							
						</div> 
						<span id="del_delivery_timeslot" class="" style="" >X</span>
					</div>
				</li>
				<?php					
				
			}
			
		}else{
			
			$deliveryTimeslotLastKey = 0;
		?>
			<li class="delivery_timeslot_container_0" style="margin-bottom: 20px;">
			
				<div class="delivery_timeslot_container_0" style="width: 100%;">
				
					<div class="starttime_body">
						<input type="time" name="byconsolewooodtrestro_delivery_timeslot[0][start_timeslot]" id="byconsolewooodtrestro_delivery_timeslot"  value="" />
					</div>
					<div  class="endtime_body">
						<input type="time" name="byconsolewooodtrestro_delivery_timeslot[0][end_timeslot]" id="byconsolewooodtrestro_delivery_timeslot" value="" />
					</div>    
					<div class="days_body"> 

						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Mon</span>
				   
						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Tue</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Wed</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Thu</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Fri</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Sat</span>
						
						<span><input type="checkbox" name="byconsolewooodtrestro_delivery_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_delivery_timeslot" checked />Sun</span>
						
					</div>        
				</div>
			</li>
			<?php			
		}
		?>	
		<div class="byconsolewooodtrestro_delivery_timeslot_more_options"></div>
		</ul>
		
		
		
		<input type="hidden" name="byconsolewooodtrestro_delivery_timeslot_count_hidden_field" id="byconsolewooodtrestro_delivery_timeslot_count_hidden_field" value="<?php echo $deliveryTimeslotLastKey;?>" />

		<div class="fldst" style="clear: both;">
		 <input type="button" id="btn_byconsolewooodtrestro_delivery_timeslot_add_another" class="byconsolewooodtrestro_delivery_timeslot" value="Add" onclick="byconsolewooodtrestro_delivery_timeslot_add_another(this)" >
		</div>
 
	</div>
	<hr/>
    <script>
    jQuery(".days_body input[type=checkbox]").click(function(){alert("This feature is available on pro version only!"); return false;});
    </script>
<?php	
}
?>