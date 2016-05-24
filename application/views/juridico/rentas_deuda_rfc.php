                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <?php 
                     $b  = explode("|", $a);
                     $mn = strtolower($b[0]);
                     $usd= strtolower($b[1]);
                     ?>
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
                                    <td colspan="6" style="color:purple;"><strong><?php echo 'M.N '.$mn?></strong></td>
                                    <td colspan="5" style="color:purple;"><strong><?php echo 'USD '.$usd?></strong></td>
                                </tr>   
                                 <tr>
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left">Tipo</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th>Aplicar</th>
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

 $data_fec = array(
'name'        => 'aplicame_'.$r->id,
'id'          => $r->id,
'size'        => '10',
'type'        => 'date',
'maxlength'   => '10',
'value'        => $r->fecha_pago,
 );
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
                                   <td style="color: green; font-size-adjust: inherit;">
                                   <?php echo form_input($data_fec);?><br />
                                   <strong>M.N <span style="color: purple;" id="cambiado_<?php echo $r->id; ?>"></span></strong>
                                   <strong>USD <span style="color: orangered;" id="cambiadousd_<?php echo $r->id; ?>"></span></strong></td>
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
                              <td></td>
                              <td style="text-align: right; color: <?php echo 'green'?>;"><strong><?php echo number_format($tmn_pre,2)?></strong></td>
                              <td style="text-align: right; color: <?php echo 'green'?>;"><strong><?php echo number_format($tusd_pre,2)?></strong></td>
                              </tr> 
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                     
                 </div>