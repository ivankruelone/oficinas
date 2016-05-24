                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
$id_user=$this->session->userdata('id');
$atributos = array('id' => 'rentas_deuda_observa');
echo form_open('juridico/rentas_deuda_observa', $atributos);
$data_observa = array(
'name'        => 'observa',
'id'          => 'observa',
'type'        => 'text',
'value'       => ''
);
$data_fecha = array(
'name'        => 'fecha',
'id'          => 'fecha',
'type'        => 'date'
);
?>
<table>
<tr>
<tr>
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('criterio', $criterio, '', 'id="criterio"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Observacion: </strong></font></td>
	<td align="left"><?php echo form_input($data_observa, "", 'required');?> </td>
 </tr>
  <tr>
	<td align="left" ><font size="+1"><strong>Fecha de aviso: </strong></font></td>
	<td align="left"><?php echo form_input($data_fecha, "", 'required');?> </td>
 </tr>
 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $local?>" id="local" name="local"/>
<input type="hidden" value="<?php echo $suc?>" id="suc" name="suc"/>
<input type="hidden" value="<?php echo $rfc?>" id="rfc" name="rfc"/>
  <?php
 
	echo form_close();
  ?>
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
                             <thead>
                                   
                                 <tr>
                                 <th style="color:black; text-align: left">Fecha Captura</th>
                                 <th style="color:black; text-align: left">Usuario</th>
                                 <th style="color:black; text-align: left">Observacion</th>
                                 <th style="color:black; text-align: left">Fecha Critica</th>
                                 <th>Accion</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;$tmn_pre=0;$tusd_pre=0;
                                foreach ($q0->result()as $r0) {
                                if($id_user==$r0->id_user){
                                $l1=anchor('juridico/rentas_observa_del/'.$suc.'/'.$rfc.'/'.$local.'/'.$crit.'/'.$r0->id,'Borrar');
                                }else{$l1='';}
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r0->fecha_cap?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r0->nombre?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r0->comentario?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r0->fecha_deshalojo?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                   </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                   
                                 <tr>
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left">Tipo</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th style="color:black; text-align: left">POSIBLE PAGO MN</th>
                                 <th style="color:black; text-align: left">POSIBLE PAGO USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;$tmn_pre=0;$tusd_pre=0;
                                foreach ($q->result()as $r) {
                                if($r->pagado==2){$color='green';}else{$color='blue';}
                                if($r->tipo=='INCREMENTO'){$color1='orange';}else{$color1=$color;}    
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->aaa?></td>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->mes.' '.$r->mesx?></td>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->tipo ?></td>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->suc?></td>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color1?>;"><?php echo $r->nom?></td>
                                   <td style="text-align: right; color: <?php echo $color1?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color1?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color1?>;"><?php echo number_format($r->totalmn_pre,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color1?>;"><?php echo number_format($r->totalusd_pre,2)?></td>
                                   
                                   </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;
                                    $tmn_pre=$tmn_pre+$r->totalmn_pre;$tusd_pre=$tusd_pre+$r->totalusd_pre;} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              <td style="text-align: right; color: <?php echo $color1?>;"><strong><?php echo number_format($tmn_pre,2)?></strong></td>
                              <td style="text-align: right; color: <?php echo $color1?>;"><strong><?php echo number_format($tusd_pre,2)?></strong></td>
                              </tr> 
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>