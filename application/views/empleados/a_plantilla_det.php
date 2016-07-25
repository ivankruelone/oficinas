                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Nomina</th>
                                 <th style="text-align: left">Empleado</th>
                                 <th style="text-align: left">Puesto</th>
                                 <th style="text-align: left">Fecha<br />Alta</th>
                                 <th style="text-align: left">Fecha<br />Registrado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $num_superv=0;$plantilla=0;$actual=0;$num_suc=0;$vac_suc=0;$plantilla_medico=0;$medico_act=0;$vac_medico_act=0;
                                foreach ($q->result()as $r) {
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: left;"><?php echo $r->nomina?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->completo?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->puestox?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->fechaalta?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->fec_as400?></td>
                                  </tr>
                               <?php 
                                } ?>
                              </tbody>
                              <tfoot>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Nomina</th>
                                 <th style="text-align: left">Empleado</th>
                                 <th style="text-align: left">Puesto</th>
                                 <th style="text-align: left">Fecha<br />Alta</th>
                                 <th style="text-align: left">Fecha<br />Registrado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $num_superv=0;$plantilla=0;$actual=0;$num_suc=0;$vac_suc=0;$plantilla_medico=0;$medico_act=0;$vac_medico_act=0;
                                foreach ($q1->result()as $r1) {
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: left;"><?php echo $r1->nomina?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r1->completo?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r1->puestox?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r1->fechaalta?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r1->fec_as400?></td>
                                  </tr>
                               <?php 
                                } ?>
                              </tbody>
                              <tfoot>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>