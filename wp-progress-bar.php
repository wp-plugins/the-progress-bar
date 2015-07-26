<?php
/*
Plugin Name: WP Progress Bar
Plugin URI: http://wp-plugins.in/wordpress-progress-bar-plugin
Description: Add progress bar in your posts easily, responsive and retina, full customize, compatible with all major browsers.
Version: 1.0.0
Author: Alobaidi
Author URI: http://wp-plugins.in
License: GPLv2 or later
*/

/*  Copyright 2015 Alobaidi (email: wp-plugins@outlook.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


// Add plugin meta links
function WPTime_wp_progress_bar_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'wp-progress-bar.php' ) !== false ) {
		
		$new_links = array(
						'<a href="http://wp-plugins.in/wordpress-progress-bar-plugin" target="_blank">Explanation of Use</a>',
						'<a href="https://profiles.wordpress.org/alobaidi#content-plugins" target="_blank">More Plugins</a>',
						'<a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Elegant Themes</a>',
					);
		
		$links = array_merge( $links, $new_links );
		
	}
	
	return $links;
	
}
add_filter( 'plugin_row_meta', 'WPTime_wp_progress_bar_plugin_row_meta', 10, 2 );


// Add settings page link in before activate/deactivate links.
function WPTime_wp_progress_bar_plugin_action_links( $actions, $plugin_file ){
	
	static $plugin;

	if ( !isset($plugin) ){
		$plugin = plugin_basename(__FILE__);
	}
		
	if ($plugin == $plugin_file) {
		
		if ( is_ssl() ) {
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=WPTime_wp_progress_bar_settings', 'https' ).'">Settings</a>';
		}else{
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=WPTime_wp_progress_bar_settings', 'http' ).'">Settings</a>';
		}
		
		$settings = array($settings_link);
		
		$actions = array_merge($settings, $actions);
			
	}
	
	return $actions;
	
}
add_filter( 'plugin_action_links', 'WPTime_wp_progress_bar_plugin_action_links', 10, 5 );


// Include Settings page
include(plugin_dir_path(__FILE__).'/settings.php');


// Add progress bar shortcode
function WPTime_progress_bar_shortcode($atts, $content = null){
	
	/* Get default options from settings page */
	if(get_option('wpt_wppb_text_color')){
		$op_text_color = get_option('wpt_wppb_text_color');
	}else{
		$op_text_color = '';
	}
	
	if(get_option('wpt_wppb_background')){
		$op_background = get_option('wpt_wppb_background');
	}else{
		$op_background = '';
	}
	
	if(get_option('wpt_wppb_progress_color')){
		$op_progress_color = get_option('wpt_wppb_progress_color');
	}else{
		$op_progress_color = '';
	}
	
	if(get_option('wpt_wppb_width')){
		$op_width = get_option('wpt_wppb_width');
	}else{
		$op_width = '';
	}
	
	if(get_option('wpt_wppb_bottom')){
		$op_bottom = get_option('wpt_wppb_bottom');
	}else{
		$op_bottom = '30';
	}
	
	/* Shortcode atts */
	extract(
		shortcode_atts(
			array(
				'text'			  =>	'',
				'text_color'	  =>	$op_text_color,
				'background'	  =>	$op_background,
				'progress_color'  =>	$op_progress_color,
				'pc'		  	  =>	'',
				'width'			  =>	$op_width,
				'bottom'		  =>	$op_bottom
			),$atts
		)
	);
	
	if( !empty($text_color) ){
		$color = ' style="color:'.$text_color.';"';
	}else{
		$color = null;
	}
	
	if( !empty($pc) ){
		if( preg_match('/(%)/', $pc) ){
			$pc_mark = null;
		}else{
			$pc_mark = '%';
		}
		$the_pc = $pc.$pc_mark;
	}else{
		if( $pc == '0' ){
			$the_pc = '0%';
		}else{
			$the_pc =  null;
		}
	}
	
	if( !empty($text) ){
		$the_text = $text.' ';
	}else{
		$the_text = null;
	}
	
	if( !empty($text) or !empty($pc) or !empty($text_color) ){
		$span = '<span'.$color.'>'.$the_text.''.$the_pc.'</span>';
	}else{
		$span = null;
	}
	
	if( !empty($background) ){
		$bg = 'background:'.$background.';';
	}else{
		$bg = null;
	}
	
	if( !empty($width) ){
		
		if( preg_match('/(%)|(px)/', $op_width) or preg_match('/(%)|(px)/', $width) ){
			$px = null;
		}
		else{
			$px = 'px';
		}
		
		$max_width = 'max-width:'.$width.$px.';';
	}else{
		$max_width = null;
	}
	
	if( empty($bottom) or $bottom == '0' ){
		$margin_bottom = 'margin-bottom:0px;';
	}
	else{
		if( preg_match('/(%)|(px)/', $op_bottom) or preg_match('/(%)|(px)/', $bottom) ){
			$px = null;
		}else{
			$px = 'px';
		}
		$margin_bottom = 'margin-bottom:'.$bottom.$px.';';
	}
	
	if( !empty($width) or !empty($background) or !empty($bottom) or empty($bottom) or $bottom == '0' ){
		$wrap_style = ' style="'.$max_width.$bg.$margin_bottom.'"';
	}else{
		$wrap_style = null;
	}
	
	if( !empty($progress_color) ){
		$p_color = 'background:'.$progress_color.';';
	}else{
		$p_color = null;
	}
	
	if( !empty($pc) ){
		if( preg_match('/(%)/', $pc) ){
			$pc_mark = null;
		}else{
			$pc_mark = '%';
		}
		
		$pece = 'width:'.$pc.$pc_mark.';';
	}else{
		$pece = null;
	}
	
	if( !empty($progress_color) or !empty($pc) ){
		$progress_style = ' style="'.$p_color.$pece.'"';
	}else{
		$progress_style = null;
	}
	
	return '<div class="wptime-plugin-progress-wrap"'.$wrap_style.'><div class="wptime-plugin-progress-bar"'.$progress_style.'></div>'.$span.'</div>';
}
add_shortcode('wp_progress_bar', 'WPTime_progress_bar_shortcode');


// Add CSS for progress bar shortcode
function WPTime_progress_bar_css(){
	if( !get_option('wpt_wppb_dis_css') ){ ?>
    	<style type="text/css">
			.wptime-plugin-progress-wrap{
				display:block !important;
				max-width:100%;
				background:#eee;
				line-height:1 !important;
				position:relative !important;
				<?php if( !get_option('wpt_wppb_dis_box_shadow') ) : ?>
					box-shadow: 0px  0px 5px 1px rgba(0, 0, 0, 0.03) inset !important;
					-moz-box-shadow: 0px  0px 5px 1px rgba(0, 0, 0, 0.03) inset !important;
					-webkit-box-shadow: 0px  0px 5px 1px rgba(0, 0, 0, 0.03) inset !important;
				<?php endif; ?>
			}

			.wptime-plugin-progress-bar{
				width:0%;
				display:block !important;
				background:#bbb;
				height:30px !important;
				box-sizing:border-box !important;
				-webkit-box-sizing:border-box !important;
				-moz-box-sizing:border-box !important;
			}

			.wptime-plugin-progress-wrap span{
				position:absolute !important;
				left:10px !important;
				top:10px !important;
				font-size:12px !important;
				color:#fff;
				line-height:1 !important;
				<?php if( get_option('wpt_wppb_ena_text_shadow') ) : ?>
					text-shadow:rgba(0, 0, 0, 0.50) 1px 1px 1px !important;
				<?php endif; ?>
			}
			
			@media all and (max-width: 768px){
				.wptime-plugin-progress-wrap{
					max-width:100% !important;
				}
			}
		</style>
    <?php }
}
add_action('wp_head', 'WPTime_progress_bar_css');

?>