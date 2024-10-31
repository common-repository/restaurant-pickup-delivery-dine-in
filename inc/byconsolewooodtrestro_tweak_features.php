<?php 

/*
* Tweak Features
*/

global $byconsolewooodtrestro_guest_no;
global $byconsolewooodtrestro_guest_purpose;

function byconsolewooodtrestro_tweak_features_admin_form(){
?>
    <div class="wrap">
        <h1>Tweak Features</h1>
        <form method="post"  class="byconsolewooodtrestro_tweak_features_admin_form_settings" action="options.php" >
            <?php
			    settings_fields("tweakfeatures");  //Output nonce, action, and option_page fields for a settings page.
                do_settings_sections('byconsolewooodtrestro_free_tweak_features'); //Print out the settings fields for a particular settings section.
                submit_button();?>
        </form>
    </div>
<?php } 

    function byconsolewooodtrestro_tweak_features_guest_no_form(){
        $byconsolewooodtrestro_guest_no =  get_option('byconsolewooodtrestro_guest_no'); //Retrieves an option value based on an option name.
        
        if($byconsolewooodtrestro_guest_no == 'yes'){
            echo '<input type="checkbox" name="byconsolewooodtrestro_guest_no" id="byconsolewooodtrestro_guest_no" value="yes" checked>';  
        } else {
            echo '<input type="checkbox" name="byconsolewooodtrestro_guest_no" id="byconsolewooodtrestro_guest_no" value="yes">';
        }
        
    }

    function byconsolewooodtrestro_tweak_features_guest_purpose_form(){
        $byconsolewooodtrestro_guest_purpose =  get_option('byconsolewooodtrestro_guest_purpose'); //Retrieves an option value based on an option name.

        if($byconsolewooodtrestro_guest_purpose == 'yes'){
            echo '<input type="checkbox" name="byconsolewooodtrestro_guest_purpose" id="byconsolewooodtrestro_guest_purpose" value="yes" checked>';  
        } else {
            echo '<input type="checkbox" name="byconsolewooodtrestro_guest_purpose" id="byconsolewooodtrestro_guest_purpose" value="yes">';
            
        }
    }

    add_action("admin_init","byconsolewooodtrestro_tweak_features_setting_management");
    function byconsolewooodtrestro_tweak_features_setting_management(){

        add_settings_section("tweakfeatures","",null,"byconsolewooodtrestro_free_tweak_features");
        
        add_settings_field("byconsolewooodtrestro_tweak_features_guest_number", "Ask Guest Number", "byconsolewooodtrestro_tweak_features_guest_no_form", "byconsolewooodtrestro_free_tweak_features", "tweakfeatures" );
        add_settings_field("byconsolewooodtrestro_tweak_features_guest_purpose", "Ask Guest Purpose", "byconsolewooodtrestro_tweak_features_guest_purpose_form", "byconsolewooodtrestro_free_tweak_features", "tweakfeatures" );


        register_setting("tweakfeatures", "byconsolewooodtrestro_guest_no");
        register_setting("tweakfeatures", "byconsolewooodtrestro_guest_purpose");

    }
?>
