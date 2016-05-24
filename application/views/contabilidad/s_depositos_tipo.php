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
        <th colspan="1">#</th>
        <th colspan="1">NID</th>
        <th colspan="1">SUCURSAL</th>
        <th colspan="1">DIAS</th>
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
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r->suc ?></td>
            <td style="text-align: left;"><?php echo $r->nombre?></td>
            <td style="text-align: left;"><?php echo $r->dias_suc ?></td>
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

<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>