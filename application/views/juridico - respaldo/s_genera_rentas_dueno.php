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
	$atributos = array('id' => 's_genera_rentas_dueno_sumit');
    echo form_open('juridico/s_genera_rentas_dueno_sumit', $atributos);


?>
<table>
<tr>
<td colspan="13">Selecciona Mes de renta</td>
</tr>

<tr>
<td colspan="13"><?php echo form_dropdown('fec', $fec, null, 'id="fec"');?></td>
</tr>
<tr>
	<td colspan="13"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
?>

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left">Motivo</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th style="color:black; text-align: right">PAGO MN</th>
                                 <th style="color:black; text-align: right">PAGO USD</th>
                                 <th style="color:black; text-align: right">DEUDA MN</th>
                                 <th style="color:black; text-align: right">DEUDA USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $con=0;$num=0;$tmn=0;$tusd=0;$imp=0;$ivaf=0;$isrf=0;$iva_isrf=0;
                                 $ttmn=0;$ttusd=0;$timp=0;$tivaf=0;$tisrf=0;$tiva_isrf=0;
                                 $mnpago=0;$usdpago=0;$mndeuda=0;$usddeuda=0;
                                 $tmnpago=0;$tusdpago=0;$tmndeuda=0;$tusddeuda=0;
                                foreach ($q->result()as $r) {
                               $l1 = anchor('juridico/s_rentas_propias_grupo/'.$r->fecha_m.'/'.$r->num.'/'.$r->pago,$r->razon.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));    
                                $num=$num+1;
                                
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->mesx?></td>
                                   <td style="text-align: left;"><?php echo $l1?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->local?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($r->mnpago,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($r->usdpago,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($r->mndeuda,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($r->usddeuda,2)?></td>
                                  </tr>
                               <?php $con=$con+1; 
                               $tmn=$tmn+$r->totalmn;
                               $tusd=$tusd+$r->totalusd;
                               $imp=$imp+$r->imp;
                               $ivaf=$ivaf+$r->ivaf;
                               $isrf=$isrf+$r->isrf;
                               $iva_isrf=$iva_isrf+$r->iva_isrf;
                               $ttmn=$ttmn+$r->totalmn;
                               $ttusd=$ttusd+$r->totalusd;
                               $timp=$timp+$r->imp;
                               $tivaf=$tivaf+$r->ivaf;
                               $tisrf=$tisrf+$r->isrf;
                               $tiva_isrf=$tiva_isrf+$r->iva_isrf;
                               
                               
                               $usdpago=$usdpago+$r->usdpago;
                               $mnpago=$mnpago+$r->mnpago;
                               $usddeuda=$usddeuda+$r->usddeuda;
                               $mndeuda=$mndeuda+$r->mndeuda;
                               $tusdpago =$tusdpago+$r->usdpago;
                               $tmnpago  =$tmnpago+$r->mnpago;
                               $tusddeuda=$tusddeuda+$r->usddeuda;
                               $tmndeuda =$tmndeuda+$r->mndeuda;
                              if(($r->num==1 and $con==2) ||($r->num==2 and $con==1)){?>
                                <tr>
                                <td colspan="3" style="color:blue; text-align: right;"><strong><?php echo $r->mesx?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($timp,2)?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($tivaf,2)?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($tisrf,2)?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($tiva_isrf,2)?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($ttmn,2)?></strong></td>
                                <td style="color:blue; text-align: right;"><strong><?php echo number_format($ttusd,2)?></strong></td>
                                <td style="color:green; text-align: right;"><strong><?php echo number_format($mnpago,2)?></strong></td>
                                <td style="color:green; text-align: right;"><strong><?php echo number_format($usdpago,2)?></strong></td>
                                <td style="color:orange; text-align: right;"><strong><?php echo number_format($mndeuda,2)?></strong></td>
                                <td style="color:orange; text-align: right;"><strong><?php echo number_format($usddeuda,2)?></strong></td>
                                </tr>
                                <tr>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left">Motivo</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                                
                               <?php $con=0;$ttmn=0;$ttusd=0;$timp=0;$tivaf=0;$tisrf=0;$tiva_isrf=0;
                               $mnpago=0;$usdpago=0;$mndeuda=0;$usddeuda=0;
                               }                            
                               } ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="3"><strong>TOTAL</strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($imp,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($ivaf,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($isrf,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($iva_isrf,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              <td style="color:green; text-align: right;"><strong><?php echo number_format($tmnpago,2)?></strong></td>
                              <td style="color:green; text-align: right;"><strong><?php echo number_format($tusdpago,2)?></strong></td>
                              <td style="color:orange; text-align: right;"><strong><?php echo number_format($tmndeuda,2)?></strong></td>
                              <td style="color:orange; text-align: right;"><strong><?php echo number_format($tusddeuda,2)?></strong></td>
                              </tr>
                              </tfoot>
                         </table>



                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>