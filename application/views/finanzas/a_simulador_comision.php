                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Punto de <br />Equilibrio</th>
                                     <th style="text-align: center;">Objetivo</th>
                                     <th style="text-align: center;">Nivel de <br />Surtido</th>
                                     <th style="text-align: center;">Objetivo <br />Nivel de<br />Surtido</th>
                                     <th style="text-align: center;">Venta Mayo</th>
                                     <th style="text-align: center;">Venta con<br />Incremento %<?php echo $varr1?></th>
                                     <th style="text-align: center;">Puntos de <br />Rentabilidad</th>
                                     <th style="text-align: center;">Puntos de <br />Merma</th>
                                     <th style="text-align: center;">Puntos de <br />Gastos</th>
                                     <th style="text-align: center;">Puntos de <br />Evaluacion<br />Farmacia</th>
                                     <th style="text-align: center;">Total de <br />Puntos</th>
                                     <th style="text-align: center;">Comision</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;
                                $tot6=0;$tot7=0;$numsuc=0;$venta_comi=0;
                                     foreach ($q1->result() as $r1) {
                                      
                                //suc, nom, punto_equi, obj_100, nivel_sur, obj_nivel, venta, p_rentabili, p_merma, p_gasto, p_eval, tot_puntos, comision_na                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->nom?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->punto_equi,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->obj_100,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '% '.number_format(($r1->nivel_sur*100),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->obj_nivel,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->ven_sin,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->venta_act,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->p_rentabili,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->p_merma,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->p_gasto,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->p_eval,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->tot_puntos,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->comision_na,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r1->punto_equi;
                                        $tot2=$tot2+$r1->obj_100;
                                        $tot3=$tot3+$r1->obj_nivel;
                                        $tot4=$tot4+$r1->venta_act;
                                        $tot6=$tot6+$r1->ven_sin;
                                        $tot5=$tot5+$r1->comision_na;
                                        
                                        if($r1->tot_puntos>=80)
                                        {
                                            $numsuc=$numsuc+1;
                                            $venta_comi=$venta_comi+$r1->venta_act;
                                        }
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE SUCURSALES PREMIADAS</td>
                             <td colspan="9"><?php echo $numsuc ?></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE VENTA APLICADO EN COMISION</td>
                             <td colspan="9"><?php echo number_format($venta_comi,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="6">MONTO DE COMISION PARA EL GERENTE NACIONAL</td>
                             <td colspan="9"><?php echo number_format($tot5,2)?></td>
                             </tr>
                             
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                 
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Punto de <br />Equilibrio</th>
                                     <th style="text-align: center;">Objetivo</th>
                                     <th style="text-align: center;">Nivel de <br />Surtido</th>
                                     <th style="text-align: center;">Objetivo <br />Nivel de<br />Surtido</th>
                                     <th style="text-align: center;">Venta Mayo</th>
                                     <th style="text-align: center;">Venta con<br />Incremento %<?php echo $varr2?></th>
                                     <th style="text-align: center;">Puntos de <br />Rentabilidad</th>
                                     <th style="text-align: center;">Puntos de <br />Merma</th>
                                     <th style="text-align: center;">Puntos de <br />Gastos</th>
                                     <th style="text-align: center;">Puntos de <br />Evaluacion<br />Farmacia</th>
                                     <th style="text-align: center;">Total de <br />Puntos</th>
                                     <th style="text-align: center;">Comision</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;
                                $tot6=0;$tot7=0;$numsuc=0;$venta_comi=0;
                                     foreach ($q2->result() as $r2) {
                                      
                                //suc, nom, punto_equi, obj_100, nivel_sur, obj_nivel, venta, p_rentabili, p_merma, p_gasto, p_eval, tot_puntos, comision_na                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nom?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->punto_equi,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->obj_100,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '% '.number_format(($r2->nivel_sur*100),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->obj_nivel,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->ven_sin,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->venta_act,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->p_rentabili,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->p_merma,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->p_gasto,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->p_eval,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->tot_puntos,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->comision_na,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r2->punto_equi;
                                        $tot2=$tot2+$r2->obj_100;
                                        $tot3=$tot3+$r2->obj_nivel;
                                        $tot4=$tot4+$r2->venta_act;
                                        $tot6=$tot6+$r2->ven_sin;
                                        $tot5=$tot5+$r2->comision_na;
                                        
                                        if($r2->tot_puntos>=80)
                                        {
                                            $numsuc=$numsuc+1;
                                            $venta_comi=$venta_comi+$r2->venta_act;
                                        }
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE SUCURSALES PREMIADAS</td>
                             <td colspan="9"><?php echo $numsuc ?></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE VENTA APLICADO EN COMISION</td>
                             <td colspan="9"><?php echo number_format($venta_comi,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="6">MONTO DE COMISION PARA EL GERENTE NACIONAL</td>
                             <td colspan="9"><?php echo number_format($tot5,2)?></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">

                             <thead>
                                 
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Punto de <br />Equilibrio</th>
                                     <th style="text-align: center;">Objetivo</th>
                                     <th style="text-align: center;">Nivel de <br />Surtido</th>
                                     <th style="text-align: center;">Objetivo <br />Nivel de<br />Surtido</th>
                                     <th style="text-align: center;">Venta Mayo</th>
                                     <th style="text-align: center;">Venta con<br />Incremento %<?php echo $varr3?></th>
                                     <th style="text-align: center;">Puntos de <br />Rentabilidad</th>
                                     <th style="text-align: center;">Puntos de <br />Merma</th>
                                     <th style="text-align: center;">Puntos de <br />Gastos</th>
                                     <th style="text-align: center;">Puntos de <br />Evaluacion<br />Farmacia</th>
                                     <th style="text-align: center;">Total de <br />Puntos</th>
                                     <th style="text-align: center;">Comision</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;
                                $tot6=0;$tot7=0;$numsuc=0;$venta_comi=0;
                                     foreach ($q3->result() as $r3) {
                                      
                                //suc, nom, punto_equi, obj_100, nivel_sur, obj_nivel, venta, p_rentabili, p_merma, p_gasto, p_eval, tot_puntos, comision_na                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->nom?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->punto_equi,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->obj_100,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '% '.number_format(($r3->nivel_sur*100),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->obj_nivel,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->ven_sin,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->venta_act,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->p_rentabili,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->p_merma,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->p_gasto,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->p_eval,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->tot_puntos,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->comision_na,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r3->punto_equi;
                                        $tot2=$tot2+$r3->obj_100;
                                        $tot3=$tot3+$r3->obj_nivel;
                                        $tot4=$tot4+$r3->venta_act;
                                        $tot6=$tot6+$r3->ven_sin;
                                        $tot5=$tot5+$r3->comision_na;
                                        
                                        if($r3->tot_puntos>=80)
                                        {
                                            $numsuc=$numsuc+1;
                                            $venta_comi=$venta_comi+$r3->venta_act;
                                        }
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE SUCURSALES PREMIADAS</td>
                             <td colspan="9"><?php echo $numsuc ?></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE VENTA APLICADO EN COMISION</td>
                             <td colspan="9"><?php echo number_format($venta_comi,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="6">MONTO DE COMISION PARA EL GERENTE NACIONAL</td>
                             <td colspan="9"><?php echo number_format($tot5,2)?></td>
                             </tr>
                             
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget yellow">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo4?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla4">

                             <thead>
                                 
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Punto de <br />Equilibrio</th>
                                     <th style="text-align: center;">Objetivo</th>
                                     <th style="text-align: center;">Nivel de <br />Surtido</th>
                                     <th style="text-align: center;">Objetivo <br />Nivel de<br />Surtido</th>
                                     <th style="text-align: center;">Venta Mayo</th>
                                     <th style="text-align: center;">Venta con<br />Incremento %<?php echo $varr4?></th>
                                     <th style="text-align: center;">Puntos de <br />Rentabilidad</th>
                                     <th style="text-align: center;">Puntos de <br />Merma</th>
                                     <th style="text-align: center;">Puntos de <br />Gastos</th>
                                     <th style="text-align: center;">Puntos de <br />Evaluacion<br />Farmacia</th>
                                     <th style="text-align: center;">Total de <br />Puntos</th>
                                     <th style="text-align: center;">Comision</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;
                                $tot6=0;$tot7=0;$numsuc=0;$venta_comi=0;
                                     foreach ($q4->result() as $r4) {
                                      
                                //suc, nom, punto_equi, obj_100, nivel_sur, obj_nivel, venta, p_rentabili, p_merma, p_gasto, p_eval, tot_puntos, comision_na                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r4->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r4->nom?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->punto_equi,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->obj_100,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '% '.number_format(($r4->nivel_sur*100),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->obj_nivel,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->ven_sin,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->venta_act,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->p_rentabili,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->p_merma,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->p_gasto,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->p_eval,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->tot_puntos,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r4->comision_na,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r4->punto_equi;
                                        $tot2=$tot2+$r4->obj_100;
                                        $tot3=$tot3+$r4->obj_nivel;
                                        $tot4=$tot4+$r4->venta_act;
                                        $tot6=$tot6+$r4->ven_sin;
                                        $tot5=$tot5+$r4->comision_na;
                                        
                                        if($r4->tot_puntos>=80)
                                        {
                                            $numsuc=$numsuc+1;
                                            $venta_comi=$venta_comi+$r4->venta_act;
                                        }
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE SUCURSALES PREMIADAS</td>
                             <td colspan="9"><?php echo $numsuc ?></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE VENTA APLICADO EN COMISION</td>
                             <td colspan="9"><?php echo number_format($venta_comi,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="6">MONTO DE COMISION PARA EL GERENTE NACIONAL</td>
                             <td colspan="9"><?php echo number_format($tot5,2)?></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo5?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla5">

                             <thead>
                                 
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Punto de <br />Equilibrio</th>
                                     <th style="text-align: center;">Objetivo</th>
                                     <th style="text-align: center;">Nivel de <br />Surtido</th>
                                     <th style="text-align: center;">Objetivo <br />Nivel de<br />Surtido</th>
                                     <th style="text-align: center;">Venta Mayo</th>
                                     <th style="text-align: center;">Venta con<br />Incremento %<?php echo $varr5?></th>
                                     <th style="text-align: center;">Puntos de <br />Rentabilidad</th>
                                     <th style="text-align: center;">Puntos de <br />Merma</th>
                                     <th style="text-align: center;">Puntos de <br />Gastos</th>
                                     <th style="text-align: center;">Puntos de <br />Evaluacion<br />Farmacia</th>
                                     <th style="text-align: center;">Total de <br />Puntos</th>
                                     <th style="text-align: center;">Comision</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;
                                $tot6=0;$tot7=0;$numsuc=0;$venta_comi=0;
                                     foreach ($q5->result() as $r5) {
                                      
                                //suc, nom, punto_equi, obj_100, nivel_sur, obj_nivel, venta, p_rentabili, p_merma, p_gasto, p_eval, tot_puntos, comision_na                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r5->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r5->nom?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->punto_equi,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->obj_100,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '% '.number_format(($r5->nivel_sur*100),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->obj_nivel,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->ven_sin,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->venta_act,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->p_rentabili,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->p_merma,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->p_gasto,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->p_eval,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->tot_puntos,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r5->comision_na,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r5->punto_equi;
                                        $tot2=$tot2+$r5->obj_100;
                                        $tot3=$tot3+$r5->obj_nivel;
                                        $tot4=$tot4+$r5->venta_act;
                                        $tot6=$tot6+$r5->ven_sin;
                                        $tot5=$tot5+$r5->comision_na;
                                        
                                        if($r5->tot_puntos>=80)
                                        {
                                            $numsuc=$numsuc+1;
                                            $venta_comi=$venta_comi+$r5->venta_act;
                                        }
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE SUCURSALES PREMIADAS</td>
                             <td colspan="9"><?php echo $numsuc ?></td>
                             </tr>
                             <tr>
                             <td colspan="6">TOTAL DE VENTA APLICADO EN COMISION</td>
                             <td colspan="9"><?php echo number_format($venta_comi,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="6">MONTO DE COMISION PARA EL GERENTE NACIONAL</td>
                             <td colspan="9"><?php echo number_format($tot5,2)?></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                 </div>