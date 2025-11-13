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

<meta property="fb:admins" content="464369106147391"/>
<meta property="fb:app_id" content="464369106147391" />
<meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>"/>
<meta property="og:description" content="<?php echo esc_attr( get_the_excerpt() ); ?>"/>
<meta property="og:url" content="<?php echo esc_attr( get_permalink() ); ?>"/>
<meta property="og:type" content="article"/>
<?php if ( has_post_thumbnail() ) : ?>
<meta property="og:image" content="<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>"/>
<?php endif; ?>
    
    <!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/pl_PL/fbevents.js');
fbq('init', '816543701848772');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=816543701848772&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<meta name="theme-color" content="#46abd7">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MKLK6C96');</script>
<!-- End Google Tag Manager -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '464369106147391',
      xfbml            : true,
      version          : 'v21.0'
    });
  };
</script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v21.0&appId=464369106147391"></script>

<?php 
}
add_action('wp_head', 'wpl_gtm_head_code');

function wpl_gtm_body_code() { 
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKLK6C96"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php 
}

add_action( 'wp_body_open', 'wpl_gtm_body_code' );

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

// Simple Shortcode
# Dodanie Realizacji shortcode dla strony głównej.
function realizacjeloopcpt() {
    ob_start();
    get_template_part('realizacjeloopcpt');
    return ob_get_clean();   
} 
add_shortcode( 'realizacjeloopcpt_shortcode', 'realizacjeloopcpt' );

