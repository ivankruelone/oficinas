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
        <th colspan="1">RRM</th>
        <th colspan="1">NID</th>
        <th colspan="1">SUCURSAL</th>
        <th colspan="1">SEC</th>
        <th colspan="1">SUSTANCIA ACTIVA</th>
        <th colspan="1">LOTE</th>
        <th colspan="1">CADUCIDAD</th>
        <th colspan="1">PIEZAS</th>
        <th colspan="1">IMPORTE VTA</th>
        <th colspan="1">PIEZAS<br />VALIDADAS CEDIS</th>
        <th colspan="1">IMPORTE<br />VALIDADO CEDIS</th>
        <th colspan="1">% VALIDADO<br />CEDIS</th>
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q->result() as $r) {
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $r->rrm ?></td>
            <td style="text-align: left;"><?php echo $r->suc?></td>
            <td style="text-align: left;"><?php echo $r->sucx?></td>
            <td style="text-align: left;"><?php echo $r->sec?></td>
            <td style="text-align: left;"><?php echo $r->susa1?></td>
            <td style="text-align: left;"><?php echo $r->lote?></td>
            <td style="text-align: left;"><?php echo $r->caducidad?></td>
            <td style="text-align: right;"><?php echo number_format($r->piezas,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->importe_vta,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->validados,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->importe_val,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->por_val,2)?></td>
            </tr>
            <?php 
            $num=$num+1;
            $tot1=$tot1+$r->piezas;
            $tot2=$tot2+$r->importe_vta;
            $tot3=$tot3+$r->validados;
            $tot4=$tot4+$r->importe_val;
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="7"><strong>TOTAL</strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot1,0)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot2,2)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot3,0)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot4,2)?></strong></td>
       <td></td>
       </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->                   
                 </div>