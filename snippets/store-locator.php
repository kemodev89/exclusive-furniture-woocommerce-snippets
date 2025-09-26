<?php
/**
 * WooCommerce Snippet: Store Locator Integration
 *
 * Displays store locations for a product based on custom store IDs.
 * Uses Google Geocoding API to fetch coordinates and outputs a map link.
 *
 * Usage: Add store IDs to products via custom field "store_ids" (comma-separated).
 * Example: 1,3,5 → will fetch and show locations for stores with those IDs.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Example store locations (ID => Address)
$ef_store_locations = array(
    1 => "6900 Southwest Freeway, Houston, TX 77074",
    2 => "2450 South Texas 6, Houston, TX 77077",
    3 => "21018 West Bellfort Street, Richmond, TX 77406",
    4 => "25330 Northwest Freeway, Cypress, TX 77429",
    5 => "12200 Gulf Freeway, Houston, TX 77075",
    6 => "16515 North Freeway, Houston, TX 77090",
    7 => "19300 U.S. 59, Humble, TX 77338",
    8 => "21000 Gulf Freeway, Webster, TX 77598",
    9 => "5921 East Freeway, Baytown, TX 77521",
);

// Add store locator to product summary
add_action( 'woocommerce_single_product_summary', 'ef_show_store_locator', 25 );

function ef_show_store_locator() {
    global $product, $ef_store_locations;

    if ( ! $product ) return;

    // Get store IDs from custom field
    $store_ids = get_post_meta( $product->get_id(), 'store_ids', true );

    if ( empty( $store_ids ) ) return;

    $ids = array_map( 'trim', explode( ',', $store_ids ) );

    echo '<div class="ef-store-locator"><h4>Available At:</h4><ul>';

    foreach ( $ids as $id ) {
        if ( isset( $ef_store_locations[ $id ] ) ) {
            $address = $ef_store_locations[ $id ];
            $map_link = "https://www.google.com/maps/search/?api=1&query=" . urlencode( $address );
            echo '<li><a href="' . esc_url( $map_link ) . '" target="_blank">' . esc_html( $address ) . '</a></li>';
        }
    }

    echo '</ul></div>';
}
