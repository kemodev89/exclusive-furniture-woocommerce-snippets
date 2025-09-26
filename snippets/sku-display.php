<?php
/**
 * WooCommerce Snippet: Display SKU on Product Pages
 * 
 * Dynamically shows SKU under the product title.
 * Works with both simple and variable products.
 * 
 * Usage: Place in theme's functions.php or as a standalone plugin.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Add SKU under product title
add_action( 'woocommerce_single_product_summary', 'ef_show_product_sku', 6 );

function ef_show_product_sku() {
    global $product;

    if ( ! $product ) {
        return;
    }

    // Only show if product has SKU
    if ( $product->get_sku() ) {
        echo '<p class="ef-product-sku"><strong>SKU:</strong> ' . esc_html( $product->get_sku() ) . '</p>';
    }
}

// Ensure SKU updates on variable product change
add_action( 'wp_footer', 'ef_dynamic_sku_update_script' );

function ef_dynamic_sku_update_script() {
    if ( ! is_product() ) {
        return;
    }
    ?>
    <script type="text/javascript">
    (function($){
        $(document).on('found_variation', 'form.variations_form', function(event, variation){
            if( variation.sku ){
                $('.ef-product-sku').html('<strong>SKU:</strong> ' + variation.sku);
            }
        });
    })(jQuery);
    </script>
    <?php
}
