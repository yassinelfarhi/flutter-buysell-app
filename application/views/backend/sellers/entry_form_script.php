<script>

	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>
	
	function jqvalidate() {
		$('#seller-form').validate({
			rules:{
				seller_name:{
					required: true,
					minlength: 4
				},
				<?php if($seller->email_verify == 1): ?>
				seller_email:{
					required: true,
					email: true,
					remote: '<?php echo $module_site_url ."/ajx_exists/". @$seller->seller_id ; ?>'
				},
				<?php endif; ?>
				<?php if($seller->phone_verify == 1): ?>
				seller_phone:{
					required: true,
					remote: '<?php echo $module_site_url ."/ajx_exists_phone/". @$seller->seller_id ; ?>'
				},
				<?php endif; ?>
				<?php if ( !isset( $seller )): ?>
				seller_password:{
					required: true,
					minlength: 4
				},
				conf_password:{
					required: true,
					equalTo: '#seller_password'
				},
				<?php endif; ?>
				"permissions[]": { 
					required: true, 
					minlength: 1 
				}
			},
			messages:{
				seller_name:{
					required: "<?php echo get_msg( 'err_seller_name_blank' ); ?>",
					minlength: "<?php echo get_msg( 'err_seller_name_len' ); ?>"
				},
				seller_email:{
					required: "<?php echo get_msg( 'err_seller_email_blank' ); ?>",
					email: "<?php echo get_msg( 'err_seller_email_invalid' ); ?>",
					remote: "<?php echo get_msg( 'err_seller_email_exist' ); ?>"
				},
				seller_phone:{
					required: "<?php echo get_msg( 'err_seller_phone_blank' ); ?>",
					remote: "<?php echo get_msg( 'err_seller_phone_exist' ); ?>"
				},
				<?php if ( !isset( $seller )): ?>
				seller_password:{
					required: "<?php echo get_msg( 'err_seller_pass_blank' ); ?>",
					minlength: "<?php echo get_msg( 'err_seller_pass_len' ); ?>"
				},
				conf_password:{
					required: "<?php echo get_msg( 'err_seller_pass_conf_blank' ); ?>",
					equalTo: "<?php echo get_msg( 'err_seller_pass_conf_not_match' ); ?>"
				},
				<?php endif; ?>
				"permissions[]": "<?php echo get_msg( 'err_permission_blank' ); ?>"
			},
			errorPlacement: function(error, element) {
				console.log( $(error).text());
				if (element.attr("name") == "permissions[]" ) {
					console.log( $(error).text());
					$("#perm_err label").html($(error).text());
					$("#perm_err").show();
				} else {
					error.insertAfter(element);
				}
			}
		});
	}

	<?php endif; ?>

</script>