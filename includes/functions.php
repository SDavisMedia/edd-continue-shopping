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
		$store_link        = edd_get_option( 'edd_continue_shopping_page' );
		$cs_text           = edd_get_option( 'edd_continue_shopping_text' );
		$cs_link_type      = edd_get_option( 'edd_continue_shopping_link_type' );
		$color             = edd_get_option( 'checkout_color', 'blue' );
		$color             = ( $color == 'inherit' ) ? '' : $color;
		?>
		<a href="<?php echo $store_link ? get_permalink( $store_link ) : home_url( '/' . lcfirst( edd_get_label_plural() ) ); ?>" class="edd-continue-shopping-button <?php echo 'text' == $cs_link_type ? '' : 'edd-submit button ' . $color; ?>" style="<?php echo 'text' == $cs_link_type ? 'font-size: inherit; font-weight: 400; margin-right: 4px;' : 'text-decoration: none;'; ?>"><?php if ( false === $cs_text ) { _e( 'Continue Shopping', 'edd-continue-shopping' ); } elseif ( !empty( $cs_text ) ) { echo $cs_text; } ?></a>
		<?php
	}
}
add_action( 'edd_cart_footer_buttons', 'eddcs_continue_shopping_link' );