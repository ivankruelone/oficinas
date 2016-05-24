                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $aviso?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
                          <caption></caption> 
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nominas</th>
                                     <th>Empleado</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Posible Nid</th>
                                     <th>Posible Sucursal</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;
                                foreach ($q->result()as $r0) {
                                
                                $num=$num+1;
                                ?>
                                <tr>
                                   <td style="color: orange;"><?php echo $num?></td>
                                    <td style="text-align: left;"><?php echo $r0->nomina?></td>
                                    <td style="text-align: left;"><?php echo $r0->empleado?></td>
                                    <td style="text-align: left;"><?php echo $r0->succ?></td>
                                    <td style="text-align: left;"><?php echo $r0->nombre?></td>
                                    <td style="text-align: left;"><?php echo $r0->nueva_suc?></td>
                                    <td style="text-align: left;"><?php echo $r0->nueva_sucx?></td>
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
$l=anchor('empleados/plantilla_todos/'.$ger,'DETALLE DE EMPLEADOS GLOBAL</a>', array('title' => 'Haz Click aqui para ver Empleados de su zona!', 'class' => 'encabezado'));
?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="6"><?php echo $l ?></th>
                                 </tr>
                                 <tr>
                                 <th style="text-align: left">Zonas</th>
                                 <th style="text-align: left">Supervisor</th>
                                 <th style="text-align: left">Sucursales</th>
                                 <th style="text-align: right">Personal Activo</th>
                                 <th style="text-align: right">Plantilla autorizada</th>
                                 <th style="text-align: right">Diferencia</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $nomina=0;$plantilla=0;$superv=0;$suc=0;
                                $tnomina=0;$tplantilla=0;$tsuperv=0;$tsuc=0;
                                foreach ($a as $r0) {
                                if($r0['regional']==$r0['f1']){
                                foreach ($r0['m'] as $r) {
                                $superv=$superv+1;$tsuperv=$tsuperv+1;
                                foreach ($r['segundo']as $r1) {
                                $suc=$suc+1;$tsuc=$tsuc+1;
                                foreach ($r1['tercero']as $r2) {
                                if($r2['puestox']<>'MEDICO' and $r2['motivo']<>'RETENCION'){$nomina=$nomina+1;$tnomina=$tnomina+1;}
                                
                                }
                                $plantilla=$plantilla+$r1['plantilla'];
                                $tplantilla=$tplantilla+$r1['plantilla'];
                                }
                                $l0 = anchor('empleados/plantilla_ss/'.$r['superv'],$r['supervx'].'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: right;"><?php echo $r['superv']?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $l0?></td>                                  
                                    <td style="color: gray;text-align: right;"><?php echo number_format($suc,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($nomina,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($plantilla,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($plantilla-$nomina,0)?></td>
                                  </tr>
                               <?php $nomina=0;$plantilla=0;$superv=0;$suc=0;}}} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                                    <td style="color: gray;text-align: right;">TOTAL</td>                                  
                                    <td style="color: gray;text-align: right;"><?php echo number_format($tsuc,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($tnomina,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($tplantilla,0)?></td>
                                    <td style="color: gray;text-align: right;"><?php echo number_format($tplantilla-$tnomina,0)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>