                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
                         $l1 = anchor('backoffice/a_solo_facturas_aplica','Procesar Facturas</a>', array('title' => 'Haz Click aqui para Generar!', 'class' => 'encabezado'));
?>
                            <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th colspan="10"><?php echo $l1?></th>
                               </tr>
                               <tr>
                               <th style="text-align: center;">A&Ntilde;o</th>
                               <th style="text-align: center;">MES</th>
                               <th style="text-align: center;">PRV</th>
                               <th style="text-align: center;">PROVEEDOR</th>
                               <th style="text-align: center;">IMPORTE</th>
                               <th style="text-align: center;">FACTURAS</th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';
                                 foreach ($q->result()as $r){
                              $l2 = anchor('backoffice/a_fac_producto/'.$r->aaa.'/'.$r->mes.'/'.$r->prv,'Producto</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                              $l3 = anchor('backoffice/a_fac_factura/'.$r->aaa.'/'.$r->mes.'/'.$r->prv,'Factura</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                              $l4 = anchor('backoffice/a_fac_sucursal/'.$r->aaa.'/'.$r->mes.'/'.$r->prv,'Sucursal</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                              $l5 = anchor('backoffice/a_fac_dia/'.$r->aaa.'/'.$r->mes.'/'.$r->prv,'Dia</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->aaa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->mesx?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->prv?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->razo?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->monto,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->num_fac,0)?></td>
                                   <td><?php echo $l2 ?></td>
                                   <td><?php echo $l3?></td>
                                   <td><?php echo $l4?></td>
                                   <td><?php echo $l5?></td>
                                </tr>
                                <?php 
                                } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2 ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                            <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                               <tr>
                               <th style="text-align: center;">A&Ntilde;o</th>
                               <th style="text-align: center;">MES</th>
                               <th style="text-align: center;">PRV</th>
                               <th style="text-align: center;">PROVEEDOR</th>
                               <th style="text-align: center;">PRODUCTOS<br />SOLICITADOS</th>
                               <th style="text-align: center;">PRODUCTOS<br />SURTIDOS</th>
                               <th style="text-align: center;">NIVEL DE<br />SURTIDO POR<br />PRODUCTOS</th>
                               <th style="text-align: center;">PIEZAS<br />SOLICITADAS</th>
                               <th style="text-align: center;">PIEZAS<br />SURTIDAS</th>
                               <th style="text-align: center;">NIVEL DE<br />SURTIDO POR<br />PIEZAS</th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;"></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';$color1='red';
                                 foreach ($q1->result()as $r1){
                              $l1 = anchor('backoffice/a_ped_producto/'.$r1->aaa.'/'.$r1->mes.'/'.$r1->prv,'Producto</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                              $l2 = anchor('backoffice/a_ped_sucursal/'.$r1->aaa.'/'.$r1->mes.'/'.$r1->prv,'Sucursal</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                              $l3 = anchor('backoffice/a_ped_dia/'.$r1->aaa.'/'.$r1->mes.'/'.$r1->prv,'Dia</a>', array('title' => 'Haz Click aqui para Ver!', 'class' => 'encabezado'));
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->aaa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->mesx?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->prv?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->razo?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r1->producto,0)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r1->pro_surtido,0)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: right;"><?php echo '% '.number_format($r1->nivel_surtido_pro,4)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r1->piezas,0)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r1->surtido,0)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: right;"><?php echo '% '.number_format($r1->nivel_surtido_pie,4)?></td>
                                   
                                   <td><?php echo $l1 ?></td>
                                   <td><?php echo $l2?></td>
                                   <td><?php echo $l3?></td>
                                   
                                </tr>
                                <?php 
                                } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>