<?php
/**
 * Helper Functions
 *
 * @package     EDD\Continue Shopping\Functions
 * @since       1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


/**
 * Add Continue Shopping link to the checkout cart.
 *
 * @since       1.0.0
 */
function eddcs_continue_shopping_link() {
	if ( class_exists( 'Easy_Digital_Downloads' ) && !edd_get_option( 'edd_continue_shopping' ) ) {
		$store_link = edd_get_option( 'edd_continue_shopping_page' );
		$color = edd_get_option( 'checkout_color', 'blue' );
		$color = ( $color == 'inherit' ) ? '' : $color;
		?>
		<a href="<?php echo $store_link ? get_permalink( $store_link ) : home_url( '/' . lcfirst( edd_get_label_plural() ) ); ?>" class="edd-continue-shopping-button edd-submit button<?php echo ' ' . $color; ?>" style="text-decoration: none;"><?php _e( 'Continue Shopping', 'edd-continue-shopping' ); ?></a>
		<?php
	}
}
add_action( 'edd_cart_footer_buttons', 'eddcs_continue_shopping_link' );