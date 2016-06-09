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
                         <table class="table table-bordered table-condensed table-striped table-hover"  id="tabla1">
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
                        <td>___</td>
<!-- TABLA -------------------------------------------------------------------------------------------------------------->                         
                         <td>
                         <table class="table table-bordered table-condensed table-striped table-hover"  id="tabla1">
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
                                $tot=$r2->venta_acumulada+$r2->proyeccion_mes_act;
                                $tot_prom=($r2->venta_acumulada+$r2->proyeccion_mes_act)/30;
                                }
                                ?>
                              </tbody>
                         </table>
                         </td>   
<!-- TABLA -------------------------------------------------------------------------------------------------------------->
                       <td>___</td>
<!-- TABLA -------------------------------------------------------------------------------------------------------------->                         
<!-- TABLA -------------------------------------------------------------------------------------------------------------->                         
                         <td>
                         <table class="table table-bordered table-condensed table-striped table-hover"  id="tabla1">
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
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($punto_equilibrio,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($objetivo_mes,2)?></strong></td>
                                <td></td>
                                 <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  ''.number_format($objetivo_mes_sin_oficinas,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($venta_mes_ant,2)?></strong></td>
                                <td></td>
                                <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($venta_aaa_ant,2)?></strong></td>
                                <td></td>
                                </tr>
                              <tr>
                                  <td style="color: <?php echo $color1?>;  background-color: #002060; text-align: left"><strong><?php echo 'FALTA PARA META'?></strong></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($falta_equilibrio,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($falta_objetivo,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  ''.number_format($falta_objetivo_sin_oficinas,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($falta_mes_ant,2)?></strong></td>
                                  <td></td>
                                  <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($falta_aaa_ant,2)?></strong></td>
                                  <td></td>
                              </tr>
                              <tr>
                                   <td style="color: <?php echo $color1?>; background-color: #002060; text-align: left"><strong><?php echo 'VENTA PROM MINIMA DIARIA'?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($prome_equilibrio,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_equilibrio,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($prome_objetivo,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_objetivo,2)?></strong></td>
                                   <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  ''.number_format($prome_objetivo_sin_oficinas,2)?></strong></td>
                                   <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_objetivo_sin_oficinas,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($prome_mes_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_mes_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  ''.number_format($prome_aaa_ant,2)?></strong></td>
                                   <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo  '% '.number_format($porcen_aaa_ant,2)?></strong></td>
                              
                              </tr>
                             </tfoot>
                         </table>
                         </td>
</tr>
</table>
  
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
                                     <th style=" color:blue; text-align: center">NID</th>
                                     <th style=" color:blue; text-align: center">SUCURSAL</th>
                                     <th style=" color:blue; text-align: center">DIAS VENTA</th>  
                                     <th style=" color:blue; text-align: center">VENTA</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />DIARIO VENTA</th>
                                     
                                     <th style=" color:blue; text-align: center">PROYECCION<br />VENTA</th>
                                     <th style=" color:blue; text-align: center">OBJETIVO AL<br />100% ABASTO </th>
                                     <th style=" color:blue; text-align: center">%<br />ABASTO</th>
                                     <th style=" color:blue; text-align: center">OBJETIVO</th>
                                     <th style=" color:blue; text-align: center">% ALCANCE DE<br />PROYECCION VENTA<br /> CONTRA OBJETIVO</th>
                                     <th style=" color:blue; text-align: center">PUNTO DE<br />EQUILIBRIO</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue';$colorc='green';
                                $prom_dia=0;$proyeccion_vta=0;$alcance_obj=0;
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t4_=0;
                                foreach ($q4->result()as $r4){
                                $l1=anchor('finanzas/s_proyeccion_venta_detalle_suc/'.$r4->suc.'/'.$aaa.'/'.$mes,'Det');
                                $prom_dia=(($r4->venta)/($r4->dia_venta));
                                $proyeccion_vta=$prom_dia*$r4->dias_mes;
                                if($r4->objetivo_mes>0){$alcance_obj=($proyeccion_vta/($r4->objetivo_mes_abasto))*100;}else{$alcance_obj=0;}
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r4->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r4->sucx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r4->dia_venta?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($r4->venta,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($prom_dia,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($proyeccion_vta,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($r4->objetivo_mes,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  '% '.number_format(($r4->abasto_act*100),2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($r4->objetivo_mes_abasto,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  '% '.number_format($alcance_obj,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo  number_format($r4->punto_equilibrio,2)?></td>
                                
                                </tr>
                               <?php 
                                $t1=$t1+$r4->venta;
                                $t2=$t2+$prom_dia;
                                $t3=$t3+$proyeccion_vta;
                                $t4=$t4+$r4->objetivo_mes;
                                $t4_=$t4_+$r4->objetivo_mes_abasto;
                                $t5=$t5+$r4->punto_equilibrio;
                                $t6=$t6+$r4->dia_venta;
                                }
                                
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="3"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t6,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t3,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t4,2)?></strong></td>
                              <td></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t4_,2)?></strong></td>
                              <td></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t5,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- END BLANK PAGE PORTLET-->
                       </div>              
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
