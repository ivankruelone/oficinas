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
	echo form_open('insumos/s_insumos_imp_pre');
    $data_fol1 = array(
              'name'        => 'fol1',
              'id'          => 'fol1',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '5'
            );
    $data_fol2 = array(
              'name'        => 'fol2',
              'id'          => 'fol2',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '5'
            );
    $data_letra = array(
              'name'        => 'letra',
              'id'          => 'letra',
              'value'       => '',
              'maxlength'   => '1',
              'size'        => '1'
            );
    
    
   
 ?>  
 <table> 
<tr>
    <td align="left" ><font size="+1"><strong>Folio inicial: </strong></font></td>
    <td><?php echo form_input($data_fol1, "", 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Folio Final: </strong></font></td>
    <td><?php echo form_input($data_fol2, "", 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Folio letra: </strong></font></td>
    <td><?php echo form_input($data_letra, "", 'required');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_comprar?>" name="id_comprar" id="id_comprar" />
<?php  
    echo form_submit('mysubmit', 'Imprime previo!');
    
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->





                 </div>