<?php
/**
 * Plugin Name: AI Shop Assistant for WooCommerce
 * Plugin URI: https://afije.com/
 * Description: Enhance user shopping experience with AI-powered product recognition and suggestions.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://afije.com
 * Text Domain: ai-shop-assistant
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * WC requires at least: 3.0
 * WC tested up to: 5.0
 *
 * @package AI_Shop_Assistant
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define plugin constants
define( 'AI_SHOP_ASSISTANT_VERSION', '1.0.0' );
define( 'AI_SHOP_ASSISTANT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AI_SHOP_ASSISTANT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_ai_shop_assistant() {
    require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-activator.php';
    AI_Shop_Assistant_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_ai_shop_assistant() {
    require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-deactivator.php';
    AI_Shop_Assistant_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ai_shop_assistant' );
register_deactivation_hook( __FILE__, 'deactivate_ai_shop_assistant' );

/**
 * The core plugin class.
 */
require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant.php';

/**
 * Begins execution of the plugin.
 */
function run_ai_shop_assistant() {
    $plugin = new AI_Shop_Assistant();
    $plugin->run();
}
run_ai_shop_assistant();
