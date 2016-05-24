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
$rm=$nom->row();
$l1=anchor("finanzas/a_venta_90_dias_excel","GENERAR ARCHIVO DE EXCEL");
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr>
                                 <th colspan="9"><?php echo $l1 ?></th>
                                 </tr>
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $rm->d1?></th>
                                     <th style="text-align: center;"><?php echo $rm->d2?></th>
                                     <th style="text-align: center;"><?php echo $rm->d3?></th>
                                     <th style="text-align: center;"><?php echo $rm->d4?></th>
                                     <th style="text-align: center;"><?php echo $rm->d5?></th>
                                     <th style="text-align: center;"><?php echo $rm->d6?></th>
                                     <th style="text-align: center;"><?php echo $rm->d7?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
                                     foreach ($q1->result() as $r1) {
                                      
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia6,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->dia7,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r1->dia1;
                                        $tot2=$tot2+$r1->dia2;
                                        $tot3=$tot3+$r1->dia3;
                                        $tot4=$tot4+$r1->dia4;
                                        $tot5=$tot5+$r1->dia5;
                                        $tot6=$tot6+$r1->dia6;
                                        $tot7=$tot7+$r1->dia7;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
$rm=$nom->row();
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $rm->d1?></th>
                                     <th style="text-align: center;"><?php echo $rm->d2?></th>
                                     <th style="text-align: center;"><?php echo $rm->d3?></th>
                                     <th style="text-align: center;"><?php echo $rm->d4?></th>
                                     <th style="text-align: center;"><?php echo $rm->d5?></th>
                                     <th style="text-align: center;"><?php echo $rm->d6?></th>
                                     <th style="text-align: center;"><?php echo $rm->d7?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
                                     foreach ($q2->result() as $r2) {
                                      
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia6,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dia7,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r2->dia1;
                                        $tot2=$tot2+$r2->dia2;
                                        $tot3=$tot3+$r2->dia3;
                                        $tot4=$tot4+$r2->dia4;
                                        $tot5=$tot5+$r2->dia5;
                                        $tot6=$tot6+$r2->dia6;
                                        $tot7=$tot7+$r2->dia7;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
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
$rm=$nom->row();
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $rm->d1?></th>
                                     <th style="text-align: center;"><?php echo $rm->d2?></th>
                                     <th style="text-align: center;"><?php echo $rm->d3?></th>
                                     <th style="text-align: center;"><?php echo $rm->d4?></th>
                                     <th style="text-align: center;"><?php echo $rm->d5?></th>
                                     <th style="text-align: center;"><?php echo $rm->d6?></th>
                                     <th style="text-align: center;"><?php echo $rm->d7?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;
                                     foreach ($q3->result() as $r3) {
                                      
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia6,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->dia7,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r3->dia1;
                                        $tot2=$tot2+$r3->dia2;
                                        $tot3=$tot3+$r3->dia3;
                                        $tot4=$tot4+$r3->dia4;
                                        $tot5=$tot5+$r3->dia5;
                                        $tot6=$tot6+$r3->dia6;
                                        $tot7=$tot7+$r3->dia7;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 
                     <!-- END BLANK PAGE PORTLET-->

                 </div>