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
<table>
<tr>
  <!-- TABLA -------------------------------------------------------------------------------------------------------------->                        
                         <td>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='white';
                                foreach ($q1->result()as $r1){
                                ?>
                                <tr>
                                <td style="color: <?php echo $color?>; background-color: #002060;  text-align: left"><strong><?php echo $r1->var?></strong></td>
                                <td style="color: <?php echo $color?>; background-color: #002060; text-align: right"><strong><?php echo  number_format($r1->valor,0)?></strong></td>
                                </tr>
                               <?php 
                                
                                }
                                ?>
                              </tbody>
                         </table>
                        </td>
<!-- TABLA -------------------------------------------------------------------------------------------------------------->
                        <td>_______</td>
<!-- TABLA -------------------------------------------------------------------------------------------------------------->                         
                         <td>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='white';
                                foreach ($q2->result()as $r2){
                                ?>
                                <tr>
                                <td style="color: <?php echo $color?>; background-color: #002060;"><strong><?php echo $r2->var?></strong></td>
                                <td style="color: <?php echo $color?>; background-color: #002060; text-align: right"><strong><?php echo  '$ '.number_format($r2->venta_acumulada,2)?></strong></td>
                                <tr>
                                <td style="color: <?php echo $color?>; background-color: #002060;  text-align: left"><strong>PROYECCION DEL MES</strong></td>
                                <td style="color: <?php echo $color?>; background-color: #002060;  text-align: right"><strong><?php echo  '$ '.number_format($r2->proyeccion_mes_act,2)?></strong></td>
                                </tr>
                                <tr>
                                <td style="color: <?php echo $color?>; background-color: #002060;  text-align: left"><strong>PROMEDIO MENSUAL VENTA</strong></td>
                                <td style="color: <?php echo $color?>; background-color: #002060;  text-align: right"><strong><?php echo  '$ '.number_format($r2->prome_venta,2)?></strong></td>
                                </tr>
                                </tr>
                               <?php 
                                }
                                ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>
                         </td>   
<!-- TABLA -------------------------------------------------------------------------------------------------------------->
<!-- TABLA -------------------------------------------------------------------------------------------------------------->
 </tr>
</table>
<!-- TABLA -------------------------------------------------------------------------------------------------------------->                         
                         <td>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th></th>
                             <th colspan="2" style=" color:white; background-color: #002060; text-align: center">PUNTO DE EQUILIBRIO<br /><?php echo $mesx.' '.$aaa?></th>
                             <th colspan="2" style=" color:white; background-color: #002060; text-align: center">OBJETIVO MES<br /><?php echo $mesx.' '.$aaa?></th>
                             <th colspan="2" style=" color:white; background-color: #002060; text-align: center">OBJETIVO MES<br /><?php echo $mesx.' '.$aaa?><br />SIN GASTOS DE OFICINAS</th>
                             <th colspan="2" style=" color:white; background-color: #002060; text-align: center">VENTA DEL MES<br /><?php echo $mes_ax.' '.$aaa_a?></th>
                             <th colspan="2" style=" color:white; background-color: #002060; text-align: center">VENTA DEL MES<br /><?php echo $mesx.' '.($aaa-1)?></th>
                             </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue';$punto_equilibrio=0;$color1='white';$color2='green';
                                foreach ($q3->result()as $r3){
                                $dias=$r3->dias_mes;
                                   
                                ?>
                                
                               <?php 
                                $punto_equilibrio=$r3->punto_equilibrio;
                                $objetivo_mes=$r3->objetivo_mes;
                                $objetivo_mes_sin_oficinas=$r3->objetivo_mes_sin_oficinas;
                                $venta_mes_ant=$r3->venta_mes_ant;
                                $venta_aaa_ant=$r3->venta_aaa_ant;
                                
                                $falta_equilibrio=($r3->punto_equilibrio-$r3->venta);
                                $falta_objetivo=($r3->objetivo_mes-$r3->venta);
                                $falta_objetivo_sin_oficinas=($r3->objetivo_mes_sin_oficinas-$r3->venta);
                                $falta_mes_ant=($r3->venta_mes_ant-$r3->venta);
                                $falta_aaa_ant=($r3->venta_aaa_ant-$r3->venta);
                                //echo $r3->punto_equilibrio;
                                //die();
                                $porcen_equilibrio=(($r3->punto_equilibrio-$r3->venta)/$r3->punto_equilibrio)*100;
                                $porcen_objetivo=(($r3->objetivo_mes-$r3->venta)/$r3->objetivo_mes)*100;
                                if($r3->objetivo_mes_sin_oficinas>0){
                                $porcen_objetivo_sin_oficinas=(($r3->objetivo_mes_sin_oficinas-$r3->venta)/$r3->objetivo_mes_sin_oficinas)*100;
                                }else{$porcen_objetivo_sin_oficinas=0;}
                                $porcen_mes_ant=(($r3->venta_mes_ant-$r3->venta)/$r3->venta_mes_ant)*100;
                                $porcen_aaa_ant=(($r3->venta_aaa_ant-$r3->venta)/$r3->venta_aaa_ant)*100;
                                }
                                $prome_equilibrio=($punto_equilibrio/$dias);
                                $prome_objetivo=($objetivo_mes/$dias);
                                $prome_objetivo_sin_oficinas=($objetivo_mes_sin_oficinas/$dias);
                                $prome_mes_ant=($venta_mes_ant/$dias);
                                $prome_aaa_ant=($venta_aaa_ant/$dias);
                                ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <td style="color: <?php echo $color1?>; background-color: #002060; text-align: left;"><strong><?php echo 'META CONTADO'?></strong></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($punto_equilibrio,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($objetivo_mes,2)?></strong></td>
                                <td></td>
                                 <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  '$ '.number_format($objetivo_mes_sin_oficinas,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($venta_mes_ant,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($venta_aaa_ant,2)?></strong></td>
                                <td></td>
                                </tr>
                              <tr>
                                  <td style="color: <?php echo $color1?>;  background-color: #002060; text-align: left"><strong><?php echo 'FALTA PARA META'?></strong></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($falta_equilibrio,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($falta_objetivo,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  '$ '.number_format($falta_objetivo_sin_oficinas,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($falta_mes_ant,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($falta_aaa_ant,2)?></strong></td>
                                  <td></td>
                              </tr>
                              <tr>
                                   <td style="color: <?php echo $color1?>; background-color: #002060; text-align: left"><strong><?php echo 'VENTA PROM MINIMA DIARIA'?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($prome_equilibrio,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_equilibrio,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($prome_objetivo,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_objetivo,2)?></strong></td>
                                   <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  '$ '.number_format($prome_objetivo_sin_oficinas,2)?></strong></td>
                                   <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_objetivo_sin_oficinas,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($prome_mes_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_mes_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '$ '.number_format($prome_aaa_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_aaa_ant,2)?></strong></td>
                              
                              </tr>
                             </tfoot>
                         </table>
                         </td>  
<!-- TABLA -------------------------------------------------------------------------------------------------------------->
               </div>
                </div>
                         
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">
                             <thead>
                                 <tr>
                                     <th style=" color:blue; text-align: center">Detalle</th>
                                     <th style=" color:blue; text-align: center">FECHA</th>
                                     <th style=" color:blue; text-align: center">DIA</th>  
                                     <th style=" color:blue; text-align: center"># SUC</th>
                                     <th style=" color:blue; text-align: center">SUC.CON<br />VENTA</th>
                                     <th style=" color:blue; text-align: center">TICKET</th>
                                     <th style=" color:blue; text-align: center">VTA.CONTADO</th>
                                     <th style=" color:blue; text-align: center">VENTA<br />ACUMULADA</th>
                                     <th style=" color:blue; text-align: center">% ALCANCE</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />TICKET</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />SUCURSAL</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />NIVEL SURTIDO</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue';$colorc='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;
                                foreach ($q4->result()as $r4){
                                $l1=anchor('finanzas/s_proyeccion_venta_detalle/'.$tipo.'/'.$r4->fechacorte,'Det');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r4->fechacorte?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r4->diax?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($r4->num_suc,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r4->suc_cortes,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r4->tic,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r4->venta_contado,2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format($r4->venta_acumulada_contado,2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format($r4->por_alcance_contado,2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format(($r4->venta_contado/$r4->tic),2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format(($r4->venta_contado/$r4->suc_cortes),2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format($r4->nivel_surtido,2)?></td>
                                </tr>
                               <?php 
                               $t1=$t1+$r4->tic;
                               $t2=$t2+$r4->venta_contado;
                               $t3=$t3+$r4->venta_credito;
                               $t4=$t4+$r4->venta_servicio;
                               $t5=$t5+$r4->venta_sin_servicio;
                               $t6=$t6+$r4->venta_total;
                                
                                }
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="5"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,2)?></strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                       </div>              
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
