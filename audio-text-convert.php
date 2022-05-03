<?php

/*
Plugin Name: Audio - Text
Description: Test to audio convert with shortcode display.
Version: 1.0
Text Domain : aud_txt
Author: Admin
*/

if ( !function_exists( 'wsv_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wsv_fs()
    {
        global  $wsv_fs ;
        
        if ( !isset( $wsv_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wsv_fs = fs_dynamic_init( array(
                'id'              => '10289',
                'slug'            => 'wp-sale-voice',
                'type'            => 'plugin',
                'public_key'      => 'pk_d802a217997da1f4776ee35b36472',
                'is_premium'      => true,
                'is_premium_only' => false,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'menu'            => array(
                'slug'    => 'audio-text',
                'support' => false,
            ),
                'is_live'         => true,
            ) );
        }
        
        return $wsv_fs;
    }
    
    // Init Freemius.
    wsv_fs();
    // Signal that SDK was initiated.
    do_action( 'wsv_fs_loaded' );
}

/**
 * Basic plugin definitions 
 * 
 * @package Post Push Notification
 * @since 1.0
 */

if ( !defined( 'AUD_TXT_DIR' ) ) {
    define( 'AUD_TXT_DIR', dirname( __FILE__ ) );
    // Plugin dir
}


if ( !defined( 'AUD_TXT_VERSION' ) ) {
    define( 'AUD_TXT_VERSION', '1.0' );
    // Plugin Version
}


if ( !defined( 'AUD_TXT_URL' ) ) {
    define( 'AUD_TXT_URL', plugin_dir_url( __FILE__ ) );
    // Plugin url
}


if ( !defined( 'AUD_TXT_INC_DIR' ) ) {
    define( 'AUD_TXT_INC_DIR', AUD_TXT_DIR . '/includes' );
    // Plugin include dir
}


if ( !defined( 'AUD_TXT_INC_URL' ) ) {
    define( 'AUD_TXT_INC_URL', AUD_TXT_URL . 'includes' );
    // Plugin include url
}


if ( !defined( 'AUD_TXT_ADMIN_DIR' ) ) {
    define( 'AUD_TXT_ADMIN_DIR', AUD_TXT_INC_DIR . '/admin' );
    // Plugin admin dir
}


if ( !defined( 'AUD_TXT_PREFIX' ) ) {
    define( 'AUD_TXT_PREFIX', 'AUD_TXT' );
    // Plugin Prefix
}


if ( !defined( 'AUD_TXT_VAR_PREFIX' ) ) {
    define( 'AUD_TXT_VAR_PREFIX', '_AUD_TXT_' );
    // Variable Prefix
}

/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package Audio Text Convert
 * @since 1.0
 */
load_plugin_textdomain( 'aud_txt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package Audio Text Convert
 * @since 1.0
 */
register_activation_hook( __FILE__, 'aud_txt_install' );
function aud_txt_install()
{
}

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package Audio Text Convert
 * @since 1.0
 */
register_deactivation_hook( __FILE__, 'aud_txt_uninstall' );
function aud_txt_uninstall()
{
}

// Global variables
global  $aud_txt_scripts, $aud_txt_admin ;
// Script class handles most of script functionalities of plugin
require_once AUD_TXT_INC_DIR . '/class-phpmp3.php';
include_once AUD_TXT_INC_DIR . '/class-aud-txt-scripts.php';
$aud_txt_scripts = new Aud_txt_Scripts();
$aud_txt_scripts->add_hooks();
// Script class handles most of front functionalities of plugin
include_once AUD_TXT_INC_DIR . '/class-aud-txt-front.php';
$aud_txt_front = new Aud_txt_Front();
$aud_txt_front->add_hooks();
// Admin class handles most of admin panel functionalities of plugin
include_once AUD_TXT_ADMIN_DIR . '/class-aud-txt-admin.php';
$aud_txt_admin = new Aud_txt_Admin();
$aud_txt_admin->add_hooks();