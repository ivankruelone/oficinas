                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <caption>Registros: <?php echo $query->num_rows(); ?></caption>
                             <thead>
                                     <tr>
                                        <th>Id Producto</th>
                                        <th>Ean</th>
                                        <th>Descripcion</th>
                                        <th>Sustancia</th>
                                        <th>Laboratorio</th>
                                        <th>Secuencia</th>
                                        <th>Clave de gobierno</th>
                                        <th>Linea</th>
                                        <th>Sublinea</th>
                                        <th>Precio Maximo al Publico</th>
                                        <th>Precio Farmacia</th>
                                        </tr>
                                     </thead>
                                <tbody>
                             
                                <?php
                               
                               foreach ($query->result()as $r){

                                $l1 = anchor('maestro/editar_producto/'.$r->idProducto, $r->idProducto.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                                    
                                
                               ?>
        
                                <tr>
                                <td style="text-align: right"><?php echo $l1; ?></td>
                                <td style="text-align: right"><?php echo $r->ean; ?></td>
                                <td style="text-align: left"><?php echo $r->descripcion; ?></td>
                                <td style="text-align: left"><?php echo $r->sustancia; ?></td>
                                <td style="text-align: left"><?php echo $r->laboratorioProvisional; ?></td>
                                <td style="text-align: right"><?php echo $r->secuencia; ?></td>
                                <td style="text-align: left"><?php echo $r->clave; ?></td>
                                <td style="text-align: left"><?php echo $r->linea; ?></td>
                                <td style="text-align: left"><?php echo $r->sublinea; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->precioMaximoPublico, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->precioFarmacia, 2); ?></td>
                                </tr>
                                <?php 
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
