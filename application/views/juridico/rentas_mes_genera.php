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
	$atributos = array('id' => 'agrega_rentas_mes');
    echo form_open('juridico/agrega_rentas_mes', $atributos);
    $data_aaa = array(
              'name'        => 'aaa',
              'id'          => 'aaa',
              'value'       => date('Y'),
              'maxlength'   => '4',
              'size'        => '4'
            );
    $data_tcambio = array(
              'name'        => 'tcambio',
              'id'          => 'tcambio',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
  ?>
  
  <table>
 <tr>
<th colspan="6" align="center">GENERA RENTAS DEL MES</th>
</tr>
<tr>
<th colspan="6" align="center"></th>
</tr>
<tr>
    <td align="left" ><font size="+1">A&ntilde;o : </font></td>
	<td><?php echo form_input($data_aaa, "", 'required');?></td>
	<td align="left" ><font size="+1">Mes : </font></td>
	<td align="left"><?php echo form_dropdown('mes', $mesx, '', 'id="mes"') ;?> </td>
	<td align="left" ><font size="+1">Tipo de cambio : </font></td>
    <td><?php echo form_input($data_tcambio, "", 'required');?></td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Generar');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>

                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th></th>
                                 <th style="color:black; text-align: left">Fecha Generada</th>
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left">Tipo</th>
                                 <th style="color:black; text-align: left"># Arrendadores</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th style="color:black; text-align: left">Tipo de Cambio</th>
                                 <th style="color:black; text-align: left">Conversion</th>
                                 <th style="color:black; text-align: left">Importe TOTAL MN</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;
                                foreach ($q->result()as $r) {
                                $conversion=(($r->totalusd)*($r->tipo_cambio));
                                if($r->aaa>0){
                                $l1=anchor('juridico/rentas_mes_genera_det/'.$r->aaa.'/'.$r->mes.'/'.$r->id_renta,'Detalle');
                                $l2=anchor('juridico/rentas_mes_del/'.$r->id_renta,'Borrar');
                                $l3=anchor('juridico/rentas_mes_val/'.$r->id_renta,'Validar');
                                }else{
                                $l1='';$l2='';$l3='';     
                                }
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l2?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->fecha_g?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->aaa?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->mesx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->tipo?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->arrendador?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->tipo_cambio,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($conversion,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r->totalmn+$conversion),2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l3?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    
                     
                 </div>