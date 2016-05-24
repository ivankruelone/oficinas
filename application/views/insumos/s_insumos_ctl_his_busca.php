                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('insumos/s_insumos_ctl_his_busca_det');
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            );
   
 ?>  
 <table> 
<tr>
    <td align="left" ><font size="+1"><strong>Fecha inicial: </strong></font></td>
    <td><?php echo form_input($data_fec1, "", 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha Final: </strong></font></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
</tr>
</table>
<?php  
    echo form_submit('mysubmit', 'Ver Articulos!');
    
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->





                 </div>