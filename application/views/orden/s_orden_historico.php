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
                                 <th>Borrar</th>
                                 <th>Folio pre-orden</th>
                                 <th>Folio orden</th>
                                 <th style="text-align: left">Prv</th>
                                 <th style="text-align: left;">Proveedor</th>
                                 <th style="text-align: right;">Fecha Envio</th>
                                 <th style="text-align: right;">Fecha Limite</th>
                                 <th style="text-align: right;">Piezas</th>
                                 <th style="text-align: right;">Surtido</th>
                                 <th style="text-align: right;">% Surtido</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;$descuento=0;$iva=0;
                                foreach ($q->result() as $r) {
                                $l1 = anchor('orden/com_orden_imp/'.$r->id_orden.'/'.$r->estatus,'Imprime</a>', array('title' => 'Haz Click aqui para Imprimir Orden!', 'class' => 'encabezado'));
                                $l2 = anchor('orden/borrar_orden_cerrada/'.$r->id_orden.'/'.$r->folprv,'Borrar');
                                if($r->estatus==0){$color='red';}else{$color='blue';}
                               ?>
                                
                                <tr>
                                <td style="color: <?php echo $color ?>;"><?php echo $l2?></td>
                                <td style="color: <?php echo $color ?>;"><?php echo $r->pre_orden?></td>
                                <td style="color: <?php echo $color ?>;"><?php echo $r->folprv?></td>
                                <td style="color: <?php echo $color ?>;"><?php echo $r->prv?></td>
                                <td style="color: <?php echo $color ?>;"><?php echo $r->corto?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo $r->fecha_envio?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo $r->fecha_limite?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo number_format($r->can,0)?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo number_format($r->llego,0)?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo '%'.number_format((($r->llego/$r->can)*100),2)?></td>
                                <td style="color: <?php echo $color ?>; text-align: right;"><?php echo $l1?></td>
                                </tr>
                                <?php 
                                $num=$num+1;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>