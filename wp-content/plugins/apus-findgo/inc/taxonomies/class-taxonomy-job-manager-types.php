<?php
/**
 * Categories
 *
 * @package    apus-findgo
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ApusFindgo_Taxonomy_Types{

	/**
	 *
	 */
	public static function init() {
		add_filter( 'register_taxonomy_job_listing_type_args', array( __CLASS__, 'change_taxonomy_type_label' ), 10 );
	}

	public static function change_taxonomy_type_label($args) {
		$singular = esc_html__( 'Listing Type', 'apus-findgo' );
		$plural   = esc_html__( 'Listings Types', 'apus-findgo' );

		$args['label']  = $plural;
		$args['labels'] = array(
			'name'              => $plural,
			'singular_name'     => $singular,
			'menu_name'         => esc_html__( 'Types', 'apus-findgo' ),
			'search_items'      => sprintf( esc_html__( 'Search %s', 'apus-findgo' ), $plural ),
			'all_items'         => sprintf( esc_html__( 'All %s', 'apus-findgo' ), $plural ),
			'parent_item'       => sprintf( esc_html__( 'Parent %s', 'apus-findgo' ), $singular ),
			'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'apus-findgo' ), $singular ),
			'edit_item'         => sprintf( esc_html__( 'Edit %s', 'apus-findgo' ), $singular ),
			'update_item'       => sprintf( esc_html__( 'Update %s', 'apus-findgo' ), $singular ),
			'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'apus-findgo' ), $singular ),
			'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'apus-findgo' ), $singular )
		);

		if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
			$args['rewrite']['slug'] = _x( 'listing-type', 'Listing type slug - resave permalinks after changing this', 'apus-findgo' );
		}

		return $args;
	}

}

ApusFindgo_Taxonomy_Types::init();