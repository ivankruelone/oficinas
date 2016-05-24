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



                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th style="color:black; text-align: right">PAGADO MN</th>
                                 <th style="color:black; text-align: right">PAGADO USD</th>
                                 <th style="color:black; text-align: right">ADEUDO MN</th>
                                 <th style="color:black; text-align: right">ADEUDO USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $tptotalmn=0;$tptotalusd=0;$tatotalmn=0;$tatotalusd=0;
                                 $con=0;$num=0;$tmn=0;$tusd=0;$imp=0;$ivaf=0;$isrf=0;$iva_isrf=0;
                                foreach ($q->result()as $r) {
                                if($r->ref_bancaria==' '){
                                    $atotalmn=$r->totalmn;$atotalusd=$r->totalusd;
                                    $ptotalmn=0;$ptotalusd=0;
                                    $motivo=' ';
                                    }else{
                                    $ptotalmn=$r->totalmn;$ptotalusd=$r->totalusd;
                                    $atotalmn=0;$atotalusd=0;
                                    $motivo='REF.BANCARIA :';    
                                    }
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left;"><?php echo $r->nom.'<br /><font color=green>'.$r->contrato.' al '.$r->fecha_termino.'</font>' ?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($ptotalmn,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($ptotalusd,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($atotalmn,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($atotalusd,2)?></td>
                                  </tr>
                                  <tr>
                                  <td style="text-align: left; color:green;" colspan="13"><?php echo $r->observacion?></td>
                                  </tr>
                                  <tr>
                                  <td style="text-align: left; color:green;" colspan="13"><?php echo $motivo.$r->ref_bancaria?></td>
                                  </tr>
                               <?php 
                               $tmn=$tmn+$r->totalmn;
                               $tusd=$tusd+$r->totalusd;
                               $imp=$imp+$r->imp;
                               $ivaf=$ivaf+$r->ivaf;
                               $isrf=$isrf+$r->isrf;
                               $iva_isrf=$iva_isrf+$r->iva_isrf;
                               $tptotalmn=$tptotalmn+$ptotalmn;
                               $tptotalusd=$tptotalusd+$ptotalusd;
                               $tatotalmn=$tatotalmn+$atotalmn;
                               $tatotalusd=$tatotalusd+$atotalusd;
                               } ?>
                              </tbody>
                              <tfoot>
                              
                              </tfoot>
                         </table>
<?php
	$atributos = array('id' => 's_rentas_propias_grupo_cia_pago_graba');
    echo form_open('juridico/s_rentas_propias_grupo_cia_pago_graba', $atributos);

$data_banca = array(
              'name'        => 'ref',
              'id'          => 'ref',
              'value'       => '',
              'maxlength'   => '45',
              'size'        => '45'
            );
$data_cuenta = array(
              'name'        => 'cuenta',
              'id'          => 'cuenta',
              'value'       => '',
              'maxlength'   => '45',
              'size'        => '45'
            );
$data_dolar = array(
              'name'        => 'dolar',
              'id'          => 'dolar',
              'value'       => '',
              'maxlength'   => '7,2',
              'size'        => '7'
            );
?>
<table>

<tr>
<td colspan="2">Cuenta</td>
<td><?php echo form_input($data_cuenta, "", 'required');?></td>
</tr>
<tr>
<td colspan="2">Referencia bancaria</td>
<td><?php echo form_input($data_banca, "", 'required');?></td>
</tr>
<?php if($pago=='USD'){?>
<tr>
<td colspan="2">Dolar</td>
<td><?php echo form_input($data_dolar, "", 'required');?></td>
</tr>
<?php }?>
<tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'Guardar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $pago?>" name="pago" id="pago" />
  <?php
 
	echo form_close();
?>                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>