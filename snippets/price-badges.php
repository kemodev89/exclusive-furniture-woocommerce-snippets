<?php
/**
 * WooCommerce Snippet: Sale & Clearance Badge Handling
 *
 * - Shows "Clearance" badge if product is tagged with "Clearance".
 * - Hides the default "Sale" badge when "Clearance" is active.
 *
 * Usage: Add "Clearance" tag to a product → it will show the Clearance badge.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Remove default sale badge
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Add custom badge logic
add_action( 'woocommerce_before_shop_loop_item_title', 'ef_custom_product_badges', 10 );
add_action( 'woocommerce_before_single_product_summary', 'ef_custom_product_badges', 10 );

function ef_custom_product_badges() {
    global $product;

    if ( ! $product ) return;

    // Check if product has "Clearance" tag
    if ( has_term( 'Clearance', 'product_tag', $product->get_id() ) ) {
        echo '<span class="ef-badge ef-clearance">Clearance</span>';
    }
    // Otherwise, show "Sale" badge if product is on sale
    elseif ( $product->is_on_sale() ) {
        echo '<span class="ef-badge ef-sale">Sale</span>';
    }
}

// Optional: Custom CSS (enqueue via theme or snippet plugin)
add_action( 'wp_head', function() {
    echo '<style>
        .ef-badge {
            display:inline-block;
            padding:4px 8px;
            font-size:13px;
            font-weight:bold;
            border-radius:3px;
            color:#fff;
            position:absolute;
            top:10px;
            left:10px;
            z-index:10;
        }
        .ef-sale { background:#e63946; }
        .ef-clearance { background:#6a1b9a; }
    </style>';
});
