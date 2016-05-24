                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     
                     <div class="metro-nav">
                        
                            <div class="metro-nav-block nav-block-orange">
                                <a href="<?php echo site_url('maestro/muestra_ultimosCostos_excel'); ?>" data-original-title="">
                                    <i class="icon-download"></i>
                                    <div class="info">
                        
                                        <?php //echo number_format($this->pagination->total_rows, 0); ?> registros
                        
                                    </div>
                                    <div class="status">
                        
                                        Descargar en excel
                        
                                    </div>
                                </a>
                            </div>
                        </div>
                     
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Ultimos Costos</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA ULTIMOS COSTOS</th>
                                    </tr>
                                     <tr>
                                        <th>Sec</th>
                                        <th>N&deg; Prv</th> 
                                        <th>Proveedor</th>
                                        <th>Codigo</th>
                                        <th>Sustacia Activa</th>
                                        <th>Clave</th>
                                        <th>Costo</th>
                                        <th>Fecha</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                               
                               foreach ($s->result()as $r){
                                //$l1 = anchor('maestro/mostrar_costos_cedis/'.$r->secuencia, $r->secuencia.'</a>', array('title' => 'Haz Click aqui para Mostrar a detalle!', 'class' => 'encabezado'));                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $r->sec; ?></td>
                                <td style="text-align: left"><?php echo $r->prv; ?></td>
                                <td style="text-align: left"><?php echo $r->razo; ?></td>
                                <td style="text-align: left"><?php echo $r->codigo; ?></td>
                                <td style="text-align: left"><?php echo $r->sustanciaActiva; ?></td>
                                <td style="text-align: left"><?php echo $r->clave; ?></td>
                                <td style="text-align: right"><?php echo $r->costo; ?></td>
                                <td style="text-align: left"><?php echo $r->fechai; ?></td>
                                </tr>
                                <?php 
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>