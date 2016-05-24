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
                                 <th></th>
                                 <th>Prv</th>
                                 <th style="text-align: left">Proveedor</th>
                                 <th style="text-align: right;">Compra</th>
                                 <th style="text-align: right;">Descuento</th>
                                 <th style="text-align: right;">Iva</th>
                                 <th style="text-align: right;">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;$descuento=0;$iva=0;
                                foreach ($q->result() as $r) {
                                $l1 = anchor('orden/s_pre_orden_cerrar_par/'.$r->id_pre_orden.'/'.$r->prv,$r->prv.'</a>', array('title' => 'Haz Click aqui para Cerrar Orden!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->id_pre_orden?></td>
                                <td style="color: maroon;"><?php echo $l1?></td>
                                <td style="color: maroon;"><?php echo $r->corto?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->compra,0)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->descu,2)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->iva,2)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format(($r->importe-$r->descu+$r->iva),2)?></td>
                                
                                </tr>
                                <?php 
                                $num=$num+1;
                                $compra=$compra+$r->compra;
                                $iva=$iva+$r->iva;
                                $descuento=$descuento+$r->descu;
                                $importe=$importe+($r->importe-$r->descu+$r->iva);
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="3" style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($compra,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($descuento,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($iva,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($importe,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>