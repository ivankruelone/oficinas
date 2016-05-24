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
                                 <th colspan="5" style="color:gray;text-align: center">INVENTARIOS</th>
                                 
                                 </tr>
                                 <tr>
                                     <th></th>
                                     <th style="text-align: left">Almacen</th> 
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                    <!--
                                     <th style="color:gray; text-align: right">Imp.Paquete</th>
                                    -->
                                     <th style="color:gray; text-align: right">Piezas Modulos</th>
                                     <th style="color:gray; text-align: right">Importe Modulos</th>
                                     
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;$tinv_impop=0;
                                foreach ($a->result()as $r){
                               if($this->session->userdata('nivel')==4){
                               $l0 = anchor('inventario/almacen_lot/'.$r->tipo,'Lote</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado')); 
                               if($r->tipo=='alm' || $r->tipo=='fbo'){
                               $l1 = anchor('inventario/almacen_det/'.$r->tipo,$r->almacen.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado')); 
                               }elseif($r->tipo=='agu' || $r->tipo=='con' || $r->tipo=='cht'){
                               $l1 = anchor('inventario/almacen_det_seg/'.$r->tipo,$r->almacen.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado')); 
                               }
                               
                               }else{ 
                               $l0 = anchor('inventario/almacen_lot_s/'.$r->tipo,'Lote</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               $l1 = anchor('inventario/almacen_det1/'.$r->tipo,$r->almacen.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               }
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->importe,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->modulos,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->modulos_importe,2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->piezas;
                               $tinv_impo=$tinv_impo+$r->importe;
                               
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right;">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              <td></td>
                              <td></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>