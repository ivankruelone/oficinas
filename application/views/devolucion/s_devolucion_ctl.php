                 <div class="span8">
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
        <th colspan="1">A&Ntilde;O</th>
        <th colspan="1">MES</th>
        <th colspan="1">RRM</th>
        <th colspan="1">PIEZAS</th>
        <th colspan="1">IMPORTE VTA</th>
        <th colspan="1">PIEZAS<br />VALIDADAS CEDIS</th>
        <th colspan="1">IMPORTE<br />VALIDADO CEDIS</th>
        <th colspan="1">% VALIDADO<br />CEDIS</th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>
         <?php  $num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$color='blue';$tot8=0;
         foreach ($q->result() as $r) {
            $l1 = anchor('devolucion/s_devolucion_pro/'.$r->aaa.'/'.$r->mes, 'Secuencia', array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
            $l2 = anchor('devolucion/s_devolucion_suc/'.$r->aaa.'/'.$r->mes, 'Sucursal', array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
            $l3 = anchor('devolucion/s_devolucion_causa/'.$r->aaa.'/'.$r->mes, 'Causa', array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                                        
                                        ?>
            <tr>
            <td style="text-align: left;"><?php echo $num ?></td>
            <td style="text-align: left;"><?php echo $r->aaa ?></td>
            <td style="text-align: left;"><?php echo $r->mesx?></td>
            <td style="text-align: right;"><?php echo number_format($r->rrm,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->piezas,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->importe_vta,2)?></td>
            <td style="text-align: right;"><?php echo number_format($r->p_validados,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->imp_validados,0)?></td>
            <td style="text-align: right;"><?php echo number_format($r->por_val,2)?></td>
            <td style="text-align: left;"><?php echo $l1 ?></td>
            <td style="text-align: left;"><?php echo $l2 ?></td>
            <td style="text-align: left;"><?php echo $l3 ?></td>
            </tr>
            <?php 
            $num=$num+1;
            $tot1=$tot1+$r->rrm;
            $tot2=$tot2+$r->piezas;
            $tot3=$tot3+$r->importe_vta;
            $tot4=$tot4+$r->p_validados;
            $tot5=$tot5+$r->imp_validados;
         }?>
                                        
        </tbody>
       <tfoot>
       <tr>
       <td colspan="3"><strong>TOTAL</strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot1,0)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot2,0)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot3,2)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot4,0)?></strong></td>
       <td style="text-align: right;"><strong><?php echo number_format($tot5,0)?></strong></td>
       <td></td>
       <td></td>
       </tr>
       </tfoot>
       </table>                        

                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->                   
                 </div>