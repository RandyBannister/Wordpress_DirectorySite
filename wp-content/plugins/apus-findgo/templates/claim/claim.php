<?php
$listing_is_claimed = get_post_meta( get_the_ID(), '_claimed', true );
if ( !$listing_is_claimed ) {
?>
	<div id="listing-map-contact" class="listing-map widget">
		<?php esc_html_e('Claim your free business page to have your changes published immediately.', 'apus-findgo'); ?>
		<a href="#claim-listing" class="claim-this-business" data-id="<?php the_ID(); ?>"><?php esc_html_e( 'Claim this business', 'apus-findgo' ); ?></a>
	</div>
	<?php echo ApusFindgo_Template_Loader::get_template_part( 'claim/claim-form'); ?>
<?php
}