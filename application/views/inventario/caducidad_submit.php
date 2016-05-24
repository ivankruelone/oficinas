                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         <?php
                         echo anchor('inventario/inv_excel_caducado/'.$id,'Descargar Inventario Caducado</a>', 'class="button-link blue"');
                         ?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">Reporte de Caducado y/o Proximo a Caducar</th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Clave</th>
                                        <th>Descripcion</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Inventario</th>
                                        <th>Caducidad (Dias)</th>
                                        <th>Almacen</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $inventario = 0;
                              
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->clave?></td>
                                <td style="text-align: center"><?php echo $r->descripcion?></td>
                                <td style="text-align: center"><?php echo $r->lote?></td>
                                <td style="text-align: center"><?php echo $r->caducidad?></td>
                                <td style="text-align: left"><?php echo number_format($r->inventario, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->diferencia, 0)?></td>
                                <td style="text-align: center"><?php echo $r->almacen?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $inventario= $inventario+$r->inventario;
                               
                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTALES</td>
                              <td style="text-align: left"><?php echo number_format($inventario, 0)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>