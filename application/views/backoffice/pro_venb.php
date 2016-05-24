                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Back</th>
                               <th style="text-align: left;">Mes</th>
                               <th style="text-align: left;">Tipo</th>
                               <th style="text-align: left;">Nid</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th style="text-align: left;">Dias</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($q->result()as $r){
                                 
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->back?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->mes?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tipo2?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                   <td style="color:<?php echo $color1?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo number_format($r->dias,0)?></td>
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