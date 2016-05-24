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
	$atributos = array('id' => 'agrega');
    echo form_open('mercadotecnia/busqueda1_encontro', $atributos);
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
                                 <th style="text-align: left">Rel1</th>
                                 <th style="text-align: left">Rel2</th>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Descipcion</th>
                                 <th style="text-align: left">Lin</th>
                                 <th style="text-align: left">Slin</th>
                                 <th style="text-align: left">Prod</th>
                                 <th style="text-align: left">Cos</th>
                                 <th style="text-align: left">Far</th>
                                 <th style="text-align: left">Pub</th>
                                 <th style="text-align: left">Venta</th>
                                 <th style="text-align: left">Margen</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->rel1?></td>
                                   <td style="text-align: left;"><?php echo $r->rel2?></td>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->descripcion.'<br /><strong><font color=red>'.$r->labprv.'</font></strong>'?></td>
                                   <td style="text-align: left;"><?php echo $r->lin?></td>
                                   <td style="text-align: left;"><?php echo $r->sublin?></td>
                                   <td style="text-align: left;"><?php echo $r->producto?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->cos,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->farmacia,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->pub,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->venta,2)?></td>
                                   <td style="text-align: right;"><?php echo "% ".number_format($r->util,2)?></td>
                                   </tr>
                               <?php $timp_prv=0;$timp_suc=0;} ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table> 
 <!---->                         
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>