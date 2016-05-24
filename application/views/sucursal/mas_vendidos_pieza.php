                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>PRODUCTOS MAS VENDIDOS POR PIEZA</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       <?php      
                       //echo anchor('maestro/captura_proveedor', 'AGREGAR NUEVO PROVEEDOR', 'class="button-link blue"')
                       ?>
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA PRODUCTOS MAS VENDIDOS POR PIEZA SUCURSAL <?php echo $suc; ?> <?php echo $nombre; ?></th>
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
                                <td style="text-align: rigth"><?php echo $num; ?></td>
                                <td style="text-align: left"><?php echo $r->codigo; ?></td>
                                <td style="text-align: left"><?php echo $r->descri; ?></td>
                                <td style="text-align: rigth"><?php echo number_format($r->cantidad, 0); ?></td>
                                <td style="text-align: rigth"><?php echo number_format($r->importe, 2); ?></td>
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