                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $tit; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Secuencia</th>
                            <th>Descripcion</th>
                            <th style="text-align: right;">Precio</th>
                            <th style="text-align: right;">Piezas</th>
                            <th style="text-align: right;">Importe</th>
                            <th style="text-align: right;">IVA</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $cantidad = 0;
                    $importe = 0;
                    $iva = 0;
                    
                    foreach($query->result() as $row){
                        
                        if($row->iva == 0)
                        {
                            $ivaFila = 0;
                        }else{
                            $ivaFila = ($row->vtagen / (1 + $row->iva)) * $row->cantidad;
                        }
                    
                    ?>
                        <tr>
                            <td><?php echo $row->detalle; ?></td>
                            <td><?php echo $row->sec; ?></td>
                            <td><?php echo $row->susa1; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->vtagen, 2);?></td>
                            <td style="text-align: right;"><?php echo number_format($row->cantidad, 0);?></td>
                            <td style="text-align: right;"><?php echo number_format($row->vtagen * $row->cantidad, 2);?></td>
                            <td style="text-align: right;"><?php echo number_format($ivaFila, 2);?></td>
                        </tr>
                        
                    <?php
                    
                        $cantidad = $cantidad + $row->cantidad;
                        $importe = $importe + $row->vtagen * $row->cantidad;
                        $iva = $iva + $ivaFila;
                    
                    }
                    
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right;">Totales</td>
                            <td style="text-align: right;"><?php echo number_format($cantidad, 0);?></td>
                            <td style="text-align: right;"><?php echo number_format($importe, 2);?></td>
                            <td style="text-align: right;"><?php echo number_format($iva, 2);?></td>
                        </tr>
                    </tfoot>
                </table>

                         </div>
                     </div>
                 </div>
                         