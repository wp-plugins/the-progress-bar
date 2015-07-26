<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// if not uninstalled plugin
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit(); // out.


/*esle:
	if uninstalled plugin, this options will be deleted.
*/
delete_option('wpt_wppb_text_color');
delete_option('wpt_wppb_background');
delete_option('wpt_wppb_progress_color');
delete_option('wpt_wppb_width');
delete_option('wpt_wppb_bottom');
delete_option('wpt_wppb_ena_text_shadow');
delete_option('wpt_wppb_dis_box_shadow');
delete_option('wpt_wppb_dis_css');

?>