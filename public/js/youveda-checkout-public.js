jQuery(document).ready(function($){
	console.clear();
	if ( true == mwb_youveda.mobile_view ) {

		var login_section = '';

		// Hide section by default.
		if ( 0 < jQuery( '.mwb_youveda_logged_in_text' ).length ) {

			login_section = jQuery( '.mwb_youveda_logged_in_text' );
			if ( login_section.hasClass( 'hide_checkout_sections' ) ) {
				jQuery( '#customer_details' ).hide();
			}
		}
		
		// Show sections on click.
		jQuery(document).on( 'click', '.mwb_youveda_logged_in_toggle', function(e) {

			login_section.toggleClass( 'hide_checkout_sections' );
			jQuery( '#customer_details' ).show();
		});
	
	// End if Mbbile View.
	}

// End if JS
});