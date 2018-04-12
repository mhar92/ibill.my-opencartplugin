<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
      <tr>
        <td class="text-left" width=1px>
          <?php echo $column_id; ?>
        </td>
        <td class="text-left">
          <?php echo $column_status; ?>
        </td>
        <td class="text-left">
          <?php echo $column_time; ?>
        </td>
        <td class="text-left">View Details</td>
      </tr>
    </thead>
    <tbody>
      <?php if ($logs) { ?>
      <?php foreach ($logs as $log) { ?>
      <tr>
        <td class="text-left">
          <?php echo $log['order_id']; ?>
        </td>
        <td class="text-left">
          <?php echo $log['status']; ?>
        </td>
        <td class="text-left">
          <?php echo $log['date_added']; ?>
        </td>
        <td class="text-left"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $log['order_id']; ?>">Details</button></td>
      </tr>

      <?php } ?>
      <?php } else { ?>
      <tr>
        <td class="text-center" colspan="4">
          <?php echo $text_no_results; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-sm-6 text-left">
    <?php echo $pagination; ?>
  </div>
  <div class="col-sm-6 text-right">
    <?php echo $results; ?>
  </div>
</div>


<?php if ($logs) { ?>
<?php foreach ($logs as $log) { ?>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $log['order_id']; ?>" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $column_logs_detail; ?></h4>
      </div>

      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover table-condensed"><thead></thead><tbody>
            <?php foreach(unserialize($log['data']) as $key => $item ) { ?>
              <tr><td><?php echo $key; ?></td><td><?php echo $item; ?></td></tr>
            <?php } ?>
        </tbody></table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>
<?php } }?>
