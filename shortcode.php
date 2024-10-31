<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function rsv_rss_add_dashboard_widgets() {
	wp_add_dashboard_widget('rsv_rss_dashboard_widget', 'RSV RSS First Feed Widget', 'rsv_rss_dashboard_widget_function');	
}
add_action( 'wp_dashboard_setup', 'rsv_rss_add_dashboard_widgets' );
/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function rsv_rss_dashboard_widget_function($atts) {
		$i = 0;
		
		$atts = shortcode_atts(
		array(
			'id' => 1
		), $atts);
		
global $wpdb;
 $rsv_rss_table_name = $wpdb->prefix . 'rsv_rss';
$results = $wpdb->get_results( 'SELECT * FROM '.$rsv_rss_table_name." where id=".$atts['id'] );
$url="";
foreach ( $results as $feeds ) {
	$url=$feeds->rssurl;
}

		if($url!=""){
		//$url = "http://rss.msn.com/en-in/";
		$rsv_rss = simplexml_load_file($url);
		//print '<h2><img style="vertical-align: middle;" src="'.$rsv_rss->channel->image->url.'" /> '.$rsv_rss->channel->title.'</h2>'; 
		//echo count($rsv_rss->channel->item);
	if(count($rsv_rss->channel->item)>=1){
	
		print "<ul class='rssList'>";
			foreach($rsv_rss->channel->item as $item) {
				if ($i < $feeds->numberoffeeds) { 
					print '<li style="clear:both;"><a href="'.$item->link.'" target="_blank">'.$item->title.'</a>';
					if($feeds->showdesc==1){
						print html_entity_decode($item->description);
					}
					print '</li>';
				}		
			$i++;
			}
		print "</ul>";
		
		echo '<style type="text/css">.rssList{margin:0; list-style:none;} .rssList li {border-bottom: 1px solid #f4f4f4;float: left;margin: 0;padding: 10px 0;width: 100%;} .rssList li:last-child{border:none;} .rssList li a{display: inline-block;}#rsv_rss_dashboard_widget .inside {display: inline-block;}</style>';
		
	}else{
		echo "<p style='color:red;'>No Feeds Found</p>";
	}
		
		}else{
			echo "<p style='color:red;'>Please check shortcode ID</p>";
		}
}


//[rsvrss]
add_shortcode( 'rsvrss', 'rsv_rss_dashboard_widget_function' );
?>