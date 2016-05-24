                 <div class="span5">
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
$atributos = array('id' => 'a_desplaza_mes_contado_fanasa_excel');
echo form_open('desplazamientos/a_desplaza_mes_contado_fanasa_excel', $atributos);
?>
                        <table  class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
   
<tr>
	<td align="left" ><strong>Producto: </strong></td>
	<td align="left"><?php echo form_dropdown('mes', $mes, 'mes');?></td>
    
 </tr>
<tr>
	<td colspan="6" align="center"><?php echo form_submit('envio', 'Ver');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?> 
                        
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>