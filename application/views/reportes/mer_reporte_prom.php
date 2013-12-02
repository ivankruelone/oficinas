                 <div class="span7">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>C&oacute;digo</th>
                                        <th>Descripci&oacute;n</th>
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
                               $l1 = anchor('reportes/mer_reporte_prom_cod/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descri?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->cantidad?></td>
                                </tr>
                               <?php 
                                
                                $total= $total+($r->cantidad);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo $total?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>