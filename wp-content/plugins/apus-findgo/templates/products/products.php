<?php
$pids = get_post_meta( get_the_ID(), '_products', true );

if ( ! $pids || ! is_array( $pids ) ) {
	return;
}

$args = array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => -1,
	'post__in' => $pids,
);

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) {
	$layout_type = apusfindgo_get_config('listing_products_layout', 'grid');
	$columns = apusfindgo_get_config('listing_products_columns', 1);
?>

	<div class="listing-products widget woocommerce">

		<h2><?php echo apusfindgo_get_config('listing_products_title', 'Listing Products'); ?></h2>

		<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns) ); ?>
	</div>
<?php
}