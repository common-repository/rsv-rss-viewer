<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;
 $rsv_rss_table_name = $wpdb->prefix . 'rsv_rss';

$charset_collate = $wpdb->get_charset_collate();
$sql = "CREATE TABLE $rsv_rss_table_name (
id mediumint(9) AUTO_INCREMENT,
  rssurl varchar(500),
  numberoffeeds int(5),
  showdesc int(2),
  PRIMARY  KEY (id)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );



if ( isset( $_POST['rsv_rss_nonce_field'] )) {
	if(!wp_verify_nonce( $_POST['rsv_rss_nonce_field'], 'rsv_rss_my_action' )){
		print 'Sorry, your nonce did not verify.';
   		exit;
	}else{
		foreach($_POST['feedurl'] as $k=>$v){
			$url=sanitize_text_field($v);
			$numberoffeeds=sanitize_text_field($_POST['numberoffeeds'][$k]);
			$showdesc=sanitize_text_field($_POST['showdesc'][$k]);
			
			$wpdb->insert( $rsv_rss_table_name, array( 'rssurl' => $url,'numberoffeeds'=>$numberoffeeds,'showdesc'=>$showdesc), array( '%s', '%d', '%d'));   
		}
	}   
}

?>