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
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green'; $col='gray'; $aaa=date('Y');
                                $monto=0;$tot=0;$total_con=0;$monto_ban=0;$iva_par=0;$iva_fac=0;
                                $fmonto=0;$ftot=0;$ftotal_con=0;$fmonto_ban=0;$fiva_par=0;$fiva_fac=0;
                                foreach ($a as $r){
                                ?>
                                <tr>
                                <td colspan="14"style="color:<?php echo $color2?>; text-align: left"><?php echo $r['cia_cxp']?></td>
                                </tr>
                                <tr>
                                     <td style="color:<?php echo $color2?>; text-align: left">Archivo</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Proveedor</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Consecutivo</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Cheque</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Iva</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Monto</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Fecha de banco</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Imp.Banco</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Fecha Fac.</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Fecha Ven.</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Factura</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Subtotal</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Iva</td>
                                     <td style="color:<?php echo $color2?>; text-align: right">Total</td>
                                 </tr>
                                <tr>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r['var']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r['prv']?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo $r['cheque_con']?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                               <?php 
                               foreach ($r['segundo'] as $r1){ 
                                if($r1['monto_partida']==$r1['monto_banco']){$color='gray';}else{$color='red';}
                                ?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r1['cheque_real']?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1['iva_partida'],2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1['monto_partida'],2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r1['fecha_che']?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1['monto_banco'],2)?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                               
                                <?php $monto=$monto+$r1['monto_partida'];
                                      $iva_par=$iva_par+$r1['iva_partida'];  
                                      $monto_ban=$monto_ban+$r1['monto_banco'];
                                      $fmonto=$fmonto+$r1['monto_partida'];
                                      $fiva_par=$fiva_par+$r1['iva_partida'];  
                                      $fmonto_ban=$fmonto_ban+$r1['monto_banco'];
                                      
                                      }
                                foreach ($r1['tercero'] as $r2){ 
                              
                                ?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fec_entrada']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fec_ven']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fac']?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['sub_fac'],2)?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['iva_fac'],2)?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['tot_fac'],2)?></td>
                                </tr>
                               
                                <?php 
                                $tot=$tot+$r2['tot_fac'];
                                $iva_fac=$iva_fac+$r2['iva_fac'];
                                $ftot=$ftot+$r2['tot_fac'];
                                $fiva_fac=$fiva_fac+$r2['iva_fac'];
                                
                                } ?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Monto Cheques</td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($iva_par,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($monto,2)?></strong></td>
                                <td>Monto Banco</td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($monto_ban,2)?></strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($iva_fac,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($tot,2)?></strong></td>
                                </tr>
                                <?php
                                $monto_ban=0;$monto=0;$iva_par=0;$tot=0;$iva_fac=0;} ?>
                              </tbody>
                              <footer>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Monto Cheques</td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($fiva_par,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($fmonto,2)?></strong></td>
                                <td>Monto Banco</td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($fmonto_ban,2)?></strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($fiva_fac,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($ftot,2)?></strong></td>
                              </tr>
                              </footer>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>