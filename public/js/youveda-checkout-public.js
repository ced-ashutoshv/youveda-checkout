jQuery(document).ready(function($){
	
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
		}
		
		/** 
		 * Show sections on click.
		 * Login Section.
		 */
		jQuery(document).on( 'click', '.mwb_youveda_logged_in_toggle', function(e) {

			login_section.toggleClass( 'hide_checkout_sections' );
			jQuery( '#customer_details' ).slideToggle( 'slow' );
		});

		/** 
		 * Show sections on click.
		 * Order Summary Section.
		 */
		jQuery(document).on( 'click', '.order_review_heading_toggle', function(e) {

			jQuery( '.woocommerce-checkout-review-order-table' ).toggleClass( 'hidden_section' );
			jQuery( '.woocommerce-checkout-review-order-table' ).slideToggle( 'slow' );

			// Is visible.
			if ( jQuery( ".woocommerce-checkout-review-order-table" ).hasClass( 'hidden_section' ) ) { 
			  jQuery( '.order_review_text' ).text( 'Hide Order Summary' );
			} 
			// Is Hidden.
			else {
			  jQuery( '.order_review_text' ).text( 'Show Order Summary' );
			}
		});
	
	// End if M0bile View.
	}

	// Hide Text from labels in payment methods.
	var t = jQuery(".wc_payment_method > label").html().split('<span class="d-none">');
	jQuery(".wc_payment_method > label").html( '<span class="d-none">' + t[1]);

	// Order button text on payment method change
	jQuery(document).on('change', '.payment_method_paypal', function() {
	   jQuery( '.mwb_youveda_place_order_button' ).text( 'Proceed To Paypal' );
	});

	jQuery(document).on('change', '.payment_method_authorize_net_cim_credit_card', function() {
	   jQuery( '.mwb_youveda_place_order_button' ).text( 'Place Order' );
	});

	if( jQuery( '#payment_method_paypal' ).attr( 'checked' ) ) {
		
		setTimeout( function() {
			jQuery( '.mwb_youveda_place_order_button' ).text( 'Proceed To Paypal' );
		} , 2000);
	}
	else {

		setTimeout( function() {
			jQuery( '.mwb_youveda_place_order_button' ).text( 'Place Order' );
		} , 2000);
	}

// End if JS
});
