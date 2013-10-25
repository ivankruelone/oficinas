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
                                 <th colspan="3"></th>
                                 <th colspan="2" style="text-align: center">INVENTARIO</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Nid</th>
                                      <th style="text-align: left">Imagen</th>  
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: right">Piezas</th>
                                     <th style="text-align: right">Importe</th>
                                     <th style="text-align: right">Venta de contado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; 
                                $num=0;$tinv=0;$tinv_impo=0;
                                foreach ($a->result()as $r){
                               $l0 = anchor('inventario/compa_cia/'.$r->mes.'/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->tipo2?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->importe,2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->piezas;
                               $tinv_impo=$tinv_impo+$r->importe;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              <td> </td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>