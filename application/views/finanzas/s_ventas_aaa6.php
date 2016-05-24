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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $v1?></th>
                                     <th style="text-align: center;"><?php echo $v2?></th>
                                     <th style="text-align: center;"><?php echo $v3?></th>
                                     <th style="text-align: center;"><?php echo $v4?></th>
                                     <th style="text-align: center;"><?php echo $v5?></th>
                                     <th style="text-align: center;"><?php echo $v6?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;
                                     foreach ($q1->result() as $r1) {
                                      $l1 = anchor('compra/s_pago_mayoristas_prv/'.$r1->suc,'VENCIMIENTO CXP</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->var6,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r1->var1;
                                        $tot2=$tot2+$r1->var2;
                                        $tot3=$tot3+$r1->var3;
                                        $tot4=$tot4+$r1->var4;
                                        $tot5=$tot5+$r1->var5;
                                        $tot6=$tot6+$r1->var6;
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
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart1"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart2"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $v1?></th>
                                     <th style="text-align: center;"><?php echo $v2?></th>
                                     <th style="text-align: center;"><?php echo $v3?></th>
                                     <th style="text-align: center;"><?php echo $v4?></th>
                                     <th style="text-align: center;"><?php echo $v5?></th>
                                     <th style="text-align: center;"><?php echo $v6?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;
                                     foreach ($q2->result() as $r2) {
                                      $l1 = anchor('compra/s_pago_mayoristas_prv/'.$r2->suc,'VENCIMIENTO CXP</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->var6,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r2->var1;
                                        $tot2=$tot2+$r2->var2;
                                        $tot3=$tot3+$r2->var3;
                                        $tot4=$tot4+$r2->var4;
                                        $tot5=$tot5+$r2->var5;
                                        $tot6=$tot6+$r2->var6;
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
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart3"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart4"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;"><?php echo $v1?></th>
                                     <th style="text-align: center;"><?php echo $v2?></th>
                                     <th style="text-align: center;"><?php echo $v3?></th>
                                     <th style="text-align: center;"><?php echo $v4?></th>
                                     <th style="text-align: center;"><?php echo $v5?></th>
                                     <th style="text-align: center;"><?php echo $v6?></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;
                                     foreach ($q3->result() as $r3) {
                                      $l1 = anchor('compra/s_pago_mayoristas_prv/'.$r3->suc,'VENCIMIENTO CXP</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                       
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->var6,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r3->var1;
                                        $tot2=$tot2+$r3->var2;
                                        $tot3=$tot3+$r3->var3;
                                        $tot4=$tot4+$r3->var4;
                                        $tot5=$tot5+$r3->var5;
                                        $tot6=$tot6+$r3->var6;
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
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart5"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart6"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>