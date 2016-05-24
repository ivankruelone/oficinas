<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Reporte De Ordenes Atendidas Por Empleado Detalle </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
     
                         
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID Empleado</th>
                                    <th style="text-align: center;">Nombre Del Empleado</th>
                                    <th style="text-align: center;">Total De Ordenes Atendidas</th>
                                    <th style="text-align: center;">Calificaci&oacute;n Total De Ordenes Atendidas</th>
                                    <th style="text-align: center;">Pregunta 1</th>
                                    <th style="text-align: center;">Pregunta 2</th>
                                    <th style="text-align: center;">Pregunta 3</th>
                                    <th style="text-align: center;">Pregunta 4</th>
                                    <th style="text-align: center;">Pregunta 5</th>
                                    <th style="text-align: center;">Pregunta 6</th>
                                    <th style="text-align: center;">Pregunta 7</th>
                                    
                                     
                                    <th style="text-align: center;">Acci&oacute;n</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $tot_o = 0;
                                $tt = 0;
                                $p1 = 0;
                                $p2 = 0;
                                $p3 = 0;
                                $p4 = 0;
                                $p5 = 0;
                                $p6 = 0;
                                $p7 = 0;

                                $registros = $q1->num_rows();

                                foreach($q1->result() as $r1){ 
                                ?>

                                <tr>
                                    <td style="text-align: center;"><?php echo $r1->id; ?></td>
                                    <td style="text-align: center;"><?php echo $r1->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $r1->total_o; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->tt,2);?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p1,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p2,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p3,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p4,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p5,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p6,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($r1->p7,2); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('mantenimiento/detalle_evaluac/'.$r1->id, 'Detalle'); ?></td>
                                    </tr>
                                    <?php
                                    $tot_o = $tot_o + $r1->total_o;
                                    $tt = $tt + $r1->tt;
                                    $p1 = $p1 + $r1->p1;
                                    $p2 = $p2 + $r1->p2;
                                    $p3 = $p3 + $r1->p3;
                                    $p4 = $p4 + $r1->p4;
                                    $p5 = $p5 + $r1->p5;
                                    $p6 = $p6 + $r1->p6;
                                    $p7 = $p7 + $r1->p7; 
                                    }  
                                    ?>
                                                   
                                </tbody>
                                   <?php if(empty($tt) || empty($p1) || empty($p2) || empty($p3) || empty($p4) || empty($p5) || empty($p6) || empty($p7) || empty($registros)){
                                   $r1 = 0;$r2 = 0;$r3 = 0;$r4 = 0;$r5 = 0;$r6 = 0;$r7 = 0;$r8 = 0;
                                   }else{
                                    $r1 = $tt / $registros;
                                    $r2 = $p1 / $registros;
                                    $r3 = $p2 / $registros;
                                    $r4 = $p3 / $registros;
                                    $r5 = $p4 / $registros;
                                    $r6 = $p5 / $registros;
                                    $r7 = $p6 / $registros;
                                    $r8 = $p7 / $registros;
                                   }  ?>
                                <tfoot> 
                                <tr>
                                    <th colspan= "1" style="text-align: center;"></th>
                                    <th colspan= "1" style="text-align: center;"> PROMEDIOS</th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo $tot_o; ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r1,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r2,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r3,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r4,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r5,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r6,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r7,2); ?></th>
                                    <th colspan= "1" style="text-align: center;">  <?php echo number_format($r8,2); ?></th>
                                    
                                
                                </tr>
                                </tfoot>
                                
                                
                                
</table>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
