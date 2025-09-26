<?php
/**
 * WooCommerce Snippet: Safe Database Cleanup
 *
 * Deletes old Action Scheduler logs, Activity Log metadata,
 * and orphaned product variations.
 *
 * Runs in small batches to avoid DB locks or downtime.
 *
 * Usage: Add as a standalone plugin or run via WP-CLI.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Schedule cleanup once daily
if ( ! wp_next_scheduled( 'ef_daily_db_cleanup' ) ) {
    wp_schedule_event( time(), 'daily', 'ef_daily_db_cleanup' );
}

add_action( 'ef_daily_db_cleanup', 'ef_run_safe_db_cleanup' );

function ef_run_safe_db_cleanup() {
    global $wpdb;

    // 1) Clean wp_actionscheduler_logs (older than 14 days)
    $wpdb->query("
        DELETE FROM {$wpdb->prefix}actionscheduler_logs
        WHERE scheduled_date_gmt < (NOW() - INTERVAL 14 DAY)
        LIMIT 500
    ");

    // 2) Clean wp_wsal_metadata (older than 7 days)
    $wpdb->query("
        DELETE FROM {$wpdb->prefix}wsal_metadata
        WHERE created_on < (NOW() - INTERVAL 7 DAY)
        LIMIT 500
    ");

    // 3) Remove orphaned product variations (older than 5 days, no parent)
    $wpdb->query("
        DELETE p FROM {$wpdb->posts} p
        WHERE p.post_type = 'product_variation'
        AND p.post_parent = 0
        AND p.post_date < (NOW() - INTERVAL 5 DAY)
        LIMIT 200
    ");
}
