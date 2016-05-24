                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <caption>Registros: <?php echo $query->num_rows(); ?></caption>
                             <thead>
                                     <tr>
                                        <th>Clave</th>
                                        <th>Nombre Generico</th>
                                        <th>Forma Farmaceutica</th>
                                        <th>Concentracion</th>
                                        <th>Presentacion</th>
                                        <th>Unidad de Medida</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               foreach ($query->result()as $r){

                                $l1 = anchor('maestro/editar_gobierno/'.$r->clave, $r->clave.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->nombreGenerico?></td>
                                <td style="text-align: left"><?php echo $r->formaFarmaceutica?></td>
                                <td style="text-align: left"><?php echo $r->concentracion?></td>
                                <td style="text-align: left"><?php echo $r->presentacion?></td>
                                <td style="text-align: left"><?php echo $r->unidadMedida?></td>
                                </tr>
                                <?php 
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
