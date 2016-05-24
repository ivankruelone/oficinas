                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Quincena</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: right">Departamento</th>
                                 <th style="color:black; text-align: right">Nomina</th>
                                 <th style="color:black; text-align: right">Empleado</th>
                                 <th style="color:black; text-align: right">Puesto</th>
                                 <th style="color:black; text-align: right">Horas<br />Trabajadas</th>
                                 <th style="color:black; text-align: right">Horas<br />en quincena</th>
                                 <th style="color:black; text-align: right">Faltas</th>
                                 <th style="color:black; text-align: right">No Chec&oacute;<br />Salida</th>
                                 <th style="color:black; text-align: right">Sancion<br />Aplicada</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                 $tmn=0;$tusd=0;
                                foreach ($q->result()as $r) {
                                if($r->diff < 0){
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->inicio.' - '.$r->fin?></td>
                                   <td style="text-align: left;"><?php echo $r->mesx?></td>
                                   <td style="text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="text-align: left;"><?php echo $r->nomina?></td>
                                   <td style="text-align: left;"><?php echo $r->completo?></td>
                                   <td style="text-align: left;"><?php echo $r->puestox?></td>
                                   <td style="text-align: right;"><?php echo $r->horas?></td>
                                   <td style="text-align: right;"><?php echo $r->horas_laboradas?></td>
                                   <td style="text-align: right;"><?php echo $r->falta?></td>
                                   <td style="text-align: right;"><?php echo $r->no_checo?></td>
                                   <td style="text-align: right;"><?php echo $r->descu?></td>
                                   
                                  </tr>
                               <?php  
                              
                               }
                               } ?>
                              </tbody>
                              <tfoot>
                               
                              
                              </tfoot>
                         </table>



                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>