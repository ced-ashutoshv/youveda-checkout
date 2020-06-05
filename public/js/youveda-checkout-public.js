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
			  jQuery( '.order_review_arrow_img' ).toggleClass( 'order_review_arrow_up' );
			} 
			// Is Hidden.
			else {
			  jQuery( '.order_review_arrow_img' ).toggleClass( 'order_review_arrow_up' );
			}
		});
	
	// End if M0bile View.
	}

	// Hide Text from labels in payment methods.
	// var t = jQuery(".wc_payment_method > label").html().split('<span class="d-none">');
	// jQuery(".wc_payment_method > label").html( '<span class="d-none">' + t[1]);

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

	if( false == mwb_youveda.mobile_view &&  jQuery( '.wc_payment_methods' ).length > 0 ) {
		
		setTimeout( function() {
			jQuery( '.wc_payment_methods' ).append( '<li class="wc_payment_method payment_method_amazon_payments_advanced "><div class="d-none"><input id="payment_method_amazon_payments_advanced" type="radio" class="input-radio" name="payment_method" value="amazon_payments_advanced" data-order_button_text="">Amazon Pay</div><label for="payment_method_amazon_payments_advanced"><span class="d-none"><img src="https://www.youveda.com/wp-content/plugins/woocommerce-gateway-amazon-payments-advanced/assets/images/amazon-payments.png" alt="Amazon Pay"></span><img src="https://www.youveda.com/wp-content/themes/x-child/images/gateways/amazon-pay.png"></label></li>' );
		} , 2000);
	}

	else if( true == mwb_youveda.mobile_view &&  jQuery( '.wc_payment_methods' ).length > 0 && jQuery( '#pay_with_amazon' ).length > 0  ){
		setTimeout( function() {
			jQuery( '.wc_payment_methods' ).append( '<li class="wc_payment_method payment_method_amazon_payments_advanced "><div class="d-none"><input id="payment_method_amazon_payments_advanced" type="radio" class="input-radio" name="payment_method" value="amazon_payments_advanced" data-order_button_text="">Amazon Pay</div><label for="payment_method_amazon_payments_advanced"><span class="d-none"><img src="https://www.youveda.com/wp-content/plugins/woocommerce-gateway-amazon-payments-advanced/assets/images/amazon-payments.png" alt="Amazon Pay"></span><img src="https://www.youveda.com/wp-content/themes/x-child/images/gateways/amazon-pay.png"></label></li>' );
		} , 2000);
	}
	else {
		setTimeout( function() {
			jQuery( '.payment_method_amazon_payments_advanced' ).hide();
		} , 2000);
	}

	if( false == mwb_youveda.mobile_view && jQuery( '#amazon-logout' ).length > 0 ) {
		
		setTimeout( function() {
			jQuery( '.woocommerce-terms-and-conditions-wrapper' ).css( 'width', '535px' );
		} , 2000);
	}

// End if JS
});
