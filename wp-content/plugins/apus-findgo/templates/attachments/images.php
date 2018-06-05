<?php

$attachments = get_comment_meta(get_comment_ID(), 'attachments', TRUE);
if ( !empty($attachments) && is_array($attachments) ) {
	?>
    <div id="comment-attactments-<?php echo esc_attr(get_comment_ID()); ?>" class="comment-attactments">
	<?php
	$count = 1;
	$total = count($attachments);
	foreach ($attachments as $attachmentId) {
		$attachmentLink = wp_get_attachment_url($attachmentId);
		$img = wp_get_attachment_image_src($attachmentId, 'thumbnail');
		if ( isset($img[0]) && $img[0] ) {
			$placeholder_image = findgo_create_placeholder(array($img[1],$img[2]));
			$img_src = $img[0];
			?>
			<div class="attachment <?php echo esc_attr($count > 10 ? 'hidden' : ''); ?>"><div class="image-wrapper"><a class="photo-item" href="<?php echo esc_url($attachmentLink); ?>"><img src="<?php echo esc_attr($placeholder_image); ?>" data-src="<?php echo esc_url_raw($img_src); ?>" alt="" class="unveil-image"></a></div><?php if ( $count == 10 && $total > 10 ) { ?><span class="show-more-images">+<?php echo ($total - 10); ?></span><?php } ?>
			</div>
			<?php
		}
		$count++;
	}
	?>
    </div>
    <?php
}