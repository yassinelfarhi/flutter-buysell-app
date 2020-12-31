<?php
	$attributes = array('id' => 'seller-form');
	echo form_open( '', $attributes );
?>
<section class="content animated fadeInRight">

	<div class="card card-info">
	    <div class="card-header">
	      <h3 class="card-title"><?php echo 'Seller Information' ?></h3>
	    </div>

	   
  		<div class="card-body">
    		<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label><?php echo 'Name'; ?></label>
						<?php echo form_input( array(
							'name' => 'seller_name',
							'value' => set_value( 'seller_name', show_data( @$sellers->seller_name ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_name' ),
							'id' => 'seller_name'
						)); ?>
					</div>

					<?php if($seller->email_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('seller_email'); ?></label>
						<?php echo form_input( array(
							'name' => 'seller_email',
							'value' => set_value( 'seller_email', show_data( @$sellers->seller_email ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_email' ),
							'id' => 'seller_email'
						)); ?>
					</div>
					<?php endif; ?>

					<?php if($seller->phone_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('seller_phone'); ?></label>
						<?php echo form_input( array(
							'name' => 'seller_phone',
							'value' => set_value( 'seller_phone', show_data( @$sellers->seller_phone ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_phone' ),
							'id' => 'seller_phone'
						)); ?>
					</div>
					<?php endif; ?>
					
				</div>

				<div class="col-md-6">
					<div class="form-group">	
						<label><?php echo 'Seller address'; ?></label>
						<?php echo form_input( array(
							'name' => 'seller_address',
							'value' => set_value( 'seller_address', show_data( @$sellers->seller_address ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_address' ),
							'id' => 'seller_address'
						)); ?>
					</div>
					<div class="form-group">	
						<label><?php echo 'Seller email'; ?></label>
						<?php echo form_input( array(
							'name' => 'seller_email',
							'value' => set_value( 'seller_email', show_data( @$sellers->seller_email ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_email' ),
							'id' => 'seller_email'
						)); ?>
					</div>
					<div class="form-group">	
						<label><?php echo 'Phone'; ?></label>
						<?php echo form_input( array(
							'name' => 'seller_phone',
							'value' => set_value( 'seller_phone', show_data( @$sellers->seller_phone ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'seller_phone' ),
							'id' => 'seller_phone'
						)); ?>
					</div>
				</div>
			</div>
		</div>
		 <!-- /.card-body -->

		<div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_save')?>
			</button>

			<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_cancel')?>
			</a>
        </div>
	</div>
</section>

<?php echo form_close(); ?>