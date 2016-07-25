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
                                 <th style="text-align: center">Zona</th>
                                 <th style="text-align: center">Supervisor</th>
                                 <th style="text-align: center">Sucursales</th>
                                 <th style="text-align: center">Plantilla<br />autorizada</th>
                                 <th style="text-align: center">Personal<br />Activo</th>
                                 <th style="text-align: center">Vacantes<br />Farmacia</th>
                                 <th style="text-align: center">Plantilla Medico<br />autorizado</th>
                                 <th style="text-align: center">Personal Medico<br />Activo</th>
                                 <th style="text-align: center">Vacantes<br />Medico</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $num_superv=0;$plantilla=0;$actual=0;$num_suc=0;$vac_suc=0;$plantilla_medico=0;$medico_act=0;$vac_medico_act=0;
                                foreach ($q->result()as $r) {
                                $l0 = anchor('empleados/a_plantilla_suc/'.$r->superv,$r->superv.'</a>', array('title' => 'Haz Click aqui para ver Supervisores!', 'class' => 'encabezado'));
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: center;"><?php echo $l0?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->supervx?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->num_suc?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->plantilla?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->actual?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->vac_suc?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->plantilla_medico?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->medico_act?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $r->vac_medico_act?></td>
                                    
                                    
                                  </tr>
                               <?php 
                               $plantilla=$plantilla+$r->plantilla;
                               $actual=$actual+$r->actual;
                               $num_suc=$num_suc+$r->num_suc;
                               $vac_suc=$vac_suc+$r->vac_suc;
                               $plantilla_medico=$plantilla_medico+$r->plantilla_medico;
                               $medico_act=$medico_act+$r->medico_act;
                               $vac_medico_act=$vac_medico_act+$r->vac_medico_act;
                               } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td style="color: gray;text-align: right;" colspan="2">TOTAL</td>                                  
                                    <td style="color: gray;text-align: center;"><?php echo number_format($num_suc,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($plantilla,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($actual,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($vac_suc,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($plantilla_medico,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($medico_act,0)?></td>
                                    <td style="color: gray;text-align: center;"><?php echo number_format($vac_medico_act,0)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>