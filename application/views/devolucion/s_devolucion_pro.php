                 <div class="span10">
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
        <th colspan="1">SEC</th>
        <th colspan="1">SUSTANCIA ACTIVA</th>
        <th colspan="1">PIEZAS</th>
        <th colspan="1">IMPORTE GENERADO</th>
        <th colspan="1">PIEZAS VALIDADAS CEDIS</th>
        <th colspan="1">IMPORTE VALIDADAS CEDIS</th>
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q->result() as $r) {
            $l1 = anchor('devolucion/s_devolucion_pro_suc/'.$r->aaa.'/'.$r->mes.'/'.$r->sec, $r->descripcion, array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r->sec ?></td>
            <td style="text-align: left;"><?php echo $l1?></td>
            <td style="text-align: right;"><?php echo number_format($r->piezas,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->importe_vta,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->validados,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->importe_val,2)?></td>
            
            </tr>
            <?php 
            $tot1=$tot1+$r->piezas;
            $tot2=$tot2+$r->importe_vta;
            $tot3=$tot3+$r->validados;
            $tot4=$tot4+$r->importe_val;
            $num=$num+1;
         
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="3">TOTAL</td>
       <td style="text-align: right;"><?php echo number_format($tot1,0)?></td>
       <td style="text-align: right;"><?php echo number_format($tot2,2)?></td>
       <td style="text-align: right;"><?php echo number_format($tot3,0)?></td>
       <td style="text-align: right;"><?php echo number_format($tot4,2)?></td>
       </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->                   
                 </div>