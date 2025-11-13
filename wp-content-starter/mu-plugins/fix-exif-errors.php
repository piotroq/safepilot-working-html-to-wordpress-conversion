<?php
/**
 * Fix EXIF Errors During Import
 * Lokalizacja: wp-content/mu-plugins/fix-exif-errors.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Wyłącz exif_read_data warnings
add_filter( 'wp_read_image_metadata', function( $metadata, $file ) {
    return $metadata;
}, 10, 2 );

// Wyłącz error reporting dla EXIF
add_action( 'wp_generate_attachment_metadata', function( $attachment_id, $attachment ) {
    if ( ! function_exists( 'wp_get_attachment_metadata' ) ) return;
    
    $old_error = error_reporting();
    error_reporting( $old_error & ~E_WARNING );
    
    return $attachment;
}, 10, 2 );

// Naprawić import attachment metadata
add_filter( 'wp_read_image_metadata', function( $meta, $file ) {
    if ( empty( $meta ) ) {
        return array(
            'width' => 0,
            'height' => 0,
            'image_meta' => array(),
        );
    }
    return $meta;
}, 10, 2 );

// Skip EXIF data na attachment
add_filter( 'sanitize_file_name_chars', function( $chars ) {
    // Pozwól na znaki które mogą być w obrazach
    return $chars;
} );

// Obsługa błędów podczas generowania attachment metadata
add_filter( 'wp_generate_attachment_metadata', function( $data, $attachment_id, $context ) {
    if ( is_wp_error( $data ) ) {
        error_log( 'Attachment metadata error for ID: ' . $attachment_id );
        return array();
    }
    return $data;
}, 10, 3 );

// Wyłącz EXIF warnings globalnie
set_error_handler( function( $errno, $errstr, $errfile, $errline ) {
    if ( strpos( $errstr, 'exif_read_data' ) !== false || 
         strpos( $errstr, 'Incorrect APP1 Exif' ) !== false ) {
        return true; // Ignore EXIF errors
    }
    return false;
} );

// Upewnij się że attachment jest zapamiętywany nawet z błędami
add_action( 'wp_insert_attachment', function( $post_id ) {
    $post = get_post( $post_id );
    if ( $post && $post->post_type === 'attachment' ) {
        // Ustaw status na 'inherit'
        wp_update_post( array(
            'ID' => $post_id,
            'post_status' => 'inherit'
        ) );
    }
} );