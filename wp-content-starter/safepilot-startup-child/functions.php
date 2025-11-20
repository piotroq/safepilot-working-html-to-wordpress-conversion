<?php
/**
 * SafePilot Startup Child Theme - Functions
 * NUCLEAR Level 3 Fix - Minimal Implementation
 * 
 * @package SafePilot_Startup_Child
 * @since 1.0.0
 * @author piotroq
 * @modified 2025-11-13 - NUCLEAR LEVEL 3 FIX for WordPress 6.7+
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * NUCLEAR LEVEL 3: Minimal Child Theme Implementation
 * MU-Plugin handles all complex logic
 * ===================================================================
 */

/**
 * Minimal Child Theme Setup
 */
if ( ! function_exists( 'safepilot_nuclear_child_setup' ) ) {
    function safepilot_nuclear_child_setup() {
        
        // Only load if MU-Plugin failed
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 
                'safepilot-startup-child', 
                get_stylesheet_directory() . '/languages' 
            );
        }
        
        // Theme support
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        
        // SafePilot image sizes
        add_image_size( 'safepilot-hero', 1920, 800, true );
        add_image_size( 'safepilot-card', 400, 300, true );
    }
}
add_action( 'init', 'safepilot_nuclear_child_setup', 25 ); // After MU-Plugin and parent

/**
 * Enqueue Styles
 */
if ( ! function_exists( 'safepilot_nuclear_child_styles' ) ) {
    function safepilot_nuclear_child_styles() {
        
        // Parent theme style
        wp_enqueue_style( 
            'safepilot-startup-parent', 
            get_template_directory_uri() . '/style.css',
            array(),
            wp_get_theme()->get('Version')
        );
        
        // Child theme style
        wp_enqueue_style( 
            'safepilot-startup-child', 
            get_stylesheet_directory_uri() . '/style.css',
            array( 'safepilot-startup-parent' ),
            wp_get_theme()->get('Version')
        );
    }
}
add_action( 'wp_enqueue_scripts', 'safepilot_nuclear_child_styles', 15 );

/**
 * Child Theme Additional Setup
 */
if ( ! function_exists( 'safepilot_nuclear_child_theme_setup' ) ) {
    function safepilot_nuclear_child_theme_setup() {
        
        // Additional theme features
        add_theme_support( 'custom-spacing' );
        add_theme_support( 'custom-units' );
        
        // Editor styles
        add_editor_style( 'style-editor.css' );
    }
}
add_action( 'after_setup_theme', 'safepilot_nuclear_child_theme_setup', 11 );

/**
 * SafePilot Child Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package safepilot-startup-child
 */

/**
 * Enqueue scripts and styles.
 */
function safepilot_child_enqueue_assets() {
    // --- Krok 3: Dodaj niestandardowe pliki CSS ---
    
    // 1. Plik z kolorami marki SafePilot
    wp_enqueue_style(
        'safepilot-brand-colors', // Unikalna nazwa (uchwyt) dla tego pliku CSS
        get_stylesheet_directory_uri() . '/assets/css/safe-pilot-fullbrand-color.css',
        array( 'safepilot-startup-child' ), // Zależność: ładuj PO głównym pliku style.css motywu potomnego
        '1.0.0' // Wersja pliku
    );

    // 2. Plik z niestandardowymi animacjami
    wp_enqueue_style(
        'safepilot-custom-animations', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/animate.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 3. Plik z niestandardowymi okienko popup zdjecia
    wp_enqueue_style(
        'safepilot-magnific-popup', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 4. Plik z niestandardowymi main glowny css extechu
    wp_enqueue_style(
        'safepilot-main-css', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 5. Plik z niestandardowymi meanmenu css extechu
    wp_enqueue_style(
        'safepilot-meanmenu-css', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/meanmenu.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 6. Plik z niestandardowymi nice select css extechu
    wp_enqueue_style(
        'safepilot-nice-select-css', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/nice-select.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 7. Plik z niestandardowymi swiper css extechu
    wp_enqueue_style(
        'safepilot-swiper-bundle-min-css', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );
    
    // 8. Plik z niestandardowymi all file style min css extechu
    wp_enqueue_style(
        'safepilot-all-style-extech-min-css', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/css/all.min.css',
        array( 'safepilot-brand-colors' ), // Zależność: ładuj PO pliku z kolorami
        '1.0.0'
    );

    // --- Krok 4: Dodaj niestandardowe pliki JavaScript ---

    // 1. Plik z biblioteką Bootstrap Bundle Extech
    wp_enqueue_script(
        'library-bootstrap-bundle-extech', // Unikalna nazwa (uchwyt) dla tego skryptu
        get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        array(), // Zależności (np. array('jquery'), jeśli skrypt wymaga jQuery)
        '2.3.4', // Wersja biblioteki
        true // `true` oznacza, że skrypt zostanie załadowany w stopce strony (zalecane dla wydajności)
    );
    
    // 2. Plik z Twoimi counterup js extech
    wp_enqueue_script(
        'counterup-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/jquery.counterup.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 3. Plik z Twoimi magnific popup js extech
    wp_enqueue_script(
        'magnific-popup-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 4. Plik z Twoimi meanmenu js extech
    wp_enqueue_script(
        'meanmenu-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/jquery.meanmenu.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 5. Plik z Twoimi niceselect js extech
    wp_enqueue_script(
        'niceselect-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/jquery.nice-select.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 6. Plik z Twoimi waypoints js extech
    wp_enqueue_script(
        'waypoints-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/jquery.waypoints.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 7. Plik z Twoimi swiper bundle extech
    wp_enqueue_script(
        'swiper-bundle-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 8. Plik z Twoimi viewport js extech
    wp_enqueue_script(
        'viewport-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/viewport.jquery.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );
    
    // 9. Plik z Twoimi wow js extech
    wp_enqueue_script(
        'wow-js-extech', // Unikalna nazwa
        get_stylesheet_directory_uri() . '/assets/js/wow.min.js',
        array( 'jquery', 'library-bootstrap-bundle-extech' ), // Zależność: ładuj PO jQuery i bibliotece AOS
        '1.0.0',
        true // Ładuj w stopce
    );

}
add_action( 'wp_enqueue_scripts', 'safepilot_child_enqueue_assets' );

// Enqueue image fix script
add_action('wp_enqueue_scripts', 'safepilot_enqueue_image_fix');
function safepilot_enqueue_image_fix() {
    wp_enqueue_script(
        'safepilot-image-fix',
        get_stylesheet_directory_uri() . '/assets/js/js-image-fix.js',
        array('jquery'),
        '1.0',
        true
    );
}

/**
 * Alternatywna metoda - filtrowanie ścieżki do plików tłumaczeniowych
 * Używaj tej funkcji, jeśli powyższa nie działa
 */
function safepilot_child_override_translation_path($mofile, $domain) {
    if ('g5-startup' === $domain) {
        $mofile = get_stylesheet_directory() . '/languages/' . $domain . '-' . get_locale() . '.mo';
    }
    return $mofile;
}
add_filter('load_textdomain_mofile', 'safepilot_child_override_translation_path', 10, 2);

remove_action('wp_head', 'wp_generator');

function my_secure_generator( $generator, $type ) {
	return '';
}
add_filter( 'the_generator', 'my_secure_generator', 10, 2 );

function my_remove_src_version( $src ) {
	global $wp_version;

	$version_str = '?ver='.$wp_version;
	$offset = strlen( $src ) - strlen( $version_str );

	if ( $offset >= 0 && strpos($src, $version_str, $offset) !== FALSE )
		return substr( $src, 0, $offset );

	return $src;
}
add_filter( 'script_loader_src', 'my_remove_src_version' );
add_filter( 'style_loader_src', 'my_remove_src_version' );

add_filter('xmlrpc_enabled', '__return_false');

add_filter(
	'admin_footer_text',
	function ( $footer_text ) {
		// Edit the line below to customize the footer text.
		$footer_text = 'Powered by <a href="https://www.pbmediaonline.pl" target="_blank" rel="noopener">PB MEDIA Studio - Strony & Sklepy internetowe</a> | safepilot.pl: <a href="https://safepilot.pl" target="_blank" rel="noopener">www.safepilot.pl</a>';
		
		return $footer_text;
	}
);

function block_spam_comments($commentdata) {
	$fake_textarea = trim($_POST['comment']);
	if(!empty($fake_textarea)) wp_die('Error!');
	$comment_content = trim($_POST['just_another_id']);
	$_POST['comment'] = $comment_content;	
	return $commentdata;
}
 
add_filter('pre_comment_on_post', 'block_spam_comments');

// Wyłącz emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Wyłącz pingbacks i trackbacks
add_filter('xmlrpc_enabled', '__return_false');
remove_action('do_pings', 'do_all_pings', 10);

// Wyłącz funkcję autosave (jeśli nie jest potrzebna)
add_action('wp_print_scripts', function() {
    wp_deregister_script('autosave');
});

// Usuń nieużywane metadane
function clean_database() {
    global $wpdb;
    $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '_edit_lock'");
}
add_action('wp_scheduled_delete', 'clean_database');

// Lazy loading obrazów (WordPress 5.5+ ma tę funkcję wbudowaną, ale można ją wzmocnić)
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    return $attr;
});

// Cache wyników zapytań
function cache_queries($query) {
    if ($query->is_main_query() && $query->is_home()) {
        $transient_key = 'home_query_cache';
        $cached_query = get_transient($transient_key);

        if ($cached_query) {
            $query->set('no_found_rows', true);
            $query->set('cache_results', true);
            $query->set('posts', $cached_query);
        } else {
            set_transient($transient_key, $query->posts, HOUR_IN_SECONDS);
        }
    }
}
add_action('pre_get_posts', 'cache_queries');

// Wyłączenie WordPress Admin Bar dla wszystkich użytkowników poza administratorami i edytorami
function disable_admin_bar_for_non_admins() {
    if (!current_user_can('administrator') && !current_user_can('editor')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'disable_admin_bar_for_non_admins');

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
		height:160px;
		width:320px;
		background-size: 320px 160px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'SafePilot - Logowanie';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%¥s*[-_¥s]+¥s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	} 
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

add_filter( 'enable_post_by_email_configuration', '__return_false' );

add_action('login_footer', function () {
    echo '<div style="text-align: center; margin-top: 20px;">© ' . date('Y') . ' SafePilot. All Rights Reserved. PB MEDIA Studio Strony & Sklepy Internetowe</div>';
});

add_filter('login_headertext', function () {
    return 'Witamy w panelu logowania - SafePilot';
});

/**
 * Add SVG files mime check.
 *
 * @param array        $wp_check_filetype_and_ext Values for the extension, mime type, and corrected filename.
 * @param string       $file Full path to the file.
 * @param string       $filename The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param string[]     $mimes Array of mime types keyed by their file extension regex.
 * @param string|false $real_mime The actual mime type or false if the type cannot be determined.
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {
		if ( ! $wp_check_filetype_and_ext['type'] ) {
			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;
			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}
			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}
		return $wp_check_filetype_and_ext;
	},
	10,
	5
);

	
add_filter(
	'admin_footer_text',
	function ( $footer_text ) {
		// Edit the line below to customize the footer text.
		$footer_text = 'Powered by <a href="https://www.pbmediaonline.pl" target="_blank" rel="noopener">PB MEDIA Studio - Strony & Sklepy internetowe</a> | SafePilot: <a href="https://safepilot.pl" target="_blank" rel="noopener">www.safepilot.pl</a>';
		
		return $footer_text;
	}
);

// Please edit the address and name below.
// Change the From address.
add_filter( 'wp_mail_from', function ( $original_email_address ) {
    return 'biuro@safepilot.pl';
} );
 
// Change the From name.
add_filter( 'wp_mail_from_name', function ( $original_email_from ) {
    return 'SafePilot - bez zbędnych turbulencji!';
} );

// === Ustawienia globalne ===

// Sprawdzenie, czy aktualny użytkownik nie ma uprawnień (czyli nie jest 'admin')
function bbloomer_should_hide_updates(): bool {
    return ( is_user_logged_in() && wp_get_current_user()->user_login !== 'admin' );
}

// === Ukrywanie aktualizacji ===

add_filter( 'pre_site_transient_update_core', 'bbloomer_maybe_disable_update_core' );
add_filter( 'pre_site_transient_update_plugins', 'bbloomer_maybe_disable_update_plugins' );
add_filter( 'pre_site_transient_update_themes', 'bbloomer_maybe_disable_update_themes' );

function bbloomer_maybe_disable_update_core( $value ) {
    if ( bbloomer_should_hide_updates() ) {
        global $wp_version;
        return (object) array(
            'last_checked'    => time(),
            'version_checked' => $wp_version,
        );
    }
    return $value;
}

function bbloomer_maybe_disable_update_plugins( $value ) {
    if ( bbloomer_should_hide_updates() ) {
        return (object) array();
    }
    return $value;
}

function bbloomer_maybe_disable_update_themes( $value ) {
    if ( bbloomer_should_hide_updates() ) {
        return (object) array();
    }
    return $value;
}

// === Zmiana etykiet menu ===

add_action( 'admin_menu', 'bbloomer_modify_admin_menu_labels', 999 );
function bbloomer_modify_admin_menu_labels() {
    if ( ! bbloomer_should_hide_updates() ) {
        return;
    }

    global $menu, $submenu;

    if ( isset( $menu[65][0] ) ) {
        $menu[65][0] = 'Wtyczki (ukryte)';
    }

    if ( isset( $submenu['index.php'][10][0] ) ) {
        $submenu['index.php'][10][0] = 'Aktualizacje (ukryte)';
    }
}

// === BLOKOWANIE DOSTĘPU DO ZAWARTOŚCI STRON WP-ADMIN ===

add_action( 'admin_init', 'bbloomer_block_plugins_and_updates_pages' );
function bbloomer_block_plugins_and_updates_pages() {
    if ( ! bbloomer_should_hide_updates() ) {
        return;
    }

    $current_screen = $_SERVER['REQUEST_URI'];

    // Blokuj stronę wtyczek
    if ( strpos( $current_screen, '/plugins.php' ) !== false ) {
        bbloomer_render_blocked_message();
    }

    // Blokuj stronę aktualizacji
    if ( strpos( $current_screen, '/update-core.php' ) !== false ) {
        bbloomer_render_blocked_message();
    }
}

// Funkcja wyświetlająca komunikat o braku dostępu
function bbloomer_render_blocked_message() {
    wp_die(
        '<h1>Brak uprawnień</h1><p>Brak uprawnień aby mieć dostęp do tej podstrony.</p>',
        'Brak dostępu',
        array( 'response' => 403 )
    );
}

/*
 * This code duplicates a WordPress page. The duplicate page will appear as a draft and the user will be redirected to the edit screen.
 */
function rd_duplicate_post_as_draft(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
        wp_die('No post to duplicate has been supplied!');
    }
    if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
        return;
    $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    $post = get_post( $post_id );
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;
    if (isset( $post ) && $post != null) {
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );
        $new_post_id = wp_insert_post( $args );
        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos)!=0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                if( $meta_key == '_wp_old_slug' ) continue;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        exit;
    } else {
        wp_die('Tworzenie posta nie powiodło się, nie można znaleźć oryginalnego posta:' . $post_id);
    }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
function rd_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplikuj to" rel="permalink">Duplikuj</a>';
    }
    return $actions;
}
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'rd_duplicate_post_link', 10, 2 );

add_theme_support( 'post-thumbnails' );
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
    add_image_size( 'homepage-thumb', 220, 180, true ); // (cropped)
    add_image_size( 'sidebar-thumb', 120, 120, true ); // Hard Crop Mode
    add_image_size( 'singlepost-thumb', 590, 999 ); // Unlimited Height Mode
}

// Disable comments from media
function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

// Remove permament comments
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu( 'new-content' );
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
// Remove Quick Draft Dashboard Widget
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );
function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
// End remove post type

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar_mdstal', 999 );
function remove_default_post_type_menu_bar_mdstal( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'edit' );
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('themes');
    $wp_admin_bar->remove_menu('widgets');
    $wp_admin_bar->remove_node( 'wp-logo' );
}

function wpl_gtm_head_code(){
?>
    
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TC7CRVGW6J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TC7CRVGW6J');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MM7BHBGT');</script>
<!-- End Google Tag Manager -->

<?php 
}
add_action('wp_head', 'wpl_gtm_head_code');

/**
 * SafePilot wp_body_open_gtm_code_schema Hook Implementation
 */

// Dodaj support dla wp_body_open_gtm_code_schema (WordPress 5.2+)
if ( ! function_exists( 'wp_body_open_gtm_code_schema' ) ) {
    /**
     * Fire the wp_body_open_gtm_code_schema action.
     * Added for backward compatibility for WordPress versions < 5.2
     */
    function wp_body_open_gtm_code_schema() {
        do_action( 'wp_body_open_gtm_code_schema' );
    }
}

/**
 * Dodanie Skip Link dla dostępności
 */
function safepilot_add_skip_link() {
    ?>
    <a class="skip-link screen-reader-text" href="#main">
        <?php esc_html_e( 'Przejdź do głównej treści', 'safepilot-startup-child' ); ?>
    </a>
    <?php
}
add_action( 'wp_body_open', 'safepilot_add_skip_link', 5 );

/**
 * Dodanie Schema.org markup dla organizacji
 */
function safepilot_add_organization_schema() {
    if ( is_front_page() ) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "SafePilot",
            "url": "https://www.safepilot.pl",
            "logo": "<?php echo get_template_directory_uri(); ?>/assets/images/safepilot-logo.png",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+48-726-739-238",
                "contactType": "customer service",
                "areaServed": "PL",
                "availableLanguage": "Polish"
            },
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "ul. Kordiana 50B/65",
                "addressLocality": "Kraków",
                "postalCode": "30-653",
                "addressCountry": "PL"
            },
            "sameAs": [
                "https://www.facebook.com/safepilot.pl",
                "https://www.linkedin.com/company/safepilot"
            ]
        }
        </script>
        <?php
    }
}
add_action( 'wp_body_open_gtm_code_schema', 'safepilot_add_organization_schema', 1 );

function wpl_gtm_body_code() { 
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MM7BHBGT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php 
}

add_action( 'wp_body_open_gtm_code_schema', 'wpl_gtm_body_code' );

// Dodaj style CSS do zaplecza admina dla wszystkich użytkowników z wyjątkiem user ID 1
function my_custom_admin_css_for_users() {
    // Sprawdź, czy użytkownik jest zalogowany
    if ( ! is_user_logged_in() ) {
        return;
    }

    // Pobierz ID aktualnego użytkownika
    $current_user_id = get_current_user_id();

    // Jeśli to NIE użytkownik o ID 1 — dodaj style
    if ( $current_user_id !== 1 ) {
        echo '<style>
            /* Ukryj metaboxy w edycji strony/postu */
            #setting-error-tgmpa, #vc_license-activation-notice, #wpb-notice-16, #slider_revolution_metabox, #post-override-options {
                display: none !important;
            }
        </style>';
    }
}
add_action('admin_head', 'my_custom_admin_css_for_users');

// Krok 1: Dodanie strony do menu administracyjnego
add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {

    // Dodanie strony do menu
    add_menu_page(
        'Pomoc techniczna',          // Tytuł strony
        'Pomoc techniczna',          // Tytuł w menu
        'edit_posts',                // Wymagana rola
        'pomoc-techniczna',          // Slug strony
        'my_plugin_options',         // Callback funkcji wyświetlającej
        'dashicons-info',                   // Ikona
        100                          // Pozycja w menu
    );
}

// Krok 2: Funkcja callback (możesz dostosować treść strony)
function my_plugin_options() {
    ?>
    <div class="wrap">
        <h1>Pomoc techniczna</h1>
        <p>Skontaktuj się z nami kiedy potrzebujesz fachowej i profesjonalnej pomocy ze swoją witryną internetową.</p>
    </div>
       <style>
div.container4 {
  margin-top: 20%;
  margin-left: 40%;
  align-items: center;
  justify-content: center
  text-align: center; }
  div.container5 {
  margin-top: 20px;
  margin-left: 45%;
  align-items: center;
  justify-content: center
  text-align: center; }
</style>
<div class="container4">
<h1 style="font-size: 50px;">Pomoc techniczna</h1></div>
<div class="container5"><h4><a href="mailto:biuro@pbmediaonline.pl" target="_blank" style="font-size: 20px;">biuro@pbmediaonline.pl</a></h4></div>
    <?php
}

// Ukrywanie wybranych pozycji menu dla wszystkich użytkowników z wyjątkiem użytkownika o ID 1
function wpdocs_customize_admin_menu_for_users() {
    // Sprawdź, czy użytkownik jest zalogowany
    if ( ! is_user_logged_in() ) {
        return;
    }

    // Pobierz ID aktualnie zalogowanego użytkownika
    $current_user_id = get_current_user_id();

    // Jeśli to NIE użytkownik o ID 1 — ukryj określone pozycje menu
    if ( $current_user_id !== 1 ) {
    remove_menu_page('vc-general'); //Divi WP Theme
    remove_menu_page('revslider'); //Divi WP Theme
    remove_menu_page('themes.php?page=trx_importer'); //Divi WP Theme
    remove_menu_page('wpsol_dashboard'); //WP CODE
    remove_submenu_page( 'upload.php', 'wp-short-pixel-bulk' );
	remove_submenu_page( 'options-general.php', 'wp-shortpixel-settings' );
	remove_submenu_page( 'upload.php', 'wp-short-pixel-custom' );
    remove_submenu_page( 'themes.php', 'trx_importer' );
    remove_submenu_page( 'themes.php', 'cars4rent_options' );
    remove_submenu_page( 'themes.php', 'cars4rent_options_customizer' );
    remove_submenu_page( 'themes.php', 'tgmpa-install-plugins' );
    }
}
add_action( 'admin_init', 'wpdocs_customize_admin_menu_for_users', 999 );

// =========================================================================
// Zaawansowana obsługa Shortcode'ów dla szablonów
// =========================================================================

/**
 * Rejestruje shortcode, który wczytuje określony plik szablonu z motywu potomnego.
 *
 * Ta funkcja pozwala dynamicznie tworzyć shortcody dla różnych plików szablonów,
 * podając nazwę shortcode'u i ścieżkę do pliku w folderze motywu potomnego.
 *
 * @param string $tag Nazwa shortcode'u (np. 'moj_slider').
 * @param string $template_path Ścieżka do pliku szablonu względem folderu motywu potomnego
 *                              (np. 'template-parts/sliders/main-slider.php').
 */
function safepilot_register_template_shortcode( $tag, $template_path ) {
    
    // Sprawdzamy, czy podano nazwę shortcode'u i ścieżkę
    if ( empty( $tag ) || empty( $template_path ) ) {
        return;
    }

    // Tworzymy nową funkcję dla shortcode'u
    add_shortcode( $tag, function() use ( $template_path ) {
        
        // Budujemy pełną, absolutną ścieżkę do pliku w motywie potomnym
        $full_path = get_stylesheet_directory() . '/' . $template_path;
        
        // Zaczynamy buforowanie wyjścia - przechwytujemy cały kod HTML z pliku
        ob_start();

        // Sprawdzamy, czy plik fizycznie istnieje na serwerze
        if ( file_exists( $full_path ) ) {
            // Jeśli tak, wczytujemy go
            include $full_path;
        } else {
            // Jeśli nie, wyświetlamy komunikat błędu (widoczny tylko dla administratorów)
            if ( current_user_can( 'manage_options' ) ) {
                echo '<p style="color: red; background: #ffe0e0; border: 1px solid red; padding: 10px;">';
                echo 'Błąd shortcode\'u [<strong>' . esc_html( $tag ) . '</strong>]: Plik szablonu nie został znaleziony w lokalizacji: <code>' . esc_html( $template_path ) . '</code>';
                echo '</p>';
            }
        }

        // Kończymy buforowanie i zwracamy całą zawartość jako tekst
        return ob_get_clean();
    });
}

// --- Przykład użycia nowej funkcji ---

// 2. Rejestracja shortcode'u dla sekcji "First Section"
safepilot_register_template_shortcode(
    'index1-first-section', 
    'template-shortcode-extech/index1/index1-first-section.php'
);

// 3. Rejestracja shortcode'u dla sekcji "Hero"
safepilot_register_template_shortcode(
    'sekcja_hero', 
    'template-shortcode-extech/index1/index1-hero-section.php'
);

// 4. Rejestracja shortcode'u dla sekcji "Usługi"
safepilot_register_template_shortcode(
    'sekcja_uslugi', 
    'template-shortcode-extech/index1/index1-service-section.php'
);

// 5. Rejestracja shortcode'u dla sekcji "O nas"
safepilot_register_template_shortcode(
    'sekcja_o_nas', 
    'template-shortcode-extech/index1/index1-about-section.php'
);

// 6. Rejestracja shortcode'u dla sekcji "Projekty" nie działa
safepilot_register_template_shortcode(
    'sekcja_projekty', 
    'template-shortcode-extech/index1/index1-project-section.php'
);

// 7. Rejestracja shortcode'u dla sekcji "Proces Pracy"
safepilot_register_template_shortcode(
    'sekcja_proces_pracy', 
    'template-shortcode-extech/index1/index1-work-process-section.php'
);

// 8. Rejestracja shortcode'u dla sekcji "Cennik"
safepilot_register_template_shortcode(
    'sekcja_cennik', 
    'template-shortcode-extech/index1/index1-pricing-section.php'
);

// 9. Rejestracja shortcode'u dla sekcji "Zespół"
safepilot_register_template_shortcode(
    'sekcja_zespol', 
    'template-shortcode-extech/index1/index1-team-section.php'
);

// 10. Rejestracja shortcode'u dla sekcji "FAQ"
safepilot_register_template_shortcode(
    'sekcja_faq', 
    'template-shortcode-extech/index1/index1-faq-section.php'
);

// 11. Rejestracja shortcode'u dla pierwszej sekcji "CTA"
safepilot_register_template_shortcode(
    'sekcja_cta_1', 
    'template-shortcode-extech/index1/index1-cta-section.php'
);

// 12. Rejestracja shortcode'u dla sekcji "Opinie"
safepilot_register_template_shortcode(
    'sekcja_opinie_slider', 
    'template-shortcode-extech/index1/index1-testimonial-section.php'
);

// 13. Rejestracja shortcode'u dla sekcji "Blog" nie działa
safepilot_register_template_shortcode(
    'sekcja_blog', 
    'template-shortcode-extech/index1/index1-blog-section.php'
);

// 14. Rejestracja shortcode'u dla drugiej sekcji "CTA"
safepilot_register_template_shortcode(
    'sekcja_cta_2', 
    'template-shortcode-extech/index1/index1-cta-section-2.php'
);

// =========================================================================
// Rejestracja shortcode'ów dla szablonu strony głównej nr 2
// =========================================================================

// Shortcode dla sekcji "Hero" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_hero_v2', 
    'template-shortcode-extech/index2/index2-hero-section.php'
);

// Shortcode dla sekcji "Why Choose Us" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_wcu_v2', 
    'template-shortcode-extech/index2/index2-wcu-section.php'
);

// Shortcode dla sekcji "O nas" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_o_nas_v2', 
    'template-shortcode-extech/index2/index2-about-section.php'
);

// Shortcode dla sekcji "Usługi" (wersja 2)
safepilot_register_template_shortcode(
    'sekcja_uslugi_v2', 
    'template-shortcode-extech/index2/index2-service-section.php'
);

// Shortcode dla sekcji "Proces Pracy" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_proces_pracy_v2', 
    'template-shortcode-extech/index2/index2-work-process-section.php'
);

// Shortcode dla sekcji "Projekty" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_projekty_v2', 
    'template-shortcode-extech/index2/index2-project-section.php'
);

// Shortcode dla sekcji "Cennik" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_cennik_v2', 
    'template-shortcode-extech/index2/index2-pricing-section.php'
);

// Shortcode dla sekcji "Zespół" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_zespol_v2', 
    'template-shortcode-extech/index2/index2-team-section.php'
);

// Shortcode dla sekcji "Blog" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_blog_v2', 
    'template-shortcode-extech/index2/index2-blog-section.php'
);

// Shortcode dla sekcji "Blog" (wersja 2) nie działa
safepilot_register_template_shortcode(
    'sekcja_footer_top_contact_cta', 
    'template-shortcode-extech/index2/footer-top-contact-cta.php'
);

// =========================================================================
// Rejestracja shortcode'ów dla szablonu strony głównej nr 3 (index-3.html)
// =========================================================================

// Shortcode dla sekcji "Hero" (wersja 3)
safepilot_register_template_shortcode(
    'sekcja_hero_v3', 
    'template-shortcode-extech/index3/index3-hero-section.php'
);

// Shortcode dla sekcji "O nas" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_o_nas_v3', 
    'template-shortcode-extech/index3/index3-about-section.php'
);

// Shortcode dla sekcji "Usługi" (wersja 3)
safepilot_register_template_shortcode(
    'sekcja_uslugi_v3', 
    'template-shortcode-extech/index3/index3-service-section.php'
);

// Shortcode dla sekcji "Proces Pracy" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_proces_pracy_v3', 
    'template-shortcode-extech/index3/index3-work-process-section.php'
);

// Shortcode dla sekcji "Osiągnięcia" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_osiagniecia_v3', 
    'template-shortcode-extech/index3/index3-achievement-section.php'
);

// Shortcode dla sekcji "Projekty" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_projekty_v3', 
    'template-shortcode-extech/index3/index3-project-section.php'
);

// Shortcode dla sekcji "Zespół" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_zespol_v3', 
    'template-shortcode-extech/index3/index3-team-section.php'
);

// Shortcode dla sekcji "Opinie" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_opinie_v3', 
    'template-shortcode-extech/index3/index3-testimonial-section.php'
);

// Shortcode dla sekcji "Aktualności" (wersja 3) nie działa
safepilot_register_template_shortcode(
    'sekcja_aktualnosci_v3', 
    'template-shortcode-extech/index3/index3-news-section.php'
);

// Shortcode dla sekcji "Aktualności" (wersja 3)
safepilot_register_template_shortcode(
    'sekcja_kontakt_template', 
    'template-shortcode-extech/contact/contact-section.php'
);

// Shortcode dla sekcji "Aktualności" (wersja 3)
safepilot_register_template_shortcode(
    'sekcja_kontakt_template_homepage', 
    'template-shortcode-extech/contact/contact-section-homepage-bottom.php'
);

// Shortcode dla sekcji "Aktualności" (wersja 3)
safepilot_register_template_shortcode(
    'sekcja_kontakt_map_bottom', 
    'template-shortcode-extech/contact/contact-section-map-bottom.php'
);

// =========================================================================
// Rejestracja shortcode'ów dla podstrony Usługi (service.html)
// =========================================================================

// Shortcode dla siatki usług
safepilot_register_template_shortcode(
    'sekcja_uslugi_grid', 
    'template-shortcode-extech/service/service-services-section.php'
);

// Shortcode dla sekcji FAQ
safepilot_register_template_shortcode(
    'sekcja_faq_uslugi', 
    'template-shortcode-extech/service/service-faq-section.php'
);

// Shortcode dla sekcji kontaktowej
safepilot_register_template_shortcode(
    'sekcja_kontakt_uslugi', 
    'template-shortcode-extech/service/service-contact-section.php'
);

// Shortcode dla sekcji kontaktowej
safepilot_register_template_shortcode(
    'contact-cta3', 
    'template-shortcode-extech/index3/contact-cta3.php'
);

// Shortcode dla sekcji kontaktowej
safepilot_register_template_shortcode(
    'gallery-section-service', 
    'template-shortcode-extech/gallery/gallery-section-service.php'
);

function delete_post_type(){
  unregister_post_type( 'portfolio' );
  unregister_post_type( 'gf_content' );
  unregister_post_type( 'gf_template' );
  unregister_post_type( 'gf_preset' );
}
add_action('init','delete_post_type', 100);

/**
 * Wczytaj pliki CSS i JS z katalogu /custom/ w katalogu głównym WordPressa
 */
function enqueue_custom_assets_from_custom_folder() {
    $custom_base_url = get_site_url() . '/custom';

    // CSS
    wp_enqueue_style(
        'cookieconsent',
        $custom_base_url . '/cookieconsent.min.css',
        array(),
        null
    );

    wp_enqueue_style(
        'iframemanager-css',
        $custom_base_url . '/iframemanager.min.css',
        array(),
        null
    );

    // JS

    wp_enqueue_script(
        'iframemanager-js',
        $custom_base_url . '/iframemanager.js',
        array(),
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_assets_from_custom_folder' );

/**
 * Enqueue Hero Slider Script
 */
function safepilot_enqueue_hero_slider() {
    if (is_front_page()) {
        wp_enqueue_script(
            'safepilot-hero-slider',
            get_stylesheet_directory_uri() . '/assets/js/hero-slider.js',
            array('jquery'),
            '2.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'safepilot_enqueue_hero_slider');

/**
 * Enqueue About Section Scripts
 */
function safepilot_about_counters_script() {
    if (is_front_page()) {
        wp_enqueue_script(
            'safepilot-about-counters',
            get_stylesheet_directory_uri() . '/assets/js/about-counters.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'safepilot_about_counters_script');

/**
 * Wczytaj cookieconsent-config.js jako moduł (type="module")
 */
function enqueue_cookieconsent_module_script() {
    $custom_base_url = get_site_url() . '/custom';

    wp_enqueue_script(
        'cookieconsent-config',
        $custom_base_url . '/cookieconsent-config.js',
        array(),
        null,
        true // wczytaj w footerze
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_cookieconsent_module_script' );

/**
 * Dodaj type="module" do cookieconsent-config.js
 */
function add_type_module_to_cookieconsent( $tag, $handle, $src ) {
    if ( 'cookieconsent-config' === $handle ) {
        return '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_type_module_to_cookieconsent', 10, 3 );

/**
 * SafePilot - Funkcje blogowe
 * Dodaj ten kod do functions.php w motywie potomnym
 */

// Enqueue stylów dla bloga
function safepilot_enqueue_blog_styles() {
    if (is_home() || is_archive() || is_search() || is_single()) {
        wp_enqueue_style(
            'safepilot-blog-styles',
            get_stylesheet_directory_uri() . '/assets/css/blog-styles.css',
            array(),
            '2.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'safepilot_enqueue_blog_styles');

// Modyfikacja excerpt length
function safepilot_excerpt_length($length) {
    if (is_home() || is_archive()) {
        return 25;
    }
    return $length;
}
add_filter('excerpt_length', 'safepilot_excerpt_length');

// Modyfikacja excerpt more
function safepilot_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'safepilot_excerpt_more');

// Dodanie obsługi thumbnails
function safepilot_setup_thumbnails() {
    add_image_size('large-image', 1200, 600, true);
    add_image_size('medium-image', 600, 400, true);
}
add_action('after_setup_theme', 'safepilot_setup_thumbnails');

// Funkcja pomocnicza do wyświetlania thumbnails
if (!function_exists('g5plus_get_post_thumbnail')) {
    function g5plus_get_post_thumbnail($size = 'large') {
        if (has_post_thumbnail()) {
            echo '<div class="sp-post-thumbnail">';
            echo '<a href="' . get_permalink() . '">';
            the_post_thumbnail($size, array('class' => 'img-fluid'));
            echo '</a>';
            echo '</div>';
        }
    }
}

/**
 * SafePilot - Poprawki dla obrazków w blogach
 * Dodaj ten kod do końca pliku functions.php
 */

// Rejestracja rozmiarów obrazków
add_action('after_setup_theme', 'safepilot_fix_image_sizes');
function safepilot_fix_image_sizes() {
    // Usunięcie starych rozmiarów
    remove_image_size('large-image');
    remove_image_size('medium-image');
    
    // Dodanie nowych rozmiarów
    add_image_size('sp-large', 1200, 600, true);
    add_image_size('sp-medium', 600, 400, true);
    add_image_size('sp-small', 400, 300, true);
    
    // Wsparcie dla obrazków wyróżniających
    add_theme_support('post-thumbnails');
    
    // Ustawienie domyślnego rozmiaru
    set_post_thumbnail_size(800, 450, true);
}

// Poprawka funkcji g5plus_get_post_thumbnail jeśli nie istnieje
if (!function_exists('g5plus_get_post_thumbnail')) {
    function g5plus_get_post_thumbnail($size = 'large') {
        if (has_post_thumbnail()) {
            echo '<div class="sp-post-thumbnail">';
            echo '<a href="' . get_permalink() . '">';
            the_post_thumbnail($size, array('class' => 'img-fluid'));
            echo '</a>';
            echo '</div>';
        } else {
            echo '<div class="sp-post-thumbnail sp-no-image">';
            echo '<a href="' . get_permalink() . '">';
            echo '<div class="sp-placeholder-image sp-placeholder-' . esc_attr($size) . '">';
            echo '<i class="fa-regular fa-image"></i>';
            echo '<span>Brak obrazka</span>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    }
}

// Filtr dla rozmiarów obrazków
add_filter('intermediate_image_sizes_advanced', 'safepilot_filter_image_sizes');
function safepilot_filter_image_sizes($sizes) {
    // Usuń niepotrzebne rozmiary
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    
    return $sizes;
}

// Regeneracja obrazków po zmianie rozmiarów
add_action('admin_notices', 'safepilot_regenerate_thumbnails_notice');
function safepilot_regenerate_thumbnails_notice() {
    if (get_option('safepilot_regenerate_thumbs_notice') !== 'dismissed') {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e('SafePilot: Zalecamy regenerację miniatur po zmianie rozmiarów. Zainstaluj wtyczkę "Regenerate Thumbnails".', 'safepilot'); ?></p>
        </div>
        <?php
    }
}

/**
 * SafePilot - Kompleksowa naprawa obrazków
 * Dodaj na końcu functions.php
 */

// Napraw rozmiary obrazków
add_filter('wp_get_attachment_image_attributes', 'safepilot_fix_image_dimensions', 999, 3);
function safepilot_fix_image_dimensions($attr, $attachment, $size) {
    // Sprawdź czy $attachment jest obiektem lub ID
    if (is_object($attachment) && isset($attachment->ID)) {
        $attachment_id = $attachment->ID;
    } elseif (is_numeric($attachment)) {
        $attachment_id = $attachment;
    } else {
        return $attr; // Zwróć bez zmian jeśli nie możemy określić ID
    }
    
    // Jeśli width lub height = 1, napraw to
    if (isset($attr['width']) && $attr['width'] == 1) {
        $image_meta = wp_get_attachment_metadata($attachment_id);
        if ($image_meta && isset($image_meta['width']) && isset($image_meta['height'])) {
            $attr['width'] = $image_meta['width'];
            $attr['height'] = $image_meta['height'];
        } else {
            // Domyślne rozmiary
            $attr['width'] = 800;
            $attr['height'] = 450;
        }
    }
    
    // Dodaj klasy
    if (!isset($attr['class'])) {
        $attr['class'] = '';
    }
    $attr['class'] .= ' sp-responsive-img';
    
    return $attr;
}

// Napraw rozmiary obrazków dla the_post_thumbnail
add_filter('post_thumbnail_html', 'safepilot_fix_thumbnail_html', 999, 5);
function safepilot_fix_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    // Napraw width="1" height="1"
    $html = preg_replace('/width="1"/', 'width="800"', $html);
    $html = preg_replace('/height="1"/', 'height="450"', $html);
    
    // Dodaj data-size attribute
    $html = str_replace('<img', '<img data-size="' . esc_attr($size) . '"', $html);
    
    return $html;
}

// Rejestruj poprawne rozmiary
add_action('after_setup_theme', 'safepilot_register_correct_sizes', 999);
function safepilot_register_correct_sizes() {
    // Usuń stare
    remove_image_size('large-image');
    remove_image_size('medium-image');
    
    // Dodaj nowe z poprawnymi rozmiarami
    add_image_size('sp-large', 1200, 600, true);
    add_image_size('sp-medium', 800, 450, true); 
    add_image_size('sp-small', 400, 300, true);
    add_image_size('sp-grid', 600, 400, true);
    
    // Upewnij się że thumbnail support jest włączony
    add_theme_support('post-thumbnails');
    
    // Ustaw domyślny rozmiar
    update_option('thumbnail_size_w', 150);
    update_option('thumbnail_size_h', 150);
    update_option('medium_size_w', 800);
    update_option('medium_size_h', 450);
    update_option('large_size_w', 1200);
    update_option('large_size_h', 600);
}

// Poprawiona funkcja g5plus_get_post_thumbnail
if (!function_exists('g5plus_get_post_thumbnail')) {
    function g5plus_get_post_thumbnail($size = 'large', $gallery_id = 0, $is_single = false) {
        // Mapowanie rozmiarów
        $size_map = array(
            'large-image' => 'sp-large',
            'medium-image' => 'sp-medium',
            'large' => 'sp-large',
            'medium' => 'sp-medium',
            'full' => 'full'
        );
        
        if (isset($size_map[$size])) {
            $size = $size_map[$size];
        }
        
        if (has_post_thumbnail()) {
            $thumbnail_id = get_post_thumbnail_id();
            
            // Sprawdź czy thumbnail_id jest poprawny
            if (!$thumbnail_id) {
                safepilot_show_placeholder($size, $is_single);
                return;
            }
            
            $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            if (empty($image_alt)) {
                $image_alt = get_the_title();
            }
            
            echo '<div class="sp-post-thumbnail">';
            if (!$is_single) {
                echo '<a href="' . esc_url(get_permalink()) . '">';
            }
            
            // Użyj wp_get_attachment_image z poprawnymi atrybutami
            $image = wp_get_attachment_image($thumbnail_id, $size, false, array(
                'class' => 'img-fluid sp-blog-img',
                'alt' => esc_attr($image_alt),
                'loading' => 'lazy'
            ));
            
            if ($image) {
                echo $image;
            } else {
                // Fallback jeśli nie można pobrać obrazka
                echo '<img src="' . esc_url(wp_get_attachment_url($thumbnail_id)) . '" class="img-fluid sp-blog-img" alt="' . esc_attr($image_alt) . '" loading="lazy">';
            }
            
            if (!$is_single) {
                echo '</a>';
            }
            echo '</div>';
        } else {
            safepilot_show_placeholder($size, $is_single);
        }
    }
}

// Funkcja pomocnicza dla placeholder
if (!function_exists('safepilot_show_placeholder')) {
    function safepilot_show_placeholder($size = 'large', $is_single = false) {
        echo '<div class="sp-post-thumbnail sp-no-image">';
        if (!$is_single) {
            echo '<a href="' . esc_url(get_permalink()) . '">';
        }
        echo '<div class="sp-placeholder-image sp-placeholder-' . esc_attr($size) . '">';
        echo '<i class="fa-regular fa-image"></i>';
        echo '<span>Brak obrazka</span>';
        echo '</div>';
        if (!$is_single) {
            echo '</a>';
        }
        echo '</div>';
    }
}

/**
 * ===================================================================
 * POPRAWIONA OBSŁUGA TŁUMACZEŃ - SafePilot Startup Framework
 * Wersja 3.0 - Naprawia błąd nieskończonej rekurencji
 * ===================================================================
 */

/**
 * Globalna flaga zapobiegająca rekurencji
 */
global $safepilot_loading_textdomain;
$safepilot_loading_textdomain = false;

/**
 * Główna funkcja ładująca tłumaczenia Startup Framework
 * Priorytet 5 - wykonuje się wcześnie, przed innymi wtyczkami
 */
function safepilot_load_startup_framework_translations() {
    // Sprawdź flagę rekurencji
    global $safepilot_loading_textdomain;
    if ( $safepilot_loading_textdomain ) {
        return;
    }
    
    // Ustaw flagę
    $safepilot_loading_textdomain = true;
    
    // Pobierz lokalizację
    $locale = determine_locale();
    
    // Ścieżki do plików
    $mofile_child = get_stylesheet_directory() . '/languages/startup-framework-' . $locale . '.mo';
    $mofile_parent = get_template_directory() . '/languages/startup-framework-' . $locale . '.mo';
    $mofile_plugin = WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $locale . '.mo';
    
    // Debug log (zakomentowane w produkcji)
    // error_log( 'SafePilot: Sprawdzam tłumaczenia dla locale: ' . $locale );
    // error_log( 'SafePilot: Child theme MO exists: ' . ( file_exists( $mofile_child ) ? 'YES' : 'NO' ) );
    
    // Najpierw próbuj załadować z motywu potomnego
    if ( file_exists( $mofile_child ) ) {
        unload_textdomain( 'startup-framework' );
        $result = load_textdomain( 'startup-framework', $mofile_child );
        
        // Debug log
        // error_log( 'SafePilot: Ładowanie z child theme: ' . ( $result ? 'SUCCESS' : 'FAILED' ) );
        
        $safepilot_loading_textdomain = false;
        return;
    }
    
    // Następnie z motywu rodzica
    if ( file_exists( $mofile_parent ) ) {
        unload_textdomain( 'startup-framework' );
        load_textdomain( 'startup-framework', $mofile_parent );
        $safepilot_loading_textdomain = false;
        return;
    }
    
    // Na końcu ze standardowej lokalizacji wtyczki
    if ( file_exists( $mofile_plugin ) ) {
        unload_textdomain( 'startup-framework' );
        load_textdomain( 'startup-framework', $mofile_plugin );
    }
    
    // Zresetuj flagę
    $safepilot_loading_textdomain = false;
}

// Usuń wszystkie poprzednie hooki przed dodaniem nowych
remove_action( 'plugins_loaded', 'safepilot_load_startup_framework_translations', 10 );
remove_filter( 'override_load_textdomain', 'safepilot_override_startup_framework_textdomain', 1 );

// Dodaj główny hook z priorytetem 5
add_action( 'plugins_loaded', 'safepilot_load_startup_framework_translations', 5 );

/**
 * Bezpieczny filtr dla load_textdomain_mofile
 * Przekierowuje ścieżkę do pliku MO bez wywoływania load_textdomain
 */
function safepilot_change_startup_framework_mofile_path( $mofile, $domain ) {
    // Tylko dla domeny startup-framework
    if ( 'startup-framework' !== $domain ) {
        return $mofile;
    }
    
    // Sprawdź flagę rekurencji
    global $safepilot_loading_textdomain;
    if ( $safepilot_loading_textdomain ) {
        return $mofile;
    }
    
    // Pobierz lokalizację
    $locale = determine_locale();
    
    // Zbuduj ścieżkę do pliku w motywie potomnym
    $mofile_child = get_stylesheet_directory() . '/languages/startup-framework-' . $locale . '.mo';
    
    // Jeśli plik istnieje w motywie potomnym, zwróć jego ścieżkę
    if ( file_exists( $mofile_child ) ) {
        // error_log( 'SafePilot: Przekierowuję do child theme MO: ' . $mofile_child );
        return $mofile_child;
    }
    
    // W przeciwnym razie zwróć oryginalną ścieżkę
    return $mofile;
}

// Dodaj bezpieczny filtr
add_filter( 'load_textdomain_mofile', 'safepilot_change_startup_framework_mofile_path', 10, 2 );

/**
 * Alternatywna metoda - hook dla init
 * Uruchamia się później, po załadowaniu wszystkich wtyczek
 */
function safepilot_late_load_translations() {
    // Tylko jeśli domena nie jest jeszcze załadowana
    if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
        safepilot_load_startup_framework_translations();
    }
}
add_action( 'init', 'safepilot_late_load_translations', 1 );

/**
 * Funkcja czyszcząca cache tłumaczeń (pomocnicza)
 */
function safepilot_clear_translation_cache() {
    global $l10n, $l10n_unloaded;
    
    if ( isset( $l10n['startup-framework'] ) ) {
        unset( $l10n['startup-framework'] );
    }
    
    if ( isset( $l10n_unloaded['startup-framework'] ) ) {
        unset( $l10n_unloaded['startup-framework'] );
    }
}

/**
 * Hook dla theme switch - czyści cache przy zmianie motywu
 */
add_action( 'switch_theme', 'safepilot_clear_translation_cache' );

/**
 * Funkcja debugowania (TYLKO DLA TESTÓW - zakomentuj w produkcji)
 */
function safepilot_debug_translations() {
    // Wyłączone w produkcji - odkomentuj tylko do debugowania
    return;
    
    /*
    if ( ! current_user_can( 'manage_options' ) || ! isset( $_GET['debug_translations'] ) ) {
        return;
    }
    
    $locale = determine_locale();
    $mofile_child = get_stylesheet_directory() . '/languages/startup-framework-' . $locale . '.mo';
    $mofile_parent = get_template_directory() . '/languages/startup-framework-' . $locale . '.mo';
    $mofile_plugin = WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $locale . '.mo';
    
    echo '<div style="background: #fff; border: 2px solid #4fb9ad; padding: 20px; margin: 20px; border-radius: 8px;">';
    echo '<h3 style="color: #213543;">🔍 Debug: Tłumaczenia Startup Framework</h3>';
    echo '<table style="width: 100%; border-collapse: collapse;">';
    echo '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Lokalizacja:</strong></td><td>' . esc_html( $locale ) . '</td></tr>';
    echo '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Child Theme:</strong></td><td>' . ( file_exists( $mofile_child ) ? '✅ Istnieje' : '❌ Brak' ) . '</td></tr>';
    echo '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Parent Theme:</strong></td><td>' . ( file_exists( $mofile_parent ) ? '✅ Istnieje' : '❌ Brak' ) . '</td></tr>';
    echo '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Plugin:</strong></td><td>' . ( file_exists( $mofile_plugin ) ? '✅ Istnieje' : '❌ Brak' ) . '</td></tr>';
    echo '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong>Textdomain loaded:</strong></td><td>' . ( is_textdomain_loaded( 'startup-framework' ) ? '✅ TAK' : '❌ NIE' ) . '</td></tr>';
    echo '</table>';
    
    // Test tłumaczenia
    $test_string = __( 'Theme Options', 'startup-framework' );
    echo '<p style="margin-top: 15px; padding: 10px; background: #f0f0f0; border-left: 4px solid #4fb9ad;">';
    echo '<strong>Test tłumaczenia:</strong> "Theme Options" → "' . esc_html( $test_string ) . '"';
    echo '</p>';
    
    echo '</div>';
    */
}
// add_action( 'wp_footer', 'safepilot_debug_translations' );
// add_action( 'admin_footer', 'safepilot_debug_translations' );

/**
 * Funkcja sprawdzająca poprawność plików MO (opcjonalna)
 */
function safepilot_validate_mo_file( $file_path ) {
    if ( ! file_exists( $file_path ) ) {
        return false;
    }
    
    // Sprawdź czy plik nie jest pusty
    if ( filesize( $file_path ) < 20 ) {
        error_log( 'SafePilot: Plik MO jest za mały: ' . $file_path );
        return false;
    }
    
    // Sprawdź sygnaturę pliku MO
    $handle = fopen( $file_path, 'rb' );
    if ( ! $handle ) {
        return false;
    }
    
    $magic = fread( $handle, 4 );
    fclose( $handle );
    
    // Magiczne numery dla plików MO
    $magic_le = "\x95\x04\x12\xde"; // Little-endian
    $magic_be = "\xde\x12\x04\x95"; // Big-endian
    
    if ( $magic !== $magic_le && $magic !== $magic_be ) {
        error_log( 'SafePilot: Nieprawidłowy format pliku MO: ' . $file_path );
        return false;
    }
    
    return true;
}