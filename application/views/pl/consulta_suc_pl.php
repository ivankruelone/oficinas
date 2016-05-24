                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-hover table-bordered" id="tabla1" style="color: black;">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">P&L SUCURSAL A DETALLE<br />A&Ntilde;O: <?php echo $aaa; ?>, MES: <?php echo getMesNombre($mes)?><br />Nid: <?php echo $suc; ?> - <?php echo $sucursal; ?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Departamento</th>
                                        <th>Concepto</th>
                                        <th>Importe</th>
                                        <th>Input</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $importe = 0;
                               $input = 0;
                               $observaciones = null;
                               
                               $ventaTotal = 0;
                               $utilidadBruta = 0;
                               
                               foreach ($venta->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                    <td style="text-align: center;"><?php echo $r->idConcepto?></td>
                                    <td><?php echo $r->departamento?></td>
                                    <td style="text-align: left;"><?php echo $r->concepto?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->importe, 2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->input, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                                   $importe= $importe+$r->importe;
                                   $input= $input+$r->input;
                                   
                                   if($r->idConcepto == 1)
                                   {
                                    $ventaTotal = $r->importe;
                                   }
                               
                              
                                 } 
                                 

                               
                               foreach ($utilidad->result()as $r){
                               
                                $num=$num+1;
                                
                                   if($r->idConcepto == 2)
                                   {
                                    $utilidadBruta = $r->input;
                                   }
                                   
                                   $importeUtilidadBruta = ($utilidadBruta / 100) * $ventaTotal;
                                
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                    <td style="text-align: center;"><?php echo $r->idConcepto?></td>
                                    <td><?php echo $r->departamento?></td>
                                    <td style="text-align: left;"><?php echo $r->concepto?></td>
                                    <td style="text-align: right;"><?php echo number_format($importeUtilidadBruta, 2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->input, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $importe= $importe+$r->importe;
                               $input= $input+$r->input;
                               
                              
                                 } 
                              
                              
                               foreach ($financiamiento->result()as $r){
                                $num=$num+1;
                                
                                   if($r->idConcepto == 3)
                                   {
                                    $costoFinanciamiento = $r->importe;
                                   }

                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                    <td style="text-align: center;"><?php echo $r->idConcepto?></td>
                                    <td><?php echo $r->departamento?></td>
                                    <td style="text-align: left;"><?php echo $r->concepto?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->importe, 2)?></td>
                                    <td style="text-align: right;"><?php echo number_format(($r->importe / $ventaTotal) * 100, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $importe= $importe+$r->importe;
                               $input= $input+$r->input;
                               
                              
                                 } 
                                 
                              
                              ?>
                              
                              <tr>
                                <td style="text-align: center; font-size: large;" colspan="5">Otros ingresos</td>
                              </tr>
                              
                              <?php

                              $otros_ingresos_importe = 0;
                               
                               foreach ($otros_ingresos->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                    <td style="text-align: center;"><?php echo $r->idConcepto; ?></td>
                                    <td><?php echo $r->departamento?></td>
                                    <td style="text-align: left;"><?php echo $r->concepto?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->importe, 2)?></td>
                                    <td style="text-align: right;"><?php echo number_format(($r->importe / $ventaTotal) * 100, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $otros_ingresos_importe = $otros_ingresos_importe + $r->importe;
                               
                              
                                 }
                               
                                                             
                              
                              ?>
                              
                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Total otros ingresos</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($otros_ingresos_importe, 2); ?></td>
                                <td>&nbsp;</td>
                              </tr>

                              <tr>
                                <td style="text-align: center; font-size: large;" colspan="5">Gastos  controlables</td>
                              </tr>
                              
                              <?php

                               $gastos_controlables_importe = 0;
                               
                               foreach ($gastos_controlables->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                <td style="text-align: center;"><?php echo $r->idConcepto; ?></td>
                                <td><?php echo $r->departamento?></td>
                                <td style="text-align: left;"><?php echo $r->concepto?></td>
                                <td style="text-align: right;"><?php echo number_format($r->importe, 2)?></td>
                                <td style="text-align: right;"><?php echo number_format(($r->importe / $ventaTotal) * 100, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $gastos_controlables_importe= $gastos_controlables_importe + $r->importe;
                               $input= $input+$r->input;
                               
                              
                                 }


                              ?>
                              
                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Total gastos controlables</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($gastos_controlables_importe, 2); ?></td>
                                <td>&nbsp;</td>
                              </tr>

                              <tr>
                                <td style="text-align: center; font-size: large;" colspan="5">Gastos  no controlables</td>
                              </tr>
                              
                              <?php

                                                             
                              $gastos_no_controlables_importe = 0;
                               
                               foreach ($gastos_no_controlables->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                <td style="text-align: center;"><?php echo $r->idConcepto; ?></td>
                                <td><?php echo $r->departamento?></td>
                                <td style="text-align: left;"><?php echo $r->concepto?></td>
                                <td style="text-align: right;"><?php echo number_format($r->importe, 2)?></td>
                                <td style="text-align: right;"><?php echo number_format(($r->importe / $ventaTotal) * 100, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $gastos_no_controlables_importe = $gastos_no_controlables_importe + $r->importe;
                               $input= $input+$r->input;
                               
                               $balance = $importeUtilidadBruta - $gastos_no_controlables_importe - $gastos_controlables_importe - $costoFinanciamiento + $otros_ingresos_importe;
                               $ganancia = $importeUtilidadBruta + $otros_ingresos_importe - $gastos_no_controlables_importe - $gastos_controlables_importe + $balance;
                              
                                 }

                                 ?>


                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Total gastos no controlables</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($gastos_no_controlables_importe, 2); ?></td>
                                <td>&nbsp;</td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Total gastos</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($gastos_controlables_importe + $gastos_no_controlables_importe, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($gastos_controlables_importe + $gastos_no_controlables_importe) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              </tbody>
                              <tfoot>
                              
                              <tr>
                                <td colspan="5"><hr /></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Ingresos varios</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($otros_ingresos_importe, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($otros_ingresos_importe) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Gastos controlables</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($gastos_controlables_importe, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($gastos_controlables_importe) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Gastos financieros, intereses</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($costoFinanciamiento, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($costoFinanciamiento) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Gastos no controlables</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($gastos_no_controlables_importe, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($gastos_no_controlables_importe) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Utilidad bruta</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($importeUtilidadBruta, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($importeUtilidadBruta) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td colspan="5"><hr /></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Ganancia</td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format($balance, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($balance) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td style="text-align: right; font-size: large;" colspan="3">Ganancia de la tienda proyectado</td>
                                <td style="text-align: right; font-size: large;" id="importe_proyectado"><?php echo number_format($balance, 2); ?></td>
                                <td style="text-align: right; font-size: large;" id="input_proyectado"><?php echo number_format((($balance) / $ventaTotal) * 100, 2); ?></td>
                              </tr>

                              <tr>
                                <td colspan="5">
                                    <div id="snap-inc-slider" class="slider"></div>
                                        <div class="slider-info">
                                            Venta total (incrementos de <?php number_format($ventaTotal, 2); ?>):
                                            <span id="snap-inc-slider-amount"></span>
                                        </div>
                                </td>
                              </tr>
                              

                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
