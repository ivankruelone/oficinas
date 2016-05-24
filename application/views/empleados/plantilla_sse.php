                 <div class="span12">
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
                                 <th style="text-align: left"></th>
                                 <th colspan="2">Accion</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $nomina=0;$plantilla=0;$superv=0;$suc=0;
                                $tnomina=0;$tplantilla=0;$tsuperv=0;$tsuc=0;
                                foreach ($a as $r0) {
                                foreach ($r0['m'] as $r) {
                                $superv=$superv+1;$tsuperv=$tsuperv+1;
                                foreach ($r['segundo']as $r1) {
                                if($r1['suc']==$r0['f1']){
                                $suc=$suc+1;$tsuc=$tsuc+1;
                                foreach ($r1['tercero']as $r2) {
                                if($r2['puestox']<>'MEDICO' and $r2['motivo']<>'RETENCION'){
                                $nomina=$nomina+1;$tnomina=$tnomina+1;
                                $tplantilla=$r1['plantilla'];}
                                if($r2['motivo']=='RETENCION'){$proceso='RETENCION';}else{$proceso='';}
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: right;"><?php echo $r2['nomina']?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r2['completo']?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r2['puestox']?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $proceso?></td>
                                    <td style="color: gray; "><?php echo anchor ('empleados/evaluacion/'.$r1['suc'].'/'.$r2['id'], 'Evaluaci&oacute;n'); ?></td>                              
                                    <td style="color: gray; "><?php echo anchor ('empleados/evaluacion_impresion/'.$r1['suc'].'/'.$r2['id'], 'Imprimir', array('target' => '_blank')); ?></td>                              
                                 </tr>
                               <?php $nomina=0;$plantilla=0;$superv=0;$suc=0;}}}}} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td style="color: blue;text-align: left;">Empleados activos <?php echo number_format($tnomina,0)?></td>
                                    <td style="color: blue;text-align: left;">Plantilla autorizada <?php echo number_format($tplantilla,0)?></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>