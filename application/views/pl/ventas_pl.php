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
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">P&L SUCURSAL <br />A&Ntilde;O: <?php echo $aaa; ?>, MES: <?php echo getMesNombre($mes)?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th style="text-align: right;">Venta total</th>
                                        <th style="text-align: right;">Balance sin Admon.</th>
                                        <th style="text-align: right;">Balance con Admon.</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $importe = 0;
                               
                               $balanceTotal = 0;
                               $balanceSinCuotaTotal = 0;
                               
                               $gananciaTotal = 0;
                               $gananciaSinCuotaTotal = 0;
                               $color = null;
                               
                               foreach ($s->result()as $r){
                                
                                
                                $num=$num+1;
                                $l1 = anchor('pl/consulta_suc_pl/'.$r->suc.'/'.$mes.'/'.$aaa, $r->suc.' '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
                                //utilidadBruta, gastosControlables, gastosNoControlables, 
                                //gastoFinanciero, otrosIngresos, ventaTotal
                                
                                $balance = $r->utilidadBruta - $r->gastosControlables - $r->gastosNoControlables - $r->gastoFinanciero + $r->otrosIngresos;
                                $balanceSinCuota = $balance + $r->cuotaFenix;
                                
                                $ganancia = $r->utilidadBruta + $r->otrosIngresos - $r->gastosControlables - $r->gastosNoControlables + $balance;
                                $gananciaSinCuota = $r->utilidadBruta + $r->otrosIngresos + $r->cuotaFenix - $r->gastosControlables - $r->gastosNoControlables + $balance;
                                
                                if($balance <= 0)
                                {
                                    $color = "#FF0000";
                                }else{
                                    $color = "#000000";
                                }

                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: left; "><?php echo $l1?></td>
                                <td style="text-align: right;"><?php echo number_format($r->ventaTotal, 2)?></td>
                                <td style="text-align: right;"><?php echo number_format($balanceSinCuota, 2)?></td>
                                <td style="text-align: right; color: <?php echo $color; ?>;"><?php echo number_format($balance, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $importe= $importe + $r->ventaTotal;
                               
                               $balanceTotal = $balanceTotal + $balance;
                               $balanceSinCuotaTotal = $balanceSinCuotaTotal + $balanceSinCuota;
                               
                               $gananciaTotal = $gananciaTotal + $ganancia;
                               $gananciaSinCuotaTotal = $gananciaSinCuotaTotal + $gananciaSinCuota;
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTALES</td>
                              <td style="text-align: right;"><?php echo number_format($importe, 2)?></td>
                              <td style="text-align: right;"><?php echo number_format($balanceSinCuotaTotal, 2)?></td>
                              <td style="text-align: right;"><?php echo number_format($balanceTotal, 2)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-hover table-bordered" id="tabla" style="color: black;">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">P&L TOTAL<br />A&Ntilde;O: <?php echo $aaa; ?>, MES: <?php echo getMesNombre($mes)?></th>
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
                                 

                               
                               foreach ($utilidad->result()as $r1){
                               
                                $num=$num+1;
                                
                                   if($r->idConcepto == 2)
                                   {
                                    $utilidadBruta = $r->input;
                                   }
                                   
                                   $importeUtilidadBruta = ($utilidadBruta / 100) * $ventaTotal;
                                $utilidadBruta1=$r1->utilidadbruta
                               ?>
                               
                                <tr style="background-color: <?php echo $r->colorDepartamento; ?>;">
                                    <td style="text-align: center;"><?php echo $r->idConcepto?></td>
                                    <td><?php echo $r->departamento?></td>
                                    <td style="text-align: left;">Utilidad Bruta</td>
                                    <td style="text-align: right;"><?php echo number_format($utilidadBruta1, 2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($r1->input, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $importe= $importe+$r->importe;
                               $input= $input+$r1->input;
                               
                              
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
                               
                               $balance = $utilidadBruta1 - $gastos_no_controlables_importe - $gastos_controlables_importe - $costoFinanciamiento + $otros_ingresos_importe;
                               $ganancia = $utilidadBruta1 + $otros_ingresos_importe - $gastos_no_controlables_importe - $gastos_controlables_importe + $balance;
                              
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
                                <td style="text-align: right; font-size: large;"><?php echo number_format($utilidadBruta1, 2); ?></td>
                                <td style="text-align: right; font-size: large;"><?php echo number_format((($utilidadBruta1) / $ventaTotal) * 100, 2); ?></td>
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
                                <td style="text-align: right; font-size: large;" colspan="3">Ganancia total proyectado</td>
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
