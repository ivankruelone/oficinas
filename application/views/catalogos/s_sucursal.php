                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Cia</th>
                               <th style="text-align: left;">Nid</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th style="text-align: left;">Direccion</th>
                               <th style="text-align: left;">Col</th>
                               <th style="text-align: left;">Poblacion</th>
                               <th style="text-align: left;">Edo</th>
                               <th style="text-align: left;">Estado</th>
                               <th style="text-align: left;">Lat</th>
                               <th style="text-align: left;">Lon</th>
                               <th style="text-align: left;">tel</th>
                               <th style="text-align: left;">tel</th>
                               <th style="text-align: left;">tel</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0; $color='gray';
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->cia?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->dire?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->col?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->pobla?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->estado?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->edo?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->lat?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->lon?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tel?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tel1?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tel_actual?></td>
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