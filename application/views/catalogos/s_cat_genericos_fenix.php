                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
//$l0 = anchor('catalogos/s_cat_insumos_nuevo/', 'Agregar nuevo insumo');
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Clas</th>
                               <th style="text-align: left;">Sec</th>
                               <th style="text-align: left;">Sustancia Activa</th>
                               <th style="text-align: left;">Venta Almacen_Fenix</th>
                               <th style="text-align: left;">Venta publico Contado sin IVA</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';
                                 foreach ($q->result()as $r){
                              
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tipo?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->sec?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->susa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->cos_almacen?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->venta_pub?></td>
                                 </tr> 
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>