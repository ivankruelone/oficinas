                <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Insumos Totales para el Departamento </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                       <?php 
                       anchor('catalogos/s_cat_insumos_dep/', '');
                       ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla5">
                             <thead>
                             
                               <tr>
                               <th style="text-align: left;">Id</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Empaque</th>
                               <th style="text-align: left;">Maximo</th>
                               <th style="text-align: left;">Observaciones</th>
                               </tr>  
                             </thead>
                              <?php                             
                                 $num=0; $color ='blue';
                                 foreach ($query->result()as $r){
                                 $num=$num+1;   
                             
                              ?>
                             <tbody>
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->id_insumos?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->empaque?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->maxi?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->observa?></td>
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