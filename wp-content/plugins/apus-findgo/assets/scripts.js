jQuery(document).ready(function($){
	var apusfindgo = {
		init: function() {
			var self = this;
			self.claim();
		},
		claim: function() {
			$('.claim-this-business').click(function(e){
				e.preventDefault();
				var post_id = $(this).data('id');
				if ( post_id ) {
					$htmlContent = $('<div>' + $('#claim-listing-form-hidden').html() + '</div>');
					$htmlContent.find('.post_id_input').val(post_id);
					$htmlContent.find('.msg').html('');

					$.magnificPopup.open({
		                mainClass: 'apus-mfp-zoom-small-in',
		                items : {
		                    src : $htmlContent,
		                    type: 'inline'
		                }
		            });

					$('form', $htmlContent).submit(function(e){

						e.preventDefault();
						var self = $(this);
						self.addClass('loading');
				        $.ajax({
				            url: apusfindgo_vars.ajaxurl,
				            type:'POST',
				            dataType: 'json',
				            data: self.serialize() + '&action=apusfindgo_claim_listing'
				        }).done(function(reponse) {
				            if (reponse.msg) {
				                self.find('.msg').html(reponse.msg);
				            }
				            self.removeClass('loading');
				        });
			        });

				} else {
					return false;
				}

			});

		}
	}
	apusfindgo.init();
	
});


