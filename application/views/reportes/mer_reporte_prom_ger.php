                 <div class="span7">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php
	$r0=$b->row();
?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="3" style="color: red;">VENTA DE PIEZAS TOTALES GENERICOS Y DR. DESCUENTO   =<?php
	echo $r0->cantidad;
?></th>
                                 </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Empleado</th>
                                        <th>Cantidad</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $total=0;
                                foreach ($a->result()as $r){
                               $num=$num+1;
                               $l1 = anchor('reportes/mer_reporte_prom_cod_ger/'.$r->nomina,$r->completo.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->cantidad?></td>
                                </tr>
                               <?php 
                                
                                $total= $total+($r->cantidad);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo $total?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>