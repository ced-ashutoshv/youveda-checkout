<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Youveda_Checkout
 * @subpackage Youveda_Checkout/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Youveda_Checkout
 * @subpackage Youveda_Checkout/public
 * @author     MakeWebBetter <webmaster@makewebbetter.com>
 */
class Youveda_Checkout_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Youveda_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youveda_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/youveda-checkout-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Youveda_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Youveda_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/youveda-checkout-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name,
			'mwb_youveda',
			array(
				'ajaxurl'       => admin_url( 'admin-ajax.php' ),
				'mobile_view'   => wp_is_mobile(),
				'auth_nonce'    => wp_create_nonce( 'mwb_youveda_nonce' ),
			)
		);
	}

	/**
	 * Override Woocommerce Template.
	 *
	 * @since    1.0.0
	 */
	public function mwb_youveda_override_woocommerce_template( $template, $template_name, $template_path ) {

	    global $woocommerce;
	    $_template = $template;

	    if ( ! $template_path ) $template_path = $woocommerce->template_url;
	   	$plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/woocommerce/';

	    // Look within passed path within the theme - this is priority.
	    $template = locate_template(
	        array(
	          $template_path . $template_name,
	          $template_name
	        )
	    );

	    // Modification: Get the template from this plugin, if it exists.
	    if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
	        $template = $plugin_path . $template_name;
	    }

	    // Use default template.
	    if ( ! $template ) {
	        $template = $_template;
	    }

	    // Return what we found.
	    return $template;
	}

	/**
	 * Override Woocommerce Template Positioning.
	 *
	 * @since    1.0.0
	 */
	public function hook_unhook_woocommerce_templates() {

		/**
		 * Removal Of Actions.
		 */
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

		/**
		 * Addition Of Actions.
		 */
		// add_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form', 20 );
		add_action( 'hook_woocommerce_checkout_payment', 'woocommerce_checkout_payment', 20 );
	}

	/**
	 * Add login section in mobile view.
	 *
	 * @since    1.0.0
	 */
	public function mwb_youveda_add_login_section( $checkout ){

		// For mobile view only.
		if( ! function_exists( 'wp_is_mobile' ) || ! wp_is_mobile() ) {
			return;
		}

		// For logged in users only.
		if ( ! is_user_logged_in() ) {
			return;
		}

		$current_user = ! empty( wp_get_current_user()->data ) ? wp_get_current_user()->data : false;
		if( ! empty( $current_user ) ) {

  			$display_name = ! empty( $current_user->display_name ) ? $current_user->display_name : false;

  			if ( empty( $display_name ) ) {
  				
  				$display_name = ! empty( $current_user->user_nicename ) ? $current_user->user_nicename : false;
  			}
		}

		?>
		<div class='mwb_youveda_compact_login'>
			<?php 	
				$login_description = sprintf( 
					'<p class="mwb_youveda_logged_in_text hide_checkout_sections">%s %s%s <br><a class="mwb_youveda_logged_in_toggle" href="javascript:void(0)">%s</a>.</p>', 
					esc_html__( 'You are logged in as', 'youveda-checkout' ), 
					$display_name,
					esc_html__( '. If you wish to change your shipping and payment information','youveda-checkout' ),
					esc_html__( 'click here', 'youveda-checkout' )
				);

				echo ( $login_description ); 
			?>
			</div>
		<?php
	}


// End of class.
}
