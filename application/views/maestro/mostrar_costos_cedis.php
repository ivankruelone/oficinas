                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Costos Cedis a Detalle</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">COSTOS CEDIS A DETALLE DE LA SECUENCIA <?php echo $secuencia; ?> </th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Sustancia Activa</th>
                                        <th>Lote</th>
                                        <th>Caducidad</th>
                                        <th>Costo</th>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                               $num=0;
                               $numero = $s->num_rows();
                               
                               foreach ($s->result()as $r){    
                                
                               $num=$num+1;
                               $consul=$s->num_rows($r); 
                                
                               ?>
        
                                <tr>
                                 <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: left"><?php echo $r->codigo; ?></td>
                                <td style="text-align: left"><?php echo $r->sustanciaActiva; ?></td>
                                <td style="text-align: left"><?php echo $r->lote; ?></td>
                                <td style="text-align: left"><?php echo $r->cadu; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->costo, 2) ; ?></td>
                                <td style="text-align: left"><?php echo $r->razonSocial; ?></td>
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