                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">AAA</th>
                               <th style="text-align: left;">Orden</th>
                               <th style="text-align: left;">Proveedor</th>
                               <th style="text-align: left;">Cia</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0; $color='blue';
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->aaa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->folprv?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->prvx?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->cia?></td>
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