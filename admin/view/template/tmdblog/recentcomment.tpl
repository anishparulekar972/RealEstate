<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-comment"></i><?php echo $heading_title; ?></h3>
  </div>
       <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td><?php echo $column_sr_no; ?></td>
          <td><?php echo $column_post; ?></td>
          <td><?php echo $column_author; ?></td>
          <td><?php echo $column_status; ?></td>
          <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>AAA</td>
          <td>DIS</td>
          <td>ENABLED</td>
          <td class="text-right"><a href="" data-toggle="tooltip" title="<?php echo $button_edit; ?>" ><i class="fa fa-pencil"></i></a></td>
        </tr>
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>