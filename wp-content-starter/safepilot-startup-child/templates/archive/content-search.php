<?php
/**
 * SafePilot - Template wyników wyszukiwania
 * @package SafePilot
 * @version 2.0
 */

global $post;
$class = array('sp-search-item', 'clearfix');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    
    <div class="sp-search-icon">
        <?php
        switch ($post->post_type) {
            case 'post':
                echo '<i class="fa-regular fa-newspaper"></i>';
                break;
            case 'page':
                echo '<i class="fa-regular fa-file-lines"></i>';
                break;
            case 'product':
                echo '<i class="fa-solid fa-box"></i>';
                break;
            default:
                echo '<i class="fa-regular fa-file"></i>';
                break;
        }
        ?>
    </div>
    
    <div class="sp-search-content">
        <!-- Tytuł -->
        <h4 class="sp-search-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        
        <!-- Meta -->
        <div class="sp-search-meta">
            <span class="sp-search-date">
                <i class="fa-regular fa-calendar"></i>
                <?php echo get_the_date(); ?>
            </span>
            
            <span class="sp-search-type">
                <?php
                switch ($post->post_type) {
                    case 'post':
                        echo '<span class="badge bg-primary">Wpis</span>';
                        break;
                    case 'page':
                        echo '<span class="badge bg-secondary">Strona</span>';
                        break;
                    case 'product':
                        echo '<span class="badge bg-success">Produkt</span>';
                        break;
                    default:
                        echo '<span class="badge bg-info">' . ucfirst($post->post_type) . '</span>';
                        break;
                }
                ?>
            </span>
        </div>
        
        <!-- Zajawka -->
        <?php if (in_array($post->post_type, array('post', 'product'))): ?>
            <div class="sp-search-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>
        <?php endif; ?>
    </div>
</article>