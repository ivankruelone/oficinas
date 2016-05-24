                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Productos de Genericos para sucursales Fenix</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                          <caption></caption> 
                             <thead>
                                 <tr>
                                     <th>Secuencia</th>
                                     <th>Sustancia Activa</th>
                                     <th>Venta Publico</th>
                                                                         
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;
                                foreach ($a as $r) {
                                
                                $num=$num+1;
                                ?>
                                <tr>
                                    <td><?php echo $r['sec']?></td>
                                    <td><?php echo $r['susa']?></td>
                                    <td><?php echo $r['venta_pub']?></td>
                                                                       
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>