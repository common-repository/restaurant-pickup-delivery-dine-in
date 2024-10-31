<?php
function byconsolewooodtrestro_pickup_timeslot(){
	
	$byconsolewooodtrestro_pickup_timeslot_array = get_option('byconsolewooodtrestro_pickup_timeslot');
	
?>
	<div class="timeslot_container">
		<div class="ordertype_lable">
			<b>Pickup</b>
		</div> 
		
		<div class="timeslot_header">
			<div class="starttime_header"><b>Start Time</b></div>
			<div class="endtime_header"><b>End Time</b></div>
			<div class="days_header"><b>Days</b></div>
		</div>
		
		<ul class="byconsolewooodtrestro_pickup_timeslot">
		<?php
		if(!empty($byconsolewooodtrestro_pickup_timeslot_array)){
			
			end($byconsolewooodtrestro_pickup_timeslot_array);         // move the internal pointer to the end of the array
			$pickupTimeslotLastKey = key($byconsolewooodtrestro_pickup_timeslot_array);

			foreach( $byconsolewooodtrestro_pickup_timeslot_array as $byconsolewooodtrestro_pickup_timeslot_key => $byconsolewooodtrestro_pickup_timeslot_array_val)
			{	
				$timeslotDaysArray = $byconsolewooodtrestro_pickup_timeslot_array_val['time_slot_for_day'];
				
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
				<li class="pickup_timeslot_container_<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>" style="margin-bottom: 20px;">
				
					<div class="pickup_timeslot_container_<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>" style="width: 100%;">
					
						<div class="starttime_body">
							<input type="time" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][start_timeslot]" id="byconsolewooodtrestro_pickup_timeslot" value="<?php echo $byconsolewooodtrestro_pickup_timeslot_array_val['start_timeslot'];?>" />
						</div>
						<div  class="endtime_body">
							<input type="time" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][end_timeslot]" id="byconsolewooodtrestro_pickup_timeslot" value="<?php echo $byconsolewooodtrestro_pickup_timeslot_array_val['end_timeslot'];?>" />
						</div>    
						<div class="days_body">

							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Mon</span>
					   
							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Tue</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Wed</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Thu</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Fri</span>

							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Sat</span>
							
							<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[<?php echo $byconsolewooodtrestro_pickup_timeslot_key;?>][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Sun</span>
							
						</div> 
						<span id="del_pickup_timeslot" class="" style="" >X</span>
					</div>
				</li>
				<?php					
				
			}
			
		}else{
			
			$pickupTimeslotLastKey = 0;
		?>
			<li class="pickup_timeslot_container_0" style="margin-bottom: 20px;">
			
				<div class="pickup_timeslot_container_0" style="width: 100%;">
				
					<div class="starttime_body">
						<input type="time" name="byconsolewooodtrestro_pickup_timeslot[0][start_timeslot]" id="byconsolewooodtrestro_pickup_timeslot"  value="" />
					</div>
					<div  class="endtime_body">
						<input type="time" name="byconsolewooodtrestro_pickup_timeslot[0][end_timeslot]" id="byconsolewooodtrestro_pickup_timeslot" value="" />
					</div>    
					<div class="days_body"> 

						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Mon</span>
				   
						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Tue</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Wed</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Thu</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Fri</span>

						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Sat</span>
						
						<span><input type="checkbox" name="byconsolewooodtrestro_pickup_timeslot[0][time_slot_for_day][]" id="byconsolewooodtrestro_pickup_timeslot" checked />Sun</span>
						
					</div>        
				</div>
			</li>
			<?php			
		}
		?>	
		<div class="byconsolewooodtrestro_pickup_timeslot_more_options"></div>
		</ul>
		
		
		
		<input type="hidden" name="byconsolewooodtrestro_pickup_timeslot_count_hidden_field" id="byconsolewooodtrestro_pickup_timeslot_count_hidden_field" value="<?php echo $pickupTimeslotLastKey;?>" />

		<div class="fldst" style="clear: both;">
		 <input type="button" id="btn_byconsolewooodtrestro_pickup_timeslot_add_another" class="byconsolewooodtrestro_pickup_timeslot" value="Add" onclick="byconsolewooodtrestro_pickup_timeslot_add_another(this)" >
		</div>
 
	</div>
	<hr/>
    <script>
    jQuery(".days_body input[type=checkbox]").click(function(){alert("This feature is available on pro version only!"); return false;});
    </script>

<?php	
}
?>