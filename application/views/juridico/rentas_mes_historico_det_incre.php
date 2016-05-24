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
                                $r=$q->row();
                                
	$atributos = array('id' => 'rentas_mes_historico_det_incre_add');
    echo form_open('juridico/rentas_mes_historico_det_incre_add', $atributos);
    $data_monto = array(
              'name'        => 'monto',
              'id'          => 'monto',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            );
  ?>
  
  <table>
 <tr>
<th colspan="6" align="center">APLICAR INCREMENTO</th>
</tr>
<tr>
<th colspan="6" align="center"></th>
</tr>
<tr>
    <td align="left" ><font size="+1">ARRENDADOR : </font></td>
	<td><?php echo $r->nom;?></td>
</tr>
<tr>
    <td align="left" ><font size="+1">IMPORTE DE INCREMENTO : </font></td>
	<td><?php echo form_input($data_monto, "", 'required');?></td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar Diferencia en pago');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cat?>" name="id_cat" id="id_cat" />    
<input type="hidden" value="<?php echo $local?>" name="local" id="local" />    
<input type="hidden" value="<?php echo $aaa?>" name="aaa" id="aaa" />    
<input type="hidden" value="<?php echo $mes?>" name="mes" id="mes" />    

  <?php
	echo form_close();
  ?>    
            <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th>DATOS ARRENDADOR</th>
                                <th style="color:black; text-align: left">Tipo</th>
                                 <th style="color:black; text-align: left"># Arrendadores</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">IVA</th>
                                 <th style="color:black; text-align: left">ISR</th>
                                 <th style="color:black; text-align: left">IVA ISR</th>
                                 <th style="color:black; text-align: left">Importe TOTAL MN</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;
                                foreach ($q1->result()as $r1) {
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r1->tipo_localx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r1->tipo?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r1->nom?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->imp,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->ivaf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->iva_isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r1->totalusd,2)?></td>
                                   </tr>
                               <?php $tmn=$tmn+$r1->totalmn;$tusd=$tusd+$r1->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              
                              </tfoot>
                         </table>
                                                 
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    
                     
                 </div>