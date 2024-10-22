<?php
class AI_Shop_Assistant_Cart_Handler {
    public function add_to_cart($product_id, $quantity = 1) {
        if (function_exists('WC')) {
            $added = WC()->cart->add_to_cart($product_id, $quantity);
            if ($added) {
                return true;
            }
        }
        return false;
    }

    public function get_cart_url() {
        if (function_exists('wc_get_cart_url')) {
            return wc_get_cart_url();
        }
        return '';
    }
}
