<?php
/**
 * Plugin Name: Hot Weather Widget
 * Plugin URI: http://hotwptemplates.com
 * Description:  HOT WordPress HOT Weather widget helps you to inform your visitors about weather conditions for the selected city! Just enter your ZIP code and select simple mode or 3D mode and you're done! You can also select units (Fahrenheit or Celsius) depending of your preference.
 * Version:1.0
 * Author: hotwptemplates.com
 * Author URI: http://hotwptemplates.com
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'hot_weather_load_widgets' );
add_action('admin_init', 'hot_weather_textdomain');
/**
 * Register our widget.
 * 'HotEffectsRotator' is the widget class used below.
 *
 * @since 0.1
 */
function hot_weather_load_widgets() {
	register_widget( 'Weather' );
}

function hot_weather_textdomain() {
	load_plugin_textdomain('hot_weather', false, dirname(plugin_basename(__FILE__) ) . '/languages');
}
	
/**
 * Weather Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */


 
class Weather extends WP_Widget {
     
	/**
	 * Widget setup.
	 */
	 
	function Weather() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Hot_weather', 'description' => __('Hot Weather', 'hot_weather') );

		/* Widget control settings. */
		$control_ops = array(  'id_base' => 'hot-weather' );

		/* Create the widget. */
		$this->WP_Widget( 'hot-weather', __('Hot Weather', 'hot_weather'), $widget_ops, $control_ops );
		
		add_action('wp_print_styles', array( $this, 'HotWeather_styles'),12);
		add_action('admin_init', array( $this,'admin_utils'));
    }
	
	function HotWeather_styles(){
		wp_enqueue_script( 'hot-weather', plugins_url('/swfobject_modified.js', __FILE__),false,'1.0.0');
	
	}
	
	function admin_utils(){
		    //
	}

	function GetDefaults()
	{
	  return array( 
                     'moduleclass_sfx' => ''
					,'displayType' => '1'
					,'units' => '0'
					,'zipCode' => '19119'
             );
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
	   extract( $args );
       echo $before_widget;
       //--------------------------------------------------------------------------------------------------------------------------------------------
	   //--------------------------------------------------------------------------------------------------------------------------------------------
	 
        $defaults = $this->GetDefaults();
		$instance = wp_parse_args( (array) $instance, $defaults );  
		
		
		?>
		
	   <?php //-------------------------RENDER START----------------------------------------------?>

		

		<div align="center">

		<?php if ($instance['displayType'] == '0') { ?>

		<object id="FlashID<?php echo $this->number;?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="184" height="76">
		  <param name="movie" value="http://www.weatherlet.com/weather.swf?locid=<?php echo $instance['zipCode']; ?>&amp;unit=<?php if ($instance['units']=='0') { echo "s"; }else{ echo "m"; } ?>" />
		  <param name="quality" value="high" />
		  <param name="wmode" value="transparent" />
		  <param name="swfversion" value="8.0.35.0" />
		  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
		  <param name="expressinstall" value="<?php echo plugins_url('/expressInstall.swf', __FILE__); ?>" />
		  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
		  <!--[if !IE]>-->
		  <object type="application/x-shockwave-flash" data="http://www.weatherlet.com/weather.swf?locid=<?php echo $instance['zipCode']; ?>&amp;unit=<?php if ($instance['units']=='0') { echo "s"; }else{ echo "m"; } ?>" width="184" height="76">
			<!--<![endif]-->
			<param name="quality" value="high" />
			<param name="wmode" value="transparent" />
			<param name="swfversion" value="8.0.35.0" />
			<param name="expressinstall" value="<?php echo plugins_url('/expressInstall.swf', __FILE__); ?>" />
			<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
			<div>
			  <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
			  <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
			</div>
			<!--[if !IE]>-->
		  </object>
		  <!--<![endif]-->
		</object>

		<?php }else{ ?>

		<object id="FlashID<?php echo $this->number;?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="300" height="150">
			<param name="movie" value="http://www.weatherlet.com/forecast.swf?locid=<?php echo $instance['zipCode']; ?>&amp;unit=<?php if ($instance['units']==0) { echo "s"; }else{ echo "m"; } ?>" />
			<param name="quality" value="high" />
			<param name="wmode" value="transparent" />
			<param name="swfversion" value="8.0.35.0" />
			<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
			<param name="expressinstall" value="<?php echo plugins_url('/expressInstall.swf', __FILE__); ?>" />
			<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
			<!--[if !IE]>-->
			<object type="application/x-shockwave-flash" data="http://www.weatherlet.com/forecast.swf?locid=<?php echo $instance['zipCode']; ?>&amp;unit=<?php if ($instance['units']=='0') { echo "s"; }else{ echo "m"; } ?>" width="300" height="150">
			  <!--<![endif]-->
			  <param name="quality" value="high" />
			  <param name="wmode" value="transparent" />
			  <param name="swfversion" value="8.0.35.0" />
			  <param name="expressinstall" value="<?php echo plugins_url('/expressInstall.swf', __FILE__); ?>" />
			  <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
			  <div>
				<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
			  </div>
			  <!--[if !IE]>-->
			</object>
			<!--<![endif]-->
		  </object>

		<?php } ?>

		<script type="text/javascript">
		<!--
		swfobject.registerObject("FlashID<?php echo $this->number;?>");
		//-->
		</script>

		</div>
	   
	   <?php //-------------------------RENDER END-------------------------------------------------?>
	   <?php 
	   //--------------------------------------------------------------------------------------------------------------------------------------------
	   //--------------------------------------------------------------------------------------------------------------------------------------------
	   
	   echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
    	
		foreach($new_instance as $key => $option)
		{
		  $instance[$key]     = $new_instance[$key];
		} 
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
	    $defaults = $this->GetDefaults();
		$instance = wp_parse_args( (array) $instance, $defaults );  ?>

		<!-- Widget Title: Text Input -->


<table style="width:355px;margin-left:-130px;background:white;border:Solid 1px Gray;border-top:Solid 4px Gray;" class="hot_weather_property_table_<?php echo $this->number ;?>" cellpadding="3">
<tr>
							
							<tr>
							<td>
							<?php _e('Display way','hot_weather'); ?>?
							</td>
							<td>
							<select class="select" id="<?php echo $this->get_field_id( 'displayType' ); ?>" name="<?php echo $this->get_field_name( 'displayType' ); ?>" >
							
								<option value="0"  >
								<?php _e('Small Widget', 'hot_weather'); ?>
								</option>
							
								<option value="1"  >
								<?php _e('3D Widget', 'hot_weather'); ?>
								</option>
							
							</select>
							<script type="text/javascript">
							document.getElementById('<?php echo $this->get_field_id( 'displayType' ); ?>').value = "<?php echo $instance['displayType']; ?>";
							</script>
							</td>
							</tr>
						

							<tr>
							<td>
							<?php _e('Units','hot_weather'); ?>?
							</td>
							<td>
							<select class="select" id="<?php echo $this->get_field_id( 'units' ); ?>" name="<?php echo $this->get_field_name( 'units' ); ?>" >
							
								<option value="0"  >
								<?php _e('Farenheit', 'hot_weather'); ?>
								</option>
							
								<option value="1"  >
								<?php _e('Celsius', 'hot_weather'); ?>
								</option>
							
							</select>
							<script type="text/javascript">
							document.getElementById('<?php echo $this->get_field_id( 'units' ); ?>').value = "<?php echo $instance['units']; ?>";
							</script>
							</td>
							</tr>
						
							<tr>
							<td>
							<?php _e('ZIP Code','hot_weather'); ?>
							</td>
							<td>
							<input type="text" name="<?php echo $this->get_field_name( 'zipCode' ); ?>" id="<?php echo $this->get_field_id( 'zipCode' ); ?>" value="<?php echo $instance['zipCode']; ?>" class="numeric" />
							</td>
							</tr>

					

</table> 		
		
<script type="text/javascript" >
   try{ 
    jQuery('.widgets-holder-wrap .widget').css({
		'overflow':'visible'
    });
	
   }catch(exc){}
</script>

	<?php  
	}
}

?>