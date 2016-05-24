  
                <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                        <div class="widget-body">
                           
                       
                       <?php 
                       anchor('catalogos/s_cat_insumos_his_detalle/', '');
                       ?>

                       
                       <?php 
                             foreach ($query2->result() as $r)
                             {
                         ?>
                       <p>Folio: <?php echo $r->id?></p>
                       <p>Numero de Sucursal: <?php echo $r->suc?></p>
                       <p>Sucursal: <?php echo $r->nombre?></p>
                       <?php 
                       }
                       ?>
                      
                    
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
 <thead>                       
                               <tr>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Cantidad Pedida</th>
                               <th style="text-align: left;">Cantidad Surtida</th>
                               <th style="text-align: left;">Porcentaje</th>
                               </tr>  
                             </thead>
                              <?php                             
                                 $num=0; $color ='blue';
                                 foreach ($query->result()as $r){
                                 $num=$num+1;   
                             
                              ?>
                             <tbody>
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->canp?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->cans?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->porcentaje?>%</td>
                                 </tr> 
                          <?php } ?> 
                              </tbody>
                              <tfoot>
                              <tr>
                             <td colspan="6" style="text-align: left; color: <?php echo $color ?>">Total de insumos: <?php echo number_format($num,0)?></td>
                             </tr>
                              </tfoot>
                         </table>


                          
                         </div>
                     </div>
                     
                      </div>