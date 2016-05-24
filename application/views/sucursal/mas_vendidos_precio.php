                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>CONSULTA PRODUCTOS MAS VENDIDOS POR PRECIO</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       <?php      
                       //echo anchor('maestro/captura_proveedor', 'AGREGAR NUEVO PROVEEDOR', 'class="button-link blue"')
                       ?>
                         <a href="#myModal1" role="button" class="btn btn-primary perrote" data-toggle="modal">Dialog</a>
                         <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel1">Modal Header</h3>
                                </div>
                                <div class="modal-body">
                                    <p id="dialogo">Body goes here...</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                </div>
                            </div>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA PRODUCTOS MAS VENDIDOS POR PRECIO SUCURSAL <?php echo $suc; ?> <?php echo $nombre; ?></th>
                                    </tr>
                                     <tr>
                                        <th>Ranking</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               $num = 1;
                               foreach ($s->result()as $r){
                                
                               ?>
        
                                <tr>
                                <td style="text-align: right;"><?php echo $num; ?></td>
                                <td style="text-align: left"><?php echo $r->codigo; ?></td>
                                <td style="text-align: left"><?php echo $r->descri; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->cantidad, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->importe, 2); ?></td>
                                </tr>
                                <?php 
                                    $num++;
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>