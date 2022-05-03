<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package Audio Text Convert
 * @since 1.0
 */

class Aud_txt_Scripts {

	//class constructor
	function __construct()
	{
		
	}
	
	/**
	 * Enqueue Scripts on Admin Side
	 * 
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	public function aud_txt_admin_scripts($hook){
		if($hook == 'toplevel_page_audio-text') {
			wp_register_style('aud-txt-style',  AUD_TXT_INC_URL . '/css/aud-txt.css', array(), '', false);
	   		wp_enqueue_style('aud-txt-style'); 

			wp_register_script('aud-txt-script', AUD_TXT_INC_URL . '/js/aud-txt.js', array(), time(), true);
	   		wp_enqueue_script('aud-txt-script');

	   		wp_localize_script('aud-txt-script', 'aud_txt_ajax', array('ajax_url' => admin_url('admin-ajax.php') ));
	   	}
	
	}

	/**
	 * Enqueue Scripts on Front Side
	 * 
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	public function aud_txt_front_scripts($hook){
		
		wp_register_style('aud-front-style',  AUD_TXT_INC_URL . '/css/aud-txt-front.css', array(), '', false);
   		wp_enqueue_style('aud-front-style'); 

   		wp_enqueue_style('aud-bootstrap',  'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css', array(), '', false);


   		wp_enqueue_script('aud-slim', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), time(), true);

   		wp_enqueue_script('aud-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', array(), time(), true);

   		wp_enqueue_script('aud-bbotstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', array(), time(), true);

		wp_register_script('aud-front-script', AUD_TXT_INC_URL . '/js/aud-txt-front.js', array(), time(), true);
   		wp_enqueue_script('aud-front-script');	   	
	
	}
	
	/**
	 * Adding Hooks
	 *
	 * Adding hooks for the styles and scripts.
	 *
	 * @package Audio Text Convert
	 * @since 1.0
	 */
	function add_hooks(){
		
		//add admin scripts
		add_action('admin_enqueue_scripts', array($this, 'aud_txt_admin_scripts'));

		//add front scripts
		add_action('wp_enqueue_scripts', array($this, 'aud_txt_front_scripts'));
	}
}
?>
