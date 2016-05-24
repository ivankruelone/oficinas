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
                                    <th colspan="10" style="color: red; text-align: center;">CONSULTAS MEDICAS</th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Receta</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Consulta</th>
                                        <th>Ticket</th>
                                        <th>Importe</th>
                                        <th>Porcentaje</th>
                                        <th>Resurtido</th>
                                        <th>Importe</th>
                                        <th>Resur D&iacute;a Ant</th>
                                        <th>Importe</th>
                                       
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $color='blue';
                               $num=0;
                               $importe=0;
                               $importe1=0;
                               $importe2=0;
                               $porcen=0;
                               $consulta1=0;
                               $comision1=0;
                               $servi=0;
                               $prome=0;
                               $med=0;
                               $funda=0;
                              
                               $numero = $s->num_rows();
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                $consul=$s->num_rows($r);
                                
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->fecha?></td>
                                <td style="text-align: right"><?php echo $r->receta?></td>
                                <td style="text-align: left"><?php echo $r->descripcion?></td>
                                <td style="text-align: right">$<?php echo $r->costo?></td>
                                <td style="text-align: right"><?php echo $r->ticket?></td>
                                <td style="text-align: right">$<?php echo number_format($r->importe, 2)?></td>
                                <td style="text-align: right"><?php echo $r->rate?>%</td>
                                <td style="text-align: right"><?php echo $r->ticket1?></td>
                                <td style="text-align: right">$<?php echo number_format($r->importe1, 2)?></td>
                                <td style="text-align: right"><?php echo $r->ticket2?></td>
                                <td style="text-align: right">$<?php echo number_format($r->importe2, 2)?></td>
                                </tr>
                               <?php 
                                
                                $importe= $importe+($r->importe);
                                $importe1= $importe1+($r->importe1);
                                $importe2= $importe2+($r->importe2);
                                $importet= $importe+$importe1+$importe2;
                                $prome=$prome+($r->rate);
                                $consulta1=$consulta1+($r->costo);
                                $med=$med+($r->impDoctor);
                                $funda=$funda+($r->impFundacion);
                                
                                
                                
                                
                                
                                
                                 } 
                                 
                                $prome1=$prome/$numero;
                                
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">TOTAL</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($consulta1, 2)?></td>
                              <td></td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($importe, 2)?></td>
                              <td></td>
                              <td></td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($importe1, 2)?></td>
                              <td></td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($importe2, 2)?></td>
                              </tr>
                              
                              <tr>
                              <td colspan="11" style="color:<?php echo $color?>; text-align: right">CONSULTAS</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($consulta1, 2)?></td>
                              </tr>
                              <tr>
                              <td colspan="11" style="color:<?php echo $color?>; text-align: right">PROMEDIO DE CONSULTAS</td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo $prome1?>%</td>
                              </tr>
                              <tr>
                              <td colspan="11" style="color:<?php echo $color?>; text-align: right">COMISI&Oacute;N MEDICO</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo $med?></td>
                              </tr>
                              <tr>
                              <td colspan="11" style="color:<?php echo $color?>; text-align: right">COMISI&Oacute;N FUNDACI&Oacute;N</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo $funda?></td>
                              </tr>
                             </tfoot>
                         </table>
                  
                  
                  
                  
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: red; text-align: center;">SERVICIOS</th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Ticket</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Servicios</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $color='blue';
                               $num=0;
                               $porcen=0;
                               $servi1=0;
                               $comision1=0;
                               $promedio=0;
                              
                              
                              
                               foreach ($a->result()as $r1){
                                $num=$num+1;
                                $servi=$a->num_rows($r1);
                                if($servi>=5){
                                    $promedio=50;
                                }else{
                                    $promedio=0;
                                }
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r1->fecha?></td>
                                <td style="text-align: right"><?php echo $r1->ticket?></td>
                                <td style="text-align: left"><?php echo $r1->descripcion?></td>
                                <td style="text-align: right">$<?php echo $r1->costo?></td>
                                </tr>
                               <?php 
                                
                                $servi1=$servi1+($r1->costo);
                                
                               
                                 } 
                                 
                                $comision4=$promedio/100*$servi1;
                                $comision5=$servi1-$comision4;
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">TOTAL</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($servi1, 2)?></td>
                              </tr>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">SERVICIOS</td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo $servi?></td>
                              </tr>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">PORCENTAJE</td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo $promedio?>%</td>
                              </tr>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">COMISI&Oacute;N MEDICO</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo $comision4?></td>
                              </tr>
                              <tr>
                              <td colspan="4" style="color:<?php echo $color?>; text-align: right">COMISI&Oacute;N FUNDACI&Oacute;N</td>
                              <td style="color:<?php echo $color?>; text-align: right">$<?php echo $comision5?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>