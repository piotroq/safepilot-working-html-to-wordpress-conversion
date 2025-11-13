<?php
/**
 * GET theme option value
 * *******************************************************
 */
if (!function_exists('g5plus_image_resize_id')) {
	function g5plus_image_resize_id($images_id, $width = NULL, $height = NULL, $crop = true, $retina = false) {
		$width      = intval( $width !== '' ? $width : get_option( 'thumbnail_size_w' ) );
		$height     = intval( $height !== '' ? $height : get_option( 'thumbnail_size_h' ) );
		$retina     = ( $retina === true ) ? 2 : 1;
		$orig_image = wp_get_attachment_image_src( $images_id, 'full' );

		if ( $orig_image === false ) {
			//return array( 'url' => '', 'width' => $width, 'height' => $height );
			return '';
		}

		$url         = $orig_image[0];
		$orig_width  = $orig_image[1];
		$orig_height = $orig_image[2];
		$file_path   = get_attached_file( $images_id );
		// Some additional info about the image.
		$info = pathinfo( $file_path );
		$dir  = $info['dirname'];
		$ext  = '';
		if ( ! empty( $info['extension'] ) ) {
			$ext = $info['extension'];
		}

		if ( $height === 0 ) {
			$height = round( ( $orig_height / $orig_width ) * $width );
			if ($width >= $orig_width) {
				return $url;
				/*return array(
					'url'    => $url,
					'width'  => $orig_width,
					'height' => $orig_height,
					'type'   => $ext,
					'path'   => $file_path
				);*/
			}
		}

		// Destination width and height variables
		$dest_width  = $width * $retina;
		$dest_height = $height * $retina;

		$name = wp_basename( $file_path, ".$ext" );

		// Suffix applied to filename.
		$suffix_retina = ( 1 != $retina ) ? '@' . $retina . 'x' : null;
		$suffix        = "{$width}x{$height}{$suffix_retina}";
		// Get the destination file name.
		$dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";

		if ( ! file_exists( $dest_file_name ) ) {
			// Load Wordpress Image Editor.
			$editor = wp_get_image_editor( $file_path );
			if ( is_wp_error( $editor ) ) {
				//return array( 'url' => $url, 'width' => $width, 'height' => $height );
				return $url;
			}
			$src_x = $src_y = 0;
			$src_w = $orig_width;
			$src_h = $orig_height;
			if ( $crop ) {
				$cmp_x = $orig_width / $dest_width;
				$cmp_y = $orig_height / $dest_height;
				// Calculate x or y coordinate, and width or height of source.
				if ( $cmp_x > $cmp_y ) {
					$src_w = round( $orig_width / $cmp_x * $cmp_y );
					$src_x = round( ( $orig_width - ( $orig_width / $cmp_x * $cmp_y ) ) / 2 );
				} elseif ( $cmp_y > $cmp_x ) {
					$src_h = round( $orig_height / $cmp_y * $cmp_x );
					$src_y = round( ( $orig_height - ( $orig_height / $cmp_y * $cmp_x ) ) / 2 );
				}
			}

			// Check if the file is writable before proceeding.
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			if ( ! $wp_filesystem->put_contents( $dest_file_name, '', FS_CHMOD_FILE ) ) {
				//return array( 'url' => $url, 'width' => $orig_width, 'height' => $orig_height );
				return $url;
			}

			// Time to crop the image!
			$editor->crop( $src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height );
			// Now let's save the image.
			$saved = $editor->save( $dest_file_name );
			// If saving fails, return the original image.
			if ( is_wp_error( $saved ) ) {
				//return array( 'url' => $url, 'width' => $width, 'height' => $height );
				return $url;
			}

			// Get resized image information.
			$resized_url    = str_replace( basename( $url ), basename( $saved['path'] ), $url );
			$resized_width  = $saved['width'];
			$resized_height = $saved['height'];
			$resized_type   = $saved['mime-type'];
			// Add the resized dimensions to original image metadata (so we can delete our resized images when the original image is delete from the Media Library).
			$metadata = wp_get_attachment_metadata( $images_id );
			if ( isset( $metadata['image_meta'] ) ) {
				//$metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
				$metadata['image_meta']['resized_images'][] = "{$name}-{$suffix}.{$ext}";
				wp_update_attachment_metadata( $images_id, $metadata );
			}
			$image_array = array(
				'url'    => $resized_url,
				'width'  => $resized_width,
				'height' => $resized_height,
				'type'   => $resized_type,
				'path'   => $dest_file_name,
			);
		} else {
			$image_array = array(
				'url'    => str_replace( wp_basename( $url ), wp_basename( $dest_file_name ), $url ),
				'width'  => $dest_width,
				'height' => $dest_height,
				'type'   => $ext,
				'path'   => $dest_file_name
			);
		}

		//$retina_url                = file_exists( "{$dir}/{$name}-{$suffix}{$suffix_retina}.{$ext}" ) ? rtrim( $image_array['url'], ".{$ext}" ) . "@2x.{$ext}" : false;
		//$image_array['retina_url'] = $retina_url;

		return $image_array['url'];


	}
}



/**
 *  Deletes the resized images when the original image is deleted from the Wordpress Media Library.
 *
 */
add_action('delete_attachment', 'g5plus_delete_resized_images');
if (!function_exists('g5plus_delete_resized_images')) {
    function g5plus_delete_resized_images($post_id)
    {

        // Get attachment image metadata
        $metadata = wp_get_attachment_metadata($post_id);
        if (!$metadata)
            return;

        // Do some bailing if we cannot continue
        if (!isset($metadata['file']) || !isset($metadata['image_meta']['resized_images']))
            return;
        $pathinfo = pathinfo($metadata['file']);
        $resized_images = $metadata['image_meta']['resized_images'];

        // Get Wordpress uploads directory (and bail if it doesn't exist)
        $wp_upload_dir = wp_upload_dir();
        $upload_dir = $wp_upload_dir['basedir'];
        if (!is_dir($upload_dir))
            return;

        // Delete the resized images
        foreach ($resized_images as $dims) {

            // Get the resized images filename
            $file = $upload_dir . '/' . $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '-' . $dims . '.' . $pathinfo['extension'];

            // Delete the resized image
            @unlink($file);
        }
    }
}
if (!function_exists('g5plus_get_option')) {
    function g5plus_get_option($key, $default = '')
    {
        if (function_exists('gf_get_option')) {
            return gf_get_option($key, $default);
        }
        return $default;
    }
}
/**
 * GET Meta Box Value
 * *******************************************************
 */
if (!function_exists('g5plus_get_rwmb_meta')) {
    function g5plus_get_rwmb_meta($key, $args = array(), $post_id = null)
    {
        if (function_exists('gf_get_rwmb_meta')) {
            return gf_get_rwmb_meta($key, $args, $post_id);
        }
        return '';
    }
}

/**
 * GET Meta Box Image Value
 * *******************************************************
 */
if (!function_exists('g5plus_get_rwmb_meta_image')) {
    function g5plus_get_rwmb_meta_image($key, $post_id = null)
    {
        if (function_exists('gf_get_rwmb_meta_image')) {
            return gf_get_rwmb_meta_image($key, $post_id);
        }
        return '';
    }
}

/**
 * GET Current Preset ID
 * *******************************************************
 */
if (!function_exists('g5plus_get_current_preset')) {
    function g5plus_get_current_preset()
    {
        if (function_exists('gf_get_current_preset')) {
            return gf_get_current_preset();
        }
        return 0;
    }
}

/**
 * Get Preset Dir
 * *******************************************************
 */
if (!function_exists('g5plus_get_preset_dir')) {
    function g5plus_get_preset_dir()
    {
        return G5PLUS_THEME_DIR . 'assets/preset/';
    }
}

/**
 * Get Preset Url
 * *******************************************************
 */
if (!function_exists('g5plus_get_preset_url')) {
    function g5plus_get_preset_url()
    {
        return G5PLUS_THEME_URL . 'assets/preset/';
    }
}

/**
 * GET Category Binder
 * *******************************************************
 */
if (!function_exists('g5plus_categories_binder')) {
    function g5plus_categories_binder($categories, $parent, $class = 'search-category-dropdown', $is_anchor = false, $show_count = false)
    {
        $index = 0;
        $output = '';
        $parent .= '';
        foreach ($categories as $key => $term) {
            $term->parent .= '';
            if (($term->parent !== $parent)) {
                continue;
            }
            if ($index == 0) {
                $output = '<ul>';
                if ($parent == 0) {
                    $output = '<ul class="' . esc_attr($class) . '">';
                }
            }

            $output .= '<li>';
            $output .= sprintf('%s%s%s',
                $is_anchor ? '<a href="' . get_term_link((int)$term->term_id, 'product_cat') . '" title="' . esc_attr($term->name) . '">' : '<span data-id="' . esc_attr($term->term_id) . '">',
                $show_count ? esc_html($term->name . ' (' . $term->count . ')') : esc_html($term->name),
                $is_anchor ? '</a>' : '</span>'
            );
            $output .= g5plus_categories_binder($categories, $term->term_id, $class, $is_anchor, $show_count);
            $output .= '</li>';
            $index++;
        }

        if (!empty($output)) {
            $output .= '</ul>';
        }

        return $output;
    }
}

/**
 * Get template
 * *******************************************************
 */
if (!function_exists('g5plus_get_template')) {
    function g5plus_get_template($template_name, $args = array())
    {
        if ($args && is_array($args)) {
            extract($args);
        }
        $template_path = 'templates/' . $template_name;
        $located = trailingslashit(get_stylesheet_directory()) . $template_path;
        if (!is_readable($located)) {
            $located = trailingslashit(get_template_directory()) . $template_path;
        }

        if (!file_exists($located)) {
            _doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $template_path), '1.0');
            return;
        }
        include($located);
    }
}

////////////////////////////////////////////////////////////////////
// region Get breadcrumb items
if (!function_exists('g5plus_get_breadcrumb_items')) {
    function g5plus_get_breadcrumb_items()
    {
        global $wp_query;

        $item = array();
        /* Front page. */
        if (is_front_page()) {
            $item['last'] = esc_html__('Home', 'g5-startup');
        }


        /* Link to front page. */
        if (!is_front_page()) {
            $item[] = '<li><a href="' . home_url('/') . '" class="home">' . esc_html__('Home', 'g5-startup') . '</a></li>';
        }

        /* If bbPress is installed and we're on a bbPress page. */
        if (function_exists('is_bbpress') && is_bbpress()) {
            $item = array_merge($item, g5plus_breadcrumb_get_bbpress_items());
        } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
            $item = array_merge($item, g5plus_filter_breadcrumb_items());
        } /* If viewing a home/post page. */
        elseif (is_home()) {
            $home_page = get_post($wp_query->get_queried_object_id());
            $item = array_merge($item, g5plus_breadcrumb_get_parents($home_page->post_parent));
            $item['last'] = get_the_title($home_page->ID);
        } /* If viewing a singular post. */
        elseif (is_singular()) {

            $post = $wp_query->get_queried_object();
            $post_id = (int)$wp_query->get_queried_object_id();
            $post_type = $post->post_type;

            $post_type_object = get_post_type_object($post_type);

            if ('post' === $wp_query->post->post_type) {
                $categories = get_the_category($post_id);
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($categories[0]->term_id, $categories[0]->taxonomy));
            }

            if ('page' !== $wp_query->post->post_type) {

                /* If there's an archive page, add it. */

                if (function_exists('get_post_type_archive_link') && !empty($post_type_object->has_archive))
                    $item[] = '<li><a href="' . get_post_type_archive_link($post_type) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . $post_type_object->labels->name . '</a></li>';

                if (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]) && is_taxonomy_hierarchical($args["singular_{$wp_query->post->post_type}_taxonomy"])) {
                    $terms = wp_get_object_terms($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"]);
                    $item = array_merge($item, g5plus_breadcrumb_get_term_parents($terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"]));
                } elseif (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]))
                    $item[] = get_the_term_list($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '');
            }

            if ((is_post_type_hierarchical($wp_query->post->post_type) || 'attachment' === $wp_query->post->post_type) && $parents = g5plus_breadcrumb_get_parents($wp_query->post->post_parent)) {
                $item = array_merge($item, $parents);
            }

            $item['last'] = get_the_title();
        } /* If viewing any type of archive. */
        else if (is_archive()) {

            if (is_category() || is_tag() || is_tax()) {

                $term = $wp_query->get_queried_object();
                //$taxonomy = get_taxonomy( $term->taxonomy );

                if ((is_taxonomy_hierarchical($term->taxonomy) && $term->parent) && $parents = g5plus_breadcrumb_get_term_parents($term->parent, $term->taxonomy))
                    $item = array_merge($item, $parents);

                $item['last'] = $term->name;
            } else if (function_exists('is_post_type_archive') && is_post_type_archive()) {
                $post_type_object = get_post_type_object(get_query_var('post_type'));
                if ($post_type_object) {
                    $item['last'] = $post_type_object->labels->name;
                }
            } else if (is_date()) {

                if (is_day())
                    $item['last'] = esc_html__('Archives for ', 'g5-startup') . get_the_time('F j, Y');

                elseif (is_month())
                    $item['last'] = esc_html__('Archives for ', 'g5-startup') . single_month_title(' ', false);

                elseif (is_year())
                    $item['last'] = esc_html__('Archives for ', 'g5-startup') . get_the_time('Y');
            } else if (is_author())
                $item['last'] = esc_html__('Archives by: ', 'g5-startup') . get_the_author_meta('display_name', $wp_query->post->post_author);

        } /* If viewing search results. */
        else if (is_search()) {
            $item['last'] = esc_html__('Search results', 'g5-startup');
        } /* If viewing a 404 error page. */
        else if (is_404())
            $item['last'] = esc_html__('Page Not Found', 'g5-startup');


        if (isset($item['last'])) {
            $item['last'] = sprintf('<li><span>%s</span></li>', $item['last']);
        }


        return apply_filters('g5plus_framework_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_filter_breadcrumb_items')) {
    function g5plus_filter_breadcrumb_items()
    {
        $item = array();
        $shop_page_id = wc_get_page_id('shop');

        if (get_option('page_on_front') != $shop_page_id) {
            $shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
            if (!is_shop()) {
                $item[] = '<li><a href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
            } else {
                $item['last'] = $shop_name;
            }
        }

        if (is_tax('product_cat') || is_tax('product_tag')) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

        } elseif (is_product()) {
            global $post;
            $terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
            if ($terms) {
                $current_term = $terms[0];
            }

        }

        if (!empty($current_term)) {
            if (is_taxonomy_hierarchical($current_term->taxonomy)) {
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
            }

            if (is_tax('product_cat') || is_tax('product_tag')) {
                $item['last'] = $current_term->name;
            } else {
                $item[] = '<li><a href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
            }
        }

        if (is_product()) {
            $item['last'] = get_the_title();
        }

        return apply_filters('g5plus_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_breadcrumb_get_bbpress_items')) {
    function g5plus_breadcrumb_get_bbpress_items()
    {
        $item = array();
        $shop_page_id = wc_get_page_id('shop');

        if (get_option('page_on_front') != $shop_page_id) {
            $shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
            if (!is_shop()) {
                $item[] = '<li><a href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
            } else {
                $item['last'] = $shop_name;
            }
        }

        if (is_tax('product_cat') || is_tax('product_tag')) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

        } elseif (is_product()) {
            global $post;
            $terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
            if ($terms) {
                $current_term = $terms[0];
            }

        }

        if (!empty($current_term)) {
            if (is_taxonomy_hierarchical($current_term->taxonomy)) {
                $item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
            }

            if (is_tax('product_cat') || is_tax('product_tag')) {
                $item['last'] = $current_term->name;
            } else {
                $item[] = '<li><a href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
            }
        }

        if (is_product()) {
            $item['last'] = get_the_title();
        }

        return apply_filters('g5plus_filter_breadcrumb_items', $item);
    }
}

if (!function_exists('g5plus_breadcrumb_get_parents')) {
    function g5plus_breadcrumb_get_parents($post_id = '', $separator = '/')
    {
        $parents = array();

        if ($post_id == 0) {
            return $parents;
        }

        while ($post_id) {
            $page = get_post($post_id);
            $parents[] = '<li><a href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a></li>';
            $post_id = $page->post_parent;
        }

        if ($parents) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }
}

if (!function_exists('g5plus_breadcrumb_get_term_parents')) {
    function g5plus_breadcrumb_get_term_parents($parent_id = '', $taxonomy = '', $separator = '/')
    {
        $parents = array();

        if (empty($parent_id) || empty($taxonomy)) {
            return $parents;
        }

        while ($parent_id) {
            $parent = get_term($parent_id, $taxonomy);
            $parents[] = '<li><a href="' . get_term_link($parent, $taxonomy) . '" title="' . esc_attr($parent->name) . '">' . $parent->name . '</a></li>';
            $parent_id = $parent->parent;
        }

        if ($parents) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }
}

// endregion
////////////////////////////////////////////////////////////////////


/**
 * Get image src
 */
if (!function_exists('g5plus_get_image_src')) {
    function g5plus_get_image_src($image_id, $size)
    {
        $image_src = '';
        $image_sizes = g5plus_get_image_size($size);
        if (isset($image_sizes)) {
            $width = $image_sizes['width'];
            $height = $image_sizes['height'];
            $image_src = g5plus_image_resize_id($image_id, $width, $height);
        } else {
            $image_src_arr = wp_get_attachment_image_src($image_id, $size);
            if ($image_src_arr) {
                $image_src = $image_src_arr[0];
            }
        }
        return $image_src;
    }
}

/**
 * Get post thumbnail
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_thumbnail')) {
    function g5plus_get_post_thumbnail($size, $noImage = 0, $is_single = false)
    {
        $args = array(
            'size'      => $size,
            'noImage'   => $noImage,
            'is_single' => $is_single
        );
        g5plus_get_template('archive/thumbnail.php', $args);
    }
}

/**
 * Get post image
 * *******************************************************
 */
if (!function_exists('g5plus_get_post_image')) {
    function g5plus_get_post_image($image_id, $size, $gallery = 0, $is_single = false)
    {
        $image_src = '';
        $image_size = g5plus_get_image_size($size);
        if (isset($image_size['width']) && isset($image_size['height'])) {
            $width = $image_size['width'];
            $height = $image_size['height'];
            $image_src = g5plus_image_resize_id($image_id, $width, $height);
        } else {
            $image_src_arr = wp_get_attachment_image_src($image_id, $size);
            if ($image_src_arr) {
                $image_src = $image_src_arr[0];
            }
        }

        if (!empty($image_src)) {
            g5plus_get_image_hover($image_id, $image_src, $size, get_permalink(), the_title_attribute('echo=0'), $gallery, $is_single);
        }
    }
}

/**
 * Get image hover
 * *******************************************************
 */
if (!function_exists('g5plus_get_image_hover')) {
    function g5plus_get_image_hover($image_id, $image_src, $size, $link, $title, $gallery = 0, $is_single = false)
    {
        $image_full_arr = wp_get_attachment_image_src($image_id, 'full');
        $image_full_src = $image_src;
        $image_thumb = wp_get_attachment_image_src($image_id);
        $image_thumb_link = '';
        if (sizeof($image_thumb) > 0) {
            $image_thumb_link = $image_thumb['0'];
        }
        if ($image_full_arr) {
            $image_full_src = $image_full_arr[0];
        }
        $width = '';
        $height = '';
        $image_size = g5plus_get_image_size($size);
        if (isset($image_size['width']) && $image_size['height']) {
            $width = $image_size['width'];
            $height = $image_size['height'];
        } else {
            $_wp_additional_image_sizes = get_intermediate_image_sizes();
            if (in_array($size, array('thumbnail', 'medium', 'large'))) {
                $width = get_option($size . '_size_w');
                $height = get_option($size . '_size_h');
            } elseif (isset($_wp_additional_image_sizes[$size])) {
                $width = $_wp_additional_image_sizes[$size]['width'];
                $height = $_wp_additional_image_sizes[$size]['height'];
            }
        }
        $args = array(
            'image_src'        => $image_src,
            'image_full_src'   => $image_full_src,
            'image_thumb_link' => $image_thumb_link,
            'width'            => $width,
            'height'           => $height,
            'link'             => $link,
            'title'            => $title,
            'galleryId'        => $gallery,
            'is_single'        => $is_single
        );
        g5plus_get_template('archive/image-hover.php', $args);
    }
}

/**
 * Get image size
 * *******************************************************
 */
if (!function_exists('g5plus_get_image_size')) {
    function g5plus_get_image_size($size)
    {
        $image_sizes = apply_filters('g5plus_image_size', array(
            'large-image'  => array(
                'width'  => 1170,
                'height' => 658
            ),
            'medium-image' => array(
                'width'  => 370,
                'height' => 282
            ),
        ));
        if (isset($image_sizes[$size])) {
            return $image_sizes[$size];
        } else {
            return null;
        }
    }
}

/**
 * Get String Limit Words
 * *******************************************************
 */
if (!function_exists('g5plus_string_limit_words')) {
    function g5plus_string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, ($word_limit + 1));

        if (count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }
}

/**
 * Render comments
 * *******************************************************
 */
if (!function_exists('g5plus_render_comments')) {
    function g5plus_render_comments($comment, $args, $depth)
    {
        g5plus_get_template('single/comment.php', array('comment' => $comment, 'args' => $args, 'depth' => $depth));
    }
}

/**
 * Get Tax meta with key not prefix
 * *******************************************************
 */
if (!function_exists('g5plus_get_tax_meta')) {
    function g5plus_get_tax_meta($term_id, $key, $multi = false)
    {
        if (defined('GF_METABOX_PREFIX')) {
            if (function_exists('get_term_meta')) {
                return get_term_meta($term_id, GF_METABOX_PREFIX . $key, !$multi);
            } else {
                return get_tax_meta($term_id, GF_METABOX_PREFIX . $key, !$multi);
            }
        } else {
            return '';
        }

    }
}

//////////////////////////////////////////////////////////////////
// Get Page Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_page_layout_settings')) {
    function &g5plus_get_page_layout_settings()
    {
        $key_page_layout_settings = 'g5plus_page_layout_settings';
        if (isset($GLOBALS[$key_page_layout_settings]) && is_array($GLOBALS[$key_page_layout_settings])) {
            return $GLOBALS[$key_page_layout_settings];
        }
        $GLOBALS[$key_page_layout_settings] = array(
            'layout'                 => 'container',
            'sidebar_layout'         => g5plus_get_option('sidebar_layout', 'right'),
            'sidebar'                => g5plus_get_option('sidebar', 'main-sidebar'),
            'sidebar_width'          => g5plus_get_option('sidebar_width', 'small'),
            'sidebar_mobile_enable'  => g5plus_get_option('sidebar_mobile_enable', 1),
            'sidebar_mobile_canvas'  => g5plus_get_option('sidebar_mobile_canvas', 1),
            'padding'                => g5plus_get_option('content_padding', array('padding-top' => '70px', 'padding-bottom' => '70px', 'units' => 'px')),
            'padding_mobile'         => g5plus_get_option('content_padding_mobile', array('padding-top' => '30px', 'padding-bottom' => '30px', 'units' => 'px')),
            'remove_content_padding' => 0,
            'has_sidebar'            => 1
        );
        if(is_404()) {
            $GLOBALS[$key_page_layout_settings]['layout'] = 'full';
        }
        return $GLOBALS[$key_page_layout_settings];
    }
}

//////////////////////////////////////////////////////////////////
// Get Post Layout Settings
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_get_post_layout_settings')) {
    function &g5plus_get_post_layout_settings()
    {
        $key_post_layout_settings = 'g5plus_post_layout_settings';
        if (isset($GLOBALS[$key_post_layout_settings]) && is_array($GLOBALS[$key_post_layout_settings])) {
            return $GLOBALS[$key_post_layout_settings];
        }

        $GLOBALS[$key_post_layout_settings] = array(
            'layout'  => g5plus_get_option('post_layout', 'large-image'),
            'columns' => g5plus_get_option('post_column', 3),
            'paging'  => g5plus_get_option('post_paging', 'navigation'),
            'slider'  => false
        );

        return $GLOBALS[$key_post_layout_settings];
    }
}

//////////////////////////////////////////////////////////////////
// Social share
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_the_social_share')) {
    function g5plus_the_social_share()
    {
        get_template_part('templates/social-share');
    }
}
//////////////////////////////////////////////////////////////////
// Social share product
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_the_social_share_product')) {
    function g5plus_the_social_share_product()
    {
        get_template_part('templates/social-share-product');
    }
}

//////////////////////////////////////////////////////////////////
// Canvas Menu
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_canvas_menu')) {
	function g5plus_canvas_menu() {
		get_template_part('templates/canvas-menu');
	}
}

/**
 * Get Fonts Awesome Array
 * *******************************************************
 */
if (!function_exists('g5plus_get_font_awesome')) {
    function &g5plus_get_font_awesome()
    {
        if (isset($GLOBALS['g5plus_font_awesome']) && is_array($GLOBALS['g5plus_font_awesome'])) {
            return $GLOBALS['g5plus_font_awesome'];
        }
        $GLOBALS['g5plus_font_awesome'] = apply_filters('g5plus_font_awesome', array(
            array('fa fa-500px' => 'fa-500px'), array('fa fa-adjust' => 'fa-adjust'), array('fa fa-adn' => 'fa-adn'), array('fa fa-align-center' => 'fa-align-center'), array('fa fa-align-justify' => 'fa-align-justify'), array('fa fa-align-left' => 'fa-align-left'), array('fa fa-align-right' => 'fa-align-right'), array('fa fa-amazon' => 'fa-amazon'), array('fa fa-ambulance' => 'fa-ambulance'), array('fa fa-anchor' => 'fa-anchor'), array('fa fa-android' => 'fa-android'), array('fa fa-angellist' => 'fa-angellist'), array('fa fa-angle-double-down' => 'fa-angle-double-down'), array('fa fa-angle-double-left' => 'fa-angle-double-left'), array('fa fa-angle-double-right' => 'fa-angle-double-right'), array('fa fa-angle-double-up' => 'fa-angle-double-up'), array('fa fa-angle-down' => 'fa-angle-down'), array('fa fa-angle-left' => 'fa-angle-left'), array('fa fa-angle-right' => 'fa-angle-right'), array('fa fa-angle-up' => 'fa-angle-up'), array('fa fa-apple' => 'fa-apple'), array('fa fa-archive' => 'fa-archive'), array('fa fa-area-chart' => 'fa-area-chart'), array('fa fa-arrow-circle-down' => 'fa-arrow-circle-down'), array('fa fa-arrow-circle-left' => 'fa-arrow-circle-left'), array('fa fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down'), array('fa fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left'), array('fa fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right'), array('fa fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up'), array('fa fa-arrow-circle-right' => 'fa-arrow-circle-right'), array('fa fa-arrow-circle-up' => 'fa-arrow-circle-up'), array('fa fa-arrow-down' => 'fa-arrow-down'), array('fa fa-arrow-left' => 'fa-arrow-left'), array('fa fa-arrow-right' => 'fa-arrow-right'), array('fa fa-arrow-up' => 'fa-arrow-up'), array('fa fa-arrows' => 'fa-arrows'), array('fa fa-arrows-alt' => 'fa-arrows-alt'), array('fa fa-arrows-h' => 'fa-arrows-h'), array('fa fa-arrows-v' => 'fa-arrows-v'), array('fa fa-asterisk' => 'fa-asterisk'), array('fa fa-at' => 'fa-at'), array('fa fa-automobile' => 'fa-automobile'), array('fa fa-backward' => 'fa-backward'), array('fa fa-balance-scale' => 'fa-balance-scale'), array('fa fa-ban' => 'fa-ban'), array('fa fa-bank' => 'fa-bank'), array('fa fa-bar-chart' => 'fa-bar-chart'), array('fa fa-bar-chart-o' => 'fa-bar-chart-o'), array('fa fa-barcode' => 'fa-barcode'), array('fa fa-bars' => 'fa-bars'), array('fa fa-battery-0' => 'fa-battery-0'), array('fa fa-battery-1' => 'fa-battery-1'), array('fa fa-battery-2' => 'fa-battery-2'), array('fa fa-battery-3' => 'fa-battery-3'), array('fa fa-battery-4' => 'fa-battery-4'), array('fa fa-battery-empty' => 'fa-battery-empty'), array('fa fa-battery-full' => 'fa-battery-full'), array('fa fa-battery-half' => 'fa-battery-half'), array('fa fa-battery-quarter' => 'fa-battery-quarter'), array('fa fa-battery-three-quarters' => 'fa-battery-three-quarters'), array('fa fa-bed' => 'fa-bed'), array('fa fa-beer' => 'fa-beer'), array('fa fa-behance' => 'fa-behance'), array('fa fa-behance-square' => 'fa-behance-square'), array('fa fa-bell' => 'fa-bell'), array('fa fa-bell-o' => 'fa-bell-o'), array('fa fa-bell-slash' => 'fa-bell-slash'), array('fa fa-bell-slash-o' => 'fa-bell-slash-o'), array('fa fa-bicycle' => 'fa-bicycle'), array('fa fa-binoculars' => 'fa-binoculars'), array('fa fa-birthday-cake' => 'fa-birthday-cake'), array('fa fa-bitbucket' => 'fa-bitbucket'), array('fa fa-bitbucket-square' => 'fa-bitbucket-square'), array('fa fa-bitcoin' => 'fa-bitcoin'), array('fa fa-black-tie' => 'fa-black-tie'), array('fa fa-bluetooth' => 'fa-bluetooth'), array('fa fa-bluetooth-b' => 'fa-bluetooth-b'), array('fa fa-bold' => 'fa-bold'), array('fa fa-bolt' => 'fa-bolt'), array('fa fa-bomb' => 'fa-bomb'), array('fa fa-book' => 'fa-book'), array('fa fa-bookmark' => 'fa-bookmark'), array('fa fa-bookmark-o' => 'fa-bookmark-o'), array('fa fa-briefcase' => 'fa-briefcase'), array('fa fa-btc' => 'fa-btc'), array('fa fa-bug' => 'fa-bug'), array('fa fa-building' => 'fa-building'), array('fa fa-building-o' => 'fa-building-o'), array('fa fa-bullhorn' => 'fa-bullhorn'), array('fa fa-bullseye' => 'fa-bullseye'), array('fa fa-bus' => 'fa-bus'), array('fa fa-buysellads' => 'fa-buysellads'), array('fa fa-cab' => 'fa-cab'), array('fa fa-calculator' => 'fa-calculator'), array('fa fa-calendar' => 'fa-calendar'), array('fa fa-calendar-check-o' => 'fa-calendar-check-o'), array('fa fa-calendar-minus-o' => 'fa-calendar-minus-o'), array('fa fa-calendar-o' => 'fa-calendar-o'), array('fa fa-calendar-plus-o' => 'fa-calendar-plus-o'), array('fa fa-calendar-times-o' => 'fa-calendar-times-o'), array('fa fa-camera' => 'fa-camera'), array('fa fa-camera-retro' => 'fa-camera-retro'), array('fa fa-car' => 'fa-car'), array('fa fa-caret-down' => 'fa-caret-down'), array('fa fa-caret-left' => 'fa-caret-left'), array('fa fa-caret-right' => 'fa-caret-right'), array('fa fa-caret-square-o-down' => 'fa-caret-square-o-down'), array('fa fa-caret-square-o-left' => 'fa-caret-square-o-left'), array('fa fa-caret-square-o-right' => 'fa-caret-square-o-right'), array('fa fa-caret-square-o-up' => 'fa-caret-square-o-up'), array('fa fa-caret-up' => 'fa-caret-up'), array('fa fa-cart-arrow-down' => 'fa-cart-arrow-down'), array('fa fa-cart-plus' => 'fa-cart-plus'), array('fa fa-cc' => 'fa-cc'), array('fa fa-cc-amex' => 'fa-cc-amex'), array('fa fa-cc-diners-club' => 'fa-cc-diners-club'), array('fa fa-cc-discover' => 'fa-cc-discover'), array('fa fa-cc-jcb' => 'fa-cc-jcb'), array('fa fa-cc-mastercard' => 'fa-cc-mastercard'), array('fa fa-cc-paypal' => 'fa-cc-paypal'), array('fa fa-cc-stripe' => 'fa-cc-stripe'), array('fa fa-cc-visa' => 'fa-cc-visa'), array('fa fa-certificate' => 'fa-certificate'), array('fa fa-chain' => 'fa-chain'), array('fa fa-chain-broken' => 'fa-chain-broken'), array('fa fa-check' => 'fa-check'), array('fa fa-check-circle' => 'fa-check-circle'), array('fa fa-check-circle-o' => 'fa-check-circle-o'), array('fa fa-check-square' => 'fa-check-square'), array('fa fa-check-square-o' => 'fa-check-square-o'), array('fa fa-chevron-circle-down' => 'fa-chevron-circle-down'), array('fa fa-chevron-circle-left' => 'fa-chevron-circle-left'), array('fa fa-chevron-circle-right' => 'fa-chevron-circle-right'), array('fa fa-chevron-circle-up' => 'fa-chevron-circle-up'), array('fa fa-chevron-down' => 'fa-chevron-down'), array('fa fa-chevron-left' => 'fa-chevron-left'), array('fa fa-chevron-right' => 'fa-chevron-right'), array('fa fa-chevron-up' => 'fa-chevron-up'), array('fa fa-child' => 'fa-child'), array('fa fa-chrome' => 'fa-chrome'), array('fa fa-circle' => 'fa-circle'), array('fa fa-circle-o' => 'fa-circle-o'), array('fa fa-circle-o-notch' => 'fa-circle-o-notch'), array('fa fa-circle-thin' => 'fa-circle-thin'), array('fa fa-clipboard' => 'fa-clipboard'), array('fa fa-clock-o' => 'fa-clock-o'), array('fa fa-clone' => 'fa-clone'), array('fa fa-close' => 'fa-close'), array('fa fa-cloud' => 'fa-cloud'), array('fa fa-cloud-download' => 'fa-cloud-download'), array('fa fa-cloud-upload' => 'fa-cloud-upload'), array('fa fa-cny' => 'fa-cny'), array('fa fa-code' => 'fa-code'), array('fa fa-code-fork' => 'fa-code-fork'), array('fa fa-codepen' => 'fa-codepen'), array('fa fa-codiepie' => 'fa-codiepie'), array('fa fa-coffee' => 'fa-coffee'), array('fa fa-cog' => 'fa-cog'), array('fa fa-cogs' => 'fa-cogs'), array('fa fa-columns' => 'fa-columns'), array('fa fa-comment' => 'fa-comment'), array('fa fa-comment-o' => 'fa-comment-o'), array('fa fa-commenting' => 'fa-commenting'), array('fa fa-commenting-o' => 'fa-commenting-o'), array('fa fa-comments' => 'fa-comments'), array('fa fa-comments-o' => 'fa-comments-o'), array('fa fa-compass' => 'fa-compass'), array('fa fa-compress' => 'fa-compress'), array('fa fa-connectdevelop' => 'fa-connectdevelop'), array('fa fa-contao' => 'fa-contao'), array('fa fa-copy' => 'fa-copy'), array('fa fa-copyright' => 'fa-copyright'), array('fa fa-creative-commons' => 'fa-creative-commons'), array('fa fa-credit-card' => 'fa-credit-card'), array('fa fa-credit-card-alt' => 'fa-credit-card-alt'), array('fa fa-crop' => 'fa-crop'), array('fa fa-crosshairs' => 'fa-crosshairs'), array('fa fa-css3' => 'fa-css3'), array('fa fa-cube' => 'fa-cube'), array('fa fa-cubes' => 'fa-cubes'), array('fa fa-cut' => 'fa-cut'), array('fa fa-cutlery' => 'fa-cutlery'), array('fa fa-dashboard' => 'fa-dashboard'), array('fa fa-dashcube' => 'fa-dashcube'), array('fa fa-database' => 'fa-database'), array('fa fa-dedent' => 'fa-dedent'), array('fa fa-delicious' => 'fa-delicious'), array('fa fa-desktop' => 'fa-desktop'), array('fa fa-deviantart' => 'fa-deviantart'), array('fa fa-diamond' => 'fa-diamond'), array('fa fa-digg' => 'fa-digg'), array('fa fa-dollar' => 'fa-dollar'), array('fa fa-dot-circle-o' => 'fa-dot-circle-o'), array('fa fa-download' => 'fa-download'), array('fa fa-dribbble' => 'fa-dribbble'), array('fa fa-dropbox' => 'fa-dropbox'), array('fa fa-drupal' => 'fa-drupal'), array('fa fa-edge' => 'fa-edge'), array('fa fa-edit' => 'fa-edit'), array('fa fa-eject' => 'fa-eject'), array('fa fa-ellipsis-h' => 'fa-ellipsis-h'), array('fa fa-ellipsis-v' => 'fa-ellipsis-v'), array('fa fa-empire' => 'fa-empire'), array('fa fa-envelope' => 'fa-envelope'), array('fa fa-envelope-o' => 'fa-envelope-o'), array('fa fa-envelope-square' => 'fa-envelope-square'), array('fa fa-eraser' => 'fa-eraser'), array('fa fa-eur' => 'fa-eur'), array('fa fa-euro' => 'fa-euro'), array('fa fa-exchange' => 'fa-exchange'), array('fa fa-exclamation' => 'fa-exclamation'), array('fa fa-exclamation-circle' => 'fa-exclamation-circle'), array('fa fa-exclamation-triangle' => 'fa-exclamation-triangle'), array('fa fa-expand' => 'fa-expand'), array('fa fa-expeditedssl' => 'fa-expeditedssl'), array('fa fa-external-link' => 'fa-external-link'), array('fa fa-external-link-square' => 'fa-external-link-square'), array('fa fa-eye' => 'fa-eye'), array('fa fa-eye-slash' => 'fa-eye-slash'), array('fa fa-eyedropper' => 'fa-eyedropper'), array('fa fa-facebook' => 'fa-facebook'), array('fa fa-facebook-f' => 'fa-facebook-f'), array('fa fa-facebook-official' => 'fa-facebook-official'), array('fa fa-facebook-square' => 'fa-facebook-square'), array('fa fa-fast-backward' => 'fa-fast-backward'), array('fa fa-fast-forward' => 'fa-fast-forward'), array('fa fa-fax' => 'fa-fax'), array('fa fa-feed' => 'fa-feed'), array('fa fa-female' => 'fa-female'), array('fa fa-fighter-jet' => 'fa-fighter-jet'), array('fa fa-file' => 'fa-file'), array('fa fa-file-archive-o' => 'fa-file-archive-o'), array('fa fa-file-audio-o' => 'fa-file-audio-o'), array('fa fa-file-code-o' => 'fa-file-code-o'), array('fa fa-file-excel-o' => 'fa-file-excel-o'), array('fa fa-file-image-o' => 'fa-file-image-o'), array('fa fa-file-movie-o' => 'fa-file-movie-o'), array('fa fa-file-o' => 'fa-file-o'), array('fa fa-file-pdf-o' => 'fa-file-pdf-o'), array('fa fa-file-photo-o' => 'fa-file-photo-o'), array('fa fa-file-picture-o' => 'fa-file-picture-o'), array('fa fa-file-powerpoint-o' => 'fa-file-powerpoint-o'), array('fa fa-file-sound-o' => 'fa-file-sound-o'), array('fa fa-file-text' => 'fa-file-text'), array('fa fa-file-text-o' => 'fa-file-text-o'), array('fa fa-file-video-o' => 'fa-file-video-o'), array('fa fa-file-word-o' => 'fa-file-word-o'), array('fa fa-file-zip-o' => 'fa-file-zip-o'), array('fa fa-files-o' => 'fa-files-o'), array('fa fa-film' => 'fa-film'), array('fa fa-filter' => 'fa-filter'), array('fa fa-fire' => 'fa-fire'), array('fa fa-fire-extinguisher' => 'fa-fire-extinguisher'), array('fa fa-firefox' => 'fa-firefox'), array('fa fa-flag' => 'fa-flag'), array('fa fa-flag-checkered' => 'fa-flag-checkered'), array('fa fa-flag-o' => 'fa-flag-o'), array('fa fa-flash' => 'fa-flash'), array('fa fa-flask' => 'fa-flask'), array('fa fa-flickr' => 'fa-flickr'), array('fa fa-floppy-o' => 'fa-floppy-o'), array('fa fa-folder' => 'fa-folder'), array('fa fa-folder-o' => 'fa-folder-o'), array('fa fa-folder-open' => 'fa-folder-open'), array('fa fa-folder-open-o' => 'fa-folder-open-o'), array('fa fa-font' => 'fa-font'), array('fa fa-fonticons' => 'fa-fonticons'), array('fa fa-fort-awesome' => 'fa-fort-awesome'), array('fa fa-forumbee' => 'fa-forumbee'), array('fa fa-forward' => 'fa-forward'), array('fa fa-foursquare' => 'fa-foursquare'), array('fa fa-frown-o' => 'fa-frown-o'), array('fa fa-futbol-o' => 'fa-futbol-o'), array('fa fa-gamepad' => 'fa-gamepad'), array('fa fa-gavel' => 'fa-gavel'), array('fa fa-gbp' => 'fa-gbp'), array('fa fa-ge' => 'fa-ge'), array('fa fa-gear' => 'fa-gear'), array('fa fa-gears' => 'fa-gears'), array('fa fa-genderless' => 'fa-genderless'), array('fa fa-get-pocket' => 'fa-get-pocket'), array('fa fa-gg' => 'fa-gg'), array('fa fa-gg-circle' => 'fa-gg-circle'), array('fa fa-gift' => 'fa-gift'), array('fa fa-git' => 'fa-git'), array('fa fa-git-square' => 'fa-git-square'), array('fa fa-github' => 'fa-github'), array('fa fa-github-alt' => 'fa-github-alt'), array('fa fa-github-square' => 'fa-github-square'), array('fa fa-gittip' => 'fa-gittip'), array('fa fa-glass' => 'fa-glass'), array('fa fa-globe' => 'fa-globe'), array('fa fa-google' => 'fa-google'), array('fa fa-google-plus' => 'fa-google-plus'), array('fa fa-google-plus-square' => 'fa-google-plus-square'), array('fa fa-google-wallet' => 'fa-google-wallet'), array('fa fa-graduation-cap' => 'fa-graduation-cap'), array('fa fa-gratipay' => 'fa-gratipay'), array('fa fa-group' => 'fa-group'), array('fa fa-h-square' => 'fa-h-square'), array('fa fa-hacker-news' => 'fa-hacker-news'), array('fa fa-hand-grab-o' => 'fa-hand-grab-o'), array('fa fa-hand-lizard-o' => 'fa-hand-lizard-o'), array('fa fa-hand-o-down' => 'fa-hand-o-down'), array('fa fa-hand-o-left' => 'fa-hand-o-left'), array('fa fa-hand-o-right' => 'fa-hand-o-right'), array('fa fa-hand-o-up' => 'fa-hand-o-up'), array('fa fa-hand-paper-o' => 'fa-hand-paper-o'), array('fa fa-hand-peace-o' => 'fa-hand-peace-o'), array('fa fa-hand-pointer-o' => 'fa-hand-pointer-o'), array('fa fa-hand-rock-o' => 'fa-hand-rock-o'), array('fa fa-hand-scissors-o' => 'fa-hand-scissors-o'), array('fa fa-hand-spock-o' => 'fa-hand-spock-o'), array('fa fa-hand-stop-o' => 'fa-hand-stop-o'), array('fa fa-hashtag' => 'fa-hashtag'), array('fa fa-hdd-o' => 'fa-hdd-o'), array('fa fa-header' => 'fa-header'), array('fa fa-headphones' => 'fa-headphones'), array('fa fa-heart' => 'fa-heart'), array('fa fa-heart-o' => 'fa-heart-o'), array('fa fa-heartbeat' => 'fa-heartbeat'), array('fa fa-history' => 'fa-history'), array('fa fa-home' => 'fa-home'), array('fa fa-hospital-o' => 'fa-hospital-o'), array('fa fa-hotel' => 'fa-hotel'), array('fa fa-hourglass' => 'fa-hourglass'), array('fa fa-hourglass-1' => 'fa-hourglass-1'), array('fa fa-hourglass-2' => 'fa-hourglass-2'), array('fa fa-hourglass-3' => 'fa-hourglass-3'), array('fa fa-hourglass-end' => 'fa-hourglass-end'), array('fa fa-hourglass-half' => 'fa-hourglass-half'), array('fa fa-hourglass-o' => 'fa-hourglass-o'), array('fa fa-hourglass-start' => 'fa-hourglass-start'), array('fa fa-houzz' => 'fa-houzz'), array('fa fa-html5' => 'fa-html5'), array('fa fa-i-cursor' => 'fa-i-cursor'), array('fa fa-ils' => 'fa-ils'), array('fa fa-image' => 'fa-image'), array('fa fa-inbox' => 'fa-inbox'), array('fa fa-indent' => 'fa-indent'), array('fa fa-industry' => 'fa-industry'), array('fa fa-info' => 'fa-info'), array('fa fa-info-circle' => 'fa-info-circle'), array('fa fa-inr' => 'fa-inr'), array('fa fa-instagram' => 'fa-instagram'), array('fa fa-institution' => 'fa-institution'), array('fa fa-internet-explorer' => 'fa-internet-explorer'), array('fa fa-intersex' => 'fa-intersex'), array('fa fa-ioxhost' => 'fa-ioxhost'), array('fa fa-italic' => 'fa-italic'), array('fa fa-joomla' => 'fa-joomla'), array('fa fa-jpy' => 'fa-jpy'), array('fa fa-jsfiddle' => 'fa-jsfiddle'), array('fa fa-key' => 'fa-key'), array('fa fa-keyboard-o' => 'fa-keyboard-o'), array('fa fa-krw' => 'fa-krw'), array('fa fa-language' => 'fa-language'), array('fa fa-laptop' => 'fa-laptop'), array('fa fa-lastfm' => 'fa-lastfm'), array('fa fa-lastfm-square' => 'fa-lastfm-square'), array('fa fa-leaf' => 'fa-leaf'), array('fa fa-leanpub' => 'fa-leanpub'), array('fa fa-legal' => 'fa-legal'), array('fa fa-lemon-o' => 'fa-lemon-o'), array('fa fa-level-down' => 'fa-level-down'), array('fa fa-level-up' => 'fa-level-up'), array('fa fa-life-bouy' => 'fa-life-bouy'), array('fa fa-life-buoy' => 'fa-life-buoy'), array('fa fa-life-ring' => 'fa-life-ring'), array('fa fa-life-saver' => 'fa-life-saver'), array('fa fa-lightbulb-o' => 'fa-lightbulb-o'), array('fa fa-line-chart' => 'fa-line-chart'), array('fa fa-link' => 'fa-link'), array('fa fa-linkedin' => 'fa-linkedin'), array('fa fa-linkedin-square' => 'fa-linkedin-square'), array('fa fa-linux' => 'fa-linux'), array('fa fa-list' => 'fa-list'), array('fa fa-list-alt' => 'fa-list-alt'), array('fa fa-list-ol' => 'fa-list-ol'), array('fa fa-list-ul' => 'fa-list-ul'), array('fa fa-location-arrow' => 'fa-location-arrow'), array('fa fa-lock' => 'fa-lock'), array('fa fa-long-arrow-down' => 'fa-long-arrow-down'), array('fa fa-long-arrow-left' => 'fa-long-arrow-left'), array('fa fa-long-arrow-right' => 'fa-long-arrow-right'), array('fa fa-long-arrow-up' => 'fa-long-arrow-up'), array('fa fa-magic' => 'fa-magic'), array('fa fa-magnet' => 'fa-magnet'), array('fa fa-mail-forward' => 'fa-mail-forward'), array('fa fa-mail-reply' => 'fa-mail-reply'), array('fa fa-mail-reply-all' => 'fa-mail-reply-all'), array('fa fa-male' => 'fa-male'), array('fa fa-map' => 'fa-map'), array('fa fa-map-marker' => 'fa-map-marker'), array('fa fa-map-o' => 'fa-map-o'), array('fa fa-map-pin' => 'fa-map-pin'), array('fa fa-map-signs' => 'fa-map-signs'), array('fa fa-mars' => 'fa-mars'), array('fa fa-mars-double' => 'fa-mars-double'), array('fa fa-mars-stroke' => 'fa-mars-stroke'), array('fa fa-mars-stroke-h' => 'fa-mars-stroke-h'), array('fa fa-mars-stroke-v' => 'fa-mars-stroke-v'), array('fa fa-maxcdn' => 'fa-maxcdn'), array('fa fa-meanpath' => 'fa-meanpath'), array('fa fa-medium' => 'fa-medium'), array('fa fa-medkit' => 'fa-medkit'), array('fa fa-meh-o' => 'fa-meh-o'), array('fa fa-mercury' => 'fa-mercury'), array('fa fa-microphone' => 'fa-microphone'), array('fa fa-microphone-slash' => 'fa-microphone-slash'), array('fa fa-minus' => 'fa-minus'), array('fa fa-minus-circle' => 'fa-minus-circle'), array('fa fa-minus-square' => 'fa-minus-square'), array('fa fa-minus-square-o' => 'fa-minus-square-o'), array('fa fa-mixcloud' => 'fa-mixcloud'), array('fa fa-mobile' => 'fa-mobile'), array('fa fa-mobile-phone' => 'fa-mobile-phone'), array('fa fa-modx' => 'fa-modx'), array('fa fa-money' => 'fa-money'), array('fa fa-moon-o' => 'fa-moon-o'), array('fa fa-mortar-board' => 'fa-mortar-board'), array('fa fa-motorcycle' => 'fa-motorcycle'), array('fa fa-mouse-pointer' => 'fa-mouse-pointer'), array('fa fa-music' => 'fa-music'), array('fa fa-navicon' => 'fa-navicon'), array('fa fa-neuter' => 'fa-neuter'), array('fa fa-newspaper-o' => 'fa-newspaper-o'), array('fa fa-object-group' => 'fa-object-group'), array('fa fa-object-ungroup' => 'fa-object-ungroup'), array('fa fa-odnoklassniki' => 'fa-odnoklassniki'), array('fa fa-odnoklassniki-square' => 'fa-odnoklassniki-square'), array('fa fa-opencart' => 'fa-opencart'), array('fa fa-openid' => 'fa-openid'), array('fa fa-opera' => 'fa-opera'), array('fa fa-optin-monster' => 'fa-optin-monster'), array('fa fa-outdent' => 'fa-outdent'), array('fa fa-pagelines' => 'fa-pagelines'), array('fa fa-paint-brush' => 'fa-paint-brush'), array('fa fa-paper-plane' => 'fa-paper-plane'), array('fa fa-paper-plane-o' => 'fa-paper-plane-o'), array('fa fa-paperclip' => 'fa-paperclip'), array('fa fa-paragraph' => 'fa-paragraph'), array('fa fa-paste' => 'fa-paste'), array('fa fa-pause' => 'fa-pause'), array('fa fa-pause-circle' => 'fa-pause-circle'), array('fa fa-pause-circle-o' => 'fa-pause-circle-o'), array('fa fa-paw' => 'fa-paw'), array('fa fa-paypal' => 'fa-paypal'), array('fa fa-pencil' => 'fa-pencil'), array('fa fa-pencil-square' => 'fa-pencil-square'), array('fa fa-pencil-square-o' => 'fa-pencil-square-o'), array('fa fa-percent' => 'fa-percent'), array('fa fa-phone' => 'fa-phone'), array('fa fa-phone-square' => 'fa-phone-square'), array('fa fa-photo' => 'fa-photo'), array('fa fa-picture-o' => 'fa-picture-o'), array('fa fa-pie-chart' => 'fa-pie-chart'), array('fa fa-pied-piper' => 'fa-pied-piper'), array('fa fa-pied-piper-alt' => 'fa-pied-piper-alt'), array('fa fa-pinterest' => 'fa-pinterest'), array('fa fa-pinterest-p' => 'fa-pinterest-p'), array('fa fa-pinterest-square' => 'fa-pinterest-square'), array('fa fa-plane' => 'fa-plane'), array('fa fa-play' => 'fa-play'), array('fa fa-play-circle' => 'fa-play-circle'), array('fa fa-play-circle-o' => 'fa-play-circle-o'), array('fa fa-plug' => 'fa-plug'), array('fa fa-plus' => 'fa-plus'), array('fa fa-plus-circle' => 'fa-plus-circle'), array('fa fa-plus-square' => 'fa-plus-square'), array('fa fa-plus-square-o' => 'fa-plus-square-o'), array('fa fa-power-off' => 'fa-power-off'), array('fa fa-print' => 'fa-print'), array('fa fa-product-hunt' => 'fa-product-hunt'), array('fa fa-puzzle-piece' => 'fa-puzzle-piece'), array('fa fa-qq' => 'fa-qq'), array('fa fa-qrcode' => 'fa-qrcode'), array('fa fa-question' => 'fa-question'), array('fa fa-question-circle' => 'fa-question-circle'), array('fa fa-quote-left' => 'fa-quote-left'), array('fa fa-quote-right' => 'fa-quote-right'), array('fa fa-ra' => 'fa-ra'), array('fa fa-random' => 'fa-random'), array('fa fa-rebel' => 'fa-rebel'), array('fa fa-recycle' => 'fa-recycle'), array('fa fa-reddit' => 'fa-reddit'), array('fa fa-reddit-alien' => 'fa-reddit-alien'), array('fa fa-reddit-square' => 'fa-reddit-square'), array('fa fa-refresh' => 'fa-refresh'), array('fa fa-registered' => 'fa-registered'), array('fa fa-remove' => 'fa-remove'), array('fa fa-renren' => 'fa-renren'), array('fa fa-reorder' => 'fa-reorder'), array('fa fa-repeat' => 'fa-repeat'), array('fa fa-reply' => 'fa-reply'), array('fa fa-reply-all' => 'fa-reply-all'), array('fa fa-retweet' => 'fa-retweet'), array('fa fa-rmb' => 'fa-rmb'), array('fa fa-road' => 'fa-road'), array('fa fa-rocket' => 'fa-rocket'), array('fa fa-rotate-left' => 'fa-rotate-left'), array('fa fa-rotate-right' => 'fa-rotate-right'), array('fa fa-rouble' => 'fa-rouble'), array('fa fa-rss' => 'fa-rss'), array('fa fa-rss-square' => 'fa-rss-square'), array('fa fa-rub' => 'fa-rub'), array('fa fa-ruble' => 'fa-ruble'), array('fa fa-rupee' => 'fa-rupee'), array('fa fa-safari' => 'fa-safari'), array('fa fa-save' => 'fa-save'), array('fa fa-scissors' => 'fa-scissors'), array('fa fa-scribd' => 'fa-scribd'), array('fa fa-search' => 'fa-search'), array('fa fa-search-minus' => 'fa-search-minus'), array('fa fa-search-plus' => 'fa-search-plus'), array('fa fa-sellsy' => 'fa-sellsy'), array('fa fa-send' => 'fa-send'), array('fa fa-send-o' => 'fa-send-o'), array('fa fa-server' => 'fa-server'), array('fa fa-share' => 'fa-share'), array('fa fa-share-alt' => 'fa-share-alt'), array('fa fa-share-alt-square' => 'fa-share-alt-square'), array('fa fa-share-square' => 'fa-share-square'), array('fa fa-share-square-o' => 'fa-share-square-o'), array('fa fa-shekel' => 'fa-shekel'), array('fa fa-sheqel' => 'fa-sheqel'), array('fa fa-shield' => 'fa-shield'), array('fa fa-ship' => 'fa-ship'), array('fa fa-shirtsinbulk' => 'fa-shirtsinbulk'), array('fa fa-shopping-bag' => 'fa-shopping-bag'), array('fa fa-shopping-basket' => 'fa-shopping-basket'), array('fa fa-shopping-cart' => 'fa-shopping-cart'), array('fa fa-sign-in' => 'fa-sign-in'), array('fa fa-sign-out' => 'fa-sign-out'), array('fa fa-signal' => 'fa-signal'), array('fa fa-simplybuilt' => 'fa-simplybuilt'), array('fa fa-sitemap' => 'fa-sitemap'), array('fa fa-skyatlas' => 'fa-skyatlas'), array('fa fa-skype' => 'fa-skype'), array('fa fa-slack' => 'fa-slack'), array('fa fa-sliders' => 'fa-sliders'), array('fa fa-slideshare' => 'fa-slideshare'), array('fa fa-smile-o' => 'fa-smile-o'), array('fa fa-soccer-ball-o' => 'fa-soccer-ball-o'), array('fa fa-sort' => 'fa-sort'), array('fa fa-sort-alpha-asc' => 'fa-sort-alpha-asc'), array('fa fa-sort-alpha-desc' => 'fa-sort-alpha-desc'), array('fa fa-sort-amount-asc' => 'fa-sort-amount-asc'), array('fa fa-sort-amount-desc' => 'fa-sort-amount-desc'), array('fa fa-sort-asc' => 'fa-sort-asc'), array('fa fa-sort-desc' => 'fa-sort-desc'), array('fa fa-sort-down' => 'fa-sort-down'), array('fa fa-sort-numeric-asc' => 'fa-sort-numeric-asc'), array('fa fa-sort-numeric-desc' => 'fa-sort-numeric-desc'), array('fa fa-sort-up' => 'fa-sort-up'), array('fa fa-soundcloud' => 'fa-soundcloud'), array('fa fa-space-shuttle' => 'fa-space-shuttle'), array('fa fa-spinner' => 'fa-spinner'), array('fa fa-spoon' => 'fa-spoon'), array('fa fa-spotify' => 'fa-spotify'), array('fa fa-square' => 'fa-square'), array('fa fa-square-o' => 'fa-square-o'), array('fa fa-stack-exchange' => 'fa-stack-exchange'), array('fa fa-stack-overflow' => 'fa-stack-overflow'), array('fa fa-star' => 'fa-star'), array('fa fa-star-half' => 'fa-star-half'), array('fa fa-star-half-empty' => 'fa-star-half-empty'), array('fa fa-star-half-full' => 'fa-star-half-full'), array('fa fa-star-half-o' => 'fa-star-half-o'), array('fa fa-star-o' => 'fa-star-o'), array('fa fa-steam' => 'fa-steam'), array('fa fa-steam-square' => 'fa-steam-square'), array('fa fa-step-backward' => 'fa-step-backward'), array('fa fa-step-forward' => 'fa-step-forward'), array('fa fa-stethoscope' => 'fa-stethoscope'), array('fa fa-sticky-note' => 'fa-sticky-note'), array('fa fa-sticky-note-o' => 'fa-sticky-note-o'), array('fa fa-stop' => 'fa-stop'), array('fa fa-stop-circle' => 'fa-stop-circle'), array('fa fa-stop-circle-o' => 'fa-stop-circle-o'), array('fa fa-street-view' => 'fa-street-view'), array('fa fa-strikethrough' => 'fa-strikethrough'), array('fa fa-stumbleupon' => 'fa-stumbleupon'), array('fa fa-stumbleupon-circle' => 'fa-stumbleupon-circle'), array('fa fa-subscript' => 'fa-subscript'), array('fa fa-subway' => 'fa-subway'), array('fa fa-suitcase' => 'fa-suitcase'), array('fa fa-sun-o' => 'fa-sun-o'), array('fa fa-superscript' => 'fa-superscript'), array('fa fa-support' => 'fa-support'), array('fa fa-table' => 'fa-table'), array('fa fa-tablet' => 'fa-tablet'), array('fa fa-tachometer' => 'fa-tachometer'), array('fa fa-tag' => 'fa-tag'), array('fa fa-tags' => 'fa-tags'), array('fa fa-tasks' => 'fa-tasks'), array('fa fa-taxi' => 'fa-taxi'), array('fa fa-television' => 'fa-television'), array('fa fa-tencent-weibo' => 'fa-tencent-weibo'), array('fa fa-terminal' => 'fa-terminal'), array('fa fa-text-height' => 'fa-text-height'), array('fa fa-text-width' => 'fa-text-width'), array('fa fa-th' => 'fa-th'), array('fa fa-th-large' => 'fa-th-large'), array('fa fa-th-list' => 'fa-th-list'), array('fa fa-thumb-tack' => 'fa-thumb-tack'), array('fa fa-thumbs-down' => 'fa-thumbs-down'), array('fa fa-thumbs-o-down' => 'fa-thumbs-o-down'), array('fa fa-thumbs-o-up' => 'fa-thumbs-o-up'), array('fa fa-thumbs-up' => 'fa-thumbs-up'), array('fa fa-ticket' => 'fa-ticket'), array('fa fa-times' => 'fa-times'), array('fa fa-times-circle' => 'fa-times-circle'), array('fa fa-times-circle-o' => 'fa-times-circle-o'), array('fa fa-tint' => 'fa-tint'), array('fa fa-toggle-down' => 'fa-toggle-down'), array('fa fa-toggle-left' => 'fa-toggle-left'), array('fa fa-toggle-off' => 'fa-toggle-off'), array('fa fa-toggle-on' => 'fa-toggle-on'), array('fa fa-toggle-right' => 'fa-toggle-right'), array('fa fa-toggle-up' => 'fa-toggle-up'), array('fa fa-trademark' => 'fa-trademark'), array('fa fa-train' => 'fa-train'), array('fa fa-transgender' => 'fa-transgender'), array('fa fa-transgender-alt' => 'fa-transgender-alt'), array('fa fa-trash' => 'fa-trash'), array('fa fa-trash-o' => 'fa-trash-o'), array('fa fa-tree' => 'fa-tree'), array('fa fa-trello' => 'fa-trello'), array('fa fa-tripadvisor' => 'fa-tripadvisor'), array('fa fa-trophy' => 'fa-trophy'), array('fa fa-truck' => 'fa-truck'), array('fa fa-try' => 'fa-try'), array('fa fa-tty' => 'fa-tty'), array('fa fa-tumblr' => 'fa-tumblr'), array('fa fa-tumblr-square' => 'fa-tumblr-square'), array('fa fa-turkish-lira' => 'fa-turkish-lira'), array('fa fa-tv' => 'fa-tv'), array('fa fa-twitch' => 'fa-twitch'), array('fa fa-twitter' => 'fa-twitter'), array('fa fa-twitter-square' => 'fa-twitter-square'), array('fa fa-umbrella' => 'fa-umbrella'), array('fa fa-underline' => 'fa-underline'), array('fa fa-undo' => 'fa-undo'), array('fa fa-university' => 'fa-university'), array('fa fa-unlink' => 'fa-unlink'), array('fa fa-unlock' => 'fa-unlock'), array('fa fa-unlock-alt' => 'fa-unlock-alt'), array('fa fa-unsorted' => 'fa-unsorted'), array('fa fa-upload' => 'fa-upload'), array('fa fa-usb' => 'fa-usb'), array('fa fa-usd' => 'fa-usd'), array('fa fa-user' => 'fa-user'), array('fa fa-user-md' => 'fa-user-md'), array('fa fa-user-plus' => 'fa-user-plus'), array('fa fa-user-secret' => 'fa-user-secret'), array('fa fa-user-times' => 'fa-user-times'), array('fa fa-users' => 'fa-users'), array('fa fa-venus' => 'fa-venus'), array('fa fa-venus-double' => 'fa-venus-double'), array('fa fa-venus-mars' => 'fa-venus-mars'), array('fa fa-viacoin' => 'fa-viacoin'), array('fa fa-video-camera' => 'fa-video-camera'), array('fa fa-vimeo' => 'fa-vimeo'), array('fa fa-vimeo-square' => 'fa-vimeo-square'), array('fa fa-vine' => 'fa-vine'), array('fa fa-vk' => 'fa-vk'), array('fa fa-volume-down' => 'fa-volume-down'), array('fa fa-volume-off' => 'fa-volume-off'), array('fa fa-volume-up' => 'fa-volume-up'), array('fa fa-warning' => 'fa-warning'), array('fa fa-wechat' => 'fa-wechat'), array('fa fa-weibo' => 'fa-weibo'), array('fa fa-weixin' => 'fa-weixin'), array('fa fa-whatsapp' => 'fa-whatsapp'), array('fa fa-wheelchair' => 'fa-wheelchair'), array('fa fa-wifi' => 'fa-wifi'), array('fa fa-wikipedia-w' => 'fa-wikipedia-w'), array('fa fa-windows' => 'fa-windows'), array('fa fa-won' => 'fa-won'), array('fa fa-wordpress' => 'fa-wordpress'), array('fa fa-wrench' => 'fa-wrench'), array('fa fa-xing' => 'fa-xing'), array('fa fa-xing-square' => 'fa-xing-square'), array('fa fa-y-combinator' => 'fa-y-combinator'), array('fa fa-y-combinator-square' => 'fa-y-combinator-square'), array('fa fa-yahoo' => 'fa-yahoo'), array('fa fa-yc' => 'fa-yc'), array('fa fa-yc-square' => 'fa-yc-square'), array('fa fa-yelp' => 'fa-yelp'), array('fa fa-yen' => 'fa-yen'), array('fa fa-youtube' => 'fa-youtube'), array('fa fa-youtube-play' => 'fa-youtube-play'), array('fa fa-youtube-square' => 'fa-youtube-square')
        ));

        return $GLOBALS['g5plus_font_awesome'];
    }
}

/**
 * Get Pe-icon-7-stroke
 * *******************************************************
 */
if (!function_exists('g5plus_get_pe_icon_7_stroke')) {
    function &g5plus_get_pe_icon_7_stroke()
    {
        if (isset($GLOBALS['g5plus_get_pe_icon_7_stroke']) && is_array($GLOBALS['g5plus_get_pe_icon_7_stroke'])) {
            return $GLOBALS['g5plus_get_pe_icon_7_stroke'];
        }
        $GLOBALS['g5plus_get_pe_icon_7_stroke'] = apply_filters('g5plus_get_pe_icon_7_stroke', array(
            array('pe-7s-album' => 'pe-7s-album'), array('pe-7s-arc' => 'pe-7s-arc'), array('pe-7s-back-2' => 'pe-7s-back-2'), array('pe-7s-bandaid' => 'pe-7s-bandaid'), array('pe-7s-car' => 'pe-7s-car'), array('pe-7s-diamond' => 'pe-7s-diamond'), array('pe-7s-door-lock' => 'pe-7s-door-lock'), array('pe-7s-eyedropper' => 'pe-7s-eyedropper'), array('pe-7s-female' => 'pe-7s-female'), array('pe-7s-gym' => 'pe-7s-gym'), array('pe-7s-hammer' => 'pe-7s-hammer'), array('pe-7s-headphones' => 'pe-7s-headphones'), array('pe-7s-helm' => 'pe-7s-helm'), array('pe-7s-hourglass' => 'pe-7s-hourglass'), array('pe-7s-leaf' => 'pe-7s-leaf'), array('pe-7s-magic-wand' => 'pe-7s-magic-wand'), array('pe-7s-male' => 'pe-7s-male'), array('pe-7s-map-2' => 'pe-7s-map-2'), array('pe-7s-next-2' => 'pe-7s-next-2'), array('pe-7s-paint-bucket' => 'pe-7s-paint-bucket'), array('pe-7s-pendrive' => 'pe-7s-pendrive'), array('pe-7s-photo' => 'pe-7s-photo'), array('pe-7s-piggy' => 'pe-7s-piggy'), array('pe-7s-plugin' => 'pe-7s-plugin'), array('pe-7s-refresh-2' => 'pe-7s-refresh-2'), array('pe-7s-rocket' => 'pe-7s-rocket'), array('pe-7s-settings' => 'pe-7s-settings'), array('pe-7s-shield' => 'pe-7s-shield'), array('pe-7s-smile' => 'pe-7s-smile'), array('pe-7s-usb' => 'pe-7s-usb'), array('pe-7s-vector' => 'pe-7s-vector'), array('pe-7s-wine' => 'pe-7s-wine'), array('pe-7s-cloud-upload' => 'pe-7s-cloud-upload'), array('pe-7s-cash' => 'pe-7s-cash'), array('pe-7s-close' => 'pe-7s-cash'), array('pe-7s-bluetooth' => 'pe-7s-bluetooth'), array('pe-7s-cloud-download' => 'pe-7s-cloud-download'), array('pe-7s-way' => 'pe-7s-way'), array('pe-7s-close-circle' => 'pe-7s-close-circle'), array('pe-7s-id' => 'pe-7s-id'), array('pe-7s-angle-up' => 'pe-7s-angle-up'), array('pe-7s-wristwatch' => 'pe-7s-wristwatch'), array('pe-7s-angle-up-circle' => 'pe-7s-angle-up-circle'), array('pe-7s-world' => 'pe-7s-world'), array('pe-7s-angle-right' => 'pe-7s-angle-right'), array('pe-7s-volume' => 'pe-7s-volume'), array('pe-7s-angle-right-circle' => 'pe-7s-angle-right-circle'), array('pe-7s-users' => 'pe-7s-users'), array('pe-7s-angle-left' => 'pe-7s-angle-left'), array('pe-7s-user-female' => 'pe-7s-user-female'), array('pe-7s-angle-left-circle' => 'pe-7s-angle-left-circle'), array('pe-7s-up-arrow' => 'pe-7s-up-arrow'), array('pe-7s-angle-down' => 'pe-7s-angle-down'), array('pe-7s-switch' => 'pe-7s-switch'), array('pe-7s-angle-down-circle' => 'pe-7s-angle-down-circle'), array('pe-7s-scissors' => 'pe-7s-scissors'), array('pe-7s-wallet' => 'pe-7s-wallet'), array('pe-7s-safe' => 'pe-7s-safe'), array('pe-7s-volume2' => 'pe-7s-volume2'), array('pe-7s-volume1' => 'pe-7s-volume1'), array('pe-7s-voicemail' => 'pe-7s-voicemail'), array('pe-7s-video' => 'pe-7s-video'), array('pe-7s-user' => 'pe-7s-user'), array('pe-7s-upload' => 'pe-7s-upload'), array('pe-7s-unlock' => 'pe-7s-unlock'), array('pe-7s-umbrella' => 'pe-7s-umbrella'), array('pe-7s-trash' => 'pe-7s-trash'), array('pe-7s-tools' => 'pe-7s-tools'), array('pe-7s-timer' => 'pe-7s-timer'), array('pe-7s-ticket' => 'pe-7s-ticket'), array('pe-7s-target' => 'pe-7s-target'), array('pe-7s-sun' => 'pe-7s-sun'), array('pe-7s-study' => 'pe-7s-study'), array('pe-7s-stopwatch' => 'pe-7s-stopwatch'), array('pe-7s-star' => 'pe-7s-star'), array('pe-7s-speaker' => 'pe-7s-speaker'), array('pe-7s-signal' => 'pe-7s-signal'), array('pe-7s-shuffle' => 'pe-7s-shuffle'), array('pe-7s-shopbag' => 'pe-7s-shopbag'), array('pe-7s-share' => 'pe-7s-share'), array('pe-7s-server' => 'pe-7s-server'), array('pe-7s-search' => 'pe-7s-search'), array('pe-7s-film' => 'pe-7s-film'), array('pe-7s-science' => 'pe-7s-science'), array('pe-7s-disk' => 'pe-7s-disk'), array('pe-7s-ribbon' => 'pe-7s-ribbon'), array('pe-7s-repeat' => 'pe-7s-repeat'), array('pe-7s-refresh' => 'pe-7s-refresh'), array('pe-7s-add-user' => 'pe-7s-add-user'), array('pe-7s-refresh-cloud' => 'pe-7s-refresh-cloud'), array('pe-7s-paperclip' => 'pe-7s-paperclip'), array('pe-7s-radio' => 'pe-7s-radio'), array('pe-7s-note2' => 'pe-7s-note2'), array('pe-7s-print' => 'pe-7s-print'), array('pe-7s-network' => 'pe-7s-network'), array('pe-7s-prev' => 'pe-7s-prev'), array('pe-7s-mute' => 'pe-7s-mute'), array('pe-7s-power' => 'pe-7s-power'), array('pe-7s-medal' => 'pe-7s-medal'), array('pe-7s-portfolio' => 'pe-7s-portfolio'), array('pe-7s-like2' => 'pe-7s-like2'), array('pe-7s-plus' => 'pe-7s-plus'), array('pe-7s-left-arrow' => 'pe-7s-left-arrow'), array('pe-7s-play' => 'pe-7s-play'), array('pe-7s-key' => 'pe-7s-key'), array('pe-7s-plane' => 'pe-7s-plane'), array('pe-7s-joy' => 'pe-7s-joy'), array('pe-7s-photo-gallery' => 'pe-7s-photo-gallery'), array('pe-7s-pin' => 'pe-7s-pin'), array('pe-7s-phone' => 'pe-7s-phone'), array('pe-7s-plug' => 'pe-7s-plug'), array('pe-7s-pen' => 'pe-7s-pen'), array('pe-7s-right-arrow' => 'pe-7s-right-arrow'), array('pe-7s-paper-plane' => 'pe-7s-paper-plane'), array('pe-7s-delete-user' => 'pe-7s-delete-user'), array('pe-7s-paint' => 'pe-7s-paint'), array('pe-7s-bottom-arrow' => 'pe-7s-bottom-arrow'), array('pe-7s-notebook' => 'pe-7s-notebook'), array('pe-7s-note' => 'pe-7s-note'), array('pe-7s-next' => 'pe-7s-next'), array('pe-7s-news-paper' => 'pe-7s-news-paper'), array('pe-7s-musiclist' => 'pe-7s-musiclist'), array('pe-7s-music' => 'pe-7s-music'), array('pe-7s-mouse' => 'pe-7s-mouse'), array('pe-7s-more' => 'pe-7s-more'), array('pe-7s-moon' => 'pe-7s-moon'), array('pe-7s-monitor' => 'pe-7s-monitor'), array('pe-7s-micro' => 'pe-7s-micro'), array('pe-7s-menu' => 'pe-7s-menu'), array('pe-7s-map' => 'pe-7s-map'), array('pe-7s-map-marker' => 'pe-7s-map-marker'), array('pe-7s-mail' => 'pe-7s-mail'), array('pe-7s-mail-open' => 'pe-7s-mail-open'), array('pe-7s-mail-open-file' => 'pe-7s-mail-open-file'), array('pe-7s-magnet' => 'pe-7s-magnet'), array('pe-7s-loop' => 'pe-7s-loop'), array('pe-7s-look' => 'pe-7s-look'), array('pe-7s-lock' => 'pe-7s-lock'), array('pe-7s-lintern' => 'pe-7s-lintern'), array('pe-7s-link' => 'pe-7s-link'), array('pe-7s-like' => 'pe-7s-like'), array('pe-7s-light' => 'pe-7s-light'), array('pe-7s-less' => 'pe-7s-less'), array('pe-7s-keypad' => 'pe-7s-keypad'), array('pe-7s-junk' => 'pe-7s-junk'), array('pe-7s-info' => 'pe-7s-info'), array('pe-7s-home' => 'pe-7s-home'), array('pe-7s-help2' => 'pe-7s-help2'), array('pe-7s-help1' => 'pe-7s-help1'), array('pe-7s-graph3' => 'pe-7s-graph3'), array('pe-7s-graph2' => 'pe-7s-graph2'), array('pe-7s-graph1' => 'pe-7s-graph1'), array('pe-7s-graph' => 'pe-7s-graph'), array('pe-7s-global' => 'pe-7s-global'), array('pe-7s-gleam' => 'pe-7s-gleam'), array('pe-7s-glasses' => 'pe-7s-glasses'), array('pe-7s-gift' => 'pe-7s-gift'), array('pe-7s-folder' => 'pe-7s-folder'), array('pe-7s-flag' => 'pe-7s-flag'), array('pe-7s-filter' => 'pe-7s-filter'), array('pe-7s-file' => 'pe-7s-file'), array('pe-7s-expand1' => 'pe-7s-expand1'), array('pe-7s-exapnd2' => 'pe-7s-exapnd2'), array('pe-7s-edit' => 'pe-7s-edit'), array('pe-7s-drop' => 'pe-7s-drop'), array('pe-7s-drawer' => 'pe-7s-drawer'), array('pe-7s-download' => 'pe-7s-download'), array('pe-7s-display2' => 'pe-7s-display2'), array('pe-7s-display1' => 'pe-7s-display1'), array('pe-7s-diskette' => 'pe-7s-diskette'), array('pe-7s-date' => 'pe-7s-date'), array('pe-7s-cup' => 'pe-7s-cup'), array('pe-7s-culture' => 'pe-7s-culture'), array('pe-7s-crop' => 'pe-7s-crop'), array('pe-7s-credit' => 'pe-7s-credit'), array('pe-7s-copy-file' => 'pe-7s-copy-file'), array('pe-7s-config' => 'pe-7s-config'), array('pe-7s-compass' => 'pe-7s-compass'), array('pe-7s-comment' => 'pe-7s-comment'), array('pe-7s-coffee' => 'pe-7s-coffee'), array('pe-7s-cloud' => 'pe-7s-cloud'), array('pe-7s-clock' => 'pe-7s-clock'), array('pe-7s-check' => 'pe-7s-check'), array('pe-7s-chat' => 'pe-7s-chat'), array('pe-7s-cart' => 'pe-7s-cart'), array('pe-7s-camera' => 'pe-7s-camera'), array('pe-7s-call' => 'pe-7s-call'), array('pe-7s-calculator' => 'pe-7s-calculator'), array('pe-7s-browser' => 'pe-7s-browser'), array('pe-7s-box2' => 'pe-7s-box2'), array('pe-7s-box1' => 'pe-7s-box1'), array('pe-7s-bookmarks' => 'pe-7s-bookmarks'), array('pe-7s-bicycle' => 'pe-7s-bicycle'), array('pe-7s-bell' => 'pe-7s-bell'), array('pe-7s-battery' => 'pe-7s-battery'), array('pe-7s-ball' => 'pe-7s-ball'), array('pe-7s-back' => 'pe-7s-back'), array('pe-7s-attention' => 'pe-7s-attention'), array('pe-7s-anchor' => 'pe-7s-anchor'), array('pe-7s-albums' => 'pe-7s-albums'), array('pe-7s-alarm' => 'pe-7s-alarm'), array('pe-7s-airplay' => 'pe-7s-airplay')));
        return $GLOBALS['g5plus_get_pe_icon_7_stroke'];
    }
}

/**
 * get the_post_thumbnail()
 * *******************************************************
 */
if (!function_exists('g5plus_the_post_thumbnail()')) {
    function g5plus_the_post_thumbnail($size = 'post-thumbnail', $attr = '')
    {
        the_post_thumbnail($size, $attr);
    }
}

/*Custom Place Input Comment Form*/
if (!function_exists('g5plus_reorder_comment_fields')) {
    function g5plus_reorder_comment_fields($comment_fields)
    {
        $comment_fields_reorder = $comment_fields;
        if (isset($comment_fields_reorder['comment'])) {
            unset($comment_fields_reorder['comment']);
        }
        $comment_fields_reorder['comment'] = $comment_fields['comment'];
        return $comment_fields_reorder;
    }

    add_filter('comment_form_fields', 'g5plus_reorder_comment_fields');
}


/*Custom Categories Count*/
if (!function_exists('g5plus_add_span_cat_count')) {
    function g5plus_add_span_cat_count($links)
    {
        $links = str_replace('(', '<span class="count">(', $links);
        $links = str_replace(')', ')</span>', $links);
        return $links;
    }

    add_filter('wp_list_categories', 'g5plus_add_span_cat_count');
    add_filter('get_archives_link', 'g5plus_add_span_cat_count');
}

/*================================================
COMMENTS FORM
================================================== */
if (!function_exists('g5plus_comment_form')) {
    function g5plus_comment_form()
    {
        $commenter = g5plus_wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;
        $fields = array(
            'author' => '<div class="form-group">' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_html__('Your name (required)', 'g5-startup') . '" ' . $aria_req . '>' .
                '</div>',
            'email'  => '<div class="form-group">' .
                '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_html__('Your email (required)', 'g5-startup') . '" ' . $aria_req . '>' .
                '</div>',
        );
        $fields = apply_filters('g5plus_comment_fields', $fields);
        $comment_form_args = array(
            'comment_field'        => '<div class="form-group" style="width: 100%; padding: 0;">' .
                '<textarea rows="6" id="comment" name="comment" placeholder="' . esc_html__('Your comment (required)', 'g5-startup') . '" ' . $aria_req . '></textarea>' .
                '</div>',
            'fields'               => $fields,
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'id_submit'            => 'btnComment',
            'class_submit'         => 'button-comment',
            //'title_reply'          => esc_html__('WRITE A COMMENT', 'g5-startup'),
            //'title_reply_to'       => esc_html__('WRITE A COMMENT to %s', 'g5-startup'),
            //'cancel_reply_link'    => esc_html__('Cancel reply', 'g5-startup'),
            //'label_submit'         => esc_html__('SEND MESSAGE', 'g5-startup')
        );

        comment_form($comment_form_args);
    }
}
/*=======================*/
if (!function_exists('g5plus_wp_get_current_commenter')) {
    function g5plus_wp_get_current_commenter()
    {
        $comment_author = '';
        if (isset($_COOKIE['comment_author_' . COOKIEHASH]))
            $comment_author = $_COOKIE['comment_author_' . COOKIEHASH];

        $comment_author_email = '';
        if (isset($_COOKIE['comment_author_email_' . COOKIEHASH]))
            $comment_author_email = $_COOKIE['comment_author_email_' . COOKIEHASH];
        $comment_author_phone = '';
        return apply_filters('wp_get_current_commenter', compact('comment_author', 'comment_author_email'));
    }
}
if (!function_exists('g5plus_vertical_check')) :
    function g5plus_vertical_check($html, $post_id, $post_thumbnail_id, $size, $attr)
    {
        $image_data = wp_get_attachment_image_src($post_thumbnail_id, 'large-image');
        //Get the image width and height from the data provided by wp_get_attachment_image_src()
        $width = $image_data[1];
        $height = $image_data[2];
        if ($height > $width) {
            $html = str_replace('attachment-', 'vertical-image attachment-', $html);
        }
        return $html;
    }
endif;
add_filter('post_thumbnail_html', 'g5plus_vertical_check', 10, 5);

/**
 * Get Page Title
 *
 * @return string|void
 */
if(!function_exists('g5plus_get_page_title')) {
    function g5plus_get_page_title()
    {
        $page_title = '';
        $custome_page_title_enable = g5plus_get_option('custome_page_title_enable', 0);
        if (is_home()) {
            if (empty($page_title)) {
                $page_title = esc_html__("Blog", 'g5-startup');
            }
        } elseif (!is_singular() && !is_front_page()) {
            if (!have_posts()) {
                $page_title = esc_html__('Nothing Found', 'g5-startup');
            } elseif (is_tag() || is_tax('product_tag')) {
                $page_title = single_tag_title(esc_html__("Tags: ", 'g5-startup'), false);
            } elseif (is_category() || is_tax()) {
                $page_title = single_cat_title('', false);
            } elseif (is_author()) {
                $page_title = sprintf(esc_html__('Author: %s', 'g5-startup'), get_the_author());
            } elseif (is_day()) {
                $page_title = sprintf(esc_html__('Daily Archives: %s', 'g5-startup'), get_the_date());
            } elseif (is_month()) {
                $page_title = sprintf(esc_html__('Monthly Archives: %s', 'g5-startup'), get_the_date(_x('F Y', 'monthly archives date format', 'g5-startup')));
            } elseif (is_year()) {
                $page_title = sprintf(esc_html__('Yearly Archives: %s', 'g5-startup'), get_the_date(_x('Y', 'yearly archives date format', 'g5-startup')));
            } elseif (is_search()) {
                $page_title = esc_html__('Search Results', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-aside')) {
                $page_title = esc_html__('Asides', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                $page_title = esc_html__('Galleries', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-image')) {
                $page_title = esc_html__('Images', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-video')) {
                $page_title = esc_html__('Videos', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                $page_title = esc_html__('Quotes', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-link')) {
                $page_title = esc_html__('Links', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-status')) {
                $page_title = esc_html__('Statuses', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                $page_title = esc_html__('Audios', 'g5-startup');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                $page_title = esc_html__('Chats', 'g5-startup');
            }
        }
        if (is_404()) {
            $page_title = esc_html__('404 Error', 'g5-startup');
        }

        if (is_singular('post')) {
        	$page_title = esc_html__('Blog','g5-startup');
        }


        if ($custome_page_title_enable) {
            $page_title = g5plus_get_option('page_title', $page_title);
        }
        if (is_singular()) {
            if (!$page_title) {
                $page_title = get_the_title(get_the_ID());
            }
            $is_custom_page_title = g5plus_get_rwmb_meta('is_custom_page_title');
            if ($is_custom_page_title) {
                $page_title = g5plus_get_rwmb_meta('custom_page_title');
            }
        }
        $page_title = apply_filters('g5plus_page_title', $page_title);
        return $page_title;
    }
}

/**
 * Page Sub title
 */
if(!function_exists('g5plus_get_page_subtitle')) {
    function g5plus_get_page_subtitle() {
        $page_sub_title = g5plus_get_option('page_sub_title');
        if (is_singular()) {
            $is_custom_page_title = g5plus_get_rwmb_meta('is_custom_page_title');
            if ($is_custom_page_title) {
                $page_sub_title = g5plus_get_rwmb_meta('custom_page_sub_title');
            }
        } elseif (is_category() || is_tax()) {
            $cat = get_queried_object();
            if ($cat && property_exists($cat, 'term_id')) {
                $term_description = strip_tags(term_description());
                if ($term_description) {
                    $page_sub_title = $term_description;
                }
            }
        }
        $page_sub_title = apply_filters('g5plus_sub_page_title', $page_sub_title);
        return $page_sub_title;
    }
}

/**
 * Display Content Block
 *
 * @param $id
 * @return mixed|string|void
 */
if(!function_exists('g5plus_content_block')) {
    function g5plus_content_block($id)
    {
        if (empty($id)) return '';
        $content = get_post_field('post_content', $id);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}

if (!function_exists('g5plus_get_default_fonts')) {
	function g5plus_get_default_fonts($is_frontEnd = true) {
		return  array(
			'body_font' => array(
				'default' => array(
					'font-size'   => '14px',
					'font-family' => 'Open Sans',
					'font-weight' => '400',
				),
				'selector' => $is_frontEnd ? array('body') : array('.editor-styles-wrapper.editor-styles-wrapper')
			) ,
			'secondary_font' => array(
				'default' => array(
					'font-family' => 'Josefin Sans',
				),

			),
			'heading_font' => array(
				'default' =>  array(
					'font-family' => 'Montserrat',
				),
			),
			'menu_font' =>  array(
				'default' =>  array(
					'font-size'   => '13px',
					'font-family' => 'Montserrat',
					'font-weight' => '400',
				),
			),
			'sub_menu_font' => array(
				'default' =>  array(
					'font-size'   => '12px',
					'font-family' => 'Montserrat',
					'font-weight' => '400',
				),
			),
			'h1_font' => array(
				'default' =>  array(
					'font-size'   => '48px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h1') :  array('.editor-styles-wrapper.editor-styles-wrapper h1')
			),
			'h2_font' => array(
				'default' =>  array(
					'font-size'   => '36px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h2') : array('.editor-styles-wrapper.editor-styles-wrapper h2')
			),
			'h3_font' => array(
				'default' =>  array(
					'font-size'   => '24px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h3') :array('.editor-styles-wrapper.editor-styles-wrapper h3','.editor-post-title__block.editor-post-title__block .editor-post-title__input')
			),
			'h4_font' => array(
				'default' =>  array(
					'font-size'   => '18px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h4') : array('.editor-styles-wrapper.editor-styles-wrapper h4')
			),
			'h5_font' => array(
				'default' =>  array(
					'font-size'   => '14px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h5') : array('.editor-styles-wrapper.editor-styles-wrapper h5')
			),
			'h6_font'  => array(
				'default' =>  array(
					'font-size'   => '12px',
					'font-family' => 'Montserrat',
					'font-weight' => '600',
				),
				'selector' => $is_frontEnd ? array('h6') : array('.editor-styles-wrapper.editor-styles-wrapper h6')
			),
		);
	}
}

if (!function_exists('g5plus_get_fonts_css')) {
	function g5plus_get_fonts_css($is_frontEnd = true) {
		$custom_fonts_variable = g5plus_get_default_fonts($is_frontEnd);
		$custom_css = '';
		foreach ($custom_fonts_variable as $optionKey => $v) {
			$fonts = g5plus_get_option($optionKey,$v['default']);
			if ($fonts) {
				$selector = (isset($v['selector']) && is_array($v['selector'])) ? implode(',', $v['selector']) : '';
				$fonts = g5plus_process_font($fonts);
				$fonts_attributes = array();
				if (isset($fonts['font-family'])) {
					$fonts['font-family'] = g5plus_get_font_family($fonts['font-family']);
					$fonts_attributes[] = "font-family: '{$fonts['font-family']}'";
				}

				if (isset($fonts['font-size'])) {
					$fonts_attributes[] = "font-size: {$fonts['font-size']}";
				}

				if (isset($fonts['font-weight'])) {
					$fonts_attributes[] = "font-weight: {$fonts['font-weight']}";
				}

				if (isset($fonts['font-style'])) {
					$fonts_attributes[] = "font-style: {$fonts['font-style']}";
				}

				if (isset($fonts['text-transform'])) {
					$fonts_attributes[] = "text-transform: {$fonts['text-transform']}";
				}

				if (isset($fonts['color'])) {
					$fonts_attributes[] = "color: {$fonts['color']}";
				}

				if (isset($fonts['line-height'])) {
					$fonts_attributes[] = "line-height: {$fonts['line-height']}";
				}


				if ((count($fonts_attributes) > 0)  && ($selector != '')) {
					$fonts_css = implode(';', $fonts_attributes);

					$custom_css .= <<<CSS
                {$selector} {
                    {$fonts_css}
                }
CSS;
				}
			}
		}

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}

if (!function_exists('g5plus_get_fonts_url')) {
	function g5plus_get_fonts_url() {
		$custom_fonts_variable = g5plus_get_default_fonts();
		$google_fonts = array();
		foreach ($custom_fonts_variable as $k => $v) {
			$custom_fonts = g5plus_get_option($k,$v['default']);
			if ($custom_fonts && is_array($custom_fonts) && isset($custom_fonts['font-family']) && !in_array($custom_fonts['font-family'],$google_fonts)) {
				$google_fonts[] = $custom_fonts['font-family'];
			}
		}
		$fonts_url = '';
		$fonts = '';
		foreach($google_fonts as $google_font)
		{
			$fonts .= str_replace('','+',$google_font) . ':100,300,400,500,600,700,900,100italic,300italic,400italic,500italic,600italic,700italic,900italic|';
		}
		if ($fonts != '')
		{
			$protocol = is_ssl() ? 'https' : 'http';
			$fonts_url =  $protocol . '://fonts.googleapis.com/css?family=' . substr_replace( $fonts, "", - 1 );
		}
		return $fonts_url;
	}
}