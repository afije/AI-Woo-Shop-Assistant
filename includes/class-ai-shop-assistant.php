<?php
class AI_Shop_Assistant {
    protected $loader;
    protected $plugin_name;
    protected $version;

    private $openai;
    private $image_analysis;
    private $product_search;
    private $cart_handler;
    private $admin;

    public function __construct() {
        $this->version = AI_SHOP_ASSISTANT_VERSION;
        $this->plugin_name = 'ai-shop-assistant';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

        $options = get_option('ai_shop_assistant_options');
        $api_key = isset($options['openai_api_key']) ? $options['openai_api_key'] : '';
        $this->openai = new AI_Shop_Assistant_OpenAI($api_key);
        $this->image_analysis = new AI_Shop_Assistant_Image_Analysis($this->openai);
        $this->product_search = new AI_Shop_Assistant_Product_Search();
        $this->cart_handler = new AI_Shop_Assistant_Cart_Handler();
    }

    private function load_dependencies() {
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-loader.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-i18n.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'admin/class-ai-shop-assistant-admin.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'public/class-ai-shop-assistant-public.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-openai.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-image-analysis.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-product-search.php';
        require_once AI_SHOP_ASSISTANT_PLUGIN_DIR . 'includes/class-ai-shop-assistant-cart-handler.php';

        $this->loader = new AI_Shop_Assistant_Loader();
    }

    private function set_locale() {
        $plugin_i18n = new AI_Shop_Assistant_i18n();
        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }

    private function define_admin_hooks() {
        $this->admin = new AI_Shop_Assistant_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_menu', $this->admin, 'add_plugin_admin_menu' );
        $this->loader->add_action( 'admin_init', $this->admin, 'options_update' );
        $this->loader->add_filter( 'plugin_action_links_' . $this->plugin_name, $this->admin, 'add_action_links' );
    }

    private function define_public_hooks() {
        $plugin_public = new AI_Shop_Assistant_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_action( 'wp_footer', $plugin_public, 'add_shop_assistant_button' );
        $this->loader->add_action( 'wp_ajax_ai_shop_assistant_process', $plugin_public, 'process_shop_assistant_request' );
        $this->loader->add_action( 'wp_ajax_nopriv_ai_shop_assistant_process', $plugin_public, 'process_shop_assistant_request' );
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_loader() {
        return $this->loader;
    }

    public function get_version() {
        return $this->version;
    }
}
