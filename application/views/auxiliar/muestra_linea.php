                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Lineas disponibles</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <?php      
                                    echo anchor('auxiliar/captura_linea', 'AGREGAR NUEVA LINEA', 'class="button-link blue"')
                                    ?>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTAS LINEA</th>
                                    </tr>
                                     <tr>
                                        <th>Id Linea</th>
                                        <th>Linea</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $numero = $s->num_rows();
                               
                               foreach ($s->result()as $r){
                                $consul=$s->num_rows($r);
                                $l1 = anchor('auxiliar/editar_linea/'.$r->idLinea, $r->idLinea.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->linea?></td>
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