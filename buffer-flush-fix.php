<?php

/*
Plugin Name: Buffer Flush Fix
Description: If you've run into the error "failed to send buffer of zlib output compression" with WordPress, this simple plugin fixes the issue.
Version: 1.0
Plugin URI: http://wordpress.org/plugins/buffer-flush-fix/
Author: Openwrite
Author URI: https://openwrite.xyz
*/


if(has_action('shutdown', 'wp_ob_end_flush_all') !== false) {

	//define fixed flush function
	function wp_ob_end_flush_all_fixed() {
		//Check whether compression on
		//If yes, don't flush buffer level one
		//This prevents the 'reserved' compression buffer being flushed, which causes an error
		//A patch has also been submitted to the WordPress core, with this plugin as an interim solution
		$start = (int) ini_get('zlib.output_compression');
		$levels = ob_get_level();
		for($i = $start; $i < $levels; $i++) {
			ob_end_flush();
		}
	}

	//remove original flush callback
	remove_action('shutdown', 'wp_ob_end_flush_all', 1);

	//add fixed flush callback
	add_action('shutdown', 'wp_ob_end_flush_all_fixed', 1);

}