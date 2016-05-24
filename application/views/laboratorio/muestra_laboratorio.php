                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Laboratorios disponibles</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                          <?php      
                          echo anchor('maestro/captura_laboratorio', 'AGREGAR NUEVO LABORATORIO', 'class="button-link blue"')
                          ?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA LABORATORIO</th>
                                    </tr>
                                     <tr>
                                        <th>Id Laboratorio</th>
                                        <th>Laboratorio</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               $numero = $s->num_rows();
                               
                               foreach ($s->result()as $r){
                                $consul=$s->num_rows($r);
                                $l1 = anchor('maestro/editar_laboratorio/'.$r->idLaboratorio, $r->idLaboratorio.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->laboratorio?></td>
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