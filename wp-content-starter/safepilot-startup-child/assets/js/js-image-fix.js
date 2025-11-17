/**
 * SafePilot - JavaScript fix dla obrazków
 */
jQuery(document).ready(function($) {
    
    // Napraw obrazki z width="1" height="1"
    function fixImageDimensions() {
        $('.sp-post-thumbnail img').each(function() {
            var $img = $(this);
            
            // Jeśli width lub height = 1, napraw
            if ($img.attr('width') == '1' || $img.attr('height') == '1') {
                $img.removeAttr('width').removeAttr('height');
                $img.css({
                    'width': '100%',
                    'height': '100%',
                    'object-fit': 'cover'
                });
            }
        });
        
        // Fix dla related posts
        $('.post-related-wrap img').each(function() {
            var $img = $(this);
            if ($img.attr('width') == '1' || $img.attr('height') == '1') {
                $img.removeAttr('width').removeAttr('height');
            }
        });
    }
    
    // Uruchom po załadowaniu
    fixImageDimensions();
    
    // Uruchom po AJAX
    $(document).ajaxComplete(function() {
        fixImageDimensions();
    });
    
    // Uruchom po lazy load
    $(window).on('load', function() {
        setTimeout(fixImageDimensions, 500);
    });
    
});