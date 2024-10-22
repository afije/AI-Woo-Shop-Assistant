<?php
class AI_Shop_Assistant_Product_Search {
    public function search_products($attributes) {
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'tax_query' => array(),
            'meta_query' => array()
        );

        foreach ($attributes as $key => $value) {
            if ($key === 'color' || $key === 'size') {
                $args['tax_query'][] = array(
                    'taxonomy' => 'pa_' . $key,
                    'field' => 'slug',
                    'terms' => $value
                );
            } elseif ($key === 'type') {
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $value
                );
            } elseif ($key === 'brand') {
                $args['meta_query'][] = array(
                    'key' => '_brand',
                    'value' => $value,
                    'compare' => 'LIKE'
                );
            }
        }

        $products = wc_get_products($args);
        return $products;
    }
}
