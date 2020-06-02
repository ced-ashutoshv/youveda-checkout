<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Add order review for mobile view here */
if( function_exists( 'wp_is_mobile' ) && wp_is_mobile() ) : ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<a class="order_review_heading_toggle" title="Click here to show order details." status="hidden" href="javascript:void(0);">
			<h3 id="order_review_heading">
				<span class="order_review_cart_icon">
					<svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__icon">
			            <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"></path>
			         </svg>
				</span>
				<span class="order_review_text">
					<?php esc_html_e( 'Show Order Summary', 'woocommerce' ); ?>
				</span>
				<span class="order_review_cart_total">
					<?php echo function_exists( 'WC' ) && ! empty( WC()->cart ) ? WC()->cart->get_cart_total() :false; ?>
				</span>
			</h3>
		</a>
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		<?php do_action( 'woocommerce_checkout_order_review_extended' ); ?>
		</div>
	<?php do_action( 'woocommerce_checkout_after_order_review' );

endif;

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>

			<div class="payment-fields-wrap">
				<?php do_action( 'hook_woocommerce_checkout_payment' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<?php if ( ! function_exists( 'wp_is_mobile' ) || ! wp_is_mobile() ) : ?>
		<div id="order_review" class="woocommerce-checkout-review-order">
			<h3 id="order_review_heading">
				<span class="order_review_cart_icon">
					<svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__icon">
			            <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z"></path>
			         </svg>
				</span>
				<span class="order_review_text">
					<?php esc_html_e( 'Order Summary', 'woocommerce' ); ?>
				</span>
				<span class="order_review_cart_total">
					<?php echo function_exists( 'WC' ) && ! empty( WC()->cart ) ? WC()->cart->get_cart_total() :false; ?>
				</span>
			</h3>
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	<?php endif; ?>

	<div class="form-row place-order mwb_youveda_place_order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php $order_button_text = 'Place order'; ?>
		<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt mwb_youveda_place_order_button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
