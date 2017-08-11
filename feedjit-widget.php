<?php
/*
Plugin Name: Feedjit Widget
Plugin URI: http://www.premiumagc.com/feedjit-widget/
Description: Live Traffic Feed on Your WordPress.
Version: 0.2
Author: Teguh Aditya
Author URI: http://www.teguhaditya.com/
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
*/
/*
    Copyright (C) 2010 - 2011 Teguh Aditya (email : teguhaditya@ovi.com)
*/
/*
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
?>
<?php
add_action( 'widgets_init', 'fj_init' );
function fj_init() {
register_widget( 'fj_register' );
}
class fj_register extends WP_Widget {
function fj_register() {
$widget_ops = array( 'classname' => 'fj_register', 'description' => __('This Widget will show the Live Traffic Feed your 

WordPress from another website', 'Feedjit_Widget') );
$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'feedjit-widget' );
$this->WP_Widget( 'feedjit-widget', __('Feedjit Widget', 'Feedjit_Widget'), $widget_ops, $control_ops );
					}
function widget( $args, $instance ) {
	extract( $args );
	$title = apply_filters('widget_title', $instance['title'] );
	$fj_lebar = $instance['fj_lebar'];
	$fj_bg = $instance['fj_bg'];
	$fj_status = $instance['fj_status'];
	echo $before_widget;
	echo $before_title . $title . $after_title;
	if( $fj_status == 'enabled') {
		echo '<center><script type="text/javascript" src="http://feedjit.com/serve/?

bc='.$fj_bg.'&tc=494949&brd1=ffffff&lnk=494949&hc=336699&ww='.$fj_lebar.'"></script></center>';
		echo '<center><font size="1"><a href="http://wordpress.org/extend/plugins/feedjit-widget/">Feedjit Widget</a></font></center>';
		} else {
		echo '<center>Live Traffic Feed Disabled</center><br />';
		echo '<center><font size="1"><a href="http://wordpress.org/extend/plugins/feedjit-widget/">Feedjit Widget</a></font></center>';
		}
	echo $after_widget;
	}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['fj_lebar'] = $new_instance['fj_lebar'];
	$instance['fj_bg'] = $new_instance['fj_bg'];
	$instance['fj_status'] = $new_instance['fj_status'];
	return $instance;
	}

function form( $instance ) {
	$defaults = array( 'title' => __('Live Traffic Feed', 'Live Traffic Feed'), 'fj_lebar' => '160', 'fj_bg' => 'FFFFFF',  'fj_status' => 

'enabled' );
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
	<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" 

value="<?php echo $instance['title']; ?>" style="width:100%;" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'fj_lebar' ); ?>"><?php _e('Feedjit Width:', 'fj_lebar'); ?></label>
	<input id="<?php echo $this->get_field_id( 'fj_lebar' ); ?>" name="<?php echo $this->get_field_name( 'fj_lebar' ); ?>" value="<?php echo $instance['fj_lebar']; ?>" style="width:100%;" />
	</p>		
	<p>
	<label for="<?php echo $this->get_field_id( 'fj_bg' ); ?>"><?php _e('Feedjit Background Color:', 'fj_bg'); ?></label>
	<input id="<?php echo $this->get_field_id( 'fj_bg' ); ?>" name="<?php echo $this->get_field_name( 'fj_bg' ); ?>" value="<?php echo $instance['fj_bg']; ?>" style="width:100%;" />
	</p>		
	<p>
	<label for="<?php echo $this->get_field_id( 'fj_status' ); ?>"><?php _e('Widget Status:', 'fj_status'); ?></label> 
	<select id="<?php echo $this->get_field_id( 'fj_status' ); ?>" name="<?php echo $this->get_field_name( 'fj_status' ); 

?>" class="widefat" style="width:100%;">
	<option <?php if ( 'enabled' == $instance['fj_status'] ) echo 'selected="selected"'; ?>>enabled</option>
	<option <?php if ( 'vertical' == $instance['fj_status'] ) echo 'selected="selected"'; ?>>disabled</option>
	</select>
	</p>
<?php
}
}
?>