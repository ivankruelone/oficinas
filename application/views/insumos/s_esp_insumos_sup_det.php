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
	$atributos = array('id' => 's_inserta_esp_insumo_sup_det');
    echo form_open('insumos/s_inserta_esp_insumo_sup_det', $atributos);
  $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7',
              'type'        =>'numeric'
              
            );  
  
  ?>
   <table>
<tr>
 <tr>   
    <td align="left" ><font size="+1"><strong>Provedor: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id_insumos', $id_insumos, '', 'id="id_insumos"') ;?> </td>
    <td align="left" ><font size="+1">Cantidad: </font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>
 </tr>
 


	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $suc?>" name="suc" id="suc" />
  <?php
 
	echo form_close();
  ?>
 
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Fecha</th>
                                     <th>Folio</th>
                                     <th>Id.Insumos</th>
                                     <th>Insumos</th>
                                     <th>Cantidad</th>
                                     <td></td>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0; $l2='';
                                foreach ($q->result() as $r) {
                                $l1= anchor('insumos/esp_borra_det/'.$r->id.'/'.$id_cc.'/'.$suc,'BORRAR');
                                $l2= anchor('insumos/cerrar_esp_insumos/'.$r->id_cc,'Cerrar');
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_cap?></td>
                                        <td style="text-align: left; "><?php echo $r->id_cc?></td>
                                        <td style="text-align: left; "><?php echo $r->id_insumos?></td>
                                        <td style="text-align: left; "><?php echo $r->descripcion?></td>
                                        <td style="text-align: right; "><?php echo $r->canp_sup?></td>
                                        <td style="text-align: right; "><?php echo $l1?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="7" style="text-align: center; size:+10;"><?php echo $l2 ?></td>
                                
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>