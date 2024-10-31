<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(isset($_GET['id'])){
global $wpdb;
 $rsv_rss_table_name = $wpdb->prefix . 'rsv_rss';

$id = $_GET['id']; // get post_id for POST or GET or Query. You know
	$wpdb->delete(
		$rsv_rss_table_name,
		array(
			'id' => $id
			) // End array
		); // End delete
}
?>

<?php
$results = $wpdb->get_results( $wpdb->prepare('SELECT * FROM '.$rsv_rss_table_name." ORDER BY id") );

if(count($results) !=0){
?>

<table class="rssDataTable">
  <tr>
    <th scope="col" width="30">ID</th>
    <th scope="col">RSS URL</th>
    <th scope="col" width="120">Shortcode</th>
    <th scope="col" width="40">Feeds</th>
    <th scope="col" width="80">Show Desc</th>
     <th scope="col" width="20">&nbsp;</th>
  </tr>
  <?php
$userdata = get_userdata( $e->ID );
foreach ( $results as $feeds ) {
	//echo $feeds->rssurl."<br>";
	//echo $feeds->id."<br>";
	?>

  <tr>
    <td><?php echo $feeds->id; ?></td>
    <td><?php echo $feeds->rssurl; ?></td>
    <td>[rsvrss id=<?php echo $feeds->id; ?>]</td>
    <td><?php echo $feeds->numberoffeeds; ?></td>
    <td><?php echo ($feeds->showdesc==1)?"Yes":"No"; ?></td>
    <td><a href="<?php get_edit_user_link( $e->ID ); ?>?page=rsv-rss-unique-identifier&id=<?php echo $feeds->id; ?>"><img src="<?php echo plugins_url( 'images/delete.png', __FILE__ ); ?>" style="width:20px; height:auto;" title="Delete Feed"></a></td>
  </tr>

<?php
}
?>
</table>

<?php
}else{
	?>
    <div class="error">
          <p><strong>No Feeds Found</strong> Please add feeds.</p>
				</div>
    <?php
}
?>
<style type="text/css">
.rssDataTable{
	width:100%;	
	border-collapse:collapse;
}
.rssDataTable td, .rssDataTable th{
	border:1px solid #d6d6d6;
	padding:5px;
	text-align:left;
}
.rssDataTable th{
	background-color:#E4E4E4;	
	padding:10px 5px;
}
.rssDataTable tr:nth-child(2n+2){
	background-color:#f4f4f4;	
}
.addRssTable {
  margin-top: 20px;
  text-align: left;
  width: 100%;
  border-collapse: collapse;
}
.addRssTable th, .addRssTable td {
  border: 1px solid #d6d6d6;
  padding: 10px;
}
.addRssTable th{
	background-color:#e4e4e4;
}
.add_field_button {
  background: green none repeat scroll 0 0;
  border: medium none;
  color: #fff;
  cursor: pointer;
  float: right;
  padding: 5px 15px;
}
.add_field_button:hover {
  color: #faf700;
}
.input_fields_wrap .regular-text {
  margin: 0 0 10px;
  width: 100%;
}
.input_fields_wrap .regular-text[type='url'] {
  padding: 5px 25px 5px 5px;
}
.input_fields_wrap > div {
  border-bottom: 1px solid #ccc;
  margin-bottom: 15px;
  padding-bottom: 5px;
  position: relative;
}

.input_fields_wrap > div:last-child {
  border: none;
  margin-bottom: 0px;
  padding-bottom: 0px;
}

.input_fields_wrap .remove_field {
  position: absolute;
  right: 5px;
  top: 6px;
}
.remove_field > img {
  height: auto;
  width: 15px;
}
</style>