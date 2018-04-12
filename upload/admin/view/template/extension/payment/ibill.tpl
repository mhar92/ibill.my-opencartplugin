<?php echo $header; ?><?php echo $column_left; ?>  
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ibill" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    
    <?php if ($error_lang) { ?>
    <div id="myAlert" class="alert alert-danger alert-dismissible show" role="alert"><i class="fa fa-exclamation-circle"></i>
      <button  type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?php echo $error_lang; ?>
    </div>
    <?php } ?>
    
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      
      
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ibill" class="form-horizontal">
            
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-setting" data-toggle="tab" aria-expanded="true">Setting</a></li>
            <li class=""><a href="#tab-logs" data-toggle="tab" aria-expanded="false">Payment Details</a></li>
            <li><a href="#tab-about" data-toggle="tab">About Plugin</a></li>
          </ul>



         <div class="tab-content"> 
         <div class="tab-pane active in" id="tab-setting">
         <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-mid"><span data-toggle="tooltip" title="<?php echo $help_mid; ?>"><?php echo $entry_mid; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="ibill_mid" value="<?php echo $ibill_mid; ?>" placeholder="<?php echo $entry_mid; ?>" id="input-mid" class="form-control"/>
			  <?php if ($error_mid) { ?>
			  <div class="text-danger"><?php echo $error_mid; ?></div>
			  <?php } ?>
			</div>
		  </div>
		  <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-apikey"><span data-toggle="tooltip" title="<?php echo $help_apikey; ?>"><?php echo $entry_apikey; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="ibill_apikey" value="<?php echo $ibill_apikey; ?>" placeholder="<?php echo $entry_apikey; ?>" id="input-apikey" class="form-control"/>
			  <?php if ($error_apikey) { ?>
			  <div class="text-danger"><?php echo $error_apikey; ?></div>
			  <?php } ?>
			</div>
		  </div>
		  
	      <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-mid"><span data-toggle="tooltip" title="<?php echo $help_rurl; ?>"><?php echo $entry_url; ?></span></label>
			<div class="col-sm-10">
			  <input type="text" name="ibill_returnurl" value="<?php echo $ibill_returnurl; ?>" placeholder="<?php echo $entry_url; ?>" id="input-returnurl" class="form-control" readonly/>
			</div>
		  </div>	  
		  
 
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_debug; ?>"><?php echo $entry_debug; ?></span></label>
			<div class="col-sm-10">
			  <select name="ibill_debug" id="input-debug" class="form-control">
				<?php if ($ibill_debug) { ?>
				<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
				<option value="0"><?php echo $text_disabled; ?></option>
				<?php } else { ?>
				<option value="1"><?php echo $text_enabled; ?></option>
				<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				<?php } ?>
			  </select>
			</div>
		  </div>

		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
			<div class="col-sm-10">
			  <select name="ibill_order_status_id" id="input-order-status" class="form-control">
				<?php foreach ($order_statuses as $order_status) { ?>
				<?php if ($order_status['order_status_id'] == $ibill_order_status_id) { ?>
				<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
				<?php } ?>
				<?php } ?>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
			<div class="col-sm-10">
			  <select name="ibill_geo_zone_id" id="input-geo-zone" class="form-control">
				<option value="0"><?php echo $text_all_zones; ?></option>
				<?php foreach ($geo_zones as $geo_zone) { ?>
				<?php if ($geo_zone['geo_zone_id'] == $ibill_geo_zone_id) { ?>
				<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
				<?php } ?>
				<?php } ?>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
			<div class="col-sm-10">
			  <select name="ibill_status" id="input-status" class="form-control">
				<?php if ($ibill_status) { ?>
				<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
				<option value="0"><?php echo $text_disabled; ?></option>
				<?php } else { ?>
				<option value="1"><?php echo $text_enabled; ?></option>
				<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				<?php } ?>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
			<div class="col-sm-10">
			  <input type="text" name="ibill_sort_order" value="<?php echo $ibill_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
			</div>
		  </div>
		  
		  </div>
		  
		  
		  
		  <div class="tab-pane" id="tab-logs">

            <div id="logs"></div>

          </div>
          
          
          <div class="tab-pane" id="tab-about">

            <div>

              <pre><code>

 * Plugin Name: Opencart plugin for iBill.my Malaysia Payment Solutions
 * Plugin URI: https://ibill.my/merchant/
 * Copyright 2018 iBill.my
 * Description: Enable online payments using online banking thorugh iBill.my Malaysia Online Payment & Billing Solutions Provider.
 * License: Free. Not allowed to reselling this plugin.
 * Support : info@ibill.my

</pre></code>
            </div>

          </div>
		  
		  
		  </div>
		  
		  
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});


  $('#logs').delegate('.pagination a', 'click', function(e) {
  	e.preventDefault();

  	$('#logs').hide().load(this.href).fadeIn('500');
  });

$('#logs').hide().load('index.php?route=extension/payment/ibill/logs&token=<?php echo $token; ?>').fadeIn('500');

$('#myAlert').on('closed.bs.alert', function () {
  $.ajax({
				url: 'index.php?route=extension/payment/ibill/installMYRcurrency&token=<?php echo $token; ?>',
                type: 'post',
			    data: 'title=malaysian-ringgit&code=MYR&symbol_left=RM&symbol_right=&decimal_place=2&value=1&status=1',
				success: function(data) {
        		$('.panel-default').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data + ' <button type="button" class="close">&times;</button></div>');
				}
			});

});



//--></script>
<?php echo $footer; ?>