<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=subscribe.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="form-title">
<span>File Type : .xls</span><br />
<span>Date Record  : <?= date('d-m-Y h:i:s') ?></span><br />
</div><br /> 
<table cellpadding="1" cellspacing="1" border="1" >
    <thead>
      <tr>
        <th style="width:10%">Email<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
        <th style="width:10%">Register Date<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if( count($datadb) > 0 ){
        foreach($datadb as $row){

            $initTable = $row['u_subscribe_id'];
       
            echo '
            <tr>
                <td>'.$row['u_subscribe_email'].'</td>
                <td>'.$row['register_date'].'</td>
             </tr>';
        }
    }
    ?>
    </tbody>
  </table>