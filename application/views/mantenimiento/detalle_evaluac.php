<?php 
$e = $q1->row();
?>
<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Evaluaci&oacute;n De Ordenes Atendidas  </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                         REPORTE DEL EMPLEADO: <?php echo $e->nombre;?>
                         
                         <br />
                         <br />
                         
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;"># De Orden</th>
                                    <th style="text-align: center;"># De Sucursal</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Total Puntos</th>
                                    <th style="text-align: center;">Promedio</th>
                                    <th style="text-align: center;">Pregunta 1</th>
                                    <th style="text-align: center;">Pregunta 2</th>
                                    <th style="text-align: center;">Pregunta 3</th>
                                    <th style="text-align: center;">Pregunta 4</th>
                                    <th style="text-align: center;">Pregunta 5</th>
                                    <th style="text-align: center;">Pregunta 6</th>
                                    <th style="text-align: center;">Pregunta 7</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php 
                                $cb = 0;
                                $pf = 0;
                                $c1 = 0;
                                $c2 = 0;
                                $c3 = 0;
                                $c4 = 0;
                                $c5 = 0;
                                $c6 = 0;
                                $c7 = 0;
                                foreach($q1->result() as $r1){ 
                                ?>
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $r1->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $r1->suc;?></td>
                                    <td style="text-align: center;"><?php echo $r1->sucursal;?></td>
                                    <td style="text-align: center;"><?php echo $r1->calificacionb;?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->prom,2);?></td>
                                    <!-- <td style="text-align: center;"><?php echo $r1->idpregunta;?></td> -->
                                    <td style="text-align: center;"><?php echo $r1->c1;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c2;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c3;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c4;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c5;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c6;?></td>
                                    <td style="text-align: center;"><?php echo $r1->c7;?></td>
                                    </tr>
                                    
                                    
                                    <?php 
                                    $cb = $cb + $r1->calificacionb; 
                                    $pf = $pf + $r1->prom;
                                    $c1 = $c1 + $r1->c1;
                                    $c2 = $c2 + $r1->c2;
                                    $c3 = $c3 + $r1->c3;
                                    $c4 = $c4 + $r1->c4;
                                    $c5 = $c5 + $r1->c5;
                                    $c6 = $c6 + $r1->c6;
                                    $c7 = $c7 + $r1->c7;
                                     }
                                    ?>

                                </tbody>
                                     <?php $a=$q1->row();?>
                                <tfoot> 
                                <tr>
                                    <th colspan= "1" style="text-align: center;"></th>
                                    <th colspan= "1" style="text-align: center;"></th>
                                    <th colspan= "1" style="text-align: center;"></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo $cb; ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($pf) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c1) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c2) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c3) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c4) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c5) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c6) / ($a->ordenes),2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format(($c7) / ($a->ordenes),2); ?></th>
                                </tr>
                                </tfoot>
</table>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->