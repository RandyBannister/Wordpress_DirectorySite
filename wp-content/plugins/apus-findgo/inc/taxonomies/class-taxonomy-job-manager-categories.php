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
class ApusFindgo_Taxonomy_Categories{

	/**
	 *
	 */
	public static function init() {
		add_filter( 'register_taxonomy_job_listing_category_args', array( __CLASS__, 'change_taxonomy_category_label' ), 10 );
		add_action( 'cmb2_init', array( __CLASS__, 'metaboxes' ) );
	}

	public static function change_taxonomy_category_label($args) {
		$singular = esc_html__( 'Listing Category', 'apus-findgo' );
		$plural   = esc_html__( 'Listings Categories', 'apus-findgo' );

		$args['label'] = $plural;

		$args['labels'] = array(
			'name'              => $plural,
			'singular_name'     => $singular,
			'menu_name'         => esc_html__( 'Categories', 'apus-findgo' ),
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
			$args['rewrite']['slug'] = _x( 'listing-category', 'Listing category slug - resave permalinks after changing this', 'apus-findgo' );
			$args['rewrite']['with_front'] = true;
			$args['rewrite']['hierarchical'] = true;
		}

		return $args;
	}

	public static function metaboxes() {
	    $metabox_id = 'apus_findgo_categories_options';

	    $cmb = new_cmb2_box( array(
			'id'           => $metabox_id,
			'title'        => '',
			'object_types' => array( 'page' ),
		) );

	    $cmb->add_field( array(
		    'name'    => __( 'Image Icon', 'apus-findgo' ),
		    'id'      => 'icon',
		    'type'    => 'file',
		    'options' => array(
		        'url' => false,
		    ),
		    'text'    => array(
		        'add_upload_file_text' => __( 'Add Icon', 'apus-findgo' )
		    )
		) );

	    $cmb->add_field( array(
	        'name'    => __( 'Font Icon', 'apus-findgo' ),
	        'desc' => __( 'You can choose a Font Icon instead using Image Icon. You can using fontawesome icon: http://fontawesome.io/', 'apus-findgo' ),
		    'id'      => 'icon_font',
		    'type'    => 'text'
	    ) );

	    $cats = new Taxonomy_MetaData_CMB2( 'job_listing_category', $metabox_id );
	}
}

ApusFindgo_Taxonomy_Categories::init();