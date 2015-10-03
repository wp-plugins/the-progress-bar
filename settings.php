<?php
	
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	
	function WPTime_wp_progress_bar_settings() {
		add_plugins_page( 'WP Progress Bar Settings', 'WP Progress Bar', 'manage_options', 'WPTime_wp_progress_bar_settings', 'WPTime_wp_progress_bar_settings_page');
	}
	add_action( 'admin_menu', 'WPTime_wp_progress_bar_settings' );
	
	function WPTime_wp_progress_bar_register_settings() {
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_text_color' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_background' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_progress_color' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_width' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_bottom' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_dis_box_shadow' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_ena_text_shadow' );
		register_setting( 'WPTime_wp_progress_bar_settings_fields', 'wpt_wppb_dis_css' );
	}
	add_action( 'admin_init', 'WPTime_wp_progress_bar_register_settings' );
		
	function WPTime_wp_progress_bar_settings_page(){ // page function
		if( get_option('wpt_wppb_text_color') ){
			$text_color = get_option('wpt_wppb_text_color');
		}else{
			$text_color = '';
		}
		
		if( get_option('wpt_wppb_background') ){
			$background = get_option('wpt_wppb_background');
		}else{
			$background = '';
		}
		
		if( get_option('wpt_wppb_progress_color') ){
			$progress_color = get_option('wpt_wppb_progress_color');
		}else{
			$progress_color = '';
		}
		
		if( get_option('wpt_wppb_width') ){
			$width = get_option('wpt_wppb_width');
		}else{
			$width = '';
		}
		
		if( get_option('wpt_wppb_bottom') ){
			$bottom = get_option('wpt_wppb_bottom');
		}else{
			$bottom = '';
		}
		
		$enable_text_shadow = get_option('wpt_wppb_ena_text_shadow');
		$disable_box_shadow = get_option('wpt_wppb_dis_box_shadow');
		$disable_css = get_option('wpt_wppb_dis_css');
		?>
			<div class="wrap">
				<h2>WP Progress Bar Settings</h2>
				<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
					<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Settings saved.</strong></p>
                        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } ?>
            	<form method="post" action="options.php">
                	<?php settings_fields( 'WPTime_wp_progress_bar_settings_fields' ); ?>
                	<table class="form-table">
                		<tbody>
                        
                    		<tr>
                        		<th scope="row"><label for="wpt_wppb_text_color">Text Color</label></th>
                            	<td>
                                    <input class="regular-text" name="wpt_wppb_text_color" type="text" id="wpt_wppb_text_color" value="<?php echo esc_attr( $text_color ); ?>">
                                    <p class="description">Enter text color code, default is #fff.</p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="wpt_wppb_background">Background</label></th>
                            	<td>
                                    <input class="regular-text" name="wpt_wppb_background" type="text" id="wpt_wppb_background" value="<?php echo esc_attr( $background ); ?>">
                                    <p class="description">Enter wrap background color code, default is #eee.</p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="wpt_wppb_progress_color">Progress Color</label></th>
                            	<td>
                                    <input class="regular-text" name="wpt_wppb_progress_color" type="text" id="wpt_wppb_progress_color" value="<?php echo esc_attr( $progress_color ); ?>">
                                    <p class="description">Enter progress bar color code, default is #bbb.</p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="wpt_wppb_width">Width</label></th>
                            	<td>
                                    <input class="regular-text" name="wpt_wppb_width" type="text" id="wpt_wppb_width" value="<?php echo esc_attr( $width ); ?>">
                                    <p class="description">Enter wrap width size, example: 200 (will be 200px), default is 100%.</p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="wpt_wppb_bottom">Margin Bottom</label></th>
                            	<td>
                                    <input class="regular-text" name="wpt_wppb_bottom" type="text" id="wpt_wppb_bottom" value="<?php echo esc_attr( $bottom ); ?>">
                                    <p class="description">Enter wrap margin bottom value, default is 30px.</p>
								</td>
                        	</tr>
                            
							<tr>
								<th scope="row">Enable Text Shadow</th>
									<td>
                                    	<fieldset>
                                        	<legend class="screen-reader-text"><span>Enable Text Shadow</span></legend>
                                            <label for="wpt_wppb_ena_text_shadow">
												<input name="wpt_wppb_ena_text_shadow" type="checkbox" id="wpt_wppb_ena_text_shadow" value="1" <?php checked( $enable_text_shadow, 1, true ); ?>>
												Enable text shadow in your progress bar text.
                                            </label>
										</fieldset>
								</td>
							</tr>
                            
							<tr>
								<th scope="row">Disable Box Shadow</th>
									<td>
                                    	<fieldset>
                                        	<legend class="screen-reader-text"><span>Disable Box Shadow</span></legend>
                                            <label for="wpt_wppb_dis_box_shadow">
												<input name="wpt_wppb_dis_box_shadow" type="checkbox" id="wpt_wppb_dis_box_shadow" value="1" <?php checked( $disable_box_shadow, 1, true ); ?>>
												Disable CSS3 box shadow from progress bar wrap.
                                            </label>
										</fieldset>
								</td>
							</tr>
                            
							<tr>
								<th scope="row">Disable Default CSS</th>
									<td>
                                    	<fieldset>
                                        	<legend class="screen-reader-text"><span>Disable Box Shadow</span></legend>
                                            <label for="wpt_wppb_dis_css">
												<input name="wpt_wppb_dis_css" type="checkbox" id="wpt_wppb_dis_css" value="1" <?php checked( $disable_css, 1, true ); ?>>
												If you want to use custom CSS, disable it, and add your custom CSS inside your style.css file.
                                            </label>
										</fieldset>
								</td>
							</tr>
                            
                            <tr>
								<th><label for="wpt-wppb-shortcode">Shortcode</label></th>
								<td>
                                	<textarea id="wpt-wppb-shortcode" rows="5" cols="80" style="white-space:nowrap;height:480px;">
### Usage

* Just use this shortcode:

	[wp_progress_bar text="Photoshop" pc="90"]
    
	now your photoshop skill will be 90%


### Shortcode Attributes

1. text="here enter your text, example: photoshop" default is none.

2. text_color="here enter text color code, example: #ff0" default is #fff.

3. background="here enter wrap background color, example: #ff0" default is #eee.

4. progress_color="here enter progress bar color, example: #ff0" default is #bbb.

5. pc="here enter percentage, example: 90" default is 0%.

6. width="here enter wrap width size, example: 200" default is 100%.

7. bottom="here enter wrap margin bottom value, example: 15" default is 30px.
                                	</textarea>
									<p class="description">Use this shortcode in your posts.</p>
                                </td>
							</tr>
                    	</tbody>
                    </table>
                    <p class="submit"><input id="submit" class="button button-primary" type="submit" name="submit" value="Save Changes"></p>
                </form>
            	<div class="tool-box">
					<h3 class="title">Recommended Links</h3>
					<p>Get collection of 87 WordPress themes for $69 only, a lot of features and free support! <a href="http://j.mp/ET_WPTime_ref_pl" target="_blank">Get it now</a>.</p>
					<p>See also:</p>
						<ul>
							<li><a href="http://j.mp/CM_WPTime" target="_blank">Premium WordPress themes on CreativeMarket.</a></li>
							<li><a href="http://j.mp/TF_WPTime" target="_blank">Premium WordPress themes on Themeforest.</a></li>
							<li><a href="http://j.mp/CC_WPTime" target="_blank">Premium WordPress plugins on Codecanyon.</a></li>
						</ul>
					<p><a href="http://j.mp/ET_WPTime_ref_pl" target="_blank"><img style="max-width:100%;" src="<?php echo plugins_url( '/banner/570x100.jpg', __FILE__ ); ?>"></a></p>
				</div>
            </div>
        <?php
	} // settings page function

?>