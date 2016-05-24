                 <div class="span5">
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
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               
                               <tr>
                               <th style="text-align: center;">Fecha</th>
                               <th style="text-align: center;">Compra</th>
                               <th style="text-align: center;">Importe</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';$por=0;
                                 foreach ($q->result()as $r){
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->fecha?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->can,0)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->monto,2)?></td>
                                </tr>
                                <?php 
                                } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>