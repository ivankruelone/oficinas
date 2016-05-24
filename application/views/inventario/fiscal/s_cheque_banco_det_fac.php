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
                                    
                            <tr>
                                     <th style="text-align: left">Archivo</th>
                                     <th style="text-align: right">Proveedor</th>
                                     <th style="text-align: right">Cheque</th>
                                     <th style="text-align: right">Fecha Fac.</th>
                                     <th style="text-align: right">Fecha Ven.</th>
                                     <th style="text-align: right">Sucursal</th>
                                     <th style="text-align: right">Factura</th>
                                     <th style="text-align: right">Subtotal</th>
                                     <th style="text-align: right">Iva</th>
                                     <th style="text-align: right">Total</th>
                                     <th style="text-align: right"># Fac</th>
                                 </tr>     
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green'; $col='gray'; $aaa=date('Y');
                                
                                $tot_fac=0;$iva_fac=0;$iva=0;$global=0;$monto_ban=0;
                                
                                $monto=0;$tot=0;$total_con=0;$monto_ban=0;$iva_par=0;$n=0;
                                $fmonto=0;$ftot=0;$ftotal_con=0;$fmonto_ban=0;$fiva_par=0;$fiva_fac=0;
                                foreach ($a as $r){ $n=0;
                                ?>
                                <tr>
                                <td colspan="14"style="color:<?php echo $color2?>; text-align: left"></td>
                                </tr>
                                
                                <tr>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r['var']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r['prv']?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo $r['cheque_real']?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                               
                                <?php foreach ($r['segundo'] as $r2){ $n=$n+1; ?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fec_entrada']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fec_ven']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['suc'].'-'.$r2['sucx']?></td>
                                <td style="color:<?php echo $col?>; text-align: left"><?php echo $r2['fac']?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['sub_fac'],2)?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['iva_fac'],2)?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($r2['tot_fac'],2)?></td>
                                <td style="color:<?php echo $col?>; text-align: right"><?php echo number_format($n,0)?></td> 
                                </tr>
                                <?php      
                                $monto_ban=$monto_ban+$r['monto_banco'];
                                $fmonto_ban=$fmonto_ban+$r['monto_banco'];
                                $iva_fac=$iva_fac+$r2['iva_fac'];
                                $tot_fac=$tot_fac+$r2['tot_fac'];
                                } ?>
                                <tr>
                                <td colspan="8"><?php echo $r['cia_cxp'].' Consecutivo <font color=blue>'.$r['cheque_con'].'</font> Fecha de cheque <font color=blue>'.$r['fecha_che'].'</font> Monto del Banco <font color=blue>'.number_format($r['monto_banco'],2).'</font>'?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($iva_fac,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($tot_fac,2)?></strong></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($n,0)?></strong></td>
                              </tr>
                                <?php $tot_fac=0;$iva_fac=0;$iva=0;$global=0;$monto_ban=0;}?>
                              </tbody>
                              <footer>
                             
                              </footer>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>