   <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>DESCUENTOS APLICADOS EN SUCURSAL</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                              <?php echo anchor('finanzas/ventas_detalle_des/','Detalle descuentos aplicados');  ?>
               
                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">NID</th>
                               <th style="text-align: left;">SUCURSAL</th>
                               <th style="text-align: left;">REPORTE</th>
                                                                
                             </thead>
                             <tbody>


                                <?php
                                $num=0;
                                foreach ($q->result()as $r) {
                                $color ='black';
                                $color1 ='orange';
                                $suc=$r->suc;
                                $l1=anchor('finanzas/ventas_des_repor/'.$suc,'Excel reporte Tarjetas desc');
                                $num=$num+1;
                                ?>

                                <tr>
                                <td style="text-align: left; color: <?php echo $color1 ?>;"><?php echo $r->suc?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $r->nombre?></td>
                                <td style="text-align: left; color: <?php echo $color ?>;"><?php echo $l1?></td>
                                                                                                
                              
                                <?php
                                }
                                ?>
                             
                               
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>