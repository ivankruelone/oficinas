                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

        <thead>
        <tr>
        <th colspan="1">#</th>
        <th colspan="1">A&Ntilde;O</th>
        <th colspan="1">MES</th>
        <th colspan="1">SUCURSALES CON MOV.</th>
        <th colspan="1">MONEDA NACIONAL</th>
        <th colspan="1">CONV.DE DOLAR</th>
        <th colspan="1">VALES</th>
        <th colspan="1">TARJETA BBV</th>
        <th colspan="1">TARJETA SANTANDER</th>
        <th colspan="1">TARJETA <br />AMERICAN EXP</th>
        <th colspan="1">TOTAL</th>
        
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q->result() as $r) {
            $l1 = anchor('contabilidad/s_depositos_tipo/'.$r->aaa.'/'.$r->mes.'/'.$r->tipo3, $r->mesx, array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r->aaa ?></td>
            <td style="text-align: left;"><?php echo $l1?></td>
            <td style="text-align: right;"><?php echo number_format($r->num_suc,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->pesos,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->mn,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->vales,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->bbv,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->san,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->exp,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->total,2)?></td>
            
            </tr>
            <?php 
            $num=$num+1;
         $tot1=$tot1+$r->pesos;
         $tot2=$tot2+$r->mn;
         $tot3=$tot3+$r->vales;
         $tot4=$tot4+$r->bbv;
         $tot5=$tot5+$r->san;
         $tot6=$tot6+$r->exp;
         $tot7=$tot7+$r->total;
         
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong>TOTAL</strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot7,2)?></strong></td>
       
        </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

        <thead>
        <tr>
        <th colspan="1">#</th>
        <th colspan="1">A&Ntilde;O</th>
        <th colspan="1">MES</th>
        <th colspan="1">SUCURSALES CON MOV.</th>
        <th colspan="1">MONEDA NACIONAL</th>
        <th colspan="1">CONV.DE DOLAR</th>
        <th colspan="1">VALES</th>
        <th colspan="1">TARJETA BBV</th>
        <th colspan="1">TARJETA SANTANDER</th>
        <th colspan="1">TARJETA <br />AMERICAN EXP</th>
        <th colspan="1">TOTAL</th>
        
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q1->result() as $r1) {
            $l1 = anchor('contabilidad/s_depositos_tipo/'.$r1->aaa.'/'.$r1->mes.'/'.$r1->tipo3, $r1->mesx, array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        
             ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r1->aaa ?></td>
            <td style="text-align: left;"><?php echo $l1?></td>
            <td style="text-align: right;"><?php echo number_format($r1->num_suc,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->pesos,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->mn,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->vales,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->bbv,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->san,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->exp,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r1->total,2)?></td>
            
            </tr>
            <?php 
            $num=$num+1;
         $tot1=$tot1+$r1->pesos;
         $tot2=$tot2+$r1->mn;
         $tot3=$tot3+$r1->vales;
         $tot4=$tot4+$r1->bbv;
         $tot5=$tot5+$r1->san;
         $tot6=$tot6+$r1->exp;
         $tot7=$tot7+$r1->total;
         
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong>TOTAL</strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot7,2)?></strong></td>
       
        </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart1">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">

        <thead>
        <tr>
        <th colspan="1">#</th>
        <th colspan="1">A&Ntilde;O</th>
        <th colspan="1">MES</th>
        <th colspan="1">SUCURSALES CON MOV.</th>
        <th colspan="1">MONEDA NACIONAL</th>
        <th colspan="1">CONV.DE DOLAR</th>
        <th colspan="1">VALES</th>
        <th colspan="1">TARJETA BBV</th>
        <th colspan="1">TARJETA SANTANDER</th>
        <th colspan="1">TARJETA <br />AMERICAN EXP</th>
        <th colspan="1">TOTAL</th>
        
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q2->result() as $r2) {
            $l1 = anchor('contabilidad/s_depositos_tipo/'.$r2->aaa.'/'.$r2->mes.'/'.$r2->tipo3, $r2->mesx, array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r2->aaa ?></td>
            <td style="text-align: left;"><?php echo $l1?></td>
            <td style="text-align: right;"><?php echo number_format($r2->num_suc,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->pesos,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->mn,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->vales,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->bbv,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->san,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->exp,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r2->total,2)?></td>
            
            </tr>
            <?php 
            $num=$num+1;
         $tot1=$tot1+$r2->pesos;
         $tot2=$tot2+$r2->mn;
         $tot3=$tot3+$r2->vales;
         $tot4=$tot4+$r2->bbv;
         $tot5=$tot5+$r2->san;
         $tot6=$tot6+$r2->exp;
         $tot7=$tot7+$r2->total;
         
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong>TOTAL</strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot6,2)?></strong></td>
       <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot7,2)?></strong></td>
       
        </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
  <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart2">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->                   
                 </div>