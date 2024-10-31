<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action( 'admin_menu', 'rsv_rss_plugin_menu' );
function rsv_rss_plugin_menu() {
add_menu_page( 'RSV RSS', 'RSV RSS', 'manage_options', 'rsv-rss-unique-identifier', 'rsv_rsss_plugin_options', 'dashicons-rss', 6 );
}


function rsv_rsss_plugin_options() {
 include("insertdata.php");


if ( !current_user_can( 'manage_options' ) )  {
wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}


echo '<div class="wrap">';
?>

<h2>RSV RSS Options</h2>
<?php
include("viewdata.php");
?>
<form method="post" action="">
  <table class="addRssTable">
    <tr>
      <th scope="row"><label for="subject">Rss Feed URL</label> <button class="add_field_button" title="Add More RSS Feeds">Add More URL's</button></th>
    </tr>
    <tr>
      <td><div class="input_fields_wrap">
          
          <div>
            <input type="url" name="feedurl[]" required class="regular-text" placeholder="Please Enter URL">
            <input type="number" name="numberoffeeds[]" required class="regular-text" placeholder="Please Enter Number of Feeds to Display" value="10" min="1">
            <select name="showdesc[]" required class="regular-text">
            <option value="0">Show Description</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
            </select>
            
            
          </div>
        </div></td>
    </tr>
    
    <tr>
      <th scope="row"><?php wp_nonce_field( 'rsv_rss_my_action', 'rsv_rss_nonce_field' ); ?><input type="submit" value="Save" class="button button-primary" id="save" name="rsv_data_save"></th>
    </tr>
    
  </table>

</form>
<script type="text/javascript">
jQuery(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
    var add_button      = jQuery(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    jQuery(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            jQuery(wrapper).append('<div><input type="text" name="feedurl[]" required class="regular-text" placeholder="Please Enter URL"/><a href="#" class="remove_field"><img src="<?php echo plugins_url( 'images/delete.png', __FILE__ ); ?>" title="Delete Fields"></a><input type="number" name="numberoffeeds[]" required class="regular-text" placeholder="Please Enter Number of Feeds to Display" value="10" min="1"><select name="showdesc[]" required class="regular-text"><option value="0">Show Description</option><option value="1">Yes</option><option value="0">No</option></select></div>'); //add input box
        }
    });
   
    jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    })
});
</script>
<?php	
	echo '</div>';
}
?>