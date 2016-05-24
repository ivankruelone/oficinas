                 <div class="span7">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th>POR DIA</th>
                                     <th>POR SUC</th>  
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                    if($r->num == 12){
                                        $aaa = 2015;
                                    }else{
                                        $aaa = 2016;
                                    }
                                    $l1=anchor('finanzas/s_proyeccion_venta/DA/'.$aaa.'/'.$r->num,'Detalle por dia');
                                    $l2=anchor('finanzas/s_proyeccion_venta_suc/DA/'.$aaa.'/'.$r->num,'Detalle por suc');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->num?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                </tr>
                               <?php 
                               
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th>POR DIA</th>
                                     <th>POR SUC</th>  
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                    if($r->num == 12){
                                        $aaa = 2015;
                                    }else{
                                        $aaa = 2016;
                                    }
                                    $l1=anchor('finanzas/s_proyeccion_venta/FE/'.$aaa.'/'.$r->num,'Detalle por dia');
                                    $l2=anchor('finanzas/s_proyeccion_venta_suc/FE/'.$aaa.'/'.$r->num,'Detalle por suc');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->num?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                </tr>
                               <?php 
                               
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>