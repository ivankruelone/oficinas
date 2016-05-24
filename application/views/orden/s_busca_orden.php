                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('orden/s_busca_orden_resultado');
    $data_orden = array(
              'name'        => 'orden',
              'id'          => 'orden',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    
    
   
 ?>  
 <table> 

<tr>
    <td align="left" ><font size="+1"><strong>Folio de orden: </strong></font></td>
    <td><?php echo form_input($data_orden, "", 'required');?></td>
    
</tr>

</table>

<?php  
    echo form_submit('mysubmit', 'Buscar!');
    
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->





                 </div>