<?php
class AI_Shop_Assistant_Admin {
    private $plugin_name;
    private $version;
    private $option_name = 'ai_shop_assistant_options';

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ai-shop-assistant-admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ai-shop-assistant-admin.js', array
