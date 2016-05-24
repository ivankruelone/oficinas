                 <div class="span10">
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
	$atributos = array('id' => 's_inserta_esp_insumo_sup');
    echo form_open('insumos/s_inserta_esp_insumo_sup', $atributos);
    
  
  ?>
   <table>
<tr>
<tr>
	
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
 </tr>
 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1= anchor('insumos/s_esp_insumos_sup_det/'.$r->id.'/'.$r->suc,$r->id);
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right;"><?php echo $l1?></td>
                                        <td style="text-align: right;"><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->sucx?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>