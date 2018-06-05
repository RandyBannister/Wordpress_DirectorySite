<?php
	$claim_title = apusfindgo_get_config('claim_title', '');
	$claim_banner = apusfindgo_get_config('claim_banner');
	$img = '';
	if ( !empty($claim_banner['id']) ) {
		$image = wp_get_attachment_image_src($claim_banner['id'], 'full');
		if ( !empty($image[0]) ) {
			$img = $image[0];
		}
	}
?>
<div id="claim-listing-form-hidden" class="hidden">
	<div class="claim-listing-form-wrapper">
		<div class="row">
			<?php if ( $img ) { ?>
				<div class="col-md-6 col-sm-12">
					<img src="<?php echo esc_url($img); ?>" alt="">
				</div>
			<?php } ?>
			<div class="<?php echo esc_attr( $img ? 'col-md-6' : ''); ?> col-sm-12">
				<form action="" class="claim-listing-form" method="post">
					<input type="hidden" name="post_id" class="post_id_input">
					<?php if ( $claim_title ) { ?>
						<h4 class="title"><?php echo esc_html__($claim_title); ?></h4>
					<?php } ?>
					<div class="msg"></div>
					<div class="form-group">
			            <input type="text" class="form-control" name="fullname" placeholder="<?php echo esc_html__( 'Fullname', 'apus-findgo' ); ?>" required="required">
			        </div><!-- /.form-group -->
			        <div class="form-group">
			            <input type="text" class="form-control" name="phone" placeholder="<?php echo esc_html__( 'Phone', 'apus-findgo' ); ?>" required="required">
			        </div><!-- /.form-group -->
			        <div class="form-group">
			            <textarea class="form-control" name="message" placeholder="<?php echo esc_html__( 'Additional proof to expedite your claim approval...', 'apus-findgo' ); ?>" cols="30" rows="5" required="required"></textarea>
			        </div><!-- /.form-group -->

			        <button class="button btn btn-block btn-purple" name="submit-claim-listing" value=""><?php echo esc_html__( 'Claim This Business', 'apus-findgo' ); ?></button>
				</form>
			</div>
		</div>
	</div>
</div>