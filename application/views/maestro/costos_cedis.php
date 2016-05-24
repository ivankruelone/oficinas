                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Costos Cedis</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA COSTOS CEDIS</th>
                                    </tr>
                                     <tr>
                                        <th>Secuencia</th>
                                        <th>Sustancia Activa</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                               
                               foreach ($s->result()as $r){
                                $l1 = anchor('maestro/mostrar_costos_cedis/'.$r->secuencia, $r->secuencia.'</a>', array('title' => 'Haz Click aqui para Mostrar a detalle!', 'class' => 'encabezado'));                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->sustanciaActiva; ?></td>
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