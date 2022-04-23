<?php
/*
Plugin Name:	WCD Bricks Elements
Plugin URI:		https://web-craft.design
Description:	Bricks Elements
Version:		1.0.0
Author:			Wolfgang Hartl
Author URI:		https://web-craft.design
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'init', function() {

    include_once(plugin_dir_path( __FILE__ ) . 'assets/assetLoader.php');

    
  }, 9 );
  


add_action( 'init', function() {
    $element_files = [
        plugin_dir_path( __FILE__ ). '/elements/githubCode.php',
        plugin_dir_path( __FILE__ ) . '/elements/codeBlock.php',
    ];
  
    foreach ( $element_files as $file ) {
      \Bricks\Elements::register_element( $file );
    }
  }, 11 );