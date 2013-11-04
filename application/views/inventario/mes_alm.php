                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                      <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="2"></th>
                                 <th colspan="2" style="color:gray;text-align: center">INVENTARIO INICIAL</th>
                                 <th colspan="1" style="color:black; text-align: center">ENTRADAS</th>
                                 <th colspan="1" style="color:blue; text-align: center">VENTA</th>
                                 <th colspan="2" style="color:green; text-align: center">INVENTARIO FINAL</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left"></th> 
                                     <th style="text-align: left">Mes</th>
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                     <th style="color:black; text-align: right">Compras</th>
                                     <th style="color:blue; text-align: right">Facturado</th>
                                     <th style="color:green; text-align: right">Piezas</th>
                                     <th style="color:green; text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $num=0;$tinv=0;$tinv_impo=0;$tinvf=0;$tinvf_impo=0;$tfac_impo=0;$trec_impo=0;$tcon_impo=0;$tcre_impo=0;
                                $facturado=0;
                                foreach ($b->result()as $r1){
                               $l0 = anchor('inventario/div_alm/'.$aaa.'/'.$r1->num,$r1->mesx.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               $facturado=$r1->facturado+$r1->facturadofbo+$r1->facturadocon; ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->num?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->ini_piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->ini_importe,2)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right"><?php echo number_format($r1->facturas,2)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right"><?php echo number_format($facturado,2)?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($r1->fin_piezas,0)?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($r1->fin_importe,2)?></td>
                                </tr>
                                
                               <?php 
                               $tinv=$tinv+$r1->ini_piezas;
                               $tinv_impo=$tinv_impo+$r1->ini_importe;
                               $tfac_impo=$tfac_impo+$r1->facturas;
                               $tcon_impo=$tcon_impo+$facturado;
                               
                               $tinvf=$tinvf+$r1->fin_piezas;
                               $tinvf_impo=$tinvf_impo+$r1->fin_importe;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              <td style="color: <?php echo $color1?>; text-align: right"><?php echo number_format($tfac_impo,2)?></td>
                              <td style="color: <?php echo $color2?>; text-align: right"><?php echo number_format($tcon_impo,2)?></td>
                              <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($tinvf,0)?></td>
                              <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($tinvf_impo,2)?></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>