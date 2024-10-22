<?php
class AI_Shop_Assistant_i18n {
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'ai-shop-assistant',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
