                    <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    
                                     <tr>
                                        <th>Id Proveedor</th>
                                        <th>Proveedor</th>
                                        <th>Piezas<br />Pedidas</th>
                                        <th>Piezas<br />Recibidas</th>
                                        <th>Abasto<br />en piezas</th>
                                        <th>Productos<br />Pedidos</th>
                                        <th>Productos<br />Recibidos</th>
                                        <th>Abasto<br />en productos</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                $t1=0;$t2=0;$t3=0;$t4=0;$por1=0;$por2=0;
                               foreach ($q->result()as $r){
                               $l1 = anchor('proveedor/a_evaluacion_prv_det/'.$r->prv.'/'.$fec1.'/'.$fec2, $r->prv.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->razo; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->can, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->llego, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($r->abasto_can, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->prod, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->prod_sur, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($r->abasto_prod, 2); ?></td>
                                </tr>
                                <?php
                                $t1 = $t1+$r->can;
                                $t2 = $t2+$r->llego;
                                $t3 = $t3+$r->prod;
                                $t4 = $t4+$r->prod_sur; 
                                 }
                                 $por1 = (($t2/$t1)*100);
                                 $por2 = (($t4/$t3)*100);
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <td colspan="2">TOTAL</td>
                                <td style="text-align: right"><?php echo number_format($t1, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($t2, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($por1, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($t3, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($t4, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($por2, 2); ?></td>
                              </tr>
                              </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>