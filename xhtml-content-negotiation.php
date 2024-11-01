<?php
/*                                                                                                                 
Plugin Name: XHTML Content Negotiation
Plugin URI: http://rayofsolaris.net/code/xhtml-content-negotiation-for-wordpress
Description: Sends content as application/xhtml+xml based on the browser's ACCEPT request.  Ignores Internet Explorer 8 and lower, which can't handle application/xhtml+xml.
Version: 1.5
Author: Samir Shah
Author URI: http://rayofsolaris.net/
License: GPL2
*/

if(!defined('ABSPATH')) exit;

class Xhtml_Content_Negotiation {
	function __construct() {
		if( !is_admin() )	// don't mess with wp-admin
			add_filter( 'option_html_type', array( $this, 'set_content_type') );
	}

	function set_content_type( $default ) {
		// If the client is stupid, stick to HTML
		if( $this->is_unsupported_browser() ) 
			return $default;
		
		$accept_string = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
		$types = array('default' => $default, 'xhtml' => 'application/xhtml+xml', 'any' => '*/*');
				
		// If the client isn't providing an accept string, we can send whatever we like!
		if( empty($accept_string) )
			return $types['xhtml'];
		
		// Check for media type preference
		$qs = array();
		foreach($types as $k => $type)
			$qs[$k] = $this->q_value($type, $accept_string);
		
		// If they prefer xhtml give them xhtml
		if( $qs['xhtml'] >= $qs['default'] || $qs['any'] > $qs['default'] )
			return $types['xhtml'];

		return $default;
	}
	
	private function q_value($type, $accept_string) {
		if( strpos($accept_string, $type) === false ) 
			return 0;
		if( preg_match( '#'.preg_quote($type).';\s?q=([01](?:\.\d{1,3})?)#i', $accept_string, $matches ) )
			return (float)$matches[1];
		return 1;	// 1 if no q-value was supplied
	}
	
	private function is_unsupported_browser() {
		// is UA IE<9
		$ua = strtolower( $_SERVER['HTTP_USER_AGENT'] );
		if( preg_match( '/msie|mspie|pocket/', $ua ) 
			&& strpos( $ua, 'opera' ) === false
			&& strpos( $ua, 'msie 9.') === false )
			return true;
		return false;
	}
} //class

new Xhtml_Content_Negotiation();
