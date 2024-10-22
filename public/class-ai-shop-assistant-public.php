<?php
class AI_Shop_Assistant_Public {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ai-shop-assistant-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ai-shop-assistant-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'ai_shop_assistant_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ai_shop_assistant_nonce')
        ));
    }

    public function add_shop_assistant_button() {
        $options = get_option('ai_shop_assistant_options');
        if (!isset($options['enabled']) || $options['enabled'] != 1) {
            return;
        }

        $button_text = isset($options['button_text']) ? $options['button_text'] : 'Shop Assistant';
        $button_position = isset($options['button_position']) ? $options['button_position'] : 'right';

        $button_class = 'ai-shop-assistant-button';
        $button_class .= $button_position === 'left' ? ' left' : ' right';

        echo '<button id="ai-shop-assistant-button" class="' . esc_attr($button_class) . '">' . esc_html($button_text) . '</button>';
        echo '<div id="ai-shop-assistant-suggestions" style="display:none;"></div>';
    }

    public function process_shop_assistant_request() {
        check_ajax_referer('ai_shop_assistant_nonce', 'nonce');

        $image_data = isset($_POST['image_data']) ? $_POST['image_data'] : '';

        if (empty($image_data)) {
            wp_send_json_error(array('message' => 'No image data provided.'));
        }

        $ai_shop_assistant = new AI_Shop_Assistant();
        $result = $ai_shop_assistant->process_shop_assistant_request($image_data);

        wp_send_json_success($result);
    }
}
