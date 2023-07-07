<?php
/**
 * Plugin Name: Disable Translation Management in WPML
 * Plugin URI: https://github.com/SatelliteWP/wpml-disable-translation-management/
 * Description: Disable the Translation Management add-on in WPML when not needed to avoid confusion.
 * Author: WPML Support
 * Author URI: https://wpml.org
 * Version: 1.0
 */

add_action( 'wpml_loaded', function() {
  global $sitepress;
  
  if ( $sitepress->is_setup_complete() != get_option( 'DisableWPMLTM' ) ) {
    update_option( 'DisableWPMLTM', $sitepress->is_setup_complete() );
  }
});

if ( get_option( 'DisableWPMLTM' ) ) {
    define( 'WPML_DO_NOT_LOAD_EMBEDDED_TM', true );
  
    $wpml_setup = get_option( 'WPML(setup)' );
    if ( ! empty( $wpml_setup ) && ! empty( $wpml_setup['is-tm-allowed'] ) ) {
        $wpml_setup['is-tm-allowed'] = false;
        update_option( 'WPML(setup)', $wpml_setup );
    }
}
