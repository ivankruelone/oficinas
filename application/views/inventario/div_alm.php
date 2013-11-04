                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="1"></th>
                                 <th colspan="2" style="color:gray;text-align: center">INVENTARIOS INICIAL</th>
                                 <th colspan="1" style="color:gray;text-align: center">ENTRADAS</th>
                                 <th colspan="1" style="color:gray;text-align: center">FACTURADO</th>
                                 <th colspan="2" style="color:gray;text-align: center">INVENTARIOS FINAL</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Almacen</th> 
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Imp.Paquete</th>
                                     <th style="color:gray; text-align: right">Compra</th>
                                     <th style="color:gray; text-align: right">facturado</th>
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Imp.Paquete</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;$tinvf=0;$tinvf_impo=0;$tcom=0;$tfac=0;
                                foreach ($a->result()as $r){
                               $l0 = anchor('inventario/almacen_lot_s/'.$r->tipox,'Lote</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               $l1 = anchor('inventario/almacen_det/'.$r->tipox,'Det</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->tipox?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->in_piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->in_importe,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->compra,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->facturado,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->fi_piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->fi_importe,2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->in_piezas;
                               $tcom=$tcom+$r->compra;
                               $tfac=$tfac+$r->facturado;
                               $tinv_impo=$tinv_impo+$r->in_importe;
                               $tinvf=$tinvf+$r->fi_piezas;
                               $tinvf_impo=$tinvf_impo+$r->fi_importe;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="1">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tcom,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tfac,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinvf,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinvf_impo,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>