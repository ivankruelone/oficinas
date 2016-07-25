<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo; ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        


                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1" style="font-size: xx-small;">
                            <thead>
                               <tr>
                               <th colspan="9" style="color: red; size: !important+15;"><?php echo 'Los m&eacute;dicos que aparecen en blanco, se encuentran dados de baja.'?></th>
                               </tr>
                               <tr>
                               <th colspan="9" style="color: red; size: !important+10;">
                               <?php echo '* = CONSULTA M&Eacute;DICA';
                                     echo '<br />';
                                     echo '** = CERTIFICADO M&Eacute;DICO GENERAL';
                                     echo '<br />';
                                     echo '*** = CERTIFICADO M&Eacute;DICO ESCOLAR';
                                     echo '<br />';
                                     echo '**** = INYECCI&Oacute;N INTRAMUSCULAR';
                                     echo '<br />';
                                     echo '***** = LAVADO &Oacute;TICO';
                                     echo '<br />';
                                     echo '****** = LAVADO OCULAR';
                                     echo '<br />';
                                     echo '******* = TOMA DE PRESI&Oacute;N';
                                     echo '<br />';
                                     echo '******** = TOMA DE GLUCOSA';?>
                               </th>
                               </tr>
                                <tr>
                   

                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">N&oacute;mina</th>
                                    <th style="text-align: center;">M&eacute;dico</th>
                                    <th style="text-align: center;">Consultas</th>
                                    <th style="text-align: center;">Recetas Surtidas</th>
                                    <th style="text-align: center;">Importe</th>
                                    <th style="text-align: center;">Importe Promedio</th>
                                    <th style="text-align: center;">Importe Promedio Recetas Surtidas</th>
                                    <th style="text-align: center;">*</th>
                                    <th style="text-align: center;">**</th>
                                    <th style="text-align: center;">***</th>
                                    <th style="text-align: center;">****</th>
                                    <th style="text-align: center;">*****</th>
                                    <th style="text-align: center;">******</th>
                                    <th style="text-align: center;">*******</th>
                                    <th style="text-align: center;">********</th>
                                    <th style="text-align: center;">Costo</th>
                                    <th style="text-align: center;">Rate</th>
                                    <th style="text-align: center;">Premio(s)</th>
                                    <th style="text-align: center;">Imp Doctor</th>
                                    <th style="text-align: center;">Imp Fundacion</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $importe = 0;
                                $costo = 0;
                                $impDoctor = 0;
                                $impFundacion = 0;
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->suc.'-'.$row->sucursal; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nomina; ?></td>
                                    <td style="text-align: center;"><?php echo $row->medico; ?></td>
                                    <td style="text-align: center;"><?php echo $row->Consul; ?></td>
                                    <td style="text-align: center;"><?php echo $row->rSurtidas; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->Impt,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->ImptProm,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->ImptPromRecSur,2); ?></td> 
                                    <td style="text-align: center;"><?php echo $row->c1; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c2; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c3; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c4; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c5; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c6; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c7; ?></td>
                                    <td style="text-align: center;"><?php echo $row->c8; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->CostoTotal,2); ?></td>
                                    <td style="text-align: center;"><?php echo $row->Rat; ?></td>
                                    <td style="text-align: center;"><?php echo $row->Prem; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->ImpDoc,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->ImpFun,2); ?></td> 
                                    
                                    
                                </tr>
                                
                                <?php 
                                $importe = $importe + $row->Impt;
                                $costo = $costo + $row->CostoTotal; 
                                $impDoctor = $impDoctor + $row->ImpDoc;
                                $impFundacion = $impFundacion + $row->ImpFun;                               
                                }
                                ?>
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe: <?php echo $importe; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Costo: <?php echo $costo; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe Doctor: <?php echo $impDoctor; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe Fundacion: <?php echo $impFundacion; ?></th>
                                </tr>
                            
                                

                            </tbody>
                         </table> 
<!--                        
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1" style="font-size: xx-small;">
                            <thead>
                               <tr>
                               <th colspan="9" style="color: red; size: !important+15;"><?php echo 'Los m&eacute;dicos que aparecen en blanco, se encuentran dados de baja.'?></th>
                               </tr>
                                <tr>
                   

                                    <th style="text-align: center;">Per&iacute;odo</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Nombre de Sucursal</th>
                                    <th style="text-align: center;">N&oacute;mina</th>
                                    <th style="text-align: center;">M&eacute;dico</th>
                                    <th style="text-align: center;">Consultas</th>
                                    <th style="text-align: center;">Recetas Surtidas</th>
                                    <th style="text-align: center;">Importe</th>
                                    <th style="text-align: center;">Importe Promedio</th>
                                    <th style="text-align: center;">Importe Promedio Recetas Surtidas</th>
                                    <th style="text-align: center;">Concepto</th>
                                    <th style="text-align: center;">Costo</th>
                                    <th style="text-align: center;">Descripci&oacute;n</th>
                                    <th style="text-align: center;">Rate</th>
                                    <th style="text-align: center;">Premio</th>
                                    <th style="text-align: center;">Imp Doctor</th>
                                    <th style="text-align: center;">Imp Fundacion</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $importe = 0;
                                $costo = 0;
                                $impDoctor = 0;
                                $impFundacion = 0;
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->sucursal; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nomina; ?></td>
                                    <td style="text-align: center;"><?php echo $row->medico; ?></td>
                                    <td style="text-align: center;"><?php echo $row->consultas; ?></td>
                                    <td style="text-align: center;"><?php echo $row->recetasSurtidas; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->importe,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->importePromedio,2); ?></td>
                                    <td style="text-align: center;"><?php echo  number_format ($row->importePromedioRecetasSurtidas,2); ?></td> 
                                    <td style="text-align: center;"><?php echo $row->concepto; ?></td>
                                    <td style="text-align: center;"><?php echo $row->costo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->descripcion; ?></td>
                                    <td style="text-align: center;"><?php echo $row->rate; ?></td>
                                    <td style="text-align: center;"><?php echo $row->premio; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->impDoctor,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->impFundacion,2); ?></td> 
                                    
                                    
                                </tr>
                                
                                <?php 
                                $importe = $importe + $row->importe;
                                $costo = $costo + $row->costo; 
                                $impDoctor = $impDoctor + $row->impDoctor;
                                $impFundacion = $impFundacion + $row->impFundacion;                               
                                }
                                ?>
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe: <?php echo $importe; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Costo: <?php echo $costo; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe Doctor: <?php echo $impDoctor; ?></th>
                                </tr>
                                <tr>
                                    <th colspan= "18" style="text-align: right;"> Importe Fundacion: <?php echo $impFundacion; ?></th>
                                </tr>
                            
                                

                            </tbody>
                         </table>

-->
<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>