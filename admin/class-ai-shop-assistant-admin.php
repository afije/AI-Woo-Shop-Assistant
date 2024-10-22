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
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ai-shop-assistant-admin.js', array('jquery'), $this->version, false);
    }

    public function add_plugin_admin_menu() {
        add_options_page(
            'AI Shop Assistant Settings', 
            'AI Shop Assistant', 
            'manage_options', 
            $this->plugin_name, 
            array($this, 'display_plugin_setup_page')
        );
    }

    public function add_action_links($links) {
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);
    }

    public function display_plugin_setup_page() {
        include_once('partials/ai-shop-assistant-admin-display.php');
    }

    public function options_update() {
        register_setting($this->plugin_name, $this->option_name, array($this, 'validate'));
    }

    public function validate($input) {
        $valid = array();

        $valid['enabled'] = (isset($input['enabled']) && !empty($input['enabled'])) ? 1 : 0;
        $valid['openai_api_key'] = (isset($input['openai_api_key']) && !empty($input['openai_api_key'])) ? sanitize_text_field($input['openai_api_key']) : '';
        $valid['button_position'] = (isset($input['button_position']) && !empty($input['button_position'])) ? sanitize_text_field($input['button_position']) : 'right';
        $valid['button_text'] = (isset($input['button_text']) && !empty($input['button_text'])) ? sanitize_text_field($input['button_text']) : 'Shop Assistant';

        return $valid;
    }
}
