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
                                 <th colspan="6">LAS SUCURSALES QUE TIENEN FECHA DE CIERRE TIENEN 1 MES PARA CAMBIAR AL PERSONAL </th>
                                 </tr>
                                 <tr>
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Fecha Cierre</th>
                                 <th style="text-align: right">Personal Activo</th>
                                 <th style="text-align: right">Plantilla autorizada</th>
                                 <th style="text-align: right">Diferencia</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $nomina=0;$plantilla=0;$superv=0;$suc=0;
                                $tnomina=0;$tplantilla=0;$tsuperv=0;$tsuc=0;$color='gray';
                                foreach ($a as $r0) {
                                foreach ($r0['m'] as $r) {
                                if($r['superv']==$r0['f1']){
                                $superv=$superv+1;$tsuperv=$tsuperv+1;
                                foreach ($r['segundo']as $r1) {
                                $suc=$suc+1;$tsuc=$tsuc+1;
                                foreach ($r1['tercero']as $r2) {
                                if($r2['puestox']<>'MEDICO' and $r2['motivo']<>'RETENCION'){$nomina=$nomina+1;$tnomina=$tnomina+1;}
                                if($r1['fecha_act']<>'0000-00-00'){$color='red';}else{$color='gray';}
                                }
                                $plantilla=$plantilla+$r1['plantilla'];
                                $tplantilla=$tplantilla+$r1['plantilla'];
                                
                                $l0 = anchor('empleados/plantilla_sse/'.$r1['suc'],$r1['sucx'].'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                 ?>
                                
                                 <tr>
                                    <td style="color:<?php echo $color ?>;text-align: right;"><?php echo $r1['suc']?></td>
                                    <td style="color:<?php echo $color ?>;text-align: left;"><?php echo $l0?></td>
                                    <td style="color:<?php echo $color ?>;text-align: right;"><?php echo $r1['fecha_act']?></td>                                  
                                    <td style="color:<?php echo $color ?>;text-align: right;"><?php echo number_format($nomina,0)?></td>
                                    <td style="color:<?php echo $color ?>;text-align: right;"><?php echo number_format($plantilla,0)?></td>
                                    <td style="color:<?php echo $color ?>;text-align: right;"><?php echo number_format($plantilla-$nomina,0)?></td>
                                  </tr>
                               <?php $nomina=0;$plantilla=0;$superv=0;$suc=0;}}}} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                                    <td colspan="2" style="color: gray;text-align: right;">FARMACIAS <?php echo number_format($tsuc,0)?></td>                                  
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