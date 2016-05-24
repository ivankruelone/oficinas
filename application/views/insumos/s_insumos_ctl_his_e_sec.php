                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('insumos/s_insumos_ctl_his_e_sec_p');
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10'
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10'
            );
    
   
 ?>  
 <table> 

<tr>
    <td align="left" ><font size="+1"><strong>Surtido: </strong></font></td>
    <td><?php echo form_input($data_fec1, "", 'required');?></td>
    
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Surtido: </strong></font></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
    
</tr>
<input type="hidden" value="<?php echo $id_comprar?>" name="id_comprar" id="id_comprar"/>
</table>
<?php  
    echo form_submit('mysubmit', 'Aceptar!');
    
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->





                 </div>