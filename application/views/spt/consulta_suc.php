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
                                    <th colspan="5" style="text-align: center;">Sucursal</th>
                                    <th colspan="4" style="text-align: center;">Consultas</th>
                                    <th colspan="12" style="text-align: center;">Servicios</th>
                                    </tr>
                                    
                                    <tr>
                                    <th colspan="5"></th>
                                    <th colspan="4" style="text-align: center;"></th>
                                    <th colspan="2" style="text-align: center;">Certificado Medico General</th>
                                    <th colspan="2" style="text-align: center;">Certificado Medico Escolar</th>
                                    <th colspan="2" style="text-align: center;">Inyeccion</th>
                                    <th colspan="2" style="text-align: center;">Lavado Otico</th>
                                    <th colspan="2" style="text-align: center;">Lavado Ocular</th>
                                    <th colspan="2" style="text-align: center;">Toma Presion</th>
                                    </tr>
                                 
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>Medico</th>
                                        <th>Turno</th>
                                        <th>Dia</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>Promedio Tickets</th>
                                        <th>Importe Total Tickets</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        <th>No.</th>
                                        <th>Importe</th>
                                        
                                     </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                               
                               $num=0;
                               $consultas=0;
                               $consultasImp=0;
                               $consultasTicket=0;
                               $cermedgen=0;
                               $cermedgenImp=0;
                               $cermedesc=0;
                               $cermedescImp=0;
                               $inyeccion=0;
                               $inyeccionImp=0;
                               $glucosa=0;
                               $glucosaImp=0;
                               $lavadoOti=0;
                               $lavadoOtiImp=0;
                               $lavadoOcu=0;
                               $lavadoOcuImp=0;
                               $tomapresion=0;
                               $tomapresionImp=0;
                               $promedioTicket=0;
                               $comision_promedio=0;
                               $doctorConsultas=0;
                               $fundacionConsultas=0;
                               $Comision_Servicios=0;
                               $doctorServicios=0;
                               $fundacionServicios=0;
                               $prome=0;
                               $numt=0;
                               
                               $numero = $s->num_rows();
                               
                               foreach ($s->result()as $r){
                                
                                    
                                
                               $num=$num+1;
                               $l1 = anchor('spt/consulta_dia/'.$r->suc.'/'.$r->nomina .'/'.$r->dia, $r->nomina.' '.$r->medico.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
                               ?>
                               
                                <tr>
                                <td style="text-align: center"><?php echo $num?></td>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->medico?></td>
                                <td style="text-align: center"><?php echo $r->turno?></td>
                                <td style="text-align: center"><?php echo $r->dia?></td>
                                <td style="text-align: right"><?php echo number_format($r->consultas, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->consultasImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->promedioTicket, 2)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->consultasTicket, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->cermedgen, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->cermedgenImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->cermedesc, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->cermedescImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->inyeccion, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->inyeccionImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->lavadoOti, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->lavadoOtiImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->lavadoOcu, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->lavadoOcuImp, 2)?></td>
                                <td style="text-align: right"><?php echo number_format($r->tomapresion, 0)?></td>
                                <td style="text-align: right">$<?php echo number_format($r->tomapresionImp, 2)?> </td>
                                
                                </tr>
                                
                                <tr>
                                <td colspan="8" style="color: blue; text-align: right;">Promedio Consultas</td>
                                <td style="text-align: right"><?php echo number_format($r->comision_promedio, 2)?></td>
                                <td colspan="11" style="color: blue; text-align: right;">Promedio Servicios</td>
                                <td style="text-align: right"><?php echo number_format($r->Comision_Servicios, 2)?></td>
                                </tr>
                                
                                <tr>
                                <td colspan="8" style="color: blue; text-align: right;">Comisi&oacute;n M&eacute;dico</td>
                                <td style="text-align: right">$<?php echo number_format($r->doctorConsultas, 2)?></td>
                                <td colspan="11" style="color: blue; text-align: right;">Comisi&oacute;n M&eacute;dico</td>
                                <td style="text-align: right">$<?php echo number_format($r->doctorServicios, 2)?></td>
                                </tr>
                                
                                <tr>
                                <td colspan="8" style="color: blue; text-align: right;">Comisi&oacute;n Fundaci&oacute;n</td>
                                <td style="text-align: right">$<?php echo number_format($r->fundacionConsultas, 2)?></td>
                                <td colspan="11" style="color: blue; text-align: right;">Comisi&oacute;n Fundaci&oacute;n</td>
                                <td style="text-align: right">$<?php echo number_format($r->fundacionServicios, 2)?></td>
                                </tr>
                                
                                <tr>
                                <td colspan="3" style="color: blue; text-align: right;">Total M&eacute;dico</td>
                                <td style="text-align: right">$<?php echo number_format($r->doctorConsultas+$r->doctorServicios, 2)?></td>
                                <td colspan="17"></td>
                                </tr>
                                <tr>
                                <td colspan="3" style="color: blue; text-align: right;">Total Fundaci&oacute;n</td>
                                <td style="text-align: right">$<?php echo number_format($r->fundacionConsultas+$r->fundacionServicios, 2)?></td>
                                <td colspan="17"></td>
                                </tr>
                                
                               <?php 
                                $color='blue';
                                $consultas= $consultas+($r->consultas);
                                $consultasImp= $consultasImp+($r->consultasImp);
                                $consultasTicket= $consultasTicket+($r->consultasTicket);
                                $cermedgen= $cermedgen+($r->cermedgen);
                                $cermedgenImp= $cermedgenImp+($r->cermedgenImp);
                                $cermedesc= $cermedesc+($r->cermedesc);
                                $cermedescImp= $cermedescImp+($r->cermedescImp);
                                $inyeccion=$inyeccion+($r->inyeccion);
                                $inyeccionImp=$inyeccionImp+($r->inyeccionImp);
                                $glucosa=$glucosa+($r->glucosa);
                                $glucosaImp=$glucosaImp+($r->glucosaImp);
                                $lavadoOti=$lavadoOti+($r->lavadoOti);
                                $lavadoOtiImp=$lavadoOtiImp+($r->lavadoOtiImp);
                                $lavadoOcu=$lavadoOcu+($r->lavadoOcu);
                                $lavadoOcuImp=$lavadoOcuImp+($r->lavadoOcuImp);
                                $tomapresion=$tomapresion+($r->tomapresion);
                                $tomapresionImp=$tomapresionImp+($r->tomapresionImp);
                                $promedioTicket=$promedioTicket+($r->promedioTicket);
                                
                                
                                $comision_promedio=$comision_promedio+($r->comision_promedio);
                                $doctorConsultas=$doctorConsultas+($r->doctorConsultas);
                                $fundacionConsultas=$fundacionConsultas+($r->fundacionConsultas);
                                $Comision_Servicios=$Comision_Servicios+($r->Comision_Servicios);
                                $doctorServicios=$doctorServicios+($r->doctorServicios);
                                $fundacionServicios=$fundacionServicios+($r->fundacionServicios);
                                 } 
                                 
                                $prome=$promedioTicket/$numero;
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <th colspan="5"></th>
                                    <th colspan="4" style="text-align: center;">Consultas</th>
                                    <th colspan="2" style="text-align: center;">Certificado Medico General</th>
                                    <th colspan="2" style="text-align: center;">Certificado Medico Escolar</th>
                                    <th colspan="2" style="text-align: center;">Inyeccion</th>
                                    <th colspan="2" style="text-align: center;">Lavado Otico</th>
                                    <th colspan="2" style="text-align: center;">Lavado Ocular</th>
                                    <th colspan="2" style="text-align: center;">Toma Presion</th>
                                    </tr>
                              
                              
                              <tr>
                                        <td colspan="5"></td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>Promedio Tickets</td>
                                        <td>Importe Total Tickets</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        <td>No.</td>
                                        <td>Importe</td>
                                        
                              </tr>
                                     
                              <tr>
                              <td colspan="5" style="color:blue; text-align: right">TOTAL</td>
                              <td style="color:blue; text-align: right"><?php echo number_format($consultas,0)?></td>
                              <td style="color:blue; text-align: right">$<?php echo number_format($consultasImp,2)?></td>
                              <td style="color:blue; text-aling: right"><?php echo number_format($prome,2)?></td>
                              <td style="color:blue; text-align: right">$<?php echo number_format($consultasTicket,2)?></td>
                              <td style="color:blue; text-align: right"><?php echo number_format($cermedgen,0)?></td>
                              <td style="color:blue; text-align: right">$<?php echo number_format($cermedgenImp,2)?></td>
                              <td style="color:blue; text-align: right"><?php echo number_format($cermedesc,0)?></td>
                              <td style="color:blue; text-align: right">$<?php echo number_format($cermedescImp,2)?></td>
                              <td style="color:blue; text-align: right"><?php echo number_format($inyeccion,0)?></td>
                              <td style="color:blue; text-align: right">$<?php echo number_format($inyeccionImp,2)?></td>
                              <td style="color:blue; text-aling: right"><?php echo number_format($lavadoOti, 0)?></td>
                              <td style="color:blue; text-aling: right">$<?php echo number_format($lavadoOtiImp,2)?></td>
                              <td style="color:blue; text-aling: right"><?php echo number_format($lavadoOcu, 0)?></td>
                              <td style="color:blue; text-aling: right">$<?php echo number_format($lavadoOcuImp, 2)?></td>
                              <td style="color:blue; text-aling: right"><?php echo number_format($tomapresion, 0)?></td>
                              <td style="color:blue; text-aling: right">$<?php echo number_format($tomapresionImp,2)?></td>
                             
                              </tr>
                              
                              <tr>
                              <td colspan="2" style="color:<?php echo $color?>; text-align: right">TOTAL M&Eacute;DICOS</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($doctorServicios+$doctorConsultas,2)?></td>
                              <td colspan="18"></td>
                              </tr>
                              
                              <tr>
                              <td colspan="2" style="color:<?php echo $color?>; text-align: right">TOTAL FUNDACI&Oacute;N</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($fundacionConsultas+$fundacionServicios,2)?></td>
                              <td colspan="18"></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
