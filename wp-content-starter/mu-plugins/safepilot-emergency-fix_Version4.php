<?php
// AWARYJNY FIX - tylko podstawowe naprawy
if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Wyłącz wszystkie notice
@error_reporting(E_ALL & ~E_NOTICE);

// 2. Napraw zlib
@ini_set('zlib.output_compression', 'Off');
remove_action('shutdown', 'wp_ob_end_flush_all', 1);

// 3. Wycisz textdomain errors  
add_filter('doing_it_wrong_trigger_error', '__return_false', 1);

// 4. Napraw getVcShared
if (!function_exists('getVcShared') && function_exists('vc_get_shared')) {
    function getVcShared($asset = '') {
        return @vc_get_shared($asset);
    }
}

// 5. Cleanup buffers
add_action('shutdown', function() {
    while (@ob_end_flush());
}, 0);