 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Historial de pedidos </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'agrega');
    echo form_open('catalogos/s_cat_insumos_his_bus', $atributos);
    $data_bus = array(
              'name'        => 'bus1',
              'id'          => 'bus1',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
              
            );
  
  ?>
 
  <table>
<tr>
	<td align="left" ><font size="+1">Busqueda: </font></td>
    <td><?php echo form_input($data_bus, "", 'required');?></td>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
 
<!---->
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Numero de Folio</th>
                                 <th style="text-align: left">Numero de Sucursal</th>
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Fecha de pedido</th>
                                 <th style="text-align: left">Cantidad Pedida</th>
                                 <th style="text-align: left">Cantidad Surtida</th>
                                 <th style="text-align: left">Porcentaje</th>
                                 <th style="text-align: left">Acciones</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                foreach ($q->result()as $r) {
                                    
              $l1 = anchor('catalogos/s_cat_insumos_his_detalle/'.$r->id.'/'.$r->suc,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
                                
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->id?></td>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>
                                   <td style="text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="text-align: left;"><?php echo $r->fecha_cap?></td>
                                   <td style="text-align: left;"><?php echo $r->can_ped?></td> 
                                   <td style="text-align: left;"><?php echo $r->can_sur?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->nivel_surtido)?>%</td>   
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                   </tr>
                               <?php 
                               $timp_prv=0;
                               $timp_suc=0;
                               } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6" style="text-align: left;">Total de referencias: <?php echo number_format($num,0)?></td>
                              </tr>
                              </tfoot>
                         </table> 
 <!---->                         
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>