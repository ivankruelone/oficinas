 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th style="text-align: center; font-size: 80%;">#</th>
                                        <th style="text-align: center; font-size: 80%;">F</th>
                                        <th style="text-align: center; font-size: 80%;">CLA</th>
                                        <th style="text-align: center; font-size: 80%;">SEC</th>
                                        <th style="text-align: center; font-size: 80%;">SUSTANCIA ACTIVA</th>
                                        <th style="text-align: center; font-size: 80%;">PAQ</th>
                                        <th style="text-align: center; font-size: 80%;">VENTA<br /><?php echo $ant?></th>
                                        <th style="text-align: center; font-size: 80%;">VENTA<br /><?php echo $act?></th>
                                        <th style="text-align: center; font-size: 80%;">PROYEC.<br />VENTA<br /><?php echo $act?></th>
                                        <th style="text-align: center; font-size: 80%;">OPTIMO<br />SUCURSAL<br />ACTUAL</th>
                                        <th style="text-align: center; font-size: 80%;">EXISTENCIA<br />CEDIS</th>
                                        <th style="text-align: center; font-size: 80%;">VENTA<br />FENIX<br /><?php echo $ant?></th>
                                        <th style="text-align: center; font-size: 80%;">VENTA<br />FENIX<br /><?php echo $act?></th>
                                        <th style="text-align: center; font-size: 80%;">PROYEC.<br />VENTA<br />FENIX <?php echo $act?></th>
                                        <th style="text-align: center; font-size: 80%;">OPTIMO<br />CEDIS</th>
                                        <th style="text-align: center; font-size: 80%;">OPTIMO<br />IDEAL</th>
                                        <th style="text-align: center; font-size: 80%;">DIF.</th>
                                        
                                        
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='red'; $color2='purple';$color1='purple';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
                                $num=0;
                                foreach ($q->result()as $r){
                                if($r->val==1){$color2='purple';}else{$color2='blue';}
                                if($r->dif>0){$color='red';}else{$color='blue';}
                               $num=$num+1;
                               //$l1 = anchor('desplazamientos/s_desplaza_metro_suc_det/'.$r->aaa.'/'.$r->mes.'/'.$r->suc,'Por Sucursal</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color2?>; text-align: left; font-size: 90%;"><?php echo $num?></td>
                                <td style="color:<?php echo $color2?>; text-align: left; font-size: 90%;"><?php echo $r->val?></td>
                                <td style="color:<?php echo $color2?>; text-align: left; font-size: 90%;"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color2?>; text-align: left; font-size: 90%;"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color2?>; text-align: left; font-size: 80%;" ><?php echo trim($r->susa)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->paq,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->venta_ant,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->venta_act,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->proyeccion,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->necesidad_act,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->exis,0)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right; font-size: 90%;"><?php echo number_format($r->venta_antf,0)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right; font-size: 90%;"><?php echo number_format($r->venta_actf,0)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right; font-size: 90%;"><?php echo number_format($r->proyeccion_f,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->optimo_cedis,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right; font-size: 90%;"><?php echo number_format($r->optimo_ideal,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right; font-size: 90%;"><?php echo number_format($r->dif,0)?></td>
                                </tr>
                               <?php 
$t1=$t1+($r->venta_ant);
$t2=$t2+($r->venta_act);
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo number_format($t1,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t2,0)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>