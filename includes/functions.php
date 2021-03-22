<?php
/**
 * Helper Functions
 *
 * @package     EDD\Continue Shopping\Functions
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


/**
 * Add Continue Shopping link to the checkout cart.
 *
 * @since       1.0.0
 */
function eddcs_continue_shopping_link() {
	if ( edd_get_option( 'edd_continue_shopping' ) ) {
		return;
	}

	$store_page        = edd_get_option( 'edd_continue_shopping_page' );
	$cs_text           = edd_get_option( 'edd_continue_shopping_text', __( 'Continue Shopping', 'edd-continue-shopping' ) );
	$cs_link_type      = edd_get_option( 'edd_continue_shopping_link_type' );
	$color             = edd_get_option( 'checkout_color', 'blue' );
	$color             = ( $color == 'inherit' ) ? '' : $color;

	$store_link = false;
	if ( ! empty( $store_page ) ) {
		$store_link = get_permalink( $store_page );
	}
	if ( empty( $store_link ) ) {
		$store_link = get_post_type_archive_link( 'download' );
	}

	/*
	 * This could still be empty if no page is selected and archives have been disabled
	 * for the `download` post type.
	 */
	if ( empty( $store_link ) ) {
		return;
	}
	?>
	<a href="<?php echo esc_url( $store_link ); ?>" class="edd-continue-shopping-button <?php echo 'text' == $cs_link_type ? '' : 'edd-submit button ' . $color; ?>" style="<?php echo 'text' == $cs_link_type ? 'font-size: inherit; font-weight: 400; margin-right: 4px;' : 'text-decoration: none;'; ?>">
		<?php echo esc_html( $cs_text ); ?>
	</a>
	<?php
}
add_action( 'edd_cart_footer_buttons', 'eddcs_continue_shopping_link' );
