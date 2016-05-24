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
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center">Prv</th>
                                    <th style="text-align: center">Proveedor</th>
                                    <th style="text-align: center">Sec</th>
                                    <th style="text-align: center">Sustancia Activa</th>
                                    <th style="text-align: center">Comprar</th>
                                    <th style="text-align: center">Costo</th>
                                    <th style="text-align: center">Descuento</th>
                                    <th style="text-align: center">Subtotal</th>
                                    <th style="text-align: center">Iva</th>
                                    <th style="text-align: center">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;$color='black';
                                foreach ($q->result() as $r) {
                                $l1 = anchor('orden/s_pre_orden_modi_sec/'.$r->id_pre_orden.'/'.$r->id,'CAMBIAR</a>', array('title' => 'Haz Click aqui para cambiar detalle!', 'class' => 'encabezado'));
                                if($r->descu>0){$color='blue';}else{$color='black';}
                               ?>
                                
                                <tr>
                                <td style="color: <?php echo $color?>;"><?php echo $l1?></td>
                                <td style="color: <?php echo $color?>;"><?php echo $r->prv?></td>
                                <td style="color: <?php echo $color?>;"><?php echo $r->corto?></td>
                                <td style="color: <?php echo $color?>;"><?php echo $r->sec?></td>
                                <td style="color: <?php echo $color?>;"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo  number_format($r->compra,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo  number_format($r->costo,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo '% '.number_format($r->descu,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo  number_format($r->importe,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo  number_format($r->iva,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo  number_format(($r->importe-$r->iva),2)?></td>
                                </tr>
                                <?php 
                                $num=$num+1;
                                $compra=$compra+$r->compra;
                                $importe=$importe+$r->importe;
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="5" style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($compra,2)?></td>
                                <td></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($importe,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>