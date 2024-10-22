<?php
// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete options
delete_option('ai_shop_assistant_options');

// Delete any custom database tables if created
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}ai_shop_assistant_data");
