                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
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
                                    <th colspan="10" style="color: blue; text-align: center;">Ejercicio Medicos del Mes de  <?php echo getMesNombre($mes)?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>Medico</th>
                                        <th>Consultas</th>
                                        <th>Ing Cons</th>
                                        <th>Rec Sur</th>
                                        <th>Conv</th>
                                        <th>Imp Rec Sur</th>
                                        <th>Prom Rec</th>
                                        <th>Serv</th>
                                        <th>Cumplimiento</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               $numero = $s->num_rows();
                               
                               $consultasPagadas = 0;
                               $importeConsultas = 0;
                               $recetasSurtidas = 0;
                               $conversion = 0;
                               $ImprecetasSurtidas = 0;
                               $PromedioReceta = 0;
                               $servicios = 0;
                               $cumplimiento =0;
                     
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                $consul=$s->num_rows($r);
                                
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->suc.' '.$r->nomsuc?></td>
                                <td style="text-align: center"><?php echo $r->medico?></td>
                                <td style="text-align: right"><?php echo number_format($r->consultasPagadas, 0)?></td>
                                <td style="text-align: right"><?php echo number_format($r->importeConsultas, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->recetasSurtidas, 0)?></td>
                                <td style="text-align: right"><?php echo number_format($r->conversion, 2)?>%</td>
                                <td style="text-align: right"><?php echo number_format($r->ImprecetasSurtidas, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->PromedioReceta, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->servicios, 0)?></td>
                                <td style="text-align: right"><?php echo number_format($r->cumplimiento, 2)?>%</td>
                                </tr>
                               <?php 
                                 } 
                                 ?>
                              </tbody>
                              <tfoot>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>