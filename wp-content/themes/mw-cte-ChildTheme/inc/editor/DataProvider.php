<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_DataProvider {

    public static function posts( $args = array() ) {

        $defaults = array(
            'post_type'      => 'post',
            'posts_per_page' => 20,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        return new WP_Query(
            wp_parse_args( $args, $defaults )
        );

    }

}