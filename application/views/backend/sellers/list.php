<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">

		<tr>
			<th><?php echo get_msg('ID')?></th>
			<th><?php echo get_msg('NAME')?></th>
			<th><?php echo get_msg('EMAIL')?></th>
			<th><?php echo get_msg('PHONE')?></th>
			
			<th><?php echo get_msg('ADDRESS')?></th>

			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><?php echo get_msg('btn_edit')?></th>

			<?php endif;?>

		

			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>

		</tr>

		<?php $count = $this->uri->segment(4) or $count = 0; ?>

		<?php if ( !empty( $sellers ) && count( $sellers->result()) > 0 ): ?>
				
			<?php foreach($sellers->result() as $seller): ?>
				
				<tr>
					<td><?php echo $seller->seller_id;?></td>
					<td><?php echo $seller->seller_name;?></td>
					<td><?php echo $seller->seller_email;?></td>
					<td><?php echo $seller->seller_phone;?></td>
					<td><?php echo $seller->seller_address;?></td>
				
				

					<?php if ( $this->ps_auth->has_access( EDIT )): ?>
					
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $seller->seller_id; ?>'>
							<i class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				
					<?php endif; ?>



					<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='<?php echo $module_site_url .'/delete/'. $seller->seller_id; ?>' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $seller->seller_id;?>">
							<i style='font-size: 18px;' class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>

				</tr>
			
			<?php endforeach; ?>

		<?php else: ?>
				
			<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

		<?php endif; ?>

	</table>
</div>