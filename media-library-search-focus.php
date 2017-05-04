<?php
   /*
   Plugin Name: Media Library Search Focus
   Description: Set the initial focus to the search field when the Media Library pops up
   Version: 1.0
   Author: Mark Bowen
   License: GPL2
   */

/**
 * When a wp.media Modal is opened, set the focus to the media toolbar's search field.
 */
add_action( 'admin_footer-post-new.php', 'wpse_media_library_search_focus' );
add_action( 'admin_footer-post.php', 'wpse_media_library_search_focus' );
function wpse_media_library_search_focus() { ?>
<script type="text/javascript">
    ( function( $ ) {
        $( document ).ready( function() {

            // Ensure the wp.media object is set, otherwise we can't do anything.
            if ( wp.media ) {

                // Ensure that the Modal is ready. This approach resolves the 
                // need for timers which were used in a previous version of my answer
                // due to the modal not being ready yet.
                wp.media.view.Modal.prototype.on( "ready", function() {
                    // console.log( "media modal ready" );

                    // Execute this code when a Modal is opened.
                    // via https://gist.github.com/soderlind/370720db977f27c20360
                    wp.media.view.Modal.prototype.on( "open", function() {
                        // console.log( "media modal open" );

                        // Select the the .media-modal within the current backbone view,
                        // find the search input, and set the focus.
                        // http://stackoverflow.com/a/8934067/3059883
                        $( ".media-modal", this.el ).find( "#media-search-input" ).focus();
                    });

                    // Execute this code when a Modal is closed.
                    wp.media.view.Modal.prototype.on( "close", function() {
                         // console.log( "media modal close" );
                    });
                });
            }

        });
    })( jQuery );
</script><?php
}

?>