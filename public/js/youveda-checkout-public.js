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

		if ( 0 < jQuery( '.woocommerce-checkout-review-order-table' ).length ) {
			jQuery( '.woocommerce-checkout-review-order-table' ).hide();
			// jQuery( '.woocommerce-checkout-review-order-table' ).addClass( 'hidden_section' );
		}
		
		// Show sections on click.
		jQuery(document).on( 'click', '.mwb_youveda_logged_in_toggle', function(e) {

			login_section.toggleClass( 'hide_checkout_sections' );
			jQuery( '#customer_details' ).toggle( 'slow' );
		});

		jQuery(document).on( 'click', '.order_review_heading_toggle', function(e) {

			jQuery( '.woocommerce-checkout-review-order-table' ).toggleClass( 'hidden_section' );
			jQuery( '.woocommerce-checkout-review-order-table' ).toggle( 'slow' );
		});
	
	// End if Mbbile View.
	}

	// Hide Text from labels in payment methods.
	var t = jQuery(".wc_payment_method > label").html().split('<span class="d-none">');
	jQuery(".wc_payment_method > label").html( '<span class="d-none">' + t[1]);

// End if JS
});