                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <caption>Registros: <?php echo $query->num_rows(); ?></caption>
                             <thead>
                                     <tr>
                                        <th>Secuencia</th>
                                        <th>Sustancia Activa</th>
                                        <th>Venta Doctor Descuento</th>
                                        <th>Venta Genericos</th>
                                        <th>Venta Fenix</th>
                                        <th>Venta Farmabodega</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               foreach ($query->result()as $r){
                                $l1 = anchor('maestro/editar_secuencia/'.$r->secuencia, $r->secuencia.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->sustanciaActiva?></td>
                                <td style="text-align: right"><?php echo number_format($r->ventaDrd, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->ventaGen, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->ventaFen, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->ventaFbo, 2)?></td>
                                </tr>
                               <?php 
                                 } 
                                 ?>
                              </tbody>
                              <tfoot>
                             </tfoot>
                         </table>                            
