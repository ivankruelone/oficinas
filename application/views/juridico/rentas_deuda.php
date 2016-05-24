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
                                 <th style="color:black; text-align: left">fecha Cierre</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Meses</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th></th>
                                 <th style="color:black; text-align: left">POSIBLE PAGO MN</th>
                                 <th style="color:black; text-align: left">POSIBLE PAGO USD</th>
                                 <th></th>
                                </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;$tmn_pre=0;$tusd_pre=0;
                                foreach ($q->result()as $r) {
                                if($r->utilidad>0){$color1='blue';}else{$color1='red';}
                                if($r->meses1>0){$meses=$r->meses.'+'.$r->meses1;}else{$meses=$r->meses;}
                                if($r->totalmn_pre>0 || $r->totalusd_pre>0){
                                $l0=anchor('juridico/rentas_deuda_gerpago/'.$r->suc.'/'.$r->rfc.'/'.$r->tipo_local,'Validar Pago');
                                }else{$l0='';}
                                $l1=anchor('juridico/rentas_deuda_rfc/'.$r->suc.'/'.$r->rfc.'/'.$r->tipo_local,'PREPAGO');
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->fecha_act?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->suc?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->nom?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $meses?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                   <td style="text-align: right; color: <?php echo 'green'?>;"><?php echo number_format($r->totalmn_pre,2)?></td>
                                   <td style="text-align: right; color: <?php echo 'green'?>;"><?php echo number_format($r->totalusd_pre,2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l0?></td>
                                  </tr>
                               <?php 
                               $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;
                               $tmn_pre=$tmn_pre+$r->totalmn_pre;$tusd_pre=$tusd_pre+$r->totalusd_pre;} 
$atts = array(
              'width'      => '1100',
              'height'     => '600',
              'scrollbars' => 'no',
              'status'     => 'no',
              'resizable'  => 'no',
              'screenx'    => '0',
              'screeny'    => '0'
            );
$l2 = anchor_popup('juridico/rentas_deuda_preimpresion/'.$local, 'Vista para impresion', $atts);
                               ?>
                               
                              </tbody>
                              <tfoot>
                              <td colspan="4"><?php echo $l2?></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><strong>TOTAL</strong></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($tmn,2)?></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($tusd,2)?></td>
                              <td></td>
                              <td style="text-align: right; color: <?php echo 'green'?>;"><?php echo number_format($tmn_pre,2)?></td>
                              <td style="text-align: right; color: <?php echo 'green'?>;"><?php echo number_format($tusd_pre,2)?></td>
                              <td></td>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                     
                 </div>