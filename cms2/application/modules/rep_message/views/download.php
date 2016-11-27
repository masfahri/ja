<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=message.xls");
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
        <th style="width:20%">Name<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
        <th style="width:30%">Email<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
        <th style="width:30%">Subject<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
        <th style="width:30%">Message<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>        
        <th style="width:15%">Send Date<a href="javascript:;"><span class="glyphicon glyphicon-sort"></span></a></th>
       
      </tr>
    </thead>
    <tbody>
    <?php 
    if( count($datadb) > 0 ){
        foreach($datadb as $row){    
            
            echo '
            <tr>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['subject'].'</td>
                <td>'.$row['message'].'</td>
                <td>'.date('d/m/y h:i:s', strtotime($row['send_date'])).'</td>
             </tr>';
        }
    }
    ?>
    </tbody>
  </table>