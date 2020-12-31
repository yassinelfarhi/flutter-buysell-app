<?php
	$attributes = array( 'id' => 'item-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">
<div class="col-md-6">
    <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><?php echo get_msg('offline_paid_prd_info')?></h3>
    </div>

    <div class="card-body">
      <div class="form-group">
            <label>
              <?php echo get_msg('itm_title_label')?>:
              <input type="hidden" id="product_id" name="product_id" value="<?php echo $this->Item->get_one($item_id)->id; ?>">
              <?php 
                $name = $this->Item->get_one($item_id)->title;
                echo $name;
              ?>
            </label>
          </div>
      <div class="form-group">
        <label>
          <?php echo get_msg('date')?>
        </label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
          </div>
           <?php echo form_input(array(
            'name' => 'date',
            'value' => set_value( 'date' , $start_date ),
            'class' => 'form-control',
            'placeholder' => '',
            'id' => 'reservation',
            'size' => '20',
            'readonly' => 'readonly'
          )); ?>

        </div>
      </div>

      <div class="form-group" style="padding-top: 30px;">
        <div class="form-check">

          <label>
          
            <?php echo form_checkbox( array(
              'name' => 'status',
              'id' => 'status',
              'value' => 'accept',
              'checked' => set_checkbox('status', 1, ( @$item->status == 1 )? true: false ),
              'class' => 'form-check-input'
            )); ?>

            <?php echo get_msg( 'status' ); ?>
          </label>
        </div>
      </div>
    </div>
   
    <div class="card-footer">
      <button type="submit" class="btn btn-sm btn-primary">
        <?php echo get_msg('btn_save')?>
      </button>

      <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
        <?php echo get_msg('btn_cancel')?>
      </a>
    </div>
  
  </div>
</div>  			
</section>