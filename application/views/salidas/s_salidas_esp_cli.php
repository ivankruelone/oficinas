                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Nid</th> 
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: right">Piezas</th>
                                     <th style="text-align: right">Importe</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                             </thead>   
                             <tbody>
                             
                                 <?php
                                $sumaimporte = 0;
                                $sumapiezas = 0;
                                foreach ($luna->result()as $r){
                                $l0 = anchor('salidas/s_salidas_esp_cli_fol/'.$mes.'/'.$uno.'/'.$r->suc,'Detalle por folio', array('title' => 'BUSCAR POR FOLIO!', 'class' => 'encabezado'));
                                $l1 = anchor('salidas/s_salidas_esp_cli_sec/'.$mes.'/'.$uno.'/'.$r->suc,'Detalle por Secuencia', array('title' => 'BUSCAR POR SECUENCIA!', 'class' => 'encabezado'));                            
                                ?>
                                <tr>
                                <td><?php echo $r->suc ?></td>
                                <td><?php echo $r->nombre ?></td>
                                <td style="text-align: right;"><?php echo number_format($r->piezas,0) ?></td>
                                <td style="text-align: right;"><?php echo number_format($r->importe,2)?></td>
                                <td><?php echo $l0 ?></td>
                                <td><?php echo $l1 ?></td>
                                </tr>
                               
                               <?php
                                $sumaimporte =  $sumaimporte+$r->importe;
                                $sumapiezas = $sumapiezas+$r->piezas;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="2">TOTAL</td>
                               <td style="text-align: right;"><strong><?php echo number_format($sumapiezas,0)?></strong></td>
                               <td style="text-align: right;"><strong><?php echo number_format($sumaimporte,2)?></strong></td>
                               <td></td>
                               <td></td>
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>